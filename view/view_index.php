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

          <fieldset>
              <legend>Accueil :</legend>
              </br>

              <form>
                    <p>
                        Dans le but de compléter notre programme d’étude, nous avons choisi de faire un projet qui viendra en aide à un problème que l’administration rencontre souvent.
                    <br><br>
                        Le projet consiste à offrir une interface pour guider l’utilisateur dans l’élaboration d’un plan-cadre. L’interface offrira à l’usager un pas-à-pas avec des instructions afin qu’aucune partie du plan-cadre ne soit oubliée. Le texte des instructions devra pouvoir être modifié par un administrateur du site.
                    <br><br>
                        Bref, le projet plan-cadre vise à faciliter et à simplifier l'élaboration et la gestion des plans-cadres. Dans le but ultime d’améliorer le développement et de faciliter l’accès aux plans-cadres.
                    </p>

              </form>
          </fieldset>
          <fieldset>
              <legend>Développeurs :</legend>
              </br>


              <img style='float:left; margin-right: 4px;' src="pic_mountain.jpg" alt="Mountain View" style="width:304px;height:228px;">
              <img style='float:left; height: 24px; width: 24px; margin-right: 4px;' src="pic_mountain.jpg" alt="Mountain View" style="width:304px;height:228px;">
              <img style='float:left; height: 24px; width: 24px; margin-right: 4px;' src="pic_mountain.jpg" alt="Mountain View" style="width:304px;height:228px;">
              <br><br>
              <h2 style='float:left; margin-right: 25px;'>Antoine Latendresse</h2>
              <h2 style='float:left; margin-right: 25px;'>Simon Roy</h2>
              <h2 style='float:left; margin-right: 25px;'>Léa Kelly</h2>


          </fieldset>

          <fieldset>
              <legend>Superviseur :</legend>
              </br>

              <h2 style='float:left; margin-right: 25px;'>Saliha Yacoub</h2>

          </fieldset>

          <fieldset>
              <legend>Dédier à :</legend>
              </br>
              <h2 style='float:left; margin-right: 25px;'>Johanne Raymond</h2>
              <h2 style='float:left; margin-right: 25px;'>Renaud Thibodeau</h2>
          </fieldset>

          <fieldset>
              <legend>Capture d'écran :</legend>
              </br>

              <img style='float:left; margin-right: 4px;' src="pic_mountain.jpg" alt="Mountain View" style="width:304px;height:228px;">


          </fieldset>

      </div>

     </body>
</html>

<?php showConnectionAlert(); ?>
