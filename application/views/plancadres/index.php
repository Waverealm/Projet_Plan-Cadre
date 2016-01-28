<div>
    <h3> Liste des plans-cadres </h3>
    <?php
        if( !empty($models) )
        {
            foreach ($models as $model):?>
    <div >
    <?php
        echo $html->link($model['Plancadre']['Cours']['nom'],'programmes/view/'.$model['Plancadre']['id'].'/'.$model['Plancadre']['dateajout']);
        endforeach
    ?>
    </div>
    <?php
        }
        else
        {
    ?>
    <div>
        <br>
    <?php
        echo "Aucun plan-cadre existant.";
    ?>  <br>
        
        <br>
    </div>
    <?php
        }
    ?>
</div>
    