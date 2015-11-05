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
  isPlanner();
?>

<!DOCTYPE html>
<html>

        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            
           <link rel="Stylesheet" href="../assets/pure.css">
           <link rel="Stylesheet" href="../assets/styles.css">
           <link rel="Stylesheet" href="../assets/others.css">
           <script src="../assets/js_global.js" ></script>
        </head>
        <body>
            <div class="container">
                <?php
                    showHeader();
                    showAppropriateMenu();
                ?>

                </br>

                <fieldset>
                            <legend>Créer un compte :</legend>
                            </br>

                        <form action="../controller/controller_create_account.php" method="post">

                            <label>Nom d'usager :</label>
                            <div>
                                <input class="field" id="UserName" name="UserName" type="text" value="<?php if (isset($_SESSION[ 'new_account_username' ])) echo htmlentities(trim($_SESSION[ 'new_account_username' ])); ?>" class="text-box single-line" />
                            </div>
                            </br>

                            <label>Mot de passe :</label>
                            <div>
                                <input class="field" id="Password" name="Password" type="password" value="" class="text-box single-line password" />
                            </div>
                            </br>

                            <label>Confirmer le mot de passe :</label>
                            <div>
                                <input class="field" id="PasswordConfirmation" name="PasswordConfirmation" type="password" value="" class="text-box single-line password" />
                            </div>
                            </br>

                            <label>Adresse courriel :</label>
                            <div>
                                <input class="field" id="Email" name="Email" type="text" value="<?php if (isset($_SESSION[ 'new_account_email' ])) echo htmlentities(trim($_SESSION[ 'new_account_email' ])); ?>" class="text-box single-line" />
                            </div>
                            </br>

                            <label>Nom :</label>
                            <div>
                                <input class="field" id="LastName" name="LastName" type="text" value="<?php if (isset($_SESSION[ 'new_account_last_name' ])) echo htmlentities(trim($_SESSION[ 'new_account_last_name' ])); ?>" class="text-box single-line" onkeypress="return alphaOnly(event);" />
                            </div>
                            </br>

                            <label>Prenom :</label>
                            <div>
                                <input class="field" id="FirstName" name="FirstName" type="text" value="<?php if (isset($_SESSION[ 'new_account_first_name' ])) echo htmlentities(trim($_SESSION[ 'new_account_first_name' ])); ?>" class="text-box single-line" onkeypress="return alphaOnly(event);" />
                            </div>
                            </br>

                            <label>Type d'utilisateur :</label>
                            <?php showUserTypeList(); ?>
                            </br>

                            <div>
                                <input type="submit" value="Soumettre..." class="btn btn-default" /> <br /><br />
                            </div>

                        </form>    
                </fieldset>
            </div>

        <center>
         <?php 

            // On affiche les erreurs s'il y en a
            if( isset($_SESSION[ 'errors_create_user' ]) )
            {
               echo $_SESSION[ 'errors_create_user' ];
               unset($_SESSION[ 'errors_create_user' ]);
            }
         ?>
      </center>
    </body>
</html>

