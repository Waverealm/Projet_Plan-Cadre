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
    
    $erreur = 0;
    
    if( $_SERVER["REQUEST_METHOD"] == "POST" )
    {
        if( isset($_POST["retirer_utilisateur"]) )
        {
            if( isset($_POST["liste_utilisateur"]) && !empty($_POST["liste_utilisateur"]) )
            {
                $utilisateur_choisi = $_POST["liste_utilisateur"];
            }
            else
            {   
                $error ++;   
            }
        }
        if( isset($_POST["retirer_plancadre"]) )
        {
            if( isset($_POST['liste_plan_cadre_elaboration']) && !empty($_POST['liste_plan_cadre_elaboration']) )
            {
                $plancadre_choisi = $_POST['liste_plan_cadre_elaboration'];
            }
            else
            {   
                $error ++;   
            }
        }
    }
    else
    {
        $erreur++;
    }

    if( $erreur)
    {
        header("Location: ../view/view_retirer_assignation.php");
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
                <legend> Retirer une assignation : </legend>
                <form action="../controller/controller_retirer_assignation.php" method="post">
                    <?php             
                        if( isset($utilisateur_choisi) )
                        {
                            $utilisateur = getPublicUtilisateur($utilisateur_choisi);
                            
                            showInfoUtilisateur($utilisateur);
                            
                            $liste = fetchPlanCadreElaboration_User($utilisateur_choisi);
                            listerPlanCadre($liste);
                        ?>
                            <input type="text" name="search_user" 
                            onKeyUp="arrayFilter(this.value, this.form.liste_plan_cadre)" 
                            onChange="arrayFilter(this.value, this.form.liste_plan_cadre)"
                            >
                            <input type="hidden" name ="utilisateur_choisi" value="<?php echo $utilisateur_choisi; ?>" />
                            <input type="submit" value="Continuer" class="btn btn-default" /> 
                            <br>
                        <?php
                        }
                        if( isset($plancadre_choisi) )
                        {
                            $plancadre = fetchPlanCadreElaboration_PlanCadre($plancadre_choisi);
                            
                            showInfoPlancadre($plancadre);
                            
                            $liste = getListeElaborateursPlancadre($plancadre_choisi);
                            showUserList($liste);
                        ?>
                            <input type="text" name="search_user" 
                            onKeyUp="arrayFilter(this.value, this.form.liste_plan_cadre)" 
                            onChange="arrayFilter(this.value, this.form.liste_plan_cadre)"
                            >
                            <input type="hidden" name ="plancadre_choisi" value="<?php echo $plancadre_choisi; ?>" />
                            <input type="submit" value="Continuer" class="btn btn-default" /> 
                            <br>
                        <?php
                        }
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