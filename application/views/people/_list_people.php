<div class="prepend-1">
<? foreach($people as $person): ?>
    <?= $say_hello ?>, <?= $person->name ?> <br />
<? endforeach; ?>
</div>
