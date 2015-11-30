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
	$lien = "../plancadre/" . $plancadre['VersionPlan'] . "_" . $plancadre['CodeCours'] . ".docx";

    return '<a href ="' . $lien . '">Télécharger </a>';
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
        if($_SESSION['recherche_code_programme'] == "Tous")
        {
            $list = selectAllPlanCadre();
        }

        // Recherche des plans-cadre officiels à travers tous les plans-cadre
        else if(isset($_SESSION['valid_only']) && $_SESSION['recherche_code_programme'] == "Tous")
        {
            $list = getPlanCadreOfficielProgram("Adopté", $_SESSION['recherche_code_programme']);
        }

        // Recherche les plans-cadre officiels spécifiques à un programme
        else if(isset($_SESSION['valid_only']))
        {
            $list = fetchAllPlanCadreOfficiel("Adopté");
        }

        // Chercher toutes les versions de tous les plans-cadre spécifiques à un programme
        else
        {
            // On va chercher les plans-cadre
            $list = fetchPlanCadreProgram($_SESSION["recherche_code_programme"]);
            // On "unset" la variable une fois que la recherche est faite
        }
    }

    // Lorsque l'utilisateur réactualise la page de lui-même
    else
    {
        $list = selectAllPlanCadre();
        unset($_SESSION["recherche_code_programme"]);
        unset($_SESSION["valid_only"]);
    }

    echo "<table>".
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
                echo "<th>Validation</th>";
            }
        }

        echo "</tr>";
        foreach ($list as $row)
        {
        	$date_adoption = $row["DateAdoption"];
        	if( !isset($date_adoption) ) 
        	{
        		$date_adoption = "pas adopté";
        	}

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
                    "<td>".$row["NomProgramme"]."</td>".
                    "<td>".$row["Etat"]."</td>".
                    "<td>".$row["DateAjout"]."</td>".
                    "<td>". $date_adoption ."</td>".
                    "<td>" . $document_link . "</td>";

            if( isset($_SESSION['user_type']) )
            {
                if ($_SESSION['user_type'] != "Élaborateur")
                {
                    if ($row["Etat"] != "Validé")
                    {
                        echo "<td><a href ='../controller/controller_validate_plancadre.php?codecours=".$row["CodeCours"]."&versionplan=".$row["VersionPlan"]."'>Valider</a></td>";
                    }

                    else
                    {
                        echo "<td>Déjà validé</td>";
                    }
                    echo "</tr>";
                }
            }
        }
    echo "</table>";
}

function showAllValidPlancadre()
{

}