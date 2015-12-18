<?php

/* 
   Nom : pages_access.css
   Créé par Léa
   Fonctions assurant le contrôle d'accès à différentes pages selon l'état
   et le type d'utilisateur
*/

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

   // Si on est déjà connecté, on ne peut pas accéder à la page de connexion
   function verifyConnected()
   {
   		if(isset($_SESSION[ "connected" ]))
		{
			if($_SESSION[ "connected" ])
			{
				// Redirige vers la page d'accueil.
				header('Location: ../view/view_index.php');
			}
		}
   }

   // Si on est pas connecté, on ne peut pas accéder aux pages réservées aux utilisateurs inscrits
   function verifyAccessPages()
	{
		if(!isset($_SESSION[ "connected" ]))
		{
			// Redirige vers la page d'accueil.
			header('Location: ../view/view_index.php');
		}
	}


/*
	Les fonctions isSomething servent à déterminer l'accès à une page.
	Pour les utiliser il suffit d'appeler les functions appropriées au
	début de la page pour limiter l'accès à la page.
*/	
	function isPlanner()
	{
		if(isset($_SESSION[ "user_type" ]))
		{
			if($_SESSION[ "user_type" ] == "Élaborateur")
			{
				// Redirige vers la page d'accueil.
				header('Location: ../view/view_index.php');
			}
		}
	}

	function isConsultant()
	{
		if(isset($_SESSION[ "user_type" ]))
		{
			if($_SESSION[ "user_type" ] == "Conseiller pédagogique")
			{
				// Redirige vers la page d'accueil.
				header('Location: ../view/view_index.php');
			}
		}
	}

	function isAdmin()
	{
		if(isset($_SESSION[ "user_type" ]))
		{
			if($_SESSION[ "user_type" ] == "Administrateur")
			{
				// Redirige vers la page d'accueil.
				header('Location: ../view/view_index.php');
			}
		}
	}

?>