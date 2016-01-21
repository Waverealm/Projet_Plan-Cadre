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
    $currentConseiller = 'assignuser';
    $currentAdmin = 'assignuser';

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
    <script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('a.toggler').click(function(){
                $(this).next('.toggled').toggle(500);
            });
        });

    </script>

    <style>
        .toggler{
            color: #3561E1;
        }
    </style>
    </head>
    

    <body>
        <div class="min-size">
        <div class="container">
            <?php
                showHeader();
                showAppropriateMenu();
            ?>
            <br>
            <fieldset id="assignation">
                <legend> Assignation d'un plan-cadre : </legend>
                <form action="../view/view_assign_user.php" method="post">
                    <br>
                    
                    Sélectionner un plan-cadre pour l'assignation :
                     <!-- toogle pour directives -->
                     
                     
                    <br>
                    <?php
                        listerPlanCadre(getPlanCadreElaboration(), 'liste_plan_cadre_elaboration');  
                    ?>
                    <input type="text" name="search_user" 
                    onKeyUp="arrayFilter(this.value, this.form.liste_plan_cadre_elaboration)" 
                    onChange="arrayFilter(this.value, this.form.liste_plan_cadre_elaboration)"
                    >
                    <input type="submit" value="Assigner le plan-cadre" class="btn btn-default" />  
                    <br>
                    
                    <br>
                    
                    <?php
                        tableauPlanCadreElaboration("plan_cadre_elaboration");  
                    ?>

                </form>
            </fieldset>
        </div>
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