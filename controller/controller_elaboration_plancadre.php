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

	if( isset( $_POST['plancadre_elaboration_list'] ) )
	{

		//prendre la valeur du select dans le $_POST
		//envoyer les données à view_create_plancadre.php
		$id = $_POST['plancadre_elaboration_list'];
		echo $id;
		$_SESSION['id_plancadre'] = $id;

		header('Location: ../view/view_create_plancadre.php');
	}

	










?>