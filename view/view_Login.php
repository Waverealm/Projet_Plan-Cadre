<?php
  session_start();

  include_once("../controller/interface_functions.php");
  include_once("../controller/pages_access.php");

  verifyConnected();
?>


<!DOCTYPE html>
<html>
    <body>

        <head>
           <link rel="Stylesheet" href="../assets/pure.css">
           <link rel="stylesheet" href="../assets/styles.css">
           <link rel="Stylesheet" href="../assets/others.css">
        </head>

        <?php
            showHeader();
            showAppropriateMenu();
        ?>

        </br>

        <fieldset>
                    <legend>Login :</legend>
                    </br>

                <form action="../controller/controller_login.php" method="post">

                        <label class="control-label col-md-2">Nom d'usager :</label>
                        <div class="col-md-10">
                            <input class="text-box single-line" data-val="true" 
                            data-val-length="Le champ Nom d&#39;usager doit être une chaîne dont la longueur maximale est de 20 caractères." 
                            data-val-length-max="50" data-val-regex="Caractères illégaux." 
                            data-val-regex-pattern="^((?!^Name$)[-a-zA-Z0-9àâäçèêëéìîïòôöùûüÿñÀÂÄÇÈÊËÉÌÎÏÒÔÖÙÛÜ_])+$" 
                            data-val-required="Le champ Nom d&#39;usager est requis." 
                            id="UserName" name="UserName" type="text" 
                            value="<?php if (isset($_SESSION[ 'username' ])) echo htmlentities(trim($_SESSION[ 'username' ])); ?>" 
                            />
                        </div>
                    </br>

                        <label class="control-label col-md-2">Mot de passe :</label>
                        <div class="col-md-2">
                            <input class="text-box single-line password" data-val="true" 
                            data-val-length="Le champ Mot de passe doit être une chaîne dont la longueur maximale est de 20." 
                            data-val-length-max="50" data-val-required="Le champ Mot de passe est requis." 
                            id="Password" name="Password" type="password" value="" 
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


