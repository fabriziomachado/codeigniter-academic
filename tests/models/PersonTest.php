<?php
include_once dirname(__FILE__) . '/../support/enviromment.php';
/**
 * @group models
 */
class PersonTest extends CIUnit_TestCase {

    protected $tables = array(
            'people' => 'people'
    );


    public function setUp() {
        $this->CI->load->spark('php-activerecord/0.0.1');
        //$this->dbfixt('people');

        parent::setUp();
    }

    public function tearDown() {
        parent::tearDown();
    }


    public function testShouldImplementSingleTableInheritance() {
        $person  = new Person();
        $studend = new Student();
        $teacher = new Teacher();

        $person = Person::find(5);

        $expected = array($person->type, $studend->type, $teacher->type);
        $actual   = array(NULL,'Student', 'Teacher');

        $this->assertEquals($expected, $actual);
        
    }


    public function testShoulHaveUniqueId() {
        
        $this->setExpectedException('ActiveRecord\DatabaseException','',23000);

        $person  = new Person();

        $person->id = 1;
        $person->name = 'dummy';
        $person->save();

    }
    
}
