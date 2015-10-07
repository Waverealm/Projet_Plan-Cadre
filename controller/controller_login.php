<?php

/* 
   Nom : controller_login.css
   Créé par Léa
   Fait le traitement lorsqu'un utilisateur tente de se connecter sur le site
*/

	// Initialisation de la session
	session_start();

	include_once('../model/queries.php');
	include_once('password.php');


	// Si on a reçu les données d'un formulaire
	if( isset( $_POST[ 'UserName' ] ) && isset( $_POST[ 'Password' ] ) )
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

	function verification( $username, $password )
	{
	   $connected = false;

	   $bdd = dbConnect();

		// On va récupérer l'utilisateur précis
		$reponse = getUser($bdd, $username);
   

	   	// On vérifie si l'adresse email et mot de passe correspondent
	   	if ($reponse[0][ "MotDePasse" ] == $password)
		{
			$connected = true;
			$_SESSION['first_name'] = $reponse[0]['Prenom'];
			$_SESSION['last_name'] = $reponse[0]['Nom'];
			// $_SESSION['user_type'] = $reponse[0]['TypeUtilisateur'];
		} else {
			$connected = false;
		}

	   return $connected;
	}

	?>