<?php
include_once dirname(__FILE__) . '/../support/enviromment.php'; 

/**
 * @group models
 */

class UserTest extends CIUnit_TestCase
{
	protected $tables = array(
		'users' => 'users'
	);
	
	private $_pcm;
	
	public function __construct($name = NULL, array $data = array(), $dataName = '')
	{
		parent::__construct($name, $data, $dataName);
	}
	
	public function setUp()
	{
		/*
		* this is an example of how you would load a product model,
		* load fixture data into the test database (assuming you have the fixture yaml files filled with data for your tables),
		* and use the fixture instance variable

		$this->CI->load->model('Product_model', 'pm');
		$this->pm=$this->CI->pm;
		$this->dbfixt('users', 'products');
		
		the fixtures are now available in the database and so:
		$this->users_fixt;
		$this->products_fixt;
		
		*/
		
		//$this->CI->load->model('Phone_carrier_model');
		//$this->_pcm = User$this->CI->Phone_carrier_model;
                ## Now do a simple find by primary key

                $this->CI->load->spark('php-activerecord/0.0.1');
                //$this->_pcm = User::all();
                //print_r($this->_pcm);

                parent::setUp();

	}
	
	public function tearDown()
	{
		parent::tearDown();
	}

        /**
	 * @dataProvider GetAllUsersProvider
	 */
        public function testFind($id, $attributes, $expected)
	{
		$actual = $this->_pcm = User::all($id);
                //print_r($actual->email_address);
		//$this->assertNotEquals('verizon@unesc.net',$actual->email_address );
                $this->assertEquals($expected, $actual->email_address);
	}


	public function GetAllUsersProvider()
	{
		return array(
			array(1,'verizon@unesc.net', 'verizon@unesc.net'),
			array(2,'att@unesc.net','att@unesc.net'),
			array(3,'sprint@unesc.net', 'sprint@unesc.net'),
		);
	}

	// ------------------------------------------------------------------------
//	
//	/**
//	 * @dataProvider GetCarriersProvider
//	 */
//	public function testGetCarriers(array $attributes, $expected)
//	{
//		$actual = $this->_pcm->getCarriers($attributes);
//		$this->assertEquals($expected, count($actual));
//	}
//
//	public function GetCarriersProvider()
//	{
//		return array(
//			array(array('name'), 5)
//		);
//	}
	
	// ------------------------------------------------------------------------
	
}
