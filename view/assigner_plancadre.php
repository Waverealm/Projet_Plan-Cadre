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

            </br>

            Choisir un utilisateur :
            </br>

            <select>
            </select>

            <input></input>

            </br>
            <!-- Trouver une solution pour faire de l'espace -->
            </br>

            Choisir un plan-cadre :

            </br>

            <select>
            </select>

            <input></input>

            </br>
            
            Donner l'élaboration du plan-cadre à l'utilisateur : 
            
            <button> Confirmer </button>

        </div>
    </body>

</html>

