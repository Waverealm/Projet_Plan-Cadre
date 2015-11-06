
<?php

    include_once("../assets/constant.php");
    include_once('../model/queries.php');



    function showHeader()
    {
        ?>
            <div class="header">
                <h1 class="header-heading">PLAN CADRE</h1>
            </div>
        <?php
    }

function showAppropriateMenu()
    {
        $visiteur = true;
        // Si la variable connected existe dans _Session
        if(isset($_SESSION[ "connected" ]))
        {
            // Si la variable connected est vrai  (redondance ?)
            if($_SESSION[ "connected" ])
            {
                // Si la variable user_type existe dans _Session
                if(isset( $_SESSION[ "user_type" ]))
                {
                    // vérifie de quel type d'utilisateur qu'il s'agit
                    switch($_SESSION[ "user_type" ])
                    {
                        case "Élaborateur":
                            showElaborateurMenu();
                            break;
                        case "Conseiller pédagogique":
                            showConseillerPedagogiqueMenu();
                            break;
                        case "Administrateur":
                            showAdminMenu();
                            break;
                        default:
                            showVisitorMenu();
                    }
                    $visiteur = false;
                }
            }
        }
        if($visiteur)
        {
            showVisitorMenu();
        }
    }

    function showVisitorMenu()
    {
        /*
        changer le menu pour que ça ne soit pas un dropdown

        */
        ?>
            <div class="pure-menu pure-menu-horizontal">
                <ul class="pure-menu-list">
                    <li class="pure-menu-item pure-menu-selected">
                        <a href="<?php echo VIEW_INDEX ?>" class="pure-menu-link">Accueil</a>
                    </li>
                    <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
                        <a href="#" id="menuLink1" class="pure-menu-link">Plan-cadre</a>
                        <ul class="pure-menu-children">
                            <li class="pure-menu-item">
                                <a href="#" class="pure-menu-link">Recherche</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <a href="<?php echo VIEW_LOGIN ?>" class="login_field">Se Connecter</a>
            </div>
        <?php
    }
    function showElaborateurMenu()
    {
        ?>
        <div class="pure-menu pure-menu-horizontal">
            <ul class="pure-menu-list">
                <li class="pure-menu-item pure-menu-selected">
                    <a href="<?php echo VIEW_INDEX ?>" class="pure-menu-link">Accueil</a>
                </li>
                <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
                    <a href="#" id="menuLink1" class="pure-menu-link">Plan-cadre</a>
                    <ul class="pure-menu-children">
                        <li class="pure-menu-item">
                            <a href="#" class="pure-menu-link">Rechercher</a>
                        </li>
                        <li class="pure-menu-item">
                            <a href="<?php echo VIEW_ELABORATION_PLANCADRE ?>" class="pure-menu-link">Créer</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="login_field"><?php echo $_SESSION['last_name'].", ".$_SESSION['first_name']."   "; ?>
                <a href="<?php echo LOGOUT ?>">Se déconnecter</a>
            </div>
        </div>
        <?php
    }
    function showConseillerPedagogiqueMenu()
    {
        ?>
            <div class="pure-menu pure-menu-horizontal">
                <ul class="pure-menu-list">
                    <li class="pure-menu-item pure-menu-selected">
                        <a href="<?php echo VIEW_INDEX ?>" class="pure-menu-link">Accueil</a>
                    </li>
                    <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
                        <a href="#" id="menuLink1" class="pure-menu-link">Plan-cadre</a>
                    <ul class="pure-menu-children">
                        <li class="pure-menu-item">
                            <a href="#" class="pure-menu-link">Recherche</a>
                        </li>
                        <li class="pure-menu-item">
                           <a href="<?php echo VIEW_ELABORATION_PLANCADRE ?>" class="pure-menu-link">Créer</a>
                        </li>
                        </ul>
                    </li>
                    <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
                        <a href="#" id="menuLink1" class="pure-menu-link">Gestion de l'information</a>
                        <ul class="pure-menu-children">
                            <li class="pure-menu-item">
                                <a href="<?php echo VIEW_CREATE_COMPETENCE ?>" class="pure-menu-link">Ajouter une compétence</a>
                            </li>
                            <li class="pure-menu-item"><?php echo VIEW_CREATE_COMPETENCE ?>
                                <a href="<?php echo VIEW_CREATE_CLASS ?>" class="pure-menu-link">Ajouter un cours</a>
                            </li>
                            <li class="pure-menu-item">
                                <a href="<?php echo VIEW_CREATE_PROGRAM ?>" class="pure-menu-link">Ajouter un programme d'études</a>
                            </li>
                            <li class="pure-menu-item">
                                <a href="<?php echo VIEW_CREATE_CONSIGNE ?>" class="pure-menu-link">Modifier les instruction des plans-cadres</a>
                            </li>
                        </ul>
                    </li>
                    <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
                        <a href="#" id="menuLink1" class="pure-menu-link">Gestion des membres
                        <ul class="pure-menu-children">
                            <li class="pure-menu-item">
                                <a href="<?php echo VIEW_CREATE_ACCOUNT ?>" class="pure-menu-link">Créer un compte</a>
                            </li>
                            <li class="pure-menu-item">
                                <a href="<?php echo VIEW_ASSIGN_USER ?>" class="pure-menu-link">Assigner un plan-cadre</a>
                            </li>
                            <li class="pure-menu-item">
                                <a href="#" class="pure-menu-link">Liste des membres</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="login_field"><?php echo $_SESSION['last_name'].", ".$_SESSION['first_name']."   "; ?>
                    <a href="<?php echo LOGOUT ?>">Se déconnecter</a>
                </div>
            </div>
        <?php
    }
    function showAdminMenu()
    {
        ?>
            <div class="pure-menu pure-menu-horizontal">
                <ul class="pure-menu-list">
                    <li class="pure-menu-item pure-menu-selected">
                        <a href="<?php echo VIEW_INDEX ?>" class="pure-menu-link">Accueil</a>
                    </li>
                    <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
                        <a href="#" id="menuLink1" class="pure-menu-link">Plan-cadre</a>
                        <ul class="pure-menu-children">
                            <li class="pure-menu-item">
                                <a href="#" class="pure-menu-link">Recherche</a>
                            </li>
                            <li class="pure-menu-item">
                                <a href="<?php echo VIEW_ELABORATION_PLANCADRE ?>" class="pure-menu-link">Créer</a>
                            </li>
                        </ul>
                    </li>
                    <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
                        <a href="#" id="menuLink1" class="pure-menu-link">Gestion de l'information</a>
                        <ul class="pure-menu-children">
                            <li class="pure-menu-item">
                                <a href="<?php echo VIEW_CREATE_COMPETENCE ?>" class="pure-menu-link">Ajouter une compétence</a>
                            </li>
                            <li class="pure-menu-item">
                                <a href="<?php echo VIEW_CREATE_CLASS ?>" class="pure-menu-link">Ajouter un cours</a>
                            </li>
                            <li class="pure-menu-item">
                                <a href="<?php echo VIEW_CREATE_PROGRAM ?>" class="pure-menu-link">Ajouter un programme d'études</a>
                            </li>
                            <li class="pure-menu-item">
                                <a href="<?php echo VIEW_CREATE_CONSIGNE ?>" class="pure-menu-link">Modifier les instruction des plans-cadres</a>
                            </li>
                        </ul>
                    </li>
                    <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
                        <a href="#" id="menuLink1" class="pure-menu-link">Gestion des membres</a>
                        <ul class="pure-menu-children">
                            <li class="pure-menu-item">
                                <a href="<?php echo VIEW_CREATE_ACCOUNT ?>" class="pure-menu-link">Créer un compte</a>
                            </li>
                            <li class="pure-menu-item">
                                <a href="<?php echo VIEW_ASSIGN_USER ?>" class="pure-menu-link">Assigner un plan-cadre</a>
                            </li>
                            <li class="pure-menu-item">
                                <a href="view_update_password_elaborator.php" class="pure-menu-link">Modification mot de passe</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="login_field"><?php echo $_SESSION['last_name'].", ".$_SESSION['first_name']."   "; ?>
                    <a href="<?php echo LOGOUT?>">Se déconnecter</a>
                </div>
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



    function getArrayUser()
    {
        $array = fetchAllUser();
        $arrayOutput;
        if(count($array) > 0)
        {
            for($i=0; $i < count($array); $i++)
            {
                // le nom et la valeur sont la clé primaire de l'utilisateur
                // le contenu / texte est le nom de l'utilisateur (prénom + nom)
                $arrayOutput[$i] = buildHTML_OptionSelect($array[$i]["NoUtilisateur"],
                    $array[$i]["NoUtilisateur"],
                    $array[$i]["Prenom"] . " " . $array[$i]["Nom"]);
            }
        }
        return $arrayOutput;
    }
    function getArrayClass()
    {
        $array = fetchAllClass();
        $arrayOutput;
        if(count($array) > 0)
        {
            for($i=0; $i < count($array); $i++)
            {
                // le nom de l'option et sa valeur sont le code du cours
                // le contenu / texte est le code du cours avec le nom du cours
                $arrayOutput[$i] = buildHTML_OptionSelect($array[$i]["CodeCours"],
                     $array[$i]["CodeCours"],
                     $array[$i]["CodeCours"] . " " . $array[$i]["NomCours"]); 
            }
        }
        return $arrayOutput;
    }







/*
    echoArray($array)
    Cette fonction utilise echo sur le contenu de chaque index de l'array.
    Suggestion : appelé cette fonction pour afficher à l'utilisateur le contenu 
    d'un array
*/
    function echoArray($array)
    {
        for ($i = 0; $i < count($array); $i++)
        {
            echo $array[$i];
        }
    }


    function showProgramsCode()
    {
        $bdd = dbConnect();

        // On va récupérer les stagiaires
        $list = selectAllProgramCode($bdd);

        echo "<div>";
            echo "<select name=\"CodeProgramme\">";

        // Affichage de la liste des codes des programmes dans une combo box.
        foreach ($list as $row)
        {
            echo "<option value=\"".$row['CodeProgramme']."\">".$row['CodeProgramme']."</option>";
        }

            echo "</select>";
        echo "</div>";
    }

    function showUserTypeList()
    {
        ?>

        <div>
             <select class="field" name="UserType" >
                <option value="Élaborateur">Élaborateur</option>
                <?php if ($_SESSION[ "user_type" ] == "Administrateur")
                {
                    echo "<option value=\"Conseiller pédagogique\">Conseiller pédagogique</option>";
                } ?>
            </select>
        </div>

        <?php
    }



?>