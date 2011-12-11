<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function render_partial($partial, $locals = null, $collection = null, $ajax = NULL) {

    if($partial{0} == '/' OR $partial{0} == '\\') 
        $partial = $partial;
    else  
        $partial = APPPATH .'views/'. $partial;
        
    $contents = '';


    if($locals)
    {
    foreach($locals AS $key => $value) {
            ${$key} = $value;
    }
    }
    $file_name = pathinfo($partial,PATHINFO_FILENAME);
    $file_name = substr_replace($file_name, '', 0, 1);
    ${$file_name . '_counter'} = 0;
       
    if($collection){
        foreach($collection as $object) {
                ${$file_name} = $object;
                ob_start();
                    include $partial;
                    $contents .= ob_get_contents();
                ob_end_clean();
                ${$file_name . '_counter'}++;
        }
    }else{
        ob_start();
        include $partial;
        $contents .= ob_get_contents();
        ob_end_clean();
    }    

    if($ajax) $contents = utf8_encode($contents);
    
    return $contents;
}

/* End of file partial_helper.php */
/* Location: ./application/helpers/partial_helper.php */
