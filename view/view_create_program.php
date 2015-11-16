<?php
/**
 * Created by PhpStorm.
 * User: 201087112//AntoineLatendresse
 * Date: 2015-10-21
 * Time: 10:48
 */
  session_start();

  include_once("../controller/interface_functions.php");
  include_once("../controller/pages_access.php");

  verifyAccessPages();
  isPlanner();
  isAdmin();
?>

<!DOCTYPE html>
<html>

    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      
      <link rel="Stylesheet" href="../assets/pure.css">
      <link rel="Stylesheet" href="../assets/styles.css">
      <link rel="Stylesheet" href="../assets/others.css">
         
    </head>
    <body> 
    <div class="container">
            <?php
                showHeader();
                showAppropriateMenu();
            ?>
      <br>
      <fieldset>
          <legend>Ajout de programme : </legend>
          </br>
<form action="../controller/controller_create_program.php" method="post">
        <label>Code du programme : </label>
        <div>
            <input class="text-box single-line" data-val="true" id="CodeProgramme" name="CodeProgramme" type="text" value="" />
        </div>
        </br>
        <label>Nom du programme : </label>
        <div>
            <input data-val="true" id="NomProgramme" name="NomProgramme" type="text" value="" />
        </div>
        </br>
        <label>Type du programme : </label>
        <div>
            <input data-val="true" id="TypeProgramme" name="TypeProgramme" type="text" value="" />
        </div>
        </br>
        <label>Type de sanction: </label>
        <div>
            <input data-val="true" id="TypeSanction" name="TypeSanction" type="text" value="" />
        </div>
        </br>
      
      <div>
            <input type="submit" value="Soumettre..." class="btn btn-default" /> <br /><br />
      </div>

     </form> 
   </fieldset>
    </div>

  </body>
</html>
