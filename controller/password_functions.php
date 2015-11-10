<?php

/* 
   Nom : password_functions.php
   Créé par Léa
   Fonctions pour le cryptage du mot de passe
   Source : https://github.com/ircmaxell/password_compat

   Go read it to know about the functions "password_hash" and "password_verify".
*/

 	require_once('../password_compat-master/lib/password.php');
 	require_once('../model/queries.php');

	function cryptPassword($pass)
	{
		// 'cost' is the CPU cost.
		// It has a range from 4 to 31.
		return password_hash($password, PASSWORD_BCRYPT, array("cost" => 10));
	}

	function verifyPassword($username, $password)
	{
		$hash = getPassword($username);

		$_SESSION[ 'result' ] = password_verify($password, $hash);
		$_SESSION[ 'test' ] = "test";

		return password_verify($password, $hash);
	}
?>