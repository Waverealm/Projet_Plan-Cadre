<?php

class Plancadre extends VanillaModel {
		var $hasOne = array('Cours' => 'Cours');
        var $hasMany = array('Elaborateur' => 'Elaborateur');

}