<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Session extends MY_Controller {


   function  __construct() 
   {
        parent::__construct();
        log_message('debug', "Model Class Initialized [". get_class($this) ."]");
        #$this->view = FALSE;
        
        $this->load->spark('php-activerecord/0.0.1');
		
		$this->load->library('tweet');
		
		

    }

    function index()
    {
	   #$this->view = FALSE;
	   #$this->session->set_flashdata('item', 'value');
	   print_r($this->session->all_userdata());
	   #print_r( $this->session->userdata('current_user'));
    }

   function twitter($provider = 'Twitter')
   {  
        $this->view = FALSE;

	        if ( !$this->tweet->logged_in() )
			{
				$provider = 'tweet';
				//$this->tweet->set_callback(site_url("auth/{$provider}/callback"));
				$this->tweet->set_callback(site_url("session/callback/{$provider}"));
				$this->tweet->login();
			}else{
			redirect('welcome/index');
			}
    }
    
    
    function callback($provider = NULL)
    {
            if($this->input->get('denied'))
            {
               $this->session->set_flashdata('error', 'O Twitter não pode autenticar este usuário');
               redirect('session/index');
            } 
           
            
            $current_user = AuthenticationService::register(new Account())
                                               //->in($this->session)
                                               ->using('twitter');                                        

            
            #$authentication_service = new AuthenticationService(new TwitterAuthentication());
            #$current_user = $authentication_service->authenticate(new Account());  

            if ( !$this->tweet->logged_in() )
            { 
                $this->session->set_flashdata('alert', 'Nenhum usuário logado com o Twitter');
                redirect('session/index');

            }    
            
            if(isset($this->session->userdata('current_user')->name))
            {
                $this->session->set_flashdata('alert', $this->session->userdata('current_user')->name .', está logado com sua conta do Twitter!');
                redirect('session/index');
            } 

    }

    function create($provider = 'erp')
    {   
        $this->view = FALSE;	

        $password = '123456';
        $identifier = 'jms'	;
        
        $parameters = array('login'=> $identifier,'password'=> $password);
        
        $account = new Account($parameters);
        
        #$current_user = AuthenticationService::register($account)
        #                                          ->using('erp');
                                                  
        
        $authentication_service = new AuthenticationService(new ErpAuthentication());
        $current_user = $authentication_service->authenticate($account, $this->session);                                          

        print_r($this->session->userdata('current_user'));
        print_r($this->session->all_userdata());
        $current = $this->session->userdata('current_user');
        echo $current->name;
        #redirect('/session/index', 'location');
    }

    function destroy()
    {   $this->tweet->logout();
		$this->session->sess_destroy();
		redirect('/session', 'location');

    }   
  
}
