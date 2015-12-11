<?php



include_once("../controller/interface_functions.php");
include_once("../model/queries.php");


// default order by codeCours pour la procédure select

/*
	showAllPlancadre
	cette fonction permet d'afficher tout les plans-cadres dans un tableau

	
	le tableau aura l'option de télécharger le plan-cadre ou de le consulter en ligne
	- faire une page qui servira de template pour afficher un plan-cadre
	- 
*/

//** à modifier
function makeLinkPlancadre($plancadre)
{

	$path = "../plancadre/" . $plancadre['No_PlanCadre'] . "_" . $plancadre['CodeCours'] . ".docx";
    if( file_exists($lien) )
    {
        $lien = "aucune document";
    }
    else
    {
        $lien = '<a href ="' . $path . '">Télécharger </a>';
    }
    return $lien;
}

// Si la variable de session de la checkbox n'existe pas, alors on la créé
function setCheckboxSessionValue()
{
    if (!(isset($_SESSION["official_only"])))
    {
        $_SESSION["official_only"] = "unchecked";
    }
}

// Coche ou décoche la checkbox selon la valeur de la variable de sesssion
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

// Fonction appelée lorsqu'une recherche a été effectuée
function unsetSearchProgram()
{
    unset($_SESSION["recherche_code_programme"]);
}

// Fonction faisant en sorte de mettre la valeur de la combo box
// sur la valeur actuelle de la variable de session pour la
// recherche d'un programme
function isSelected($selectedValue)
{
    if (isset($_SESSION['recherche_code_programme']) && $_SESSION['recherche_code_programme'] == $selectedValue)
    {
        return 'selected';
    }
}

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

                    $path = $row["Presentation_Cours"];
                    if( !isset($path) ) 
                    {
                        $document_link = "lien manquant";
                    }
                    else
                    {
                        $document_link = makeLinkPlancadre($row);
                    }

                    echo "<tr>".
                            "<td>".$row["CodeCours"]."</td>".
                            "<td>".$row["NomCours"]."</td>".
                            "<td>".$row["CodeProgramme"]."</td>".
                            "<td>".$row["NomProgramme"]."</td>";
                            
                    if($row["Officiel"] == 1)
                    {
                        echo "<td>Version officielle</td>";
                    }

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
                        if ($_SESSION['user_type'] != "Élaborateur")
                        {
                            if ($row["Etat"] != "Validé" && $row["Etat"] != "Adopté")
                            {
                                // ****************       la date de soumission / autre serait plus approprié que celle de la clé primaire
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

function showAllValidPlancadre()
{

}