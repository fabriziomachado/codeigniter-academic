<?php if (!defined('BASEPATH')) {  exit('No direct script access allowed'); }

class ErpAuthentication implements Authentication {

    public function authenticate(Account $account) 
    {
        #echo "ErpAuthentication::autenticate" . PHP_EOL;
        
         $current_user = Account::find(array('provider'=>'erp','login'=> $account->login));
         
  	     if( $current_user )
  	     {
              return $current_user->person; 
  	     } 

        return FALSE;
    }
}
