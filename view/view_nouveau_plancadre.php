<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    include_once("../assets/constants.php");

    include_once(MODEL_PAGE_ACCESS);
    include_once(MODEL_PAGE);
    include_once(MODEL_COURS);
    include_once(MODEL_UTILISATEUR);
    include_once(MODEL_PLAN_CADRE);

    // Variables utilisées pour le menu interractif
    $currentConseiller = 'nouvea_plancadre';
    $currentAdmin = 'nouvea_plancadre';

    verifyAccessPages();
    isPlanner();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <link rel="Stylesheet" href="../assets/pure.css">
        <link rel="Stylesheet" href="../assets/styles.css">
        <link rel="Stylesheet" href="../assets/others.css">

        <script type="text/javascript" src="../assets/js_global.js" ></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script type="text/javascript">
            function filterBoth(search, first_list, second_list)
            {
                arrayFilter(search, first_list);
                arrayFilter(search, second_list);
                
                
            }
        </script>
    </head>
    

    <body>
        <div class="container">
            <?php
                showHeader();
                showAppropriateMenu();
            ?>
            <br>
            <fieldset id="assignation">
                <legend>Ajout d'un plan-cadre : </legend>
                <form action="../controller/controller_nouveau_plancadre.php" method="post">

                    <br>

                    Ajouter un nouveau plan-cadre pour le cours sélectionner : 

                    <br>
                    <?php
                        showClassListAll();
                    ?>
                    <input type="text" name="search_class" id="search_class"
                    onKeyUp="filterBoth(this.value, this.form.class_list_all, this.plan_cadre_elaboration_list)" 
                    onChange="filterBoth(this.value, this.form.class_list_all, this.plan_cadre_elaboration_list)">

                    <br>
                    
                    <br>
                    
                    Assigner un utilisateur immédiatement (optionnel) : 
                    
                    <br>
                    
                    <?php
                        showUserListAll();
                    ?>

                    <input type="text" name="search_user" 
                    onKeyUp="arrayFilter(this.value, this.form.user_list_all)" 
                    onChange="arrayFilter(this.value, this.form.user_list_all)"
                    >
                    <br>
                    
                    <br>
                     
                    <div class="col-md-offset-2 col-md-2">
                            <input type="submit" value="Ajouter" class="btn btn-default" /> 
                            
                            <br>
                            <br>
                    </div>
                     Liste des plans-cadres déjà en élaboration :
                    <br>
                    <?php
                        showPlanCadreElaboration();
                        showInfoPlanCadre(getPlanCadreElaboration());    
                    
                    ?>
                    
                </form>
               
            </fieldset>
        </div>
    </body>
</html>

<?php
    // affiche un message pour la confirmation de l'assignation
    if( isset($_SESSION[ 'info_assign' ]) )
    {
        ?>

        <script>alert("<?php echo $_SESSION[ 'info_assign' ]; ?>");</script>

        <?php

        unset($_SESSION[ 'info_assign' ]);
    }
?>