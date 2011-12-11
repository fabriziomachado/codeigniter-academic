<?php if (!defined('BASEPATH')) {  exit('No direct script access allowed'); }

class TwitterAuthentication implements Authentication {

    private $CI;
    
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->library('tweet');
        
    }

    public function authenticate(Account $account) {

        #echo 'TwitterAuthentication::autenticate' . PHP_EOL;
        
        $tokens  = $this->CI->tweet->get_tokens();		
		$account_twitter = $this->CI->tweet->call('get', 'account/verify_credentials');
        
  	     if( $account_twitter )
  	     {   $account_user = Account::find_by_provider_and_login('twitter', $account_twitter->screen_name);

  	         if($account_user)
  	         {
      	         return $account_user->person;
      	      }   
  	     } 

        return FALSE;
    }
}
