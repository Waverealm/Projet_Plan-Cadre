<?php

class PlancadresController extends VanillaController {
	
	function beforeAction () {

	}

	function view($plancadreId = null) {

		$this->Plancadre->id = $plancadreId;
        $this->Plancadre->showHasOne();
		$this->Plancadre->showHasMany();
		$plancadres = $this->Plancadre->search();
	
		$this->set('plancadres',$plancadres);

	}
	
	
	function index() {
		$this->Plancadre->orderBy('dateajout','ASC');
		$models = $this->Plancadre->search();
		$this->set('models',$models);
	
	}

	function afterAction() {

	}


}