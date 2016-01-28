<?php

class CoursController extends VanillaController {
	
	function beforeAction () {

	}

	function view($coursId = null) {

		$this->Cours->id = $coursId;
		$this->Cours->showHasOne();
		$cours = $this->Cours->search();
	
		$this->set('cours',$cours);

	}
	
	
	function index() {
		$this->Cours->orderBy('nom','ASC');
		$this->Cours->showHasOne();
		$cours = $this->Cours->search();
		
		$this->set('cours',$cours);
	
	}

	function afterAction() {

	}


}