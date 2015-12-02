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
	if( isset( $_POST[ 'user_list_all' ] ) && isset( $_POST[ 'class_list_all' ] ) )
	{

		$user = $_POST["user_list_all"];
		$codecours = $_POST["class_list_all"];

		$etat = "Élaboration";

		$id = createPlanCadre($codecours, $etat);
		
		assignUserPlanCadre($id, $user);

		header('Location: ../view/view_index.php');
		exit;
	}

?>