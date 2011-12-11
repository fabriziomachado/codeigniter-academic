<?php

/**
 * @group Lib
 */

#include_once APPPATH . 'hooks/layout.php';

class Layout extends CIUnit_TestCase
{
    public function setUp()
    {
        // Set up fixtures to be run before each test
        
        // Load the tested library so it will be available in all tests
        //$this->CI->load->library('example_lib', '', mylib);
        
        #$reflection = new ReflectionClass('Layout');
        #var_dump($reflection->getMethods());
        
        //$LAYOUT =& load_class('layout', 'hooks', '');
        //$this->CI->load->hook('layout');
        
        #$lay =  new Layout;
        //echo $LAYOUT->initx();

        
    }
    
    public function testMethod()
    {
        // Check if everything is ok
        //$this->assertEquals(4, $this->CI->mylib->add(2, 2));
    }
}
