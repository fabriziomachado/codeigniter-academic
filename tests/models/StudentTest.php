<?php
include_once dirname(__FILE__) . '/../support/enviromment.php';

/**
 * @group models 
 */
class StudentTest extends CIUnit_TestCase
{
    # load fixtures
    protected $tables = array(
        'enrollments' => 'enrollments',
        'people' => 'people'
    );
    
	public function setUp()
	{
        $this->CI->load->spark('php-activerecord/0.0.1');
		parent::setUp();
	}

	public function tearDown()
	{
		parent::tearDown();
	}

    public function testShouldBeSubclassOfPerson() {
        $this->assertInstanceOf('Person', new Student());
    }

#    public function testShouldBeAnSubclassOfPerson()
#	{
#        $this->assertTrue(is_subclass_of(new Student(), 'Person'));
#	}
	
    public function testShouldBeAnInstanceOfStudent() {
        $this->assertInstanceOf('Student', new Student());
    }

    public function testShouldHaveManyEnrollments()
	{
        $student = Student::find(1);
        $this->assertEquals(2, count($student->enrollments));
	}
	
	
	public function testShouldHaveManyEnrollmentsWithStub()
	{
	   $obj1 = array('id' => 1, 'student_id' =>1, 'year' => 2010 );
  	   $obj2 = array('id' => 2, 'student_id' =>1, 'year' => 2011 );
  	   $obj3 = array('id' => 3, 'student_id' =>1, 'year' => 2012 );
  	   
       $enrollments = array($obj1, $obj2, $obj3);

       $student_stub = $this->getMockBuilder('Student', array('find'))
                     ->disableOriginalConstructor()
                     ->getMock();
        
       $student_stub::staticExpects($this->any())
              ->method('find')->with(5)
              ->will($this->returnValue($enrollments));

      
 
       $this->assertEquals(3, count($student_stub::find(5)));


	}
	
    public function testShouldHaveAName()
	{
        $student = Student::create(array('name' => null));
        $this->assertContains("Name can't be blank", $student->errors->full_messages());
	}	
	
    public function testShouldCreateEnrollment()
	{
	
     	#$this->setExpectedException('ActiveRecord\DatabaseException','',23000);
        #print_r(Student::exists(11));	
        $student = Student::find(1);
        $student->create_enrollments(array('year'=>2008));
        $student->create_enrollments(array('year'=>2009));

        $this->assertTrue($student->is_valid());
        #echo join(', ',$student->errors->full_messages());
	}	
	
	public function testShouldInvalidWhenNoHaveAName()
	{
	    $student = new Student();
        $student->name = NULL;
        $this->assertTrue($student->is_invalid());
	}
	
}
