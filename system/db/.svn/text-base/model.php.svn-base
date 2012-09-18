<?php

require_once 'sqlengine.php';
require_once 'form.php';

class Model {

	/**
	 * Map Variables of a class into a dictionary with their respective values inside
	 * the Dictionary
	 * @param Dictioary
	 */
	private $sqlengine;
	private $form;


	function __construct(){

		$this->sqlengine = new SQLEngine();
		$this->form = new Form();
		

	}

	function getForm(){

		return $this->form;
	}

	function getInstance(){

		$dictionary = get_class_vars(get_class($this));
		foreach ($dictionary as $item => $value){
			$dictionary[$item] = $this->{$item};
		}
		return $dictionary;


		return $vars;
	}

	function getSQLEngine(){


		return $this->sqlengine;


	}
        /**
         * Escape all query items
         * @param type $statement
         * @param type $params
         * @return type 
         */

	function prepareStatement($statement,$params){

		$query = $statement;

		foreach ($params as $param =>$key){


                    $code = $params[$param];
                    $code = mysql_escape_string($code);
                    

                    $statement = str_replace(":".$param, $code, $statement);

                    

		}

		return $statement;


	}

	function isValid(){

		$valid = true;
		$this->form->messages = array();
		$validators = $this->form->getValidators();


		foreach ($validators as $validator){


			$actionname = $validator[0];
			$fieldname = $validator[1];
			$fields = $validator[2];
			$currentfields = array();


			foreach ($fields as $field){
					
				array_push($currentfields, $this->{$field});
					
			}

			$this->form->{$actionname}($fieldname,$currentfields);


		}

		if(!empty($this->form->messages)){

			$valid = false;
		}

		


	 return $valid;


	}


}