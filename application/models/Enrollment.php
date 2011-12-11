<?php
class Enrollment extends ActiveRecord\Model {
  
   static $validates_uniqueness_of = array(
	      array('year', 'message' => 'blech')
	    );

   static $belongs_to = array(
     array('student')
   );
}
