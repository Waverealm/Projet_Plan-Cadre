<?php
  session_start();

  include_once("../controller/interface_functions.php");
  include_once("../controller/pages_access.php");

  verifyAccessPages();
?>

<!DOCTYPE html>
<html>
  <body>
    <head>
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
          <legend>Ajout de programme :</legend>
          </br>
<form action="../controller/controller_create_competence.php" method="post">
        <label class="control-label col-md-2">Code du programme :</label>
        <div class="col-md-10">
            <input class="text-box single-line" data-val="true" id="CodeProgramme" name="CodeProgramme" type="text" value="" />
        </div>
        </br>
        <label class="control-label col-md-2">Nom du programme :</label>
        <div class="col-md-10">
            <input class="text-box single-line" data-val="true" id="NomProgramme" name="NomProgramme" type="text" value="" />
        </div>
        </br>
        <label class="control-label col-md-2">Type du programme :</label>
        <div class="col-md-10">
            <input class="text-box single-line" data-val="true" id="TypeProgramme" name="TypeProgramme" type="text" value="" />
        </div>
        </br>
        <label class="control-label col-md-2">Type de sanction:</label>
        <div class="col-md-10">
            <input class="text-box single-line" data-val="true" id="TypeSanction" name="TypeSanction" type="text" value="" />
        </div>
        </br>
        <label class="control-label col-md-2">Date d'ajout :</label>
        <div class="col-md-10">
            <input class="text-box single-line" data-val="true" id="DateAjoutProgramme" name="DateAjoutProgramme" type="text" value="" />
        </div>
        </br>
      
      <div class="col-md-offset-2 col-md-2">
            <input type="submit" value="Soumettre..." class="btn btn-default" /> <br /><br />
      </div>

     </form> 
   </fieldset>
    </div>

  </body>
</html>
