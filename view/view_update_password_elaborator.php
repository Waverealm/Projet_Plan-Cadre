<?php
/**
 * Created by PhpStorm.
 * User: 201087112
 * Date: 2015-11-02
 * Time: 15:21
 */

session_start();

include_once("../controller/interface_functions.php");
include_once("../controller/pages_access.php");

//verifyConnected();
?>

    <!DOCTYPE html>
    <html>

    <body>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <link rel="Stylesheet" href="../assets/pure.css">
        <link rel="Stylesheet" href="../assets/styles.css">
        <link rel="Stylesheet" href="../assets/others.css">

    </head>

    <div class="container">
        <?php
        //showHeader();
        //showAppropriateMenu();
        ?>
        <br>

        </br>

        <fieldset>
            <legend>Modification de mot de passe :</legend>
            </br>

            <form action="../controller/controller_update_elaborator_password.php" method="post">

                <label class="control-label col-md-2">Username du compte a changer :</label>
                <div class="col-md-2">
                    <input class="text-box single-line password" data-val="true"
                           data-val-length="Le champ Mot de passe doit être une chaîne dont la longueur maximale est de 20."
                           data-val-length-max="50" data-val-required="Le champ Mot de passe est requis."
                           id="Username" name="Username" type="password" value=""
                        />
                </div>
                </br>

                <label class="control-label col-md-2">Ancien mot de passe :</label>
                <div class="col-md-2">
                    <input class="text-box single-line password" data-val="true"
                           data-val-length="Le champ Mot de passe doit être une chaîne dont la longueur maximale est de 20."
                           data-val-length-max="50" data-val-required="Le champ Mot de passe est requis."
                           id="OldPassword" name="OldPassword" type="password" value=""
                        />
                </div>
                </br>

                <label class="control-label col-md-2">Nouveau mot de passe :</label>
                <div class="col-md-2">
                    <input class="text-box single-line password" data-val="true"
                           data-val-length="Le champ Mot de passe doit être une chaîne dont la longueur maximale est de 20."
                           data-val-length-max="50" data-val-required="Le champ Mot de passe est requis."
                           id="NewPassword" name="NewPassword" type="password" value=""
                        />
                </div>
                </br>

                <label class="control-label col-md-2">Confirmation du nouveau mot de passe :</label>
                <div class="col-md-2">
                    <input class="text-box single-line password" data-val="true"
                           data-val-length="Le champ Mot de passe doit être une chaîne dont la longueur maximale est de 20."
                           data-val-length-max="50" data-val-required="Le champ Mot de passe est requis."
                           id="NewPasswordConfirm" name="NewPasswordConfirm" type="password" value=""
                        />
                </div>
                </br>

                <div class="col-md-offset-2 col-md-2">
                    <input type="submit" value="Soumettre..." class="btn btn-default" /> <br /><br />
                </div>

            </form>
        </fieldset>
    </body>
    </html>

<?php showConnectionAlert(); ?>