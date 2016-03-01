<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 








    

function showSessionMessage($errors)
{
    // On affiche les erreurs s'il y en a
    if( isset($_SESSION[ $errors ]) )
    {
        ?>

        <script>alert("<?php echo $_SESSION[ $errors ]; ?>");</script>

        <?php
        // une fois les erreurs ont été affichées on ne veut pas 
        // qu'elles le soient la prochaine fois.
        unset($_SESSION[ $errors ]);
    }
}



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
                    // l'utilisateur n'est pas un visiteur
                    $visiteur = false;
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
                            // erreur ! type d'utilisateur invalide
                            showConnectedMenu();
                    }
                }
            }
        }
        if($visiteur)
        {
            showVisitorMenu();
        }
        
    }
    
    function getSelectedMenuClass()
    {
        return 'class="pure-menu-item pure-menu-selected"';
    }
    
    function showVisitorMenu()
    {
        GLOBAL $currentVisitor;

        ?>
            <div class="pure-menu pure-menu-horizontal">
                <ul class="pure-menu-list">
                    <li <?php if($currentVisitor == 'index') {echo getSelectedMenuClass();} ?> class="pure-menu-item">
                        <a href="<?php echo VIEW_INDEX ?>" class="pure-menu-link">Accueil</a>
                    </li>
                    <li <?php if($currentVisitor == 'searchplancadre') {echo getSelectedMenuClass();} ?> class="pure-menu-item pure-menu-allow-hover">
                        <a href="<?php echo VIEW_SEARCH_PLAN_CADRE ?>" id="menuLink1" class="pure-menu-link">Plan-cadre</a>

                    </li>
                </ul>
                <a href="<?php echo VIEW_LOGIN ?>" class="login_field">Se Connecter</a>
            </div>
        <?php
    }
    function showConnectedMenu()
    {
        GLOBAL $currentVisitor;
        ?>
            <div class="pure-menu pure-menu-horizontal">
                <ul class="pure-menu-list">
                    <li <?php if($currentVisitor == 'index') {echo getSelectedMenuClass();} ?> class="pure-menu-item">
                        <a href="<?php echo VIEW_INDEX ?>" class="pure-menu-link">Accueil</a>
                    </li>
                    <li <?php if($currentVisitor == 'searchplancadre') {echo getSelectedMenuClass();} ?> class="pure-menu-item pure-menu-allow-hover">
                        <a href="<?php echo VIEW_SEARCH_PLAN_CADRE ?>" id="menuLink1" class="pure-menu-link">Plan-cadre</a>
                    </li>
                </ul>
                <div class="login_field"><?php echo "<font color='red'> Type d'utilisateur invalide ! </font>" . $_SESSION['last_name'].", ".$_SESSION['first_name']."   "; ?>
                <a href="<?php echo CONTROLLER_LOGOUT ?>">Se déconnecter</a>
            </div>
        </div>
        <?php
    }
    function showElaborateurMenu()
    {
        GLOBAL $currentElaborator;
        ?>
        <div class="pure-menu pure-menu-horizontal">
            <ul class="pure-menu-list">
                <li <?php if($currentElaborator == 'index') {echo 'class="pure-menu-item pure-menu-selected"';} ?> class="pure-menu-item ">
                    <a href="<?php echo VIEW_INDEX ?>" class="pure-menu-link">Accueil</a>
                </li>
                <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
                    <a href="#" id="menuLink1" class="pure-menu-link">Plan-cadre</a>
                    <ul class="pure-menu-children">
                        <li <?php if($currentElaborator == 'searchplancadre') {echo 'class="pure-menu-item pure-menu-selected"';} ?> class="pure-menu-item">
                            <a href="<?php echo VIEW_SEARCH_PLAN_CADRE ?>" class="pure-menu-link">Rechercher</a>
                        </li>
                        <li <?php if($currentElaborator == 'elaborationplancadre') {echo 'class="pure-menu-item pure-menu-selected"';} ?> class="pure-menu-item">
                            <a href="<?php echo VIEW_ELABORATION_PLANCADRE ?>" class="pure-menu-link">Créer</a>
                        </li>
                    </ul>
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
                    <li <?php if($currentConseiller == 'index') {echo getSelectedMenuClass();} ?> class="pure-menu-item ">
                        <a href="<?php echo VIEW_INDEX ?>" class="pure-menu-link">Accueil</a>
                    </li>
                    <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
                        <a href="#" id="menuLink1" class="pure-menu-link">Plan-cadre</a>
                    <ul class="pure-menu-children">
                        <li <?php if($currentConseiller == 'searchplancadre') {echo getSelectedMenuClass();} ?> class="pure-menu-item">
                            <a href="<?php echo VIEW_SEARCH_PLAN_CADRE ?>" class="pure-menu-link">Recherche</a>
                        </li>
                        <li <?php if($currentConseiller == 'elaborationplancadre') {echo getSelectedMenuClass();} ?> class="pure-menu-item">
                           <a href="<?php echo VIEW_ELABORATION_PLANCADRE ?>" class="pure-menu-link">Créer un plan-cadre</a>
                        </li>
                        </ul>
                    </li>
                    <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
                        <a href="#" id="menuLink1" class="pure-menu-link">Gestion de l'information</a>
                        <ul class="pure-menu-children">
                            <li <?php if($currentConseiller == 'createclass') {echo getSelectedMenuClass();} ?> class="pure-menu-item">
                                <a href="<?php echo VIEW_MANAGE_CLASS ?>" class="pure-menu-link">Ajouter/Modifier un cours</a>
                            </li>
                            <li <?php if($currentConseiller == 'createprogram') {echo getSelectedMenuClass();} ?> class="pure-menu-item">
                                <a href="<?php echo VIEW_CREATE_PROGRAM ?>" class="pure-menu-link">Ajouter un programme d'études</a>
                            </li>
                            <li <?php if($currentConseiller == 'updateinstructions') {echo getSelectedMenuClass();} ?> class="pure-menu-item">
                                <a href="<?php echo VIEW_UPDATE_INSTRUCTIONS ?>" class="pure-menu-link">Modifier les instruction des plans-cadres</a>
                            </li>
                        </ul>
                    </li>
                    <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
                        <a href="#" id="menuLink1" class="pure-menu-link">Gestion des membres</a>
                        <ul class="pure-menu-children">
                            <li <?php if($currentConseiller == 'createaccount') {echo getSelectedMenuClass();} ?> class="pure-menu-item">
                                <a href="<?php echo VIEW_CREATE_ACCOUNT ?>" class="pure-menu-link">Créer un compte</a>
                            </li>
                            <li <?php if($currentConseiller == 'assignuser') {echo getSelectedMenuClass();} ?> class="pure-menu-item">
                                <a href="../view/view_assign_plancadre.php" class="pure-menu-link">Assigner un plan-cadre</a>
                            </li>
                            <li <?php if($currentConseiller == 'nouvea_plancadre') {echo getSelectedMenuClass();} ?> class="pure-menu-item">
                                <a href="../view/view_nouveau_plancadre.php" class="pure-menu-link">Ajouter un plan-cadre</a>
                            </li>
                            <li <?php if($currentConseiller == 'retirer_assignation') {echo getSelectedMenuClass();} ?> class="pure-menu-item">
                                <a href="<?php echo "../view/view_retirer_assignation.php" ?>" class="pure-menu-link">Retirer une assignation</a>
                            </li>
                            <li <?php if($currentConseiller == 'updatepassword') {echo getSelectedMenuClass();} ?> class="pure-menu-item">
                                <a href="<?php echo VIEW_UPDATE_PASSWORD ?>" class="pure-menu-link">Modification mot de passe</a>
                            </li>
                        </ul>
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
                    <li <?php if($currentAdmin == 'index') {echo 'class="pure-menu-item pure-menu-selected"';} ?> class="pure-menu-item ">
                        <a href="<?php echo VIEW_INDEX ?>" class="pure-menu-link">Accueil</a>
                    </li>
                    <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
                        <a href="#" id="menuLink1" class="pure-menu-link">Plan-cadre</a>
                        <ul class="pure-menu-children">
                            <li <?php if($currentAdmin == 'searchplancadre') {echo 'class="pure-menu-item pure-menu-selected"';} ?> class="pure-menu-item">
                                <a href="<?php echo VIEW_SEARCH_PLAN_CADRE ?>" class="pure-menu-link">Recherche</a>
                            </li>
                            <li <?php if($currentAdmin == 'elaborationplancadre') {echo 'class="pure-menu-item pure-menu-selected"';} ?> class="pure-menu-item">
                                <a href="<?php echo VIEW_ELABORATION_PLANCADRE ?>" class="pure-menu-link">Créer un plan-cadre</a>
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
                </ul>
                <div class="login_field"><?php echo $_SESSION['last_name'].", ".$_SESSION['first_name']."   "; ?>
                    <a href="<?php echo CONTROLLER_LOGOUT ?>">Se déconnecter</a>
                </div>
            </div>
        <?php
    }
    
    
    
    function showFooter()
    {
        ?>
            <footer>
                
            </footer>
        <?php
    }
    
