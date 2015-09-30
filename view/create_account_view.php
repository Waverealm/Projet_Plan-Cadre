<!DOCTYPE html>
<html>
    <body>
        <?php
        include_once("../controller/interface_functions.php");
        ?>

        <head>
           <link rel="Stylesheet" href="../assets/pure.css">
           <link rel="Stylesheet" href="../assets/styles.css">
        </head>

            <?php
             echo getMenu();
            ?>

            </br>

            <fieldset>
                        <legend>Inscription:</legend>
                        </br>

                    <form action="../controller/create_account_controller.php" method="post">

                            <label class="control-label col-md-2">Nom d'usager :</label>
                            <div class="col-md-10">
                                <input class="text-box single-line" data-val="true" data-val-length="Le champ Nom d&#39;usager doit être une chaîne dont la longueur maximale est de 50." data-val-length-max="50" data-val-regex="Caractères illégaux." data-val-regex-pattern="^((?!^Name$)[-a-zA-Z0-9àâäçèêëéìîïòôöùûüÿñÀÂÄÇÈÊËÉÌÎÏÒÔÖÙÛÜ_])+$" data-val-required="Le champ Nom d&#39;usager est requis." id="UserName" name="UserName" type="text" value="" />
                            </div>
                        </br>

                            <label class="control-label col-md-2">Mot de passe :</label>
                            <div class="col-md-2">
                                <input class="text-box single-line password" data-val="true" data-val-length="Le champ Mot de passe doit être une chaîne dont la longueur maximale est de 50." data-val-length-max="50" data-val-required="Le champ Mot de passe est requis." id="Password" name="Password" type="password" value="" />
                            </div>
                        </br>

                            <label class="control-label col-md-2">Confirmation :</label>
                            <div class="col-md-2">
                                <input class="text-box single-line password" data-val="true" data-val-length="Le champ Confirmation doit être une chaîne dont la longueur maximale est de 50." data-val-length-max="50" data-val-required="Le champ Confirmation est requis." id="PasswordConfirmation" name="PasswordConfirmation" type="password" value="" />
                            </div>

                        </br>

                            <label class="control-label col-md-2">Courriel :</label>
                            <div class="col-md-10">
                                <input class="text-box single-line" data-val="true" data-val-length-max="50" data-val-required="Le courriel est requis." id="Email" name="Email" type="text" value="" />
                            </div>
                        </br>

                        <div class="col-md-offset-2 col-md-2">
                            <input type="submit" value="Soumettre..." class="btn btn-default" /> <br /><br />
                        </div>

                    </form>    
            </fieldset>
        </div>
    </body>
</html>

