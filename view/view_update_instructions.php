<?php

  if(!isset($_SESSION)) 
  { 
      session_start(); 
  } 

  include_once("../assets/constant.php");
  include_once("../controller/interface_functions.php");
  include_once("../model/model_pages_access.php");

  // Variable utilisée pour le menu interractif
  $currentConseiller = 'updateinstructions';

  verifyAccessPages();
  isAdmin();
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

      <script> 
        window.onload = loadInstruction;
      </script>
      <style type="text/css">
        table, th, td{
          border: 1px solid black;
        }
      </style>
  </head>

  <body>
    <div class="container">
      <?php
        showHeader();
        showAppropriateMenu();
      ?>

      <br><!-- espace -->

      <form action="../controller/controller_update_instructions.php" method="post">
        <fieldset>

          <br>
          <?php
            showInstructionsTable();
          ?>
          <br>

          <label> Le code de la consigne : 
            <?php
              showConsignePlanCadre();
            ?>
          </label>
          <br>

          <label>L'énoncé de la consigne : </label>
          <div>
            <textarea id='enonce' name='enonce' rows="12" cols="50"></textarea>
          </div>
          <br>

          <label>La description de la consigne : </label>
          <div>
            <textarea id='description' name='description' rows="12" cols="50"></textarea>
          </div>
          <br>

          <div>
            <input type="submit" value="Soumettre..." class="btn btn-default" /><br><!-- changement de ligne -->
          </div>

        </fieldset>  

      </form> 

    </div>
  </body>
</html>

    <?php 
        showSessionMessage("errors_update_instructions");
    ?>