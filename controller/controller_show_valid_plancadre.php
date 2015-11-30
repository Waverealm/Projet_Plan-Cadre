<?php
// Nom : controller_show_valid_plancadre.php
// Créé par Léa Kelly
// Fichier appelé lorsqu'on veut rechercher des plans-cadre officiels
// Afin de s'assurer si on a coché la "checkbox" ou non, une variable de session est créée. 

	session_start();

	if (isset($_POST['valid_only']))
	{
		$_SESSION['valid_only'] = "checked";

		header('Location: ../view/view_search_plan_cadre.php');
	}

?>