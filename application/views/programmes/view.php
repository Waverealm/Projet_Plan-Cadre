<div><h2><strong><?php echo $programme['Programme']['nom']?></strong></h2>
</div>

<?php if (!empty($programme['Cours'])): ?>
<div><h2>Please select a product</h2>
<?php foreach ($programme['Cours'] as $cours):?>
<div class="category">

<?php echo $html->link($cours['Cours']['nom'],'cours/view/'.$cours['Cours']['id'].'/'.$cours['Cours']['nom'])?>

</div>
<?php endforeach?>
</div>
<?php endif?>