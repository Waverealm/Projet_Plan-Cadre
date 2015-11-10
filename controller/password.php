<?php

/* 
   Nom : password.css
   Créé par Léa
   Fonctions pour le cryptage du mot de passe
   Source : https://alias.io/2010/01/store-passwords-safely-with-php-and-mysql/

   - Les commentaires en anglais proviennent du site.
*/

	function cryptPassword($pass)
	{
		// A higher "cost" is more secure but consumes more processing power
		$cost = 10;

		// Create a random salt
		$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');

		// Prefix information about the hash so PHP knows how to verify it later.
		// "$2a$" Means we're using the Blowfish algorithm. The following two digits are the cost parameter.
		$salt = sprintf("$2a$%02d$", $cost) . $salt;

		// Hash the password with the salt
		return crypt($pass, $salt);
	}

	function verifyPassword($username, $pass)
	{

		$bd_pass = getPassword($username);

		// Hashing the password with its hash as the salt returns the same hash
		if(!function_exists('hash_equals')) {
  			function hash_equals($bd_pass, $pass) {
    			if(strlen($bd_pass) != strlen($pass)) {
      				return false;
    			} else {
      				$res = $bd_pass ^ $pass;
      				$ret = 0;
      				for($i = strlen($res) - 1; $i >= 0; $i--) $ret |= ord($res[$i]);
      					return !$ret;
    			}
  			}
		}


		// Hash_Equals ne marche pas dans notre version de PHP... Il faut trouver une alternative.
		/* if ( hash_equals($bd_pass->hash, crypt($pass, $bd_pass->hash)) )
		{
  			return true;
		}

		else
		{
			return false;
		}*/
	}
?>