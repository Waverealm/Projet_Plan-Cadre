<?php
/* 
   Nom : controller_elaboration_plancadre.php
   Créé par : Simon Roy
   Gestion de la vue view_elaboration_plancadre.php
*/

   //session_start();

	include_once('../model/queries.php');
	include_once('../controller/interface_functions.php');



	// mettre dans session le code du cours et prendre le bon id/version du plancadre




	//header('Location: ../view/view_create_plancadre.php');


	function getArrayPlanCadre()
	{
		$user = $_POST[ 'UserName' ];

		$array = fetchPlanCadreElaboration($user);
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

















?>