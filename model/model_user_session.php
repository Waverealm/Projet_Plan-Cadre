<?php

/* 
   Nom : model_user_session.php
   Créé par Simon Roy
   Regroupe les fonctions liés à l'utilisateur courant.


   suggestion : une session devrait être initialisé avant d'appeler 
   des fonctions de ce modèle.
*/


//session_start();

include_once('../model/queries.php');
include_once('../controller/password_functions.php');
include_once("../assets/constant.php");




function setNoUser ( $no_user )
{
	$_SESSION['no_user'] = $no_user;
}
function setFirstName ( $first_name )
{
	$_SESSION['first_name'] = $first_name;
}
function setLastName ( $last_name )
{
	$_SESSION['last_name'] = $last_name;
}

/*
// on ne veut pas pouvoir changer le type du user
function setUserType ( $user_type )
{
	$_SESSION['user_type'] = $user_type;
}
*/

function getNoUser ()
{
	return $_SESSION['no_user'];
}
function getFirstName ()
{
	return $_SESSION['first_name'];
}
function getLastName ()
{
	return $_SESSION['last_name'];
}
function getUserType ()
{
	return $_SESSION['user_type'];
}






/*
    Nom de la fonction : showPlanCadreCurrentUser
    Cette fonction permet d'afficher une liste déroulante des plans-cadres
    que l'utilisateur courrant peut élaborer.
*/
    function showPlanCadreCurrentUser()
    {
        $id = $_SESSION['no_user'];
        $list = fetchPlanCadreElaboration_User($id);

        echo "<select name='plancadre_elaboration_list' id='plancadre_elaboration_list' >";
        
        if(sizeof($list) > 0)
        {
            foreach ($list as $row)
            {
                echo "<option value=\"".$row["No_PlanCadre"]."\">".$row["CodeCours"]." ".$row["NomCours"]."</option>";
            }
        }
        else
        {
            echo "<option value='not_found'>" . "Aucun plan-cadre ne vous a été assigné." . "</option>";
        }
        echo "</select>";
    }

