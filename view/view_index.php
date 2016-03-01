<?php
  if(!isset($_SESSION)) 
  { 
      session_start(); 
  }
  
  
  include_once("../assets/constants.php");
  include_once(MODEL_PAGE);
  include_once("../model/model_plan_cadre_official_index.php");

  // Variables utilisées pour le menu interractif
  $currentVisitor = 'searchplancadreofficiel';
  $currentElaborator = 'searchplancadreofficiel';
  $currentConseiller = 'searchplancadreofficiel';
  $currentAdmin = 'searchplancadreofficiel';
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
        <div class="container"  >
          <?php
            showHeader();
            showAppropriateMenu();
          ?>
          <br>
          <fieldset>
            <legend>Liste des plans-cadres officiels: </legend>
              <?php 
                showAllOfficielPlancadre();
              ?>
          </fieldset>
        </div>

     </body>
</html>