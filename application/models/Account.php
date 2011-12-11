<?php
class Account extends ActiveRecord\Model {

    
    static $belongs_to = array(
      array('person')
    );
    
    static $validates_inclusion_of = array(
       array('provider', 'in' => array('twitter','facebook'),
             'message' => 'Not included in the list of valids providers autentications' )
    );
	


 }
