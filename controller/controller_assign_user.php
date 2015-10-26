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
	if( isset( $_POST[ 'select_user_list' ] ) && isset( $_POST[ 'select_class_list' ] ) )
	{

		$user = $_POST["select_user_list"];
		$codecours = $_POST["select_class_list"];
		// elaboration contient 11 charatère, la BD n'en prend que 10 pour l'etat d'un plancadre
		$etat = "elaboratio";

		$id = createPlanCadre($codecours, $etat);
		
		assignUserPlanCadre($id, $user);

		header('Location: ../view/view_index.php');
		exit;
	}

	function getArrayUser()
	{
		$array = fetchAllUser();
		$arrayOutput;
		if(count($array) > 0)
		{
			for($i=0; $i < count($array); $i++)
			{
				// le nom et la valeur sont la clé primaire de l'utilisateur
				// le contenu / texte est le nom de l'utilisateur (prénom + nom)
				$arrayOutput[$i] = buildHTML_OptionSelect($array[$i]["NoUtilisateur"],
					$array[$i]["NoUtilisateur"],
					$array[$i]["Prenom"] . " " . $array[$i]["Nom"]);
			}
		}

		return $arrayOutput;
	}
	function getArrayClass()
	{
		$array = fetchAllClass();
		$arrayOutput;
		if(count($array) > 0)
		{
			for($i=0; $i < count($array); $i++)
			{
				// le nom de l'option et sa valeur sont le code du cours
				// le contenu / texte est le code du cours avec le nom du cours
				$arrayOutput[$i] = buildHTML_OptionSelect($array[$i]["CodeCours"],
					 $array[$i]["CodeCours"],
					 $array[$i]["CodeCours"] . " " . $array[$i]["NomCours"]); 
			}
		}
		return $arrayOutput;
	}

?>