<?php

// Nom : model_search_plan_cadre.php
// Fait par Simon Roy et Léa Kelly
// Contient les différentes fonctions d'affichage pour la page de recherche
// de plans-cadre


if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

include_once("../controller/interface_functions.php");
include_once("../model/queries.php");


/*
    Nom : makeLinkPlancadre($plancadre)
	Cette fonction génère le lien de téléchargement d'un plan-cadre
*/
function makeLinkPlancadre($plancadre)
{

	$path = "../plancadre/" . $plancadre['No_PlanCadre'] . "_" . $plancadre['CodeCours'] . ".docx";

    switch ($plancadre["Etat"]) 
    {
        case 'Adopté':
            if($plancadre["Officiel"] > 0)
            {
                $etat = "officiel";
            }
            else
            {
                $etat = "archive";
            }
            break;
        case 'Validé':
        case 'Élaboration':
        default:
            $etat = "Elaboration";
            break;
    }

    if( file_exists($path) )
    {
        $lien = '<a href ="'.$path.'"' . 'download="' . $plancadre['CodeCours'] . '_plancadre_' . $etat .'.docx"' .'">Télécharger </a>';
    }
    else
    {
         $lien = "aucun document";
    }
    return $lien;
}

/*
    Nom : setCheckboxSessionValue()
    Si la variable de session de la checkbox n'existe pas, on l'initialise
*/
function setCheckboxSessionValue()
{
    if (!(isset($_SESSION["official_only"])))
    {
        $_SESSION["official_only"] = "unchecked";
    }
}

/*
    Nom : updateCheckbox()
    Fait en sorte de garder l'état de la checkbox
*/
function updateCheckbox()
{
    if($_SESSION["official_only"] == "checked")
    {
        echo "checked='checked'";
    }

    else if ($_SESSION["official_only"] == "unchecked")
    {
        echo "";
    }
}

/*
    Nom : isSelected($selectedValue)
    Fonction faisant en sorte de mettre la valeur de la combo box
    sur la valeur actuelle de la variable de session pour la
    recherche d'un programme
*/
function isSelected($selectedValue)
{
    if (isset($_SESSION['recherche_code_programme']) && $_SESSION['recherche_code_programme'] == $selectedValue)
    {
        return 'selected';
    }
}

/*
    Nom : isSelected($selectedValue)
    Fonction qui s'occupe de l'affichage du tableau dans la page de recherche des plans-cadres
*/
function showPlanCadre()
{
    $list = null;

    if(isset($_SESSION['recherche_code_programme']))
    {
        // Il est nécessaire de traiter cette alternative au cas ou l'utilisateur veut réafficher
        // tous les plans-cadre après avoir cherché pour un programme en particulier, étant
        // donné que la page ne se réactualise pas toute seule
        // C'est aussi pour une question de "user friendly"
        // Rechercher toutes les versions de tous les plans-cadre
        if (isset($_SESSION['official_only']) && $_SESSION['official_only'] == "unchecked" && $_SESSION['recherche_code_programme'] == "Tous")
        {
            $list = selectAllPlanCadre();
        }

        // Recherche les plans-cadre officiels à travers tous les plans-cadre existants
        else if(isset($_SESSION['official_only']) && $_SESSION['official_only'] == "checked" && $_SESSION['recherche_code_programme'] == "Tous")
        {
            $list = fetchAllPlanCadreOfficiel(1);
        }

        // Recherche tous les plans-cadre officiels spécifiques à un programme
        else if(isset($_SESSION['official_only']) && $_SESSION['official_only'] == "checked")
        {
            $list = getPlanCadreOfficielProgram(1, $_SESSION['recherche_code_programme']);
        }

        // Rechercher toutes les versions de tous les plans-cadre spécifiques à un programme
        else
        {
            $list = fetchPlanCadreProgram($_SESSION["recherche_code_programme"]);
        }
    }

    // Si on a coché la checkbox, mais que la variable de session de recherche n'a pas encore été créé
    // (c'est le cas lorsqu'on un utilisateur vient de se connecter)
    // Pas le choix de géré cette condition, sinon l'affichage ne se modifie pas en fonction de la checkbox
    else if(isset($_SESSION['official_only']) && $_SESSION['official_only'] == "checked")
    {
        $list = fetchAllPlanCadreOfficiel(1);
    }

    // Si la variable de session de recherche n'a pas encore été créé, il faut traiter cette situation
    else
    {
        $list = selectAllPlanCadre();
    }


    // Génération de l'affichage du tableau
    if(!empty($list))
    {
        echo "<table id='tab_recherche'>".
                    "<tr>".
                        "<th>Code du cours</th>".
                        "<th>Nom du cours</th>".
                        "<th>Code du programme</th>".
                        "<th>Nom du programme</th>".
                        "<th>État</th>".
                        "<th>Date de création</th>".
                        "<th>Date d'adoption</th>".
                        "<th>Télécharger</th>";
                if( isset($_SESSION['user_type']) )
                {
                    if ($_SESSION['user_type'] != "Élaborateur")
                    {
                        echo "<th>Validation</th>".
                             "<th>Adoption</th>";

                    }
                }

                    echo "<th>Élaborateur</th>";   

                echo "</tr>";

                foreach ($list as $row)
                {
                    $date_adoption = $row["DateAdoption"];

                    $document_link = makeLinkPlancadre($row);

                    echo "<tr>".
                            "<td>".$row["CodeCours"]."</td>".
                            "<td>".$row["NomCours"]."</td>".
                            "<td>".$row["CodeProgramme"]."</td>".
                            "<td>".$row["NomProgramme"]."</td>";
                            
                    // Si le plan-cadre est officiel, alors on l'indique
                    if($row["Officiel"] == 1)
                    {
                        echo "<td>Version officielle</td>";
                    }

                    // Sinon on affiche l'état actuel
                    else
                    {
                        echo "<td>".$row["Etat"]."</td>";
                    }

                    echo    "<td>".$row["DateAjout"]."</td>";

                    $date_adoption = $row["DateAdoption"];

                    if( !isset($date_adoption) ) 
                    {
                        $date_adoption = "pas adopté";
                    }

                    echo    "<td>". $date_adoption ."</td>".
                            "<td>" . $document_link . "</td>";

                    if( isset($_SESSION['user_type']) )
                    {
                        // Si on n'est pas élaborateur, alors on ne peut pas valider/adopter un plan-cadre
                        if ($_SESSION['user_type'] != "Élaborateur")
                        {
                            if ($row["Etat"] != "Validé" && $row["Etat"] != "Adopté")
                            {
                                echo "<td><a href ='../controller/controller_validate_plancadre.php?codecours=".$row["CodeCours"]."&versionplan=".$row["No_PlanCadre"]."'>Valider</a></td>";
                                echo "<td>//</td>";
                            }

                            else if($row["Etat"] == "Validé")
                            {
                                echo "<td>Déjà validé</td>";
                                echo "<td><a href ='../controller/controller_adopt_plancadre.php?codecours=".$row["CodeCours"]."&versionplan=".$row["No_PlanCadre"]."'>Adopter</a></td>";
                            }

                            else if($row["Etat"] == "Adopté")
                            {
                                echo "<td>//</td>";
                                echo "<td>Déjà adopté</td>";
                            }
                        }
                    }

                        echo "<td>".$row["Prenom"]." ".$row["Nom"]."</td>";
                    echo "</tr>";
                }
            echo "</table>";
    }

    else
    {
        echo "Aucun plan-cadre ne correspond à vos critères de recherche";
    }
    
}