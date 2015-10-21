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


	// Si on a reçu les données d'un formulaire
	if( isset( $_POST[ 'search_user_list' ] ) && isset( $_POST[ 'search_class_list' ] ) )
	{

		$user = $_POST["search_user_list"];
		$course = $_POST["search_class_list"];
		

		assignUserPlanCadre($user, $course);

		header('Location: ../view/view_index.php');
	}







	function getArrayUser()
	{
		$array = fetchAllUser();
		$arrayOutput;
		if(count($array) > 0)
		{
			for($i=0; $i < count($array); $i++)
			{
				$arrayOutput[$i] = "<option name='". $array[$i]["Prenom"] . " " . $array[$i]["Nom"] ."' value='". $array[$i]["Prenom"] . " " . $array[$i]["Nom"] ."' >" 
				. $array[$i]["Prenom"] . " " . $array[$i]["Nom"] . "</option>";
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
				$arrayOutput[$i] = "<option name='". $array[$i]["CodeCours"] . " " . $array[$i]["NomCours"] ."' value='". $array[$i]["CodeCours"] . " " . $array[$i]["NomCours"] ."' >" 
				. $array[$i]["CodeCours"] . " " . $array[$i]["NomCours"] . "</option>";
			}
		}
		return $arrayOutput;
	}





	
?>