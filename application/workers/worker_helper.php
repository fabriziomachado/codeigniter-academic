<?php 
# load stack codeigniter
include_once dirname(__FILE__) . '/../third_party/CIUnit/bootstrap_phpunit.php';

require_default_class_job_this_worker();



function require_default_class_job_this_worker()
{
    $currentFile = $_SERVER["SCRIPT_NAME"];
    $parts = Explode('/', $currentFile);
    $current_worker = $parts[count($parts) - 1];
    $current_worker = str_replace('worker','job', $current_worker);

    require_once(APPPATH ."/workers/$current_worker");
} 
 

