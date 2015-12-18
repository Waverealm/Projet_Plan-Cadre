<?php 

/* 
   Nom : controller_logout.css
   Créé par Léa
   Traitement si l'utilisateur se déconnecte
*/

	if(!isset($_SESSION)) 
	{ 
	    session_start(); 
	} 

   include_once("../assets/constant.php");

   // On détruit la session
   session_destroy();
   unset( $_SESSION );
   
   header('Location: ' . VIEW_INDEX);
?>