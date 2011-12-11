<?php if (!defined('BASEPATH')) {  exit('No direct script access allowed'); }



class AuthenticationService {

    private $provider;
    private $account;
    private $CI;    

    public function  __construct( $provider) {
       #echo "AuthenticationService::contruction" . PHP_EOL;
       $this->provider = $provider;
       $this->CI  =& get_instance();
    }
   
   public function authenticate(Account $account, $session = null)
   {  
        #echo "AuthenticationService::register" . PHP_EOL;
        $current_user = $this->provider->authenticate($account);    

        $this->CI->session = $session ? $session : $this->CI->session;
        $this->CI->session->set_userdata('current_user', null);
        
        // register current user in session
 	    if($current_user)
 	    {   
 	        $para = new stdClass();
            $para->id = $current_user->id;
            $para->name = $current_user->name;
        
 	        $parameters = array('id' => $current_user->id, 'name' => $current_user->name);
 	        $this->CI->session->set_userdata('current_user',$para);
 	     }   
   
        return $current_user;
   }

    static public function register(Account $account)
    {   
        #echo "AuthenticationService::registerdsl" . PHP_EOL;
        
        $authentication_service =  new self(null);
        $authentication_service->account = $account;
        
        return $authentication_service;
    }
   
    public function in($session)
    {
        #echo "AuthenticationService::using" . PHP_EOL;
        $this->session = $session;
        return $this;
    }
    
    public function using($provider)
    {
        #echo "AuthenticationService::using" . PHP_EOL;
        $this->provider = $this->build($provider);
        $this->authenticate($this->account);
        
    }
    
    private function build($provider) 
    {
        #echo "AuthenticationService::build" . PHP_EOL;
        
        $provider = ucfirst(strtolower($provider)).'Authentication';
        if (class_exists($provider))
            return new $provider();
        else
            throw new Exception("Class {$provider} not found!");
    }      

}
