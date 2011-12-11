<?php
include_once dirname(__FILE__) . '/spec_helper.php';
include_once APPPATH . '/workers/resize_image_job.php';


require_once 'PHPSpec/Mocks/Functions.php';
use \Mockery as m;

class DescribeResizeImageJob extends \PHPSpec\Context
{
    function before() 
    { 
       $this->thumbs_sizes = array(
                              array('width' => 80,'height' => 80),
                              array('width' => 90,'height' => 90),
                              array('width' => 100,'height' => 100),
                              array('width' => 200,'height' => 200),
                              array('width' => 300,'height' => 300)
                       );
                                
       $this->params = array('file' => 'photo.png', 
                             'path' => APPPATH . '../spec/fixtures/',
                             'thumbs_sizes' => $this->thumbs_sizes,
                             'suffix_image' => 'thumb'
                       );
       
       $this->original_image = $this->params['path'] . $this->params['file'];
       $this->resize_job = $this->spec(new ResizeImageJob($this->params));
                               
    }

    public function after()  
    {  
       $this->remove_images();
    }  

    public function itCreatesNewsThumbsOfOriginalImage()
    {
        $thumbs_created = count($this->thumbs_sizes);
        $this->spec($this->count_images_resized())->should->be($thumbs_created); 
    }
    
    
    public function itPreservesTheOriginalImage()
    {
        $this->spec(file_exists($this->original_image))->should->beTrue(); 
    }
 
    public function itAllowsUndoYourJob()
    {
        $this->resize_job->undo();
        $this->spec($this->count_images_resized())->should->be(0); 
        
    }   

    public function itThrowsAExceptionIfNotReceiveAnArrayOfParametersInContructor()  
    {  
        $msg_exception = 'Arguments required for the work were not informed or not a array';
         $this->spec(function() {
                            new ResizeImageJob;
                      })->should->throwException('Exception', $msg_exception );  
    } 

    public function itNotifiesClientsForEachImageResized()
    {
        $notifier = m::mock('Notifier');
        $notifier->shouldReceive('publish')->times(6);
        new ResizeImageJob($this->params, $notifier);
    }    
    
    // helpers
    private function remove_images()
    {
       extract($this->params);
       
       list($file_name, $file_type) = explode('.', $file);
       $match_files = $path . '*' . $file_name .'_'. $suffix_image .'.'. $file_type;

       foreach(glob($match_files) as $file) { 
            if(file_exists($file)) unlink($file);
       } 
    }
    
    private function count_images_resized()
    { 
       
       extract($this->params);
       
       list($file_name, $file_type) = explode('.', $file);
       $match_files = $path . '*' . $file_name .'_'. $suffix_image .'.'. $file_type;
       
       #$match_files = $this->params['path'] . '*photo_thumb.png';
       return count(glob($match_files));
    }
   
}
