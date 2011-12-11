<?php

	class Tweet_test extends MY_Controller {
		

		
		function __construct()
		{
			parent::__construct();
			
			$this->load->spark('php-activerecord/0.0.1');
			
			$this->view  = FALSE;
			
			// It really is best to auto-load this library!
			$this->load->library('tweet');
			
			
			if($this->input->get('denied'))  redirect('welcome/index');
			
			// Enabling debug will show you any errors in the calls you're making, e.g:
			#$this->tweet->enable_debug(TRUE);
			
			// If you already have a token saved for your user
			// (In a db for example) - See line #37
			// 
			// You can set these tokens before calling logged_in to try using the existing tokens.
			// $tokens = array('oauth_token' => 'foo', 'oauth_token_secret' => 'bar');
			// $this->tweet->set_tokens($tokens);
			
			
			if ( !$this->tweet->logged_in() )
			{
				// This is where the url will go to after auth.
				// ( Callback url )
				$provider = 'tweet';
				$this->tweet->set_callback(site_url("auth/{$provider}/callback"));
				
				// Send the user off for login!
				$this->tweet->login();
			}
			else
			{
				// You can get the tokens for the active logged in user:
				// $tokens = $this->tweet->get_tokens();
				
				// 
				// These can be saved in a db alongside a user record
				// if you already have your own auth system.
			}
		}
		
		function index()
		{
			echo 'hi there';
			echo "<pre>"; print_r($this->tweet->get_tokens()); echo "</pre>";
			
			
		}
		
		function logout()
		{
    		$this->tweet->logout();
		}
		
		function auth($provider = '')
		{
		    echo $provider;
		    echo $this->uri->segment(2);
		    
			$tokens = $this->tweet->get_tokens();
			
			// $user = $this->tweet->call('get', 'account/verify_credentiaaaaaaaaals');
			// 
			// Will throw an error with a stacktrace.
			
			$user = $this->tweet->call('get', 'account/verify_credentials');
			#echo $user->screen_name . PHP_EOL;
			#echo "<h1>USER:</h1>";echo "<PRE>"; var_dump($user);echo "</PRE>";
			
			#$user = $this->tweet->call('get', 'account/totals');
			#echo "<h1>TOTALS:</h1>";echo "<PRE>"; var_dump($user);echo "</PRE>";
			
			

    	   $account = Account::find_by_provider_and_login('twitter', $user->screen_name);
		   if( $account ) 
		        echo $account->person->name . PHP_EOL;
			
			#$friendship 	= $this->tweet->call('get', 'friendships/show', array('source_screen_name' => $user->screen_name, 'target_screen_name' => 'unesc'));
			#echo "<h1>FRIENDSHIPS:</h1>";echo "<PRE>";var_dump($friendship);echo "</PRE>";
			
##			if ( $friendship->relationship->target->following === FALSE )
##			{
##				$this->tweet->call('post', 'friendships/create', array('screen_name' => $user->screen_name, 'follow' => TRUE));
##			}
##			
##			$this->tweet->call('post', 'statuses/update', array('status' => 'Testing #CodeIgniter Twitter library by @elliothaughin - http://bit.ly/grHmua'));
##			
##			$options = array(
##						'count' => 10,
##						'page' 	=> 2,
##						'include_entities' => 1
##			);
##			
##			$timeline = $this->tweet->call('get', 'statuses/home_timeline');
##			
##			echo "<h1>TIMELINE:</h1>";echo "<PRE>"; var_dump($timeline); echo "</PRE>";
		}
	}
