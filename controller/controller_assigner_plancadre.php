<?php
	session_start();

	include_once('../model/queries.php');


	function fetchUserName()
	{

		$query = dbConnect()->prepare("CALL SELECT_USERNAME");

		$query->execute();
		$result = $query->fetchAll();


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
				$arrayOutput[i] = "<option name='option". i  ."' value='". $row["Username"] ."' >" 
				. $row ."</option>";
			}
		}

		return $arrayOutput;
	}




	
?>