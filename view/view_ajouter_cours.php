
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

        <label class="control-label col-md-2">Nom du cours :</label>
        <div class="col-md-10">
            <input class="text-box single-line" data-val="true" id="NomCours" name="NomCours" type="text" value="" />
        </div>
        </br>
        <label class="control-label col-md-2">Programme du cours :</label>
        <div class="col-md-10">
            <input class="text-box single-line" data-val="true" id="ProgCours" name="ProgCours" type="text" value="" />
        </div>
        </br>
        <label class="control-label col-md-2">Type du cours :</label>
        <div class="col-md-10">
            <input class="text-box single-line" data-val="true" id="TypeCours" name="TypeCours" type="text" value="" />
        </div>
        </br>
        <label class="control-label col-md-2">Nombre d'unites :</label>
        <div class="col-md-10">
            <input class="text-box single-line" data-val="true" id="Unites" name="Unites" type="text" value="" />
        </div>
        </br>
        <label class="control-label col-md-2">Nombre d'heures :</label>
        <div class="col-md-10">
            <input class="text-box single-line" data-val="true" id="Heures" name="Heures" type="text" value="" />
        </div>
      </br>
      
      <div class="col-md-offset-2 col-md-2">
            <input type="submit" value="Soumettre..." class="btn btn-default" /> <br /><br />
      </div>

      
    </div>

  </body>
</html>
