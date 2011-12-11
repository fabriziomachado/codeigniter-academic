<div id="content">
    <div class="span-15">
        <h1>Resized Photos</h1>
        <h2>Your photos are resized in the background. Press F5 to see has been resized</h2>
        <? # render_partial('jobs/_list_files.php', array('files' => $files)); ?>
         <input type="button" value=":: Ping EveryOne::" id="ping-pong-everyone">
         <input type="button" value=":: Ping This ::" id="ping-pong-this">
    </div> 
  
    <div class="span-8 last" style="background-color:#c9c1a7;padding:20px;">
        <h1>Upload new photo</h1>
        <?= render_partial('jobs/_form_upload.php'); ?>

       
        <?= anchor('welcome/index', 'got to index page', 'title="News title"') ?>
    </div>
    
    <div id='photos' class="span-23">
    <?if($files) echo render_partial('jobs/_photo.php', null, $files ); ?> 
    </div>
</div>
