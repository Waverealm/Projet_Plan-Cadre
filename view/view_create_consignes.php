<?php

  session_start();

  include_once("../assets/constant.php");
  include_once("../controller/interface_functions.php");
  include_once("../controller/pages_access.php");
  include_once("../controller/controller_create_consignes.php");

  verifyAccessPages();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      
      <link rel="Stylesheet" href="../assets/pure.css">
      <link rel="Stylesheet" href="../assets/styles.css">
      <link rel="Stylesheet" href="../assets/others.css">

      <script type="text/javascript" src="../assets/js_global.js" ></script>
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

      <form action="../controller/controller_create_class.php" method="post">
        <fieldset>

          <br>
          <?php
            showPageConsignePlanCadre();
          ?>

          <br>

          <br>

          <label> Le code de la consigne : 
            <?php
              showConsignePlanCadre();
            ?>
          </label><br><!-- changement de ligne -->

          <br><!-- espace -->

          <label>L'énoncé de la consigne : </label><br><!-- changement de ligne -->
          <textarea name='enonce' ></textarea><br><!-- changement de ligne -->

          <br><!-- espace -->

          <label>La description de la consigne : </label>
          <br><!-- changement de ligne -->
          <textarea name='description'>
            <?php 
              
            ?>
          </textarea><br><!-- changement de ligne -->

          <br><!-- espace -->

          <div>
            <input type="submit" value="Soumettre..." class="btn btn-default" /><br><!-- changement de ligne -->

            <br><!-- espace -->

          </div>
        </fieldset>  
      </form> 
    </div>
  </body>
</html>
