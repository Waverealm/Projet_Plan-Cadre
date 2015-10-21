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
	if( isset( $_POST[ '' ] ) && isset( $_POST[ 'Password' ] ) )
	{
	   // On les récupère
	   $username = $_POST[ 'UserName' ];
	   $password = $_POST[ 'Password' ]; // À REMPLACER UNE FOIS QUE LA FONCTION SERA AUSSI UTILISÉE DANS LA CRÉATION DU COMPTE :  getCryptedPassword($_POST['Password']);

	   $_SESSION[ 'username' ] = $username;

	   // On teste si les informations sont valides
	   if( verification( $username, $password ) )
	   {
		  unset($_SESSION[ 'username' ]);
		  $_SESSION[ 'username_usager' ] = $username;
		  $_SESSION[ 'connection_info' ] = "Vous avez été correctement identifié.";
		  $_SESSION[ 'connected' ] = true;
		  header('Location: ../view/view_index.php');
	   }
	   else
	   {
		  // Sinon on avertit l'utilisateur
	   	  $_SESSION[ 'connection_info' ] =  "Nom d'utilisateur ou mot de passe invalide.";
		  header('Location: ../view/view_login.php');
	   }
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