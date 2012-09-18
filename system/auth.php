<?php

class Auth {




	/**
	 * Get the user auth
	 *
	 */
	static function getAuth(){

		$result = false;

		if(isset($_SESSION['auth'])){

				
			$result = true;

		}

		return $result;

	}





}