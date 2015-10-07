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
		$arrayOutput = "<option>-- aucun --</option>";
		

		while($row = $result)
		{

		}


	}




	
?>