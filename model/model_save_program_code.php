<?php
// Nom : model_save_program_code
// Créé par Léa Kelly
// Fichier appelé lorsqu'on les plans-cadre associés au code d'un programme.
// Le code du programme est sauvegardé dans une variable de session afin d'actualiser l'affichage en fonction

	session_start();

	if (isset($_POST['CodeProgramme']))
	{

		$_SESSION['recherche_plan_cadre'] = $_POST['CodeProgramme'];
	}

	header('Location: ../view/view_search_plan_cadre.php');
?>