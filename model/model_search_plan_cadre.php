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
function showAllPlancadre()
{
    $list = selectAllPlanCadre();

    echo "<table>".
            "<tr>".
                "<th>Code du cours</th>".
                "<th>Nom du cours</th>".
                "<th>Code du programme</th>".
                "<th>Nom du programme</th>".
                "<th>Date de création</th>".
                "<th>Date d'adoption</th>".
                "<th>Télécharger</th>".
            "</tr>";
        foreach ($list as $row)
        {
        	$date_adoption = $row["DateAdoption"];
        	$document_link = $row["Presentation_Cours"];
        	if( !isset($date_adoption) ) 
        	{
        		$date_adoption = "pas adopté";
        	}
        	if( !isset($document_link) ) 
        	{
        		$document_link = "lien manquant";
        	}
        	else
        	{
        		// s'occuper de générer un lien qui a de l'allure et qui fonctionne
        		// plutôt faire une fonction qui va s'occuper de faire ça 
        	}
            echo "<tr>".
                    "<td>".$row["CodeCours"]."</td>".
                    "<td>".$row["NomCours"]."</td>".
                    "<td>".$row["CodeProgramme"]."</td>".
                    "<td>".$row["NomProgramme"]."</td>".
                    "<td>".$row["DateAjout"]."</td>".
                    "<td>". $date_adoption ."</td>".
                    "<td>" . $document_link . "</td>".
                "</tr>";
        }
    echo "</table>";
}

function showAllValidPlancadre()
{

}