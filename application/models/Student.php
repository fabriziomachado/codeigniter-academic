<?php
class Student extends Person {
    
    static $primary_key = 'id';
    static $has_many = array(array('enrollments'));

    public function  __construct(array $attributes = array()) {
        parent::__construct(array_merge($attributes,array('type'=> __CLASS__ )));
    }
}
