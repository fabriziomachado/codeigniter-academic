<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class People extends MY_Controller {

 
    function  __construct() {
        parent::__construct();
    }

    public function message($to = 'World')
	{  $this->view  = FALSE;
	    $this->layout = false;
		echo "Hello {$to}!".PHP_EOL;
		
		#executa em CLI - $  php index.php welcome message
	}

    function index($var1 = 0)
    {   
    
           $this->data['people'] = (object) array((object) array('name'=>'John'), (object) array('name'=>'Michael'));
           $this->data['locals_vars'] = array('people'=> $this->data['people'],'say_hello'=> 'Hello World');


        if (ENVIRONMENT === 'testing') 
             $this->load->view('people/index', $this->data); # descomentar para pegar nos tests

            
    }

	public function testes()
	{
            #echo  $this->input->post('login');
            #$this->view = 'welcome/index';
            #$this->load->view('people/index',$data); # descomentar para pegar nos tests
            
		#$this->load->spark('php-activerecord/0.0.1');
        ##echo '<pre>'; var_dump(Test::all()); exit;
        #$obj = Test::find(1);
        #echo $obj->body;
        
	
		// Load the rest client spark
		#$username = 'fabriziocolombo';
        #$this->load->spark('restclient');
        #$this->rest->initialize(array('server' => 'http://twitter.com/'));
        #$tweets = $this->rest->get('statuses/user_timeline/'.$username.'.xml');
        
   	    #$this->load->spark('gravatar_helper/1.2.0');
	    #echo "<img src='". Gravatar_helper::from_email('fabrizio@unesc.net') ."'>";
		$this->load->view('welcome_message');        

		
	}
	
	
	function help()
    {
        $title = "fabriio";
        #for($i=0; $i<5 ; $i++){
        #    $this->load->view("myviews",array("title"=>$title));
        #}
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
