<?php

/* 
   Nom : pages_access.css
   Créé par Léa
   Fonctions assurant le contrôle d'accès à différentes pages selon l'état
   et le type d'utilisateur
*/


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

?>