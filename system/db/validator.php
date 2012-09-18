<?php

require_once 'messages.php';

class Validator {

	public $messages;

	function __construct(){

		$messages = array();


	}


	function checkEmail($field,$params=array()){
			

		// Check if the email address is properly typed

		return ERROR_MAIL;
			
			
	}

	function checkEmpty($field,$params=array()){
			
		if(!empty($params)){
			$a = $params[0];
			if(empty($a)){

				$this->messages[$field] = EMPTY_FIELD;


			}
		}


	}

	function checkPassword($field,$params=array()){

		if(!empty($params)&& count($params)>1){



			$a = $params[0];
			$b = $params[1];

			if(!($a==$b)){


				$this->messages[$field] = NOT_EQUAL;


			}
				
			if(empty($a)&&empty($b)){
					
				$this->messages[$field] = EMPTY_PASSWORD;

					
			}
			
			


		}

	}

	function checkEqual($field,$params=array()){
	
	
		/**
		 * Fill
		 * 
		 */
		
	if(!empty($params)&& count($params)>1){



			$a = $params[0];
			$b = $params[1];

			if(!($a==$b)){


				$this->messages[$field] = NOT_EQUAL;


			}
				
			if(empty($a)&&empty($b)){
					
				$this->messages[$field] = EMPTY_EMAIL;

					
			}
			
			


		}
		
		
	}




}