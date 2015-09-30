

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

      Code du cours : <input></input>
      Nom du cours : <input></input>
      Le programme du cours <select></select>
      </br>
      Type du cours : <select></select>
      </br>
      Nombre d'unités : <select></select>
      <!-- le nombre d'unités reste stable mais le nombre d'heures de cours peut changer drastiquement d'un cours à un autre donc input + combobox-->
      Nombre d'heures : <select></select>
      <input></input>


      </br>


      <button> Confirmer </button>

      
    </div>

  </body>
</html>
