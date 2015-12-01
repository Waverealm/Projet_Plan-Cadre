<?php
// Nom : controller_show_valid_plancadre.php
// Créé par Léa Kelly
// Fichier appelé lorsqu'on veut rechercher des plans-cadre officiels
// Afin de s'assurer si on a coché la "checkbox" ou non, on gère la situation en conséquence à l'aide d'une variable de session

	session_start();
	
	if (isset($_SESSION["valid_only"]))
	{
		if($_SESSION["valid_only"] == "unchecked")
		{
			$_SESSION['valid_only'] = "checked";
		}

		else if($_SESSION['valid_only'] == "checked")
		{
			$_SESSION['valid_only'] = "unchecked";
		}
	}

	header('Location: ../view/view_search_plan_cadre.php');
?>