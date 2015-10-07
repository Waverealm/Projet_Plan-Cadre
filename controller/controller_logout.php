<?php 

/* 
   Nom : controller_logout.css
   Créé par Léa
   Traitement si l'utilisateur se déconnecte
*/

   session_start();
   
   session_destroy();
   unset( $_SESSION );
   
   header('Location: ../view/view_index.php');
?>