<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @group Controller
 * @backupGlobals disabled
 */
class WelcomeTest extends CIUnit_TestCase
{
    public function setUp()
    {
        $this->CI = set_controller('welcome');
    }
    
    public function testShouldRenderingAPartialsWithLocals(){
             
             $this->post_params['login'] = 'fabrizio';
             $this->CI->index(1);          
             $output = $this->CI->output->get_output();
 
            $this->assertRegExp('/Hello World, John/', $output);
             
    }
    
    public function testShouldRenderingACollectionOfPartials(){
             
             #$this->post_params['login'] = 'fabrizio';
             $this->CI->index(5);          
             $output = $this->CI->output->get_output();
 
            $this->assertRegExp('/Hello,  John \(0\)/', $output);
             
    }    
}
