<?php
include_once dirname(__FILE__) . '/../support/enviromment.php'; 

/**
 * @group models
 */

class AccountTest extends CIUnit_TestCase
{
	protected $tables = array(
		'accounts' => 'accounts',
		'people' => 'people'
	);
	
	
	public function setUp()
	{
        $this->CI->load->spark('php-activerecord/0.0.1');
        
        $this->account = new  Account(array('provider' => 'twitter','login' => 'Maria da Silva'));
        
        parent::setUp();
	}
	
	public function tearDown()
	{
		parent::tearDown();
	}


    public function testShouldSuccessWithValidProvider()
	{
        $this->account->save(); 
        $actual_is_valid = $this->account->errors->is_invalid('provider');
        
        $this->assertFalse($actual_is_valid );
	
	}

    public function testShouldErrorMessageWithInvalidProvider()
	{

    	 $this->account->provider = 'gmail';
         $this->account->save(); 
        
        $expected_message = 'Not included in the list of valids providers autentications';
        $actual_message   =  $this->account->errors->on('provider');
        $actual_is_valid =  $this->account->errors->is_invalid('provider');
        
        $this->assertTrue($actual_is_valid );
        $this->assertEquals($expected_message, $actual_message);
    }
    
    public function testShould()
	{

	   $account = Account::find_by_provider_and_login('twitter','fabriziocolombo');
	   $account->login . PHP_EOL;
	   $account->person->name;
	}


	
}
