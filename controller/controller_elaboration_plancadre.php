<?php
/* 
   Nom : controller_elaboration_plancadre.php
   Créé par : Simon Roy
   Gestion de la vue view_elaboration_plancadre.php
*/

if(!isset($_SESSION))
{
    session_start();
}

	include_once('../model/queries.php');
	include_once('../controller/interface_functions.php');



	// mettre dans session le code du cours et prendre le bon id/version du plancadre

	if( isset( $_POST['html_select_plancadre'] ) )
	{

		//prendre la valeur du select dans le $_POST
		//envoyer les données à view_create_plancadre.php
		$id = $_POST['html_select_plancadre'];
		//echo $id;
		$_SESSION['id_plancadre'] = $id;

		header('Location: ../view/view_create_plancadre.php');
	}


	function getArrayPlanCadre()
	{
		$id = $_SESSION['no_user'];
		$array = fetchPlanCadreElaboration_User($id);
		$arrayOutput;
		if(count($array) > 0)
		{
			for($i=0; $i < count($array); $i++)
			{
				// le nom et la valeur sont la clé primaire du plancadre
				// le contenu / texte est le code du cours avec le nom du cours
				$arrayOutput[$i] = buildHTML_OptionSelect($array[$i]["PlanCadre_VersionPlan"],
					$array[$i]["PlanCadre_VersionPlan"],
					$array[$i]["CodeCours"] . " " . $array[$i]["NomCours"]);
			}
		}

		return $arrayOutput;
	}










?>