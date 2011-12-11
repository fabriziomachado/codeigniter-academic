<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends  MY_Controller  {

    function __construct() {
        parent::__construct();
        log_message('debug', "Model Class Initialized [". get_class($this) ."]");
        
        $this->load->spark('php-activerecord/0.0.1');
    }
    

    public function nullo()
    {
        $this->layout = false;
        #$this->view = false;
        $this->load->view('welcome/notify');
    }

    
   public function index($id = 0) {
    
        #echo PHP_EOL . $this->input->post('login');
        
        
        $this->data['peoples'] = (object) array((object) array('name'=>'John'), (object) array('name'=>'Michael'));
        $this->data['locals_vars'] = array('peoples'=> $this->data['peoples'],'say_hello'=> 'Hello World');
        
        //@TODO: refatorar para abstrair esse trecho
        if (ENVIRONMENT == 'testing') 
             $this->load->view('welcome/index', $this->data); # descomentar para pegar nos tests
 
    }
    
     public function _index() {   
     
      #$this->output->cache(10);
//        $user = new User(array("email_address" => "beau.frusetta@gmail.com"));
//        $user->save();
//
//        ## This should show you the User record that you just created
//        print_r($user);
//
//        ## Now do a simple find by email address
//        $user = User::find_by_email_address("beau.frusetta@gmail.com");
//        print_r($user);
//
//        ## Now do a simple find by primary key
#        $user = User::find(1);
#        print_r($user);
    try { 
           $person = Person::find(11);
            //$person = Student::find(12);
           // $person = Teacher::find(11);
            echo "<pre>"; print_r($person); echo "</pre>";
            //echo "-> ". $person->name .' - '. $person->type;
            
##            $student = Student::create(array('name' => null));
##            
##            if (count($student->errors) > 0)
##                    echo "[FAILED] saving " . join(', ',$student->errors->full_messages()) . "\n\n";



    } catch (ActiveRecord\RecordNotFound $e) {
        echo $e->getMessage();
    }


//       echo "<pre>"; print_r($person); echo "</pre>";
//
//       $student = Student::find(2);
//       echo $student->name .' - '. $student->type;
//
//        $enroll = Enrollment::first();
//        print_r($enroll);

//
        $this->load->view('welcome_message');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
