<?php

class ProgrammesController extends VanillaController {
	
	function beforeAction () {

	}

	function view($programmeId = null) {

		$this->Programme->id = $programmeId;
		$this->Programme->showHasMany();
		$programme = $this->Programme->search();
	
		$this->set('programme',$programme);

	}
	
	
	function index() {
		$this->Programme->orderBy('nom','ASC');
		$programmes = $this->Programme->search();
		$this->set('programmes',$programmes);
	
	}

	function afterAction() {

	}


}