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

            <input></input>


            <select>
            </select>


            </br>
            <!-- Trouver une solution pour faire de l'espace -->
            </br>

            Choisir un plan-cadre :

            </br>

            <input></input>

            <select>
            </select>


            </br>

            Donner l'élaboration du plan-cadre à l'utilisateur : 

            <div class="col-md-offset-2 col-md-2">
                        <input type="submit" value="Soumettre..." class="btn btn-default" /> <br /><br />
            </div>

        </div>
    </body>

</html>

