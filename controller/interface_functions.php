<?php


    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 


    include_once("../assets/constant.php");
    include_once('../model/queries.php');
    include_once('../model/model_search_plan_cadre.php');

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
        GLOBAL $currentVisitor;

        /*
            Le menu a été changé pour ne pas être un drop-down menu
            puisqu'il y a seulement un lien

            <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
                <a href="#" id="menuLink1" class="pure-menu-link">Plan-cadre</a>
                 <ul class="pure-menu-children">
                    <li class="pure-menu-item">
                        <a href="<?php echo VIEW_SEARCH_PLAN_CADRE ?>" class="pure-menu-link">Recherche</a>
                    </li>
                </ul>
            </li>
            
        */

        ?>
            <div class="pure-menu pure-menu-horizontal">
                <ul class="pure-menu-list">
                    <li <?php if($currentVisitor == 'searchplancadreofficiel') {echo 'class="pure-menu-item pure-menu-selected"';} ?> class="pure-menu-item">
                        <a href="<?php echo VIEW_INDEX ?>" class="pure-menu-link">Accueil</a>
                    </li>
                    <li <?php if($currentVisitor == 'searchplancadre') {echo 'class="pure-menu-item pure-menu-allow-hover pure-menu-selected"';} ?> class="pure-menu-item pure-menu-allow-hover">
                        <a href="<?php echo VIEW_SEARCH_PLAN_CADRE ?>" id="menuLink1" class="pure-menu-link">Plan-cadre</a>

                    </li>
                    <li <?php if($currentVisitor == 'index') {echo 'class="pure-menu-item pure-menu-selected"';} ?> class="pure-menu-item ">
                        <a href="<?php echo ABOUT ?>" class="pure-menu-link">À propos</a>
                    </li>
                </ul>
                <a href="<?php echo VIEW_LOGIN ?>" class="login_field">Se Connecter</a>
            </div>
        <?php
    }
    function showElaborateurMenu()
    {
        GLOBAL $currentElaborator;
        ?>
        <div class="pure-menu pure-menu-horizontal">
            <ul class="pure-menu-list">
                <li <?php if($currentElaborator == 'searchplancadreofficiel') {echo 'class="pure-menu-item pure-menu-selected"';} ?> class="pure-menu-item ">
                    <a href="<?php echo VIEW_INDEX ?>" class="pure-menu-link">Accueil</a>
                </li>
                <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
                    <a href="#" id="menuLink1" class="pure-menu-link">Plan-cadre</a>
                    <ul class="pure-menu-children">
                        <li <?php if($currentElaborator == 'searchplancadre') {echo 'class="pure-menu-item pure-menu-selected"';} ?> class="pure-menu-item">
                            <a href="<?php echo VIEW_SEARCH_PLAN_CADRE ?>" class="pure-menu-link">Rechercher</a>
                        </li>
                        <li <?php if($currentElaborator == 'elaborationplancadre') {echo 'class="pure-menu-item pure-menu-selected"';} ?> class="pure-menu-item">
                            <a href="<?php echo VIEW_ELABORATION_PLANCADRE ?>" class="pure-menu-link">Modifier un Plan-cadre</a>
                        </li>
                    </ul>
                </li>
                <li <?php if($currentElaborator == 'index') {echo 'class="pure-menu-item pure-menu-selected"';} ?> class="pure-menu-item ">
                    <a href="<?php echo ABOUT ?>" class="pure-menu-link">À propos</a>
                </li>
            </ul>
            <div class="login_field"><?php echo $_SESSION['last_name'].", ".$_SESSION['first_name']."   "; ?>
                <a href="<?php echo CONTROLLER_LOGOUT ?>">Se déconnecter</a>
            </div>
        </div>
        <?php
    }

/*
    <li class="pure-menu-item">
        <a href="<?php echo VIEW_CREATE_COMPETENCE ?>" class="pure-menu-link">Ajouter une compétence</a>
    </li>

    Nous ne occupons présentement pas des compétences. 
    On peut travailler dessus à la fin si il reste du temps.

*/
    function showConseillerPedagogiqueMenu()
    {
        GLOBAL $currentConseiller;
        ?>
            <div class="pure-menu pure-menu-horizontal">
                <ul class="pure-menu-list">
                    <li <?php if($currentConseiller == 'searchplancadreofficiel') {echo 'class="pure-menu-item pure-menu-selected"';} ?> class="pure-menu-item ">
                        <a href="<?php echo VIEW_INDEX ?>" class="pure-menu-link">Accueil</a>
                    </li>
                    <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
                        <a href="#" id="menuLink1" class="pure-menu-link">Plan-cadre</a>
                    <ul class="pure-menu-children">
                        <li <?php if($currentConseiller == 'searchplancadre') {echo 'class="pure-menu-item pure-menu-selected"';} ?> class="pure-menu-item">
                            <a href="<?php echo VIEW_SEARCH_PLAN_CADRE ?>" class="pure-menu-link">Recherche</a>
                        </li>
                        <li <?php if($currentConseiller == 'elaborationplancadre') {echo 'class="pure-menu-item pure-menu-selected"';} ?> class="pure-menu-item">
                           <a href="<?php echo VIEW_ELABORATION_PLANCADRE ?>" class="pure-menu-link">Modifier un Plan-cadre</a>
                        </li>
                        </ul>
                    </li>
                    <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
                        <a href="#" id="menuLink1" class="pure-menu-link">Gestion de l'information</a>
                        <ul class="pure-menu-children">
                            <li <?php if($currentConseiller == 'createclass') {echo 'class="pure-menu-item pure-menu-selected"';} ?> class="pure-menu-item">
                                <a href="<?php echo VIEW_MANAGE_CLASS ?>" class="pure-menu-link">Ajouter/Modifier un cours</a>
                            </li>
                            <li <?php if($currentConseiller == 'createprogram') {echo 'class="pure-menu-item pure-menu-selected"';} ?> class="pure-menu-item">
                                <a href="<?php echo VIEW_CREATE_PROGRAM ?>" class="pure-menu-link">Ajouter un programme d'études</a>
                            </li>
                            <li <?php if($currentConseiller == 'updateinstructions') {echo 'class="pure-menu-item pure-menu-selected"';} ?> class="pure-menu-item">
                                <a href="<?php echo VIEW_UPDATE_INSTRUCTIONS ?>" class="pure-menu-link">Modifier les instruction des plans-cadres</a>
                            </li>
                        </ul>
                    </li>
                    <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
                        <a href="#" id="menuLink1" class="pure-menu-link">Gestion des membres</a>
                        <ul class="pure-menu-children">
                            <li <?php if($currentConseiller == 'createaccount') {echo 'class="pure-menu-item pure-menu-selected"';} ?> class="pure-menu-item">
                                <a href="<?php echo VIEW_CREATE_ACCOUNT ?>" class="pure-menu-link">Créer un compte</a>
                            </li>
                            <li <?php if($currentConseiller == 'assignuser') {echo 'class="pure-menu-item pure-menu-selected"';} ?> class="pure-menu-item">
                                <a href="<?php echo VIEW_ASSIGN_USER ?>" class="pure-menu-link">Assigner un plan-cadre</a>
                            </li>
                            <li <?php if($currentConseiller == 'updatepassword') {echo 'class="pure-menu-item pure-menu-selected"';} ?> class="pure-menu-item">
                                <a href="<?php echo VIEW_UPDATE_PASSWORD ?>" class="pure-menu-link">Modification mot de passe</a>
                            </li>
                        </ul>
                    </li>
                    <li <?php if($currentConseiller == 'index') {echo 'class="pure-menu-item pure-menu-selected"';} ?> class="pure-menu-item ">
                        <a href="<?php echo ABOUT ?>" class="pure-menu-link">À propos</a>
                    </li>
                </ul>
                <div class="login_field"><?php echo $_SESSION['last_name'].", ".$_SESSION['first_name']."   "; ?>
                    <a href="<?php echo CONTROLLER_LOGOUT ?>">Se déconnecter</a>
                </div>
            </div>
        <?php
    }
    function showAdminMenu()
    {
        GLOBAL $currentAdmin;
        ?>
            <div class="pure-menu pure-menu-horizontal">
                <ul class="pure-menu-list">
                    <li <?php if($currentAdmin == 'searchplancadreofficiel') {echo 'class="pure-menu-item pure-menu-selected"';} ?> class="pure-menu-item ">
                        <a href="<?php echo VIEW_INDEX ?>" class="pure-menu-link">Accueil</a>
                    </li>
                    <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
                        <a href="#" id="menuLink1" class="pure-menu-link">Plan-cadre</a>
                        <ul class="pure-menu-children">
                            <li <?php if($currentAdmin == 'searchplancadre') {echo 'class="pure-menu-item pure-menu-selected"';} ?> class="pure-menu-item">
                                <a href="<?php echo VIEW_SEARCH_PLAN_CADRE ?>" class="pure-menu-link">Recherche</a>
                            </li>
                            <li <?php if($currentAdmin == 'elaborationplancadre') {echo 'class="pure-menu-item pure-menu-selected"';} ?> class="pure-menu-item">
                                <a href="<?php echo VIEW_ELABORATION_PLANCADRE ?>" class="pure-menu-link">Modifier un Plan-cadre</a>
                            </li>
                        </ul>
                    </li>
                    <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
                        <a href="#" id="menuLink1" class="pure-menu-link">Gestion des membres</a>
                        <ul class="pure-menu-children">
                            <li <?php if($currentAdmin == 'createaccount') {echo 'class="pure-menu-item pure-menu-selected"';} ?> class="pure-menu-item">
                                <a href="<?php echo VIEW_CREATE_ACCOUNT ?>" class="pure-menu-link">Créer un compte</a>
                            </li>
                            <li <?php if($currentAdmin == 'assignuser') {echo 'class="pure-menu-item pure-menu-selected"';} ?> class="pure-menu-item">
                                <a href="<?php echo VIEW_ASSIGN_USER ?>" class="pure-menu-link">Assigner un plan-cadre</a>
                            </li>
                            <li <?php if($currentAdmin == 'updatepassword') {echo 'class="pure-menu-item pure-menu-selected"';} ?> class="pure-menu-item">
                                <a href="<?php echo VIEW_UPDATE_PASSWORD ?>" class="pure-menu-link">Modification mot de passe</a>
                            </li>
                        </ul>
                    </li>
                    <li <?php if($currentAdmin == 'index') {echo 'class="pure-menu-item pure-menu-selected"';} ?> class="pure-menu-item ">
                        <a href="<?php echo ABOUT ?>" class="pure-menu-link">À propos</a>
                    </li>
                </ul>
                <div class="login_field"><?php echo $_SESSION['last_name'].", ".$_SESSION['first_name']."   "; ?>
                    <a href="<?php echo CONTROLLER_LOGOUT ?>">Se déconnecter</a>
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


    function showProgramsCode()
    {
        $list = selectAllProgramCode();

        echo "<div>";
            echo "<select name=\"program_list_all\">";

        // Affichage de la liste des codes des programmes dans une combo box.
        foreach ($list as $row)
        {
            echo "<option value=\"".$row['CodeProgramme']."\">".$row['CodeProgramme']. "</option>";
        }

            echo "</select>";
        echo "</div>";
    }

    function showUserTypeList()
    {
        ?>

        <div>
             <select class="field" name="user_type" >
                <option value="Élaborateur">Élaborateur</option>
                <?php 
                if ($_SESSION[ "user_type" ] == "Administrateur")
                {
                ?>
                    <option value="Conseiller pédagogique">Conseiller pédagogique</option>
                <?php
                } 
                ?>
            </select>
        </div>

        <?php
    }

/*
    Nom de la fonction : showUserListAll
    Fait par : Simon Roy
    Cette fonction permet d'afficher une liste d'utilisateur
    dans une liste déroulante. La liste d'utilisateur est obtenue par fecthAllUser
*/
    function showUserListAll()
    {
        if ($_SESSION[ 'user_type' ] == 'Administrateur')
        {
            $list = fetchAllUser();
        }
        else if ($_SESSION[ 'user_type' ] == 'Conseiller pédagogique')
        {
            $list = fetchAllPlanners("Élaborateur");
        }
        echo "<select class='field' name='user_list_all'>";
        if(sizeof($list) > 0)
        {
            foreach ($list as $row)
            {
                echo "<option value=\"".$row['NoUtilisateur']."\">".$row['Prenom']." ".$row['Nom']."</option>";
            }
        }
        else
        {
            echo "<option>"."Aucun utilisateur"."</option>";
        }
        
        echo "</select>";
    }

    function showListPrograms()
    {
        $list = selectAllPrograms();

        echo '<select name="CodeProgramme">';
            echo '<option value="">' . '</option>';
        foreach ($list as $row)
        {
            echo '<option value="'.$row['CodeProgramme'].'">'.$row['CodeProgramme']. ' ' .$row['NomProgramme']. '</option>';
        }
        echo "</select>";
    }

    function showProgramListAll()
    {
        $list = selectAllPrograms();

        echo "<form action='../controller/controller_save_program_code.php' method='post'>";
            echo "<select name=\"CodeProgramme\" id=\"CodeProgramme\">";
                echo "<option value='Tous' ".isSelected('Tous').">Afficher tous les plans-cadre</option>";
            if(sizeof($list) > 0)
            {
                foreach ($list as $row)
                {
                    echo "<option value=\"".$row['CodeProgramme']."\" ".isSelected($row['CodeProgramme']).">".$row['CodeProgramme']. " " . $row['NomProgramme']  ."</option>";
                }
            }
            else
            {
                echo "<option>"."Aucun Programme"."</option>";
            }
            echo "</select>";

            echo "<input type='submit' value='Rechercher'>";
        echo "</form>";
    }
    


    function showListProgramsWithSelected()
    {
        $list = selectAllPrograms();

        echo "<div>";
            echo '<select name="program_list_all">';
                echo '<option value="">' . '</option>';
        foreach ($list as $row)
        {
            if(isset($_SESSION["selected_CodeProgramme"]))
            {
                if($row["CodeProgramme"] == $_SESSION["selected_CodeProgramme"])
                {
                    echo '<option selected value="'.$row['CodeProgramme'].'">'.$row['CodeProgramme']. ' ' .$row['NomProgramme']. '</option>';
                    unset($_SESSION["selected_CodeProgramme"]);
                }
                else
                {
                    echo '<option value="'.$row['CodeProgramme'].'">'.$row['CodeProgramme']. ' ' .$row['NomProgramme']. '</option>';
                }
            }
            else
            {
                echo '<option value="'.$row['CodeProgramme'].'">'.$row['CodeProgramme']. ' ' .$row['NomProgramme']. '</option>';
            }
        }

            echo "</select>";
        echo "</div>";
    }

/*
    Nom de la fonction : showListClassWithSelected
    Fait par : Simon Roy
    Cette fonction permet d'afficher une liste déroulante de tous les cours.
*/
    function showListClassWithSelected()
    {
        $list = fetchAllClass();

        echo "<select name='class_list_all' id='class_list_all'>";
            echo "<option value=\"" . "\">" . "</option>";
        
        if(sizeof($list) > 0)
        {
            foreach ($list as $row)
            {
                if(isset($_SESSION["selected_CodeCours"]) )
                {
                    if($row["CodeCours"] == $_SESSION["selected_CodeCours"])
                    {
                        echo "<option selected value=\"".$row["CodeCours"]."\">".$row["CodeCours"]." ".$row["NomCours"]."</option>";
                        unset($_SESSION["selected_CodeCours"]);
                    }
                    else
                    {
                        echo "<option value=\"".$row["CodeCours"]."\">".$row["CodeCours"]." ".$row["NomCours"]."</option>";
                    }
                }
                else
                {
                     echo "<option value=\"".$row["CodeCours"]."\">".$row["CodeCours"]." ".$row["NomCours"]."</option>";
                }
            }
        }
        else
        {
            echo "<option>"."Aucun cours"."</option>";
        }
        echo "</select>";
    }



    function showClassListAll()
    {
        $list = fetchAllClass();

        echo "<select name='class_list_all' id='class_list_all'>";
            echo "<option value=\"" . "\">" . "</option>";
        
        if(sizeof($list) > 0)
        {
            foreach ($list as $row)
            {
                if(empty(fetchPlanCadreClass($row["CodeCours"])))
                {
                    echo "<option value=\"".$row["CodeCours"]."\">".$row["CodeCours"]." ".$row["NomCours"]."</option>";
                }
            }
        }
        else
        {
            echo "<option>"."Aucun cours"."</option>";
        }
        echo "</select>";
    }

/*
    Nom de la fonction : showPlanCadreElaboration
    Fait par : Simon Roy
    Cette fonction permet d'afficher une liste déroulante de tous 
    les plans-cadres en élaboration
*/
    function showPlanCadreElaboration()
    {
        $list = selectPlanCadreElaboration();

        echo "<select name='plan_cadre_elaboration_list' id='plan_cadre_elaboration_list'>";
            echo "<option value=\"" . "\">" . "</option>";
        
        if(sizeof($list) > 0)
        {
            foreach ($list as $row)
            {
                
                echo "<option value=\"".$row["No_PlanCadre"]."\">". "(".$row["DateAjout"].")". " " 
                .$row["CodeCours"]." ".$row["NomCours"]."</option>";
            }
        }
        else
        {
            echo "<option>"."Aucun cours"."</option>";
        }
        echo "</select>";
    }

/*
    Nom de la fonction : showConsignePlanCadre
*/
    function showConsignePlanCadre()
    {
        $list = selectAllConsignesPlanCadre();

        echo "<div>";
            echo "<select class='field' name=\"consigne_list\" onchange='showSelectedInstruction(this.value)'>";
                foreach ($list as $row)
                {
                    echo "<option value=\"".$row["CodeConsigne"]."\">" .$row["TitreConsigne"]."</option>";
                }
            echo "</select>";
        echo "</div>";
    }



    // pour les tag html select (la validation)
    // http://stackoverflow.com/questions/1271640/validate-select-box

    function showInstructionsTable()
    {
        $list = selectAllConsignesPlanCadre();

        echo "<table>".
                "<tr>".
                    "<th>Titre de la section</th>".
                    "<th>Énoncé de la consigne</th>".
                    "<th>Description de la consigne</th>".
                "</tr>";
        foreach ($list as $row)
        {
            echo "<tr>".
                    "<td>".$row["TitreConsigne"]."</td>".
                    "<td id=\"".$row["CodeConsigne"]."_enonce"."\">".$row["EnonceConsigne"]."</td>".
                    "<td id=\"".$row["CodeConsigne"]."_description"."\">".$row["DescriptionConsigne"]."</td>".
                "</tr>";
        }
        echo "</table>";
    }

    function showInstructionToggle($codeInstruction)
    {
        $descriptionConsigne = fetchDescriptionInstruction($codeInstruction);

        ?>

        <br>
        <a class="toggler">Afficher/masquer la consigne</a>
        <p class="toggled"><?php echo $descriptionConsigne[0][ "DescriptionConsigne" ]; ?></p>
        <br>
        <br>

        <?php
    }

    function showSessionMessage($errors)
    {
        // On affiche les erreurs s'il y en a
        if( isset($_SESSION[ $errors ]) )
        {
            ?>

            <script>alert("<?php echo $_SESSION[ $errors ]; ?>");</script>

            <?php

            unset($_SESSION[ $errors ]);
        }
    }

?>