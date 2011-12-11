<?php
class Phone_carrier_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function  getCarriers($attributes)
    {
         return $this->db->get('phone_carrier')->result();
    }

}