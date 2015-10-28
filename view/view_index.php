<?php
  session_start();

  include_once("../controller/interface_functions.php");
?>

<!DOCTYPE html>
<html>

    <body >
      <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

         <link rel="Stylesheet" href="../assets/pure.css">
         <link rel="Stylesheet" href="../assets/styles.css">
         <link rel="Stylesheet" href="../assets/others.css">
         
      </head>
      
      <div class="container"  style="background-color: ghostwhite">
            <?php
                showHeader();
                showAppropriateMenu();
            ?>
      <br>

          <fieldset>
              <legend>Accueil :</legend>
              </br>

              <form>
                    <p>
                        Dans le but de compléter notre programme d’études, nous avons choisi de faire un projet qui viendra en aide à un problème que l’administration rencontre souvent.
                    <br><br>
                        Le projet consiste à offrir une interface pour guider l’utilisateur dans l’élaboration d’un plan-cadre. L’interface offrira à l’usager un pas-à-pas avec des instructions afin qu’aucune partie du plan-cadre ne soit oubliée. Le texte des instructions devra pouvoir être modifié par un conseiller pédagogique.
                    <br><br>
                        Bref, le projet plan-cadre vise à faciliter et à simplifier l'élaboration et la gestion des plans-cadres, dans le but ultime d’améliorer le développement et de faciliter l’accès aux plans-cadres.
                    </p>

              </form>
          </fieldset>
          <fieldset>
              <legend>Développeurs :</legend>
              </br>

              <table>
                <tr>
                  <td class='developers'><img src="../images/photo_Antoine.JPG"></td>
                  <td class='developers'><img src="../images/photo_Simon.JPG"></td>
                  <td class='developers'><img src="../images/photo_lea.png"></td>
                </tr>
                <tr>
                  <td class='developers'><h3>Antoine Latendresse</h3></td>
                  <td class='developers'><h3>Simon Roy</h3></td>
                  <td class='developers'><h3>Léa Kelly</h3></td>
                </tr>
              </table>


          </fieldset>

          <fieldset>
              <legend>Superviseur :</legend>
              </br>

              <h3 style='float:left; margin-right: 25px;'>Saliha Yacoub</h3>

          </fieldset>

          <fieldset>
              <legend>Dédié à :</legend>
              </br>
              <td><h3 style='float:left;'>Johanne Raymond et Renaud Thibodeau</h3></td>
          </fieldset>

          <fieldset>
              <legend>Capture d'écran :</legend>
              </br>
              <tr>
                  <td><img style='float:left; margin-right: 20px' src="../images/create_PC.png"></td>
              </tr>

          </fieldset>

      </div>

     </body>
</html>

<?php showCreateAccountSuccess(); ?>
<?php showConnectionAlert(); ?>