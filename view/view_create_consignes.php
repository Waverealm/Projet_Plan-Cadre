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
  </head>

  <body>
    <div class="container">
      <?php
        showHeader();
        showAppropriateMenu();
      ?>
      <br>


      <form action="../controller/controller_create_class.php" method="post">
        <fieldset>

          <label> Le code de la consigne : </label>
          <select name='select_'>
            <?php
              //call to showHTML_Select_
            ?>
          </select><br>

          <br>

          <label>L'énoncé de la consigne : </label><br>
          <textarea name='enonce' ></textarea><br>

          <br>

          <label>La description de la consigne : </label>
          <br>
          <textarea name='description'>
            <?php 
              
            ?>
          </textarea><br>

          <br>

          <div>
            <input type="submit" value="Soumettre..." class="btn btn-default" /><br>

            <br>

          </div>
        </fieldset>  
      </form> 
    </div>
  </body>
</html>
