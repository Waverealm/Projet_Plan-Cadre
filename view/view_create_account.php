<?php

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    include_once("../controller/interface_functions.php");
    include_once("../model/model_pages_access.php");

    // Variables utilisées pour le menu interractif
    $currentConseiller = 'createaccount';
    $currentAdmin = 'createaccount';

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

                <fieldset>
                            <legend>Créer un compte :</legend>
                            </br>

                        <form action="../controller/controller_create_account.php" method="post">

                            <label>Nom d'utilisateur :</label>
                            <div>
                                <input class="field" id="username" name="username" type="text" 
                                value="<?php if (isset($_SESSION[ 'new_account_username' ])) echo htmlentities(trim($_SESSION[ 'new_account_username' ])); ?>" 
                                class="text-box single-line" 
                                required
                                />
                            </div>
                            </br>

                            <label>Mot de passe :</label>
                            <div>
                                <input class="field" id="password" name="password" type="password" 
                                value="" class="text-box single-line password" 
                                required
                                />
                            </div>
                            </br>

                            <label>Confirmer le mot de passe :</label>
                            <div>
                                <input class="field" id="pass_confirm" name="pass_confirm" 
                                type="password" value="" class="text-box single-line password" 
                                required
                                />
                            </div>
                            </br>

                            <label>Adresse courriel :</label>
                            <div>
                                <input class="field" id="email" name="email" type="email" 
                                value="<?php if (isset($_SESSION[ 'new_account_email' ])) echo htmlentities(trim($_SESSION[ 'new_account_email' ])); ?>" 
                                class="text-box single-line" 
                                required
                                />
                            </div>
                            </br>

                            <label>Nom :</label>
                            <div>
                                <input class="field" id="last_name" name="last_name" type="text" 
                                value="<?php if (isset($_SESSION[ 'new_account_last_name' ])) echo htmlentities(trim($_SESSION[ 'new_account_last_name' ])); ?>"
                                class="text-box single-line" onkeypress="return alphaOnly(event);"
                                required
                                />
                            </div>
                            </br>

                            <label>Prenom :</label>
                            <div>
                                <input class="field" id="first_name" name="first_name" type="text" 
                                value="<?php if (isset($_SESSION[ 'new_account_first_name' ])) echo htmlentities(trim($_SESSION[ 'new_account_first_name' ])); ?>" 
                                class="text-box single-line" onkeypress="return alphaOnly(event);" 
                                required
                                />
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
    </body>
</html>

    <?php 
        showSessionMessage("errors_create_user");
    ?>
