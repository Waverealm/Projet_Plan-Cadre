<?php

include_once("../assets/constants.php");
include_once(REQUETES_BD);

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 




/*
    Nom de la fonction : showListeCours
    Description :
    Cette fonction permet d'afficher une liste déroulante de tous les cours qui n'ont pas de plan-cadre en élaboration
    Détails : 
    L'affichage montrera le code du cours
*/
    function showClassListAll()
    {
        $list = fetchAllClass();

        echo "<select name='class_list_all' id='class_list_all' style='width: 300px'>";
            echo "<option value=\"" . "\">" . "</option>";
        

        foreach ($list as $row)
        {
            if(empty(fetchPlanCadreClass($row["CodeCours"])))
            {
                echo "<option value=\"".$row["CodeCours"]."\">".$row["CodeCours"]." ".$row["NomCours"]."</option>";
            }
        }
        if( empty($list) )
        {
            echo "<option>"."Aucun cours"."</option>";
        }
        echo "</select>";
    }


/*
    Nom de la fonction : showListeCours
    Fait par : Simon Roy
    Description :
    Cette fonction permet d'afficher une liste déroulante de tous les cours.
    Détails : 
    L'affichage montrera le code du cours suivi du nom du cours.
    L'option qui sera sélectionné par défaut est le cours (CodeCours) contenu dans la
    variable $_SESSION["selected_CodeCours"].
*/
    function showListeCours()
    {
        $list = fetchAllClass();

        echo "<select name='class_list_all' id='class_list_all' style='width: 300px'>";
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