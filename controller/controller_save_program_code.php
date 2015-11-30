<?php
// Nom : controller_save_program_code.php
// Créé par Léa Kelly
// Fichier appelé lorsqu'on veut rechercher les plans-cadre associés au code d'un programme.
// Le code du programme est sauvegardé dans une variable de session afin d'actualiser l'affichage en fonction

	session_start();

	if (isset($_POST['CodeProgramme']))
	{

		$_SESSION['recherche_code_programme'] = $_POST['CodeProgramme'];
	}

	header('Location: ../view/view_search_plan_cadre.php');
?>