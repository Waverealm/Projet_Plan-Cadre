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
    include_once( REQUETES_BD );

    $page_actuelle = "retirer_assignation";
    

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
    </head>
    

    <body>
        <div class="container">
            <?php
                showHeader();
                showAppropriateMenu();
            ?>
            <br>
            <fieldset id="assignation">
                <legend> Retirer une assignation : </legend>
                <form action="../view/view_retirer_assignation_suite.php" method="post">
                    <br>
                    
                    à un utilisateur :
                    <br>
                    <?php
                        showUserList( getListUser(), "liste_utilisateur" );
                    ?>
                    <input type="text" name="search_user" 
                    onKeyUp="arrayFilter(this.value, this.form.liste_utilisateur)" 
                    onChange="arrayFilter(this.value, this.form.liste_utilisateur)"
                    >
                    <input type="submit" name="retirer_utilisateur" value="Continuer" class="btn btn-default" /> 
                    <br>
                    
                    <br>
                    
                    ou d'un plan-cadre en élaboration :
                    <br>
                    <?php
                        listerPlanCadre( getPlanCadreElaboration(), 'liste_plan_cadre_elaboration' );
                    ?>
                    <input type="text" name="search_user" 
                    onKeyUp="arrayFilter(this.value, this.form.liste_plan_cadre_elaboration)" 
                    onChange="arrayFilter(this.value, this.form.liste_plan_cadre_elaboration)"
                    >
                    <input type="submit" name="retirer_plancadre" value="Continuer" class="btn btn-default" /> 
                    <br>
                    
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