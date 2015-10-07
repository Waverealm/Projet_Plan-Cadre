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
         
      </head>
      
      <div class="container">
        <?php
        echo getMenu();
        ?>
      <br>

      <div>Petit test</div>
      
      </div>

     </body>
</html>

<?php

   if( isset($_SESSION[ 'info_connexion' ]) )
   {
      ?>
      <script>alert("<?php echo $_SESSION[ 'info_connexion' ]; ?>");</script>
      <?php
      unset($_SESSION[ 'info_connexion' ]);
   }

?>
