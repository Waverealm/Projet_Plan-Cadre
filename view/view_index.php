<?php
  session_start();

  include_once("../controller/interface_functions.php");
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

      <div>Petit test</div>
      
      </div>

     </body>
</html>

<?php showConnectionAlert(); ?>
