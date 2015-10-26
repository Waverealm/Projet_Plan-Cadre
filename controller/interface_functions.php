
<?php

    function showHeader()
    {
        ?>

            <div class="header"> 
                <h1 class="header-heading">Plan-cadre</h1>
            </div>

        <?php
    }

    function showAppropriateMenu()
    {
        if(isset($_SESSION[ "connected" ]))
        {
            if($_SESSION[ "connected" ])
            {
                ?>
                    <div class="pure-menu pure-menu-horizontal">
                        <ul class="pure-menu-list">
                            <li class="pure-menu-item pure-menu-selected"><a href="view_index.php" class="pure-menu-link">Accueil</a></li>
                            <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
                                <a href="#" id="menuLink1" class="pure-menu-link">Plan-cadre</a>
                                <ul class="pure-menu-children">
                                    <li class="pure-menu-item"><a href="#" class="pure-menu-link">Recherche</a></li>
                                    <li class="pure-menu-item"><a href="#" class="pure-menu-link">Élaboration</a></li>
                                </ul>
                            </li>
                            <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
                                <a href="#" id="menuLink1" class="pure-menu-link">Gestion de l\'information</a>
                                <ul class="pure-menu-children">
                                    <li class="pure-menu-item"><a href="view_add_competence.php" class="pure-menu-link">Ajouter des compétences</a></li>
                                    <li class="pure-menu-item"><a href="view_add_class.php" class="pure-menu-link">Ajouter des cours</a></li>
                                    <li class="pure-menu-item"><a href="view_add_program.php" class="pure-menu-link">Ajouter des programme d\'étude</a></li>
                                    <li class="pure-menu-item"><a href="#" class="pure-menu-link">Modifier les instruction des plans-cadres</a></li>
                                </ul>
                            </li>
                            <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
                                <a href="#" id="menuLink1" class="pure-menu-link">Gestion des comptes utilisateurs</a>
                                <ul class="pure-menu-children">
                                    <li class="pure-menu-item"><a href="view_create_account.php" class="pure-menu-link">Créer un compte</a></li>
                                    <li class="pure-menu-item"><a href="view_create_plancadre.php" class="pure-menu-link">Créer un Plan-Cadre</a></li>
                                    <li class="pure-menu-item"><a href="view_assign_user.php" class="pure-menu-link">Assigner un plan-cadre</a></li>
                                    <li class="pure-menu-item"><a href="#" class="pure-menu-link">Liste des membres</a></li>
                                </ul>
                            </li>
                        </ul>
                        <div class="login_field"><?php echo $_SESSION['last_name'].", ".$_SESSION['first_name']."   "; ?><a href="../controller/controller_logout.php">Se déconnecter</a></div>
                    </div>

                <?php
            }
        }

        else
        {
            showVisitorMenu();
        }
    }

    function showVisitorMenu()
    {
        ?>
            <div class="pure-menu pure-menu-horizontal">
                <ul class="pure-menu-list">
                    <li class="pure-menu-item pure-menu-selected"><a href="view_index.php" class="pure-menu-link">Accueil</a></li>
                    <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
                        <a href="#" id="menuLink1" class="pure-menu-link">Plan-cadre</a>
                        <ul class="pure-menu-children">
                            <li class="pure-menu-item"><a href="#" class="pure-menu-link">Recherche</a></li>
                        </ul>
                    </li>
                </ul>
                <a href="view_login.php" class="login_field">Se Connecter</a>
            </div>

        <?php
    }

    function showConnectionAlert()
    {
        if( isset($_SESSION[ 'connection_info' ]) )   
        {
            ?>
            <script>alert("<?php echo $_SESSION[ 'connection_info' ]; ?>");</script>
            <?php
            unset($_SESSION[ 'connection_info' ]);
        }
    }

    function showCreateAccountSuccess()
    {
        if (isset($_SESSION[ 'new_account_success' ]))
        {
            ?>
            <script>alert("<?php echo 'Le compte a bien été créé'; ?>");</script>
            <?php

            unset($_SESSION[ 'new_account_success']);
        }
    }




/*
    buildHTML_OptionSelect($name, $value, $content)
    Cette fonction retourne une chaine de charactère qui devrait servir 
    a représenter un tag html <option>. 
    Par exemple,
    <select name="select_list" id="select_list">
    <?php
    buildHTML_OptionSelect("nom", "valeur", "contenu");
    ?>
    </select>
*/
    function buildHTML_OptionSelect($name, $value, $content)
    {
        return "<option "
        ."name='".$name."'" 
        ." value='".$value."'"
        ." >"
        .$content
        ."</option>";
    }

?>