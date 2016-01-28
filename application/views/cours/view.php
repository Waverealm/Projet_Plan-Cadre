<div><h2>Please select a category</h2>
<?php foreach ($cours as $un_cours):?>
<div class="category">

<?php echo $un_cours['nom'] . " " . $un_cours['code'] ?>
<br>

</div>
<?php endforeach?>
</div>