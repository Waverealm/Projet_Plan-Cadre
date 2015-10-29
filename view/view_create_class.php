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
                        <legend>Ajout de cours :</legend>
                        </br>
<form action="../controller/controller_create_class.php" method="post">
        <label>Code du cours :</label>
        <div>
            <input data-val="true" id="CodeCours" name="CodeCours" type="text" value="" />
        </div>
        </br>
        <label>Nom du cours :</label>
        <div>
            <input data-val="true" id="NomCours" name="NomCours" type="text" value="" />
        </div>
        </br>
        <label>Type du cours :</label>
        <div>
            <input data-val="true" id="TypeCours" name="TypeCours" type="text" value="" />
        </div>
        </br>
        <label>Ponderation du cours :</label>
        <div>
            <input data-val="true" id="Ponderation" name="Ponderation" type="text" value="" />
        </div>
        </br>
        <label>Nombre d'unites :</label>
        <div>
            <input data-val="true" id="NombreUnites" name="NombreUnites" type="text" value="" />
        </div>
        </br>
        <label>Nombre d'heures :</label>
        <div >
            <input data-val="true" id="NombreHeures" name="NombreHeures" type="text" value="" />
        </div>
        </br>
        <label>Code du programme :</label>
        <?php showProgramsCode(); ?>
        </br>
        
      <div>
            <input type="submit" value="Soumettre..." class="btn btn-default" /> <br /><br />
      </div>

     </form> 
 </fieldset>
    </div>

  </body>
</html>
