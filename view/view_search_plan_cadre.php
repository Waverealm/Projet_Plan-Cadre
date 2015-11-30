<?php
  session_start();

  $currentVisitor = 'searchplancadre';
  $currentElaborator = 'searchplancadre';
  $currentConseiller = 'searchplancadre';
  $currentAdmin = 'searchplancadre';
  
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
                <input type="checkbox" name="valid_only" id="valid_only" onchange="this.form.submit();"> 
                Afficher seulement les plans-cadres qui sont valides 
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