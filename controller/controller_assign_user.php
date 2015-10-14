<?php
	// génère une erreur, suggérer d'appler une seule fois
	//session_start();

	include_once('../model/queries.php');


	function fetchUserName()
	{

		$bdd = dbConnect();
		$query = $bdd->prepare("CALL SELECT_USERNAME()");

		$query->execute();

		$result = $query->fetchAll();
		$query->closeCursor();

		return $result;
	}


	function fillComboBoxUser()
	{
		$array = fetchUserName();
		$arrayOutput;
		//$arrayOutput[0] = "<option>-- aucun --</option>";
		if(count($array) > 0)
		{
			for($i=0; $i < count($array); $i++)
			{
				$arrayOutput[$i] = "<option name='". $array[$i]["Prenom"] . " " . $array[$i]["Nom"] ."' value='". $array[$i]["NoUtilisateur"] ."' >" 
				. $array[$i]["Prenom"] . " " . $array[$i]["Nom"] . "</option>";
			}
		}

		return $arrayOutput;
	}




	
?>