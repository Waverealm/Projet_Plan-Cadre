<?php
	// génère une erreur, suggérer d'appler une seule fois
	//session_start();

	include_once('../model/queries.php');

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
	function getArrayCourse()
	{
		$array = fetchAllCourse();
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