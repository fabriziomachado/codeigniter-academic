<?php
include_once dirname(__FILE__) . '/../support/enviromment.php'; 

// @TODO: excluir depois feito so para testar reflexão em metodos privvados
class Foo {
  private function myPrivateMethod() {
    return 'blah';
  }
}

/**
 * @group models
 */
class AuthenticationServiceTest extends CIUnit_TestCase
{

	protected $tables = array(
		'accounts' => 'accounts',
		'people' => 'people'
	);
	
	public function setUp()
	{
        	$this->CI->load->spark('php-activerecord/0.0.1');
	        $this->CI->load->library('session');
   	        parent::setUp();
	}
	
	public function tearDown()
	{
		parent::tearDown();
	}

    public function testShouldRegisterCurrentUserInSessionWhenGivenAValidTwitterAccount()
    {
    
	     $account = new Account(array('login' => 'fabriziocolombo'));
	     $person_return  = new Person(array('id' => 7, 'name'=>'Fabrizio Colombo'));
                  
         $autenticationMock = $this->getMock('TwitterAuthentication', 
                                        array('authenticate'), array(), '', 
                                        FALSE, FALSE, FALSE);
                                        
         $autenticationMock->expects($this->once())
                       ->method('authenticate')
                       ->with($this->isInstanceOf(new Account()))
                       ->will($this->returnValue($person_return));

          $service = new AuthenticationService($autenticationMock);
          $current_user = $service->authenticate($account);
         
          $username_registered_in_session_expected = 'Fabrizio Colombo';
          $username_registered_in_session_actual   = $this->CI->session->userdata('current_user')->name;
         
          $this->assertEquals($username_registered_in_session_expected,
                              $username_registered_in_session_actual);
          #$this->assertTrue($autenticationMock instanceof Authentication);
    
    }

    public function testShouldNotRegisterCurrentUserInSessionWhenGivenAInvalidTwitterAccount()
    {
    
         $account_invalid = new Account(array('login' => 'invali_username'));
                  
         $autenticationMock = $this->getMock('TwitterAuthentication', 
                                        array('authenticate'), array(), '', 
                                        FALSE, FALSE, FALSE);
                                        
         $autenticationMock->expects($this->once())
                       ->method('authenticate')
                       ->with($this->isInstanceOf(new Account()))
                       ->will($this->returnValue(FALSE));

          $service = new AuthenticationService($autenticationMock);
          $current_user = $service->authenticate($account_invalid);

          $this->assertFalse($current_user);
    
    }

    public function testShouldRegisterCurrentUserInSessionWhenGivenAValidErpAccount()
    {
         $attributes = array('login' => 'jms', 'password' => '123456');
	     $account = new Account($attributes);
         
         $session = $this->CI->session; //array(); 
          
         $service = new AuthenticationService(new ErpAuthentication());
         $current_user = $service->authenticate($account);
          
         $this->assertEquals('Joao Marcos', $this->CI->session->userdata('current_user')->name );
    }
    
    public function testShouldNotRegisterCurrentUserInSessionWhenGivenAInvalidErpAccount()
    {
         $attributes = array('login' => 'invalid', 'password' => 'nonono');
	     $account = new Account($attributes);
          
         $service = new AuthenticationService(new ErpAuthentication());
         $current_user = $service->authenticate($account);

         $this->assertFalse($current_user);
    }    

    public function testShouldRegisterCurrentUserInSessionUsingADslOwn()
	{
	    $attributes = array('login' => 'jms', 'password' => '123456');
	    $account = new Account($attributes);
	    $session = $this->CI->session;
    
	    $current_user = AuthenticationService::register($account)
	                                //->in($session)
	                                ->using('erp');    

        $this->assertEquals('Joao Marcos', $this->CI->session->userdata('current_user')->name );	                                
    }  
    
    public function testShouldRegisterCurrentUserInSessionUsingReflection()
	{    
	    ## desta forma não funcionaria pq o método é privado
	    #$foo = new Foo;
	    #$this->assertEquals('blah', $foo->myPrivateMethod());
	    
	    ## por reflexão é possivel mudar a visibilidade do método antes do teste
	    $method = new ReflectionMethod('Foo', 'myPrivateMethod');
	    $method->setAccessible(TRUE);
	    $this->assertEquals('blah', $method->invoke(new Foo));
    }           
	
}
