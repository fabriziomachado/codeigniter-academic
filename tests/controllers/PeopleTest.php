<?php


/**
 * @group Controller
 * @backupGlobals disabled
 */
class PeopleTest extends CIUnit_TestCase
{
    public function setUp()
    {
        // Set the tested controller
        $this->CI = set_controller('people');
    }
    
    public function testWelcomeController()
    {
#        // Call the controllers method
#        $this->CI->index(2);
#        
#        // Fetch the buffered output
#        $out = output();
#        
#        // Check if the content is OK
#        $this->assertSame(0, preg_match('/(error|notice)/i', $out));
    }
    
    public function _testShouldShowTitle(){
             
             # para funcionar os testes de views tem que chamar 
             # as views da forma padrão do CI no controlador
             
             #$this->post_params['login'] = 'fabrizio';
             #$_POST = $this->post_params;
             #$assigned_vars = viewvars();
             
             $this->CI->index(1);
            
             #$output = output();
             $output = $this->CI->output->get_output();
             #echo $output; 
             #echo $this->CI->output->_display(); 

            $this->assertRegExp('/Rendering a collection of partials/', $output);
            # $this->assertSame(1, preg_match('/(fabrizio|error|notice)/i', $output));
            
    }
}
