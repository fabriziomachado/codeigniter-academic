<?php
include_once dirname(__FILE__) . '/../support/enviromment.php';

/**
 * @group models
 */
class EnrollmentTest extends CIUnit_TestCase {

    protected $tables = array(
        'enrollments' => 'enrollments',
        'people' => 'people'
    );


    public function setUp() {
        $this->CI->load->spark('php-activerecord/0.0.1');
        parent::setUp();
    }

    public function tearDown() {
        parent::tearDown();
    }


    public function testShouldBelongsToAnStudent() {
        $enroll = Enrollment::first();
        $this->assertEquals('Paola de Oliveira', $enroll->student->name);
    }

}
