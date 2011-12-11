<?php
class Person extends ActiveRecord\Model {
    
	static $validates_presence_of = array(array('name'));
	
	static $has_many = array(array('accounts'));

    public function  __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }
 }
