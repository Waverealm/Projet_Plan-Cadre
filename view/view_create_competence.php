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

  <body>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      
      <link rel="Stylesheet" href="../assets/pure.css">
      <link rel="Stylesheet" href="../assets/styles.css">
      <link rel="Stylesheet" href="../assets/others.css">
         
    </head>
      
    <div class="container">
            <?php
                showHeader();
                showAppropriateMenu();
            ?>
      <br>
      <fieldset>
                        <legend>Ajout de competence :</legend>
                        </br>
<form action="../controller/controller_create_competence.php" method="post">
        <label>Code de la competence :</label>
        <div>
            <input data-val="true" id="CodeCompetence" name="CodeCompetence" type="text" value="" />
        </div>
        </br>
        <label>Nom de la competence :</label>
        <div>
            <input data-val="true" id="NomCompetence" name="NomCompetence" type="text" value="" />
        </div>
        </br>
        <label>Description de la competence :</label>
        <div>
            <input data-val="true" id="DescriptionCompetence" name="DescriptionCompetence" type="text" value="" />
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
