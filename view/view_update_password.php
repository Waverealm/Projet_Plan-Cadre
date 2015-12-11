<?php

    session_start();

    $currentConseiller = 'updatepassword';
    $currentAdmin = 'updatepassword';

    include_once("../controller/interface_functions.php");
    include_once("../controller/pages_access.php");

    verifyAccessPages();
    isPlanner();

?>

<!DOCTYPE html>
<html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

            <link rel="Stylesheet" href="../assets/pure.css">
            <link rel="Stylesheet" href="../assets/styles.css">
            <link rel="Stylesheet" href="../assets/others.css">

        </head>
        <body>
            <div class="container">
                <?php
                    showHeader();
                    showAppropriateMenu();
                ?>

                <fieldset>

                    <legend>Modification de mot de passe :</legend>
                    </br>

                    <form action="<?php echo CONTROLLER_UPDATE_PASSWORD ?>" method="post">

                        <label>Nom d'usager :</label>
                        <?php showUserListAll(); ?>
                        </br>

                        <label>Nouveau mot de passe :</label>
                        <div>
                            <input class="text-box single-line password" data-val="true"
                                   data-val-length="Le champ Mot de passe doit être une chaîne dont la longueur maximale est de 20."
                                   data-val-length-max="50" data-val-required="Le champ Mot de passe est requis."
                                   id="NewPassword" name="NewPassword" type="password" value=""
                                />
                        </div>
                        </br>

                        <label>Confirmation du nouveau mot de passe :</label>
                        <div>
                            <input class="text-box single-line password" data-val="true"
                                   data-val-length="Le champ Mot de passe doit être une chaîne dont la longueur maximale est de 20."
                                   data-val-length-max="50" data-val-required="Le champ Mot de passe est requis."
                                   id="NewPasswordConfirm" name="NewPasswordConfirm" type="password" value=""
                                />
                        </div>
                        </br>

                        <div>
                            <input type="submit" value="Soumettre..." class="btn btn-default" /> <br /><br />
                        </div>

                    </form>
                </fieldset>
            </div>
        </body>
    </html>

    <?php 
        showSessionMessage("errors_update_password");
        showSessionMessage("success_update_password");
    ?>