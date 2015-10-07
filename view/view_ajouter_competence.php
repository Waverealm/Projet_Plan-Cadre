

<!DOCTYPE html>
<html>

<?php
include_once("../controller/interface_functions.php");
?>


  <body>
    <head>
      <link rel="Stylesheet" href="../assets/pure.css">
      <link rel="Stylesheet" href="../assets/styles.css">
         
    </head>
      
    <div class="container">
      <?php
      echo getMenu();
      ?>
      <br>
      <fieldset>
                        <legend>Ajout de competence :</legend>
                        </br>
<form action="../controller/controller_create_competence.php" method="post">
        <label class="control-label col-md-2">Code de la competence :</label>
        <div class="col-md-10">
            <input class="text-box single-line" data-val="true" id="CodeCompetence" name="CodeCompetence" type="text" value="" />
        </div>
        </br>
        <label class="control-label col-md-2">Nom de la competence :</label>
        <div class="col-md-10">
            <input class="text-box single-line" data-val="true" id="NomCompetence" name="NomCompetence" type="text" value="" />
        </div>
        </br>
        <label class="control-label col-md-2">Description de la competence :</label>
        <div class="col-md-10">
            <input class="text-box single-line" data-val="true" id="DescriptionCompetence" name="DescriptionCompetence" type="text" value="" />
        </div>
        </br>
        <label class="control-label col-md-2">Date d'ajout :</label>
        <div class="col-md-10">
            <input class="text-box single-line" data-val="true" id="DateAjoutCompetence" name="DateAjoutCompetence" type="text" value="" />
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
