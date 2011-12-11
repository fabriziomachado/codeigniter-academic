<?php
class Teacher extends Person {
    static $primary_key = 'id';

    public function  __construct(array $attributes = array()) {
        parent::__construct(array_merge($attributes,array('type'=> __CLASS__ )));
    }
}
