<?php
	session_start();

	include_once('../model/queries.php');


	function fetchUserName()
	{

		$bdd = dbConnect();
		$query = $bdd->prepare("CALL SELECT_USERNAME");

		$query->execute();

		$result = $query->fetchAll()
		$query->closeCursor();

		return $result;
	}


	function fillComboBoxUser()
	{
		$array = fetchUserName();
		$arrayOutput[0] = "<option>-- aucun --</option>";
		$i = 0;
		if(count($array) > 0)
		{
			$i++;
			while($row = $array->fetch_assoc())
			{
				// possibilité changer pour simplement écrire directement les balises ici ?
				$arrayOutput[i] = "<option name='option". $array[i]["NoUtilisateur"]  ."' value='". $array[i]["NoUtilisateur"] ."' >" 
				. $array[i]["Prenom"] . " " . $array[i]["Nom"] . "</option>";
			}
		}

		return $arrayOutput;
	}




	
?>