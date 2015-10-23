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
                            <input id="UserName" name="UserName" type="text" value="<?php if (isset($_SESSION[ 'new_account_username' ])) echo htmlentities(trim($_SESSION[ 'new_account_username' ])); ?>" class="text-box single-line" />
                        </div>
                        </br>

                        <label class="control-label col-md-2">Mot de passe :</label>
                        <div class="col-md-2">
                            <input id="Password" name="Password" type="password" value="" class="text-box single-line password" />
                        </div>
                        </br>

                        <label class="control-label col-md-2">Confirmer le mot de passe :</label>
                        <div class="col-md-2">
                            <input id="PasswordConfirmation" name="PasswordConfirmation" type="password" value="" class="text-box single-line password" />
                        </div>
                        </br>

                        <label class="control-label col-md-2">Adresse courriel :</label>
                        <div class="col-md-10">
                            <input id="Email" name="Email" type="text" value="<?php if (isset($_SESSION[ 'new_account_email' ])) echo htmlentities(trim($_SESSION[ 'new_account_email' ])); ?>" class="text-box single-line" />
                        </div>
                        </br>

                        <label class="control-label col-md-2">Nom :</label>
                        <div class="col-md-2">
                            <input id="LastName" name="LastName" type="text" value="<?php if (isset($_SESSION[ 'new_account_last_name' ])) echo htmlentities(trim($_SESSION[ 'new_account_last_name' ])); ?>" class="text-box single-line" />
                        </div>
                        </br>

                        <label class="control-label col-md-2">Prenom :</label>
                        <div class="col-md-2">
                            <input id="FirstName" name="FirstName" type="text" value="<?php if (isset($_SESSION[ 'new_account_first_name' ])) echo htmlentities(trim($_SESSION[ 'new_account_first_name' ])); ?>" class="text-box single-line" />
                        </div>
                        </br>

                        <label class="control-label col-md-2">Type d'utilisateur :</label>
                        <div class="col-md-2">
                            <select name="UserType" >
                              <option value="Elaborateur">Elaborateur</option>
                           </select>
                        </div>
                        </br>

                        <div class="col-md-offset-2 col-md-2">
                            <input type="submit" value="Soumettre..." class="btn btn-default" /> <br /><br />
                        </div>

                    </form>    
            </fieldset>
        </div>
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

