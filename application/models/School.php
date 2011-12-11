<?php
 class School extends ActiveRecord\Model {
   static $has_many = array(
     array('people')
   );
 }
