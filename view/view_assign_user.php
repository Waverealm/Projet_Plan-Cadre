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

    // Variables utilisées pour le menu interractif
    $currentConseiller = 'assignuser';
    $currentAdmin = 'assignuser';

    verifyAccessPages();
    isPlanner();
    
    if( isset($_POST["plan_cadre_elaboration"]) )
    {
        $plan_cadre_choisi = $_POST["plan_cadre_elaboration"];
    }
    else if ( isset($_POST["liste_plan_cadre_elaboration"]) )
    {
        if( !empty($_POST["liste_plan_cadre_elaboration"]) )
        {
            $plan_cadre_choisi = $_POST["liste_plan_cadre_elaboration"];
        }
    }
    
    if( !isset($plan_cadre_choisi) )
    {
        header('Location: ' . VIEW_ASSIGN_PLANCADRE);
    }
    else
    {   
        $plancadre = fetchPlanCadreElaboration_PlanCadre($plan_cadre_choisi);
        if( empty($plancadre) )
        {
            header('Location: ' . VIEW_ASSIGN_PLANCADRE);
        }
    }

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
                <legend>Assignation : </legend>
                <form action="../controller/controller_assign_user.php" method="post">

                    Le plan-cadre choisi :
                    <?php
                    
                        echo "(" . " " . ")" . " " .
                        $plancadre[0]["CodeCours"] . " " . $plancadre[0]["NomCours"];
                    ?>
                    <input name="id_plancadre" type="hidden" value="<?php echo $plan_cadre_choisi ?>" />
                    <br>
                    
                    <br>
                    
                    Choisir un utilisateur :
                    
                    <br>

                    <?php
                        showUserList( getListeElaborateursDisponibles( $plan_cadre_choisi) );
                    ?>

                    <input type="text" name="search_user" 
                    onKeyUp="arrayFilter(this.value, this.form.user_list_all)" 
                    onChange="arrayFilter(this.value, this.form.user_list_all)"
                    >

                    <br>
                    <br>
                    
                    <div class="col-md-offset-2 col-md-2">
                            <input type="submit" value="Assigner le plan-cadre" class="btn btn-default" /> 
                            
                            <br>
                            <br>
                    </div>
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