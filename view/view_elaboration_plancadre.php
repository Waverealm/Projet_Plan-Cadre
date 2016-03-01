<?php

  if(!isset($_SESSION)) 
  { 
      session_start(); 
  } 
  
  include_once("../model/model_page.php");
  include_once("../model/model_pages_access.php");
  include_once("../model/model_user_session.php");
  
  // Variables utilisées pour le menu interractif
  $currentElaborator = 'elaborationplancadre';
  $currentConseiller = 'elaborationplancadre';
  $currentAdmin = 'elaborationplancadre';

  verifyAccessPages();
  isAdmin();
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

        <script>
          $( window ).load(function() {
                if ($( "#plancadre_elaboration_list" ).val() == "not_found")
                {
                   $( "#btn_update" ).prop( "disabled", true );
                   $( "#btn_update" ).removeClass('btn btn-default').addClass('btn-disabled');
                }
            });
        </script>

    </head>
    <body>


        <div class="container">
            <?php
                showHeader();
                showAppropriateMenu();
            ?>

            <br>


            <fieldset>

                <form action="../controller/controller_elaboration_plancadre.php" method="post">

                    Choisir le plan-cadre que vous voulez modifier :

                    <br>

                    <?php
                        showPlanCadreCurrentUser();
                    ?>

                    <input type="text" name="search_class" 
                    onKeyUp="arrayFilter(this.value, this.form.plancadre_elaboration_list)" 
                    onChange="arrayFilter(this.value, this.form.plancadre_elaboration_list)"
                    >

                    <br>
                    <br>

                    <div class="col-md-offset-2 col-md-2">
                            <input type="submit" value="Modifier ce plan-cadre" id='btn_update' class="btn btn-default" /> 
                            
                            <br>
                            <br>
                    </div>

                </form>

            </fieldset>
        </div>
    </body>

</html>

