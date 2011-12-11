<? if($files): ?>
    <? foreach($files as $file): ?>
       <img src="<?=  base_url() ?>assets/images/photos/<?= $file ?>" />
    <? endforeach; ?>
 <? endif; ?>
