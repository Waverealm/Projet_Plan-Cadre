<?php
  if(!isset($_SESSION)) 
  { 
      session_start(); 
  } 

  include_once("../assets/constants.php");
  
  include_once( MODEL_PAGE );
  include_once( MODEL_PROGRAMME );
  include_once( MODEL_SEARCH_PLAN_CADRE );
  

  // Variables utilisées pour le menu interractif
  $currentVisitor = 'searchplancadre';
  $currentElaborator = 'searchplancadre';
  $currentConseiller = 'searchplancadre';
  $currentAdmin = 'searchplancadre';

  // Initialise la variable de session de la checkbox si elle n'existe pas.
  setCheckboxSessionValue();
?>

<!DOCTYPE html>
<html>


      <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta charset="utf-8">
        <link rel="Stylesheet" href="../assets/pure.css">
        <link rel="Stylesheet" href="../assets/styles.css">
        <link rel="Stylesheet" href="../assets/others.css">

        <script type="text/javascript" src="../assets/js_global.js"></script>
      </head>
      <body >
        <div class="container"  style="background-color: ghostwhite">
          <?php
            showHeader();
            showAppropriateMenu();
          ?>
          <br>
          <fieldset>
            <legend>Liste des plans-cadres : </legend>
              <form action='../controller/controller_save_program_code.php' method='post'>
                <?php
                  showProgramListAll();
                ?>
              </form>
              <form action='../controller/controller_show_valid_plancadre.php' method='post'>
                <input type="checkbox" name="valid_only" id="valid_only" <?php updateCheckbox(); ?> onchange="this.form.submit();"> 
                Afficher seulement les plans-cadre officiels de la recherche
              </form>
              <br>
              <br>

              <?php 
                showPlancadre();
              ?>
          </fieldset>
        </div>

     </body>
</html>