<?php
# 0.0.0.0:4730
# http://localhost/gearman-monitor
# $ gearmand -vvv -q libsqlite3 --libsqlite3-db=/tmp/gearman.sqlite
# http://gearman.org/index.php?id=manual:job_server

# $ sudo vi /etc/default/gearman-job-server
# PARAMS="--listen=127.0.0.1 -q libsqlite3 --libsqlite3-db=/tmp/gearman.sqlite"

# sudo vi /etc/monit/conf.d/gearman.conf
#check process gearmand with pidfile /var/run/gearman/gearmand.pid
#   start program = "/etc/init.d/gearman-job-server start"
#   stop program = "/etc/init.d/gearman-job-server stop"
#   group gearman

# sudo ps x -o pid,command | sed -n "s/^ *\([0-9]*\) .*worker\.php.*/\1/p"
# sudo /etc/init.d/gearman-workers start|stop

$gmw = new GearmanWorker();
$gmw->addServer();
$gmw->addFunction("resize_image", "resize_image");

# waiting for job
while($gmw->work()){
   if($gmw->returnCode() != GEARMAN_SUCCESS) break;
}

 
function resize_image($job, $data=NULL)
{
    
##    echo "Received job: " . $job->handle() . PHP_EOL;
##    $workload      = $job->workload();
##    $workload_size = $job->workloadSize();
##    echo "Workload: $workload ($workload_size)\n";


##     # This status loop is not needed, just showing how it works
##      for ($x= 0; $x < $workload_size; $x++)
##      {
##        echo "Sending status: " . ($x + 1) . "/$workload_size complete\n";
##        $job->sendStatus($x, $workload_size);
##        #sleep(1);
##      }

 
    /* get the name of the file to process */
    list($file, $path) = unserialize($job->workload());

    $path = '/home/fabrizio/public_html/dev.localhost/codeigniter-academic/assets/images/photos/';
    $src  = $path.$file;
    
    
    /* create our imagmagick object */
    $imagem = new Imagick();
    $imagem->readImage($src);
    if(!$imagem) return false;
    
    # resize image
    for($percent=100; $percent >= 10; $percent-=20)
    {
        $new_file_resizable = $path."{$percent}_{$file}";
        /* resize image */
        $new_size = round($imagem->getImageWidth() * ($percent/100));
        $imagem->thumbnailImage($new_size, 0);
        $imagem->writeImage($new_file_resizable);    
            
        $msg_return = "$new_file_resizable - new-size: $new_size" . PHP_EOL;
        
        echo $msg_return;
        #exec("notify-send  --hint=string:x-canonical-private-synchronous: -i 'dialog-ok' '". $dest ."'");
        sleep(2);
    }    
    
    $imagem->destroy();

    
    return true;
}
?>
