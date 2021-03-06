<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

// Nom : model_search_plan_cadre.php
// Fait par Antoine Latendresse

include_once("../assets/constants.php");
include_once(MODEL_PAGE);
include_once(MODEL_SEARCH_PLAN_CADRE);
//include_once("../controller/interface_functions.php");
include_once("../model/queries.php");

// Fonction pour afficher la liste des plans-cadres officiels sur la page d'accueil
// La fonction est en théorie presque la même que showPlanCadre() dans model_search_plan_cadre.php
function showAllOfficielPlancadre()
{
    $list = selectAllOfficielPlanCadre();

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

            echo "</tr>";
        }
        echo "</table>";
    }

    else
    {
        echo "Aucun plan-cadre ne correspond à vos critères de recherche";
    }
}