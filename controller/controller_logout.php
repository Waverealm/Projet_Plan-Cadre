<?php 

/* 
   Nom : controller_logout.css
   Créé par Léa
   Traitement si l'utilisateur se déconnecte
*/

   session_start();

   include_once("../assets/constant.php");

   session_destroy();
   unset( $_SESSION );
   
   header('Location: ' . VIEW_INDEX);
?>