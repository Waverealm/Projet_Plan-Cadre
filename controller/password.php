<?php

	// Fonction reprise de mon vieux projet.
	// À AMÉLIORER
	function getCryptedPassword($pass)
	{
		// Contenu de mon salt
		$salt = 'W9hvxBZpTHTj1YnO9QAhR94tw9rLs1bIKnwENsxd';

		return md5($pass.$salt);
	}
?>