<?php
// Nom : controller_show_valid_plancadre.php
// Créé par Léa Kelly
// Fichier appelé lorsqu'on veut coche/décoche dans la checkbox dans la page de recherche de plans-cadres
// Afin de s'assurer si on a coché la "checkbox" ou non, on gère la situation en conséquence à l'aide d'une variable de session

	if(!isset($_SESSION)) 
	{ 
	    session_start(); 
	} 
	
	if (isset($_SESSION["official_only"]))
	{
		if($_SESSION["official_only"] == "unchecked")
		{
			$_SESSION['official_only'] = "checked";
		}

		else if($_SESSION['official_only'] == "checked")
		{
			$_SESSION['official_only'] = "unchecked";
		}
	}

	header('Location: ../view/view_search_plan_cadre.php');
?>