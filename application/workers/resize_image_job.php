<?php #if (!defined('BASEPATH')) {  exit('No direct script access allowed'); }

include_once dirname(__FILE__) . '/notifier.php';

class ResizeImageJob  {

    private $CI;
    private $params;
    private $notifier;
    
    public function __construct($params = array(), $notifier = null)
    {  
        isset($notifier) ? $this->notifier = $notifier : $this->notifier = new Notifier;
    
        if(!$params OR 
           !$params['path'] OR
           !$params['file'] OR
           !is_array($params) ) throw new Exception('Arguments required for the work were not informed or not a array');
 
        #initialize default params
        $params_default = array(
            'suffix_image' => 'thumb.png',
            'thumbs_sizes' => array(array('width' => 50,'height' => 50)),
            'image_library' => 'gd2',
            'source_image' => $params['path'] . $params['file'],
            'create_thumb' => TRUE,
            'maintain_ratio' => FALSE,
            'width' => 600,
            'height' => 400
        );

        $this->params = array_merge($params_default, $params);

        $this->CI =& get_instance();
        $this->CI->load->library('image_lib'); 
        $this->CI->load->spark('restclient/2.0.0');
        $this->CI->load->library('rest');
        
        $this->execute($this->params); 
            
    } 


    private function execute($params) 
    {
       extract($params);

        foreach($thumbs_sizes as $thumb_size)
        {
            $new_file = $thumb_size['width'] .'x'. $thumb_size['height'] .'_'. $file;     
            $new_image_src = $path . $new_file;   
              
             #initialize image library
            $config = array_merge($params, 
                                  array('new_image' => $new_image_src, 
                                        'width'  => $thumb_size['width'],
                                        'height' => $thumb_size['height']
                                       )
                                 );
            
            #sleep(2); # force hard work
            
            $this->CI->image_lib->initialize($config);
            $this->CI->image_lib->resize(); 
            
            #TODO:refactory 
            list($file_name, $file_type) = explode('.',  $new_file);
            $new_file =  $file_name .'_'. $suffix_image ;
            
            $this->notifier->publish('resize',$new_file);
            
        }

        $this->notifier->publish('message','All images were successfully uploaded!');
        return TRUE;
    }
    

    public function undo()
    {   
       extract($this->params);
       list($file_name, $file_type) = explode('.', $file);
       
       $match_files = $path . '*' . $file_name .'_'. $suffix_image .'.'. $file_type;
       foreach(glob($match_files) as $file) { 
            if(file_exists($file)) unlink($file);
       } 
    }

}
