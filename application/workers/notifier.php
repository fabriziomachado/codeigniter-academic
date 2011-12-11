<?php #if (!defined('BASEPATH')) {  exit('No direct script access allowed'); }

class Notifier  {
    
    private $CI;
    
    public function __construct()
    {  
        $this->CI =& get_instance();
        $this->CI->load->spark('restclient/2.0.0');
        $this->CI->load->library('rest');
        $this->url_server = 'http://localhost:8000/';
    } 


    public function publish($channel, $message)
    {
        $this->CI->rest->initialize(array('server' => 'http://localhost:8000/',
                                          'http_user' => 'admin',
                                          'http_pass' => 'secret',
                                          'http_auth' => 'basic'));
        $this->CI->rest->post($channel , array('title' => 'NOTICE', 'message'=> $message), 'json');
    }
}

