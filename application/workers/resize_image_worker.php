<?php
include_once dirname(__FILE__) . '/worker_helper.php';
#include_once dirname(__FILE__) . '/notifier.php';

$gmw = new GearmanWorker();
$gmw->addServer();
$gmw->addFunction("resize_image", "resize_image");

# while (1) $gmw->work();
# waiting for job
while($gmw->work()){
   if($gmw->returnCode() != GEARMAN_SUCCESS) break;
}

# function this worker 
function resize_image($job)
{
    $job_params = unserialize($job->workload());
    $resize_job = new ResizeImageJob($job_params);
   
    return GEARMAN_SUCCESS;
}
