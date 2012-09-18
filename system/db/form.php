<?php
require_once 'validator.php';

class Form extends Validator{

	private $validators;

	function __construct(){

		$this->validators = array();
		parent::__construct();

	}

	function setValidator($validatorName,$messagefield,$params=array()){

		$validator = array($validatorName,$messagefield,$params);

		array_push($this->validators,$validator);

	}

	/**
	 * Check if the model is valid
	 * 1. For each widget the function will call the apropiate method to render it on the message board
	 * 2.
	 */
	function getValidators(){
		
		return $this->validators;
	}


}

