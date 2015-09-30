

<!DOCTYPE html>
<html>

<?php
include_once("../controller/interface_functions.php");
?>


    <body>
      <head>
         <link rel="Stylesheet" href="../assets/pure.css">
         <link rel="Stylesheet" href="../assets/styles.css">
         
         <!-- à chaque cinquième seconde la page est appelée à nouveau
              utile lorsqu'on veut modifier le style/css de la page
         -->
         <meta http-equiv="refresh" content="5" >
      </head>
      
      <div class="container">
            <?php
            echo DisplayMenu();
            ?>
      <br>

      <div>Petit test</div>
       </div>
     </body>
</html>
