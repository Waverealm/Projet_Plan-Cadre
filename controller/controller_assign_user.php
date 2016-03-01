<?php
/* 
   Nom : controller_assign_user.php
   Créé par : Simon Roy
   Gestion de la vue view_assign_user.php
*/

   	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

	include_once("../assets/constants.php");
	include_once(REQUETES_BD);
	
	if( isset($_POST["id_plancadre"]) && isset($_POST["user_list"]) )
	{
		if( !empty($_POST["id_plancadre"]) && !empty($_POST["user_list"]) )
		{
			assignUserPlanCadre($_POST["id_plancadre"], $_POST["user_list"]);

			$_SESSION[ 'info_assign' ] = 'Assignation effectuée avec succès';

			header('Location: ../view/view_assign_user.php');
		}
	}
	header('Location: ../view/view_assign_user.php');

?>