<?php

/**
 * @group Helper
 */

class PartialsHelperTest extends CIUnit_TestCase
{
	public function setUp()
	{
  	    $this->CI->load->helper('partials');

        $this->peoples = (object) array((object) array('name'=>'John'), (object) array('name'=>'Michael'));
        $this->locals_vars = array('peoples'=> $this->peoples,'say_hello'=> 'Hello World');
		  
	}
	

	public function testReturnsAPartialOfAView()
	{
	    $partial       = TESTSPATH . 'fixtures/_list_peoples_view_fixt.php';
	    $expected_html = TESTSPATH . 'fixtures/_list_peoples_view_output.html';
	
	    $output_html =  render_partial($partial, $this->locals_vars );

        $this->assertStringEqualsFile( $expected_html ,  $output_html);
	}
	
	public function testReturnsAPartialForEachItemInTheCollection()
	{
        $partial       = TESTSPATH . 'fixtures/_peoples_view_fixt.php';
        $expected_html = TESTSPATH . 'fixtures/_peoples_view_output.html';

        $output_html = render_partial($partial, $this->locals_vars, $this->peoples );

        $this->assertStringEqualsFile( $expected_html ,  $output_html);
	}
}
