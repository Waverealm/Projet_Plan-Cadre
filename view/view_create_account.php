<?php
/**
 * Created by PhpStorm.
 * User: 201087112//AntoineLatendresse
 * Date: 2015-10-21
 * Time: 10:48
 */
  session_start();

  include_once("../controller/interface_functions.php");
  include_once("../controller/pages_access.php");

  verifyAccessPages();
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

            </br>

            <fieldset>
                        <legend>Inscription:</legend>
                        </br>

                    <form action="../controller/controller_create_account.php" method="post">

                            <label class="control-label col-md-2">Nom d'usager :</label>
                            <div class="col-md-10">
                                <input id="UserName" name="UserName" type="text" value="" class="text-box single-line" data-val="true" data-val-length="Le champ Nom d&#39;usager doit être une chaîne dont la longueur maximale est de 50." data-val-length-max="50" data-val-regex="Caractères illégaux." data-val-regex-pattern="^((?!^Name$)[-a-zA-Z0-9àâäçèêëéìîïòôöùûüÿñÀÂÄÇÈÊËÉÌÎÏÒÔÖÙÛÜ_])+$" data-val-required="Le champ Nom d&#39;usager est requis." />
                            </div>
                        </br>

                            <label class="control-label col-md-2">Mot de passe :</label>
                            <div class="col-md-2">
                                <input id="Password" name="Password" type="password" value="" class="text-box single-line password" data-val="true" data-val-length="Le champ Mot de passe doit être une chaîne dont la longueur maximale est de 50." data-val-length-max="50" data-val-required="Le champ Mot de passe est requis."  />
                            </div>
                        </br>

                        <label class="control-label col-md-2">Nom :</label>
                        <div class="col-md-2">
                            <input id="Nom" name="Nom" type="text" value="" class="text-box single-line password" data-val="true" data-val-length="Le champ Mot de passe doit être une chaîne dont la longueur maximale est de 50." data-val-length-max="50" data-val-required="Le champ Mot de passe est requis."  />
                        </div>
                        </br>

                        <label class="control-label col-md-2">Prenom :</label>
                        <div class="col-md-2">
                            <input id="Prenom" name="Prenom" type="text" value="" class="text-box single-line password" data-val="true" data-val-length="Le champ Mot de passe doit être une chaîne dont la longueur maximale est de 50." data-val-length-max="50" data-val-required="Le champ Mot de passe est requis."  />
                        </div>
                        </br>

                            <label class="control-label col-md-2">Confirmation :</label>
                            <div class="col-md-2">
                                <input id="PasswordConfirmation" name="PasswordConfirmation" type="password" value="" class="text-box single-line password" data-val="true" data-val-length="Le champ Confirmation doit être une chaîne dont la longueur maximale est de 50." data-val-length-max="50" data-val-required="Le champ Confirmation est requis."  />
                            </div>

                        </br>

                            <label class="control-label col-md-2">Courriel :</label>
                            <div class="col-md-10">
                                <input id="Email" name="Email" type="text" value="" class="text-box single-line" data-val="true" data-val-length-max="50" data-val-required="Le courriel est requis."  />
                            </div>
                        </br>

                        <div class="col-md-offset-2 col-md-2">
                            <input type="submit" value="Soumettre..." class="btn btn-default" /> <br /><br />
                        </div>

                    </form>    
            </fieldset>
        </div>
        </div>
    </body>
</html>

