<?php
/* 
   Nom : controller_assign_user.php
   Créé par : Simon Roy
   Gestion de la vue view_assign_user.php
*/
   	// erreur: A session had already been started
    // code inutile à enlever/confirmer
   	//session_start();

	include_once('../model/queries.php');
	include_once('../controller/interface_functions.php');

	// Si on a reçu les données d'un formulaire
	if( isset( $_POST[ 'html_select_user' ] ) && isset( $_POST[ 'html_select_class' ] ) )
	{

		$user = $_POST["html_select_user"];
		$codecours = $_POST["html_select_class"];
		// elaboration contient 11 charatère, la BD n'en prend que 10 pour l'etat d'un plancadre
		$etat = "elaboratio";

		$id = createPlanCadre($codecours, $etat);
		
		assignUserPlanCadre($id, $user);

		header('Location: ../view/view_index.php');
		exit;
	}



	
?>