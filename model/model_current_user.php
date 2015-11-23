<?php

include_once("../controller/interface_functions.php");
include_once("../model/queries.php");















/*
    Nom de la fonction : showPlanCadreCurrentUser
    Cette fonction permet d'afficher une liste déroulante des plans-cadres
    que l'utilisateur courrant peut élaborer.
*/
    function showPlanCadreCurrentUser()
    {
        $id = $_SESSION['no_user'];
        $list = fetchPlanCadreElaboration_User($id);

        echo "<select name=\"plancadre_elaboration_list\">";
        
        if(sizeof($list) > 0)
        {
            foreach ($list as $row)
            {
                echo "<option value=\"".$row["PlanCadre_VersionPlan"]."\">".$row["CodeCours"]." ".$row["NomCours"]."</option>";
            }
        }
        else
        {
            echo "<option>" . "Aucun plan-cadre ne vous a été assigné." . "</option>";
        }
        echo "</select>";
    }