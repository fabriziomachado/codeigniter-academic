<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jobs extends MY_Controller {
   
   private $upload_path;
   
   function  __construct() 
   {
        parent::__construct();
        log_message('debug', "Model Class Initialized [". get_class($this) ."]");
        
        $this->upload_path = BASEPATH . '../assets/images/photos/';    
        $this->load->library('gearman');

    }
 
    public function index()
    { 
       $files = get_filenames($this->upload_path);
       $this->data['files'] = $files;
    }  
    
    public function upload()
    {
        #load library upload with default parameters
    	$this->load->library('upload', array('upload_path' => $this->upload_path,
		                                     'allowed_types' => 'gif|jpg|png',
		                                     'overwrite' => TRUE )
		                               );

		#thumbs images with sizes will be created
		$thumbs_sizes = array(
                            array('width' => 100,'height' => 100),
                            array('width' => 200,'height' => 200),
                            array('width' => 300,'height' => 300)
                        );

        # upload image to server
		if ($this->upload->do_upload())
		{   
		    $data = $this->upload->data();
		    $params = serialize(array('file' => $data['file_name'], 
		                              'path' => $data['file_path'],
		                              'thumbs_sizes' => $thumbs_sizes));

            #send job to background worker
            $this->gearman->gearman_client();
		    $jobid = $this->gearman->do_job_background('resize_image', $params); 
		}

		redirect('jobs/index');
    }
}
