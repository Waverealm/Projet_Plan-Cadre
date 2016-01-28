<div>
    <h3> Sélectionner un programme pour voir la liste des cours du programme</h3>
    <?php foreach ($programmes as $programme):?>
    <div >
    
    <?php echo $html->link($programme['Programme']['nom'],'programmes/view/'.$programme['Programme']['id'].'/'.$programme['Programme']['nom'])?>
    
    
    </div>
    <?php endforeach?>
</div>
    

