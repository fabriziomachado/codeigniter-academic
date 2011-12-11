<?php
class MY_Controller extends CI_Controller
{

    #public $layout = 'default'; 
    public $title = 'Unesc - Universidade do Extremo Sul Catarinense';
    public $css = array('application','libs/blueprint/screen',
                        'libs/jquery-ui-1.8.16.custom','libs/ui.notify');
    public $js  = array('libs/modernizr-2.0.6', 
                        'libs/jquery-1.6.2.min', 'libs/jquery-ui-1.8.16.custom.min',
                        'libs/jquery.notify.min', 'libs/now','application');
    public $data = array();
    public $view  = TRUE;

    function  __construct() 
    {
        parent::__construct();
        #$this->output->enable_profiler(TRUE);
      
    }
}
