<div><h2>Please select a category</h2>
<?php foreach ($cours as $un_cours):?>
<div class="category">

<?php echo $un_cours['Cours']['nom'] . " " . $un_cours['Cours']['code'] . " " . $un_cours['Programme']['nom'] . " " . $un_cours['Programme']['code'] ?>
<br>

</div>
<?php endforeach?>
</div>