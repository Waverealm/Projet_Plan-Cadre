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

		createPlanCadre($course, "elaborateur");
		
		//assignUserPlanCadre($user, $course);

		header('Location: /../view/view_index.php');
		exit;
	}




  	function createPlanCadre($codecours, $etat)
  	{
      	$insert = dbConnect()->prepare("CALL INSERT_PLAN_CADRE(?,?)");

      	$insert->bindParam(1, $codecours, PDO::PARAM_STR);
      	$insert->bindParam(2, $etat, PDO::PARAM_STR);

      	$insert->execute();
  	}

	function getArrayUser()
	{
		$array = fetchAllUser();
		$arrayOutput;
		if(count($array) > 0)
		{
			for($i=0; $i < count($array); $i++)
			{
				$arrayOutput[$i] = "<option name='". $array[$i]["NoUtilisateur"] ."' value='". $array[$i]["NoUtilisateur"] ."' >" 
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
				$arrayOutput[$i] = "<option name='". $array[$i]["CodeCours"] ."' value='". $array[$i]["CodeCours"] ."' >" 
				. $array[$i]["CodeCours"] . " " . $array[$i]["NomCours"] . "</option>";
			}
		}
		return $arrayOutput;
	}





	
?>