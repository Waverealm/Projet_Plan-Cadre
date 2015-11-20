<?php
  session_start();

  include_once("../controller/interface_functions.php");
  include_once("../model/model_search_plan_cadre.php");
?>

<!DOCTYPE html>
<html>


      <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta charset="utf-8">
        <link rel="Stylesheet" href="../assets/pure.css">
        <link rel="Stylesheet" href="../assets/styles.css">
        <link rel="Stylesheet" href="../assets/others.css">
         
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
            <?php 
              showAllPlancadre();
            ?>
          </fieldset>
        </div>

     </body>
</html>