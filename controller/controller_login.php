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


	// Si on a reçu les données d'un formulaire et qu'elles ne sont pas vident
	if( isset( $_POST[ 'UserName' ] ) && isset( $_POST[ 'Password' ] ) && !empty($_POST[ 'UserName' ] ) && !empty($_POST[ 'Password' ] ))
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
    else
    {
        $_SESSION[ 'connection_info' ] =  "Un ou plusieurs champs sont vident.";
        header('Location: ../view/view_login.php');
    }

	function verification( $username, $password )
	{
	    //$connected = false;// ligne inutile parce que php don't care about that

		// On va récupérer l'utilisateur précis
		$reponse = getUser($username);
   

	   	// On vérifie si l'adresse email et mot de passe correspondent
	   	if ($reponse[0][ "MotDePasse" ] == $password)
		{
			$connected = true;
            // le nom et le prénom servent à assurer à l'utilisateur qu'il est connecté
            // et connecté avec le bon compte
			$_SESSION['first_name'] = $reponse[0]['Prenom'];
			$_SESSION['last_name'] = $reponse[0]['Nom'];

            // nécessaire pour valider le niveau d'accès de l'utilisateur
			$_SESSION['user_type'] = $reponse[0]['TypeUtilisateur'];
			//nécessaire pour accéder à d'autres informations liées à l'utilisateur plus loin
            // dans la session
			$_SESSION['no_user'] = $reponse[0]['NoUtilisateur'];
		} else {
			$connected = false;
		}

	   return $connected;
	}

	?>