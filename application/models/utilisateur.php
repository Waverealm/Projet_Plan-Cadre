<?php

class Utilisateur extends VanillaModel {
		var $hasMany = array('Elaborateur' => 'Elaborateur');
}