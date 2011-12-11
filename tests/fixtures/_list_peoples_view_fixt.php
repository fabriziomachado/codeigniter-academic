<div class="prepend-1">
<? foreach($peoples as $person): ?>
    <?= $say_hello ?>, <?= $person->name ?> <br />
<? endforeach; ?>
</div>
