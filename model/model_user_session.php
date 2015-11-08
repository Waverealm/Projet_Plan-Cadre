<?php

/* 
   Nom : model_user_session.php
   Créé par Simon Roy
   Regroupe les fonctions liés à l'identifaction d'un utilisateur.

   suggestion : une session devrait être initialisé avant d'
*/


//session_start();

include_once('../model/queries.php');
include_once('password.php');
include_once("../assets/constant.php");




function setNoUser ( $no_user )
{
	$_SESSION['no_user'] = $no_user;
}
function setFirstName ( $first_name )
{
	$_SESSION['first_name'] = $first_name;
}
function setLastName ( $last_name )
{
	$_SESSION['last_name'] = $last_name;
}
function setLastName ( $user_type )
{
	$_SESSION['user_type'] = $user_type;
}




function getNoUser ()
{
	return $_SESSION['no_user'];
}
function getFirstName ()
{
	return $_SESSION['first_name'];
}
function getLastName ()
{
	return $_SESSION['last_name'];
}
function getLastName ()
{
	return $_SESSION['user_type'];
}













// pas besoin de fermeture
?>