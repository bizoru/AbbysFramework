<?php


class HttpHandler {


	static function post($key){

		$code = $_POST[$key];
		$code = stripslashes($code);
		$code = mysql_escape_string($code);
		

		return $code;

	}

	static function cleanPost(){

		$post = $_POST;
		$result= array();

		foreach ($post as $value=>$key){



		}

	}
        
        static function wipe($param){
            $code = $param;
            $code = stripslashes($code);
            $code = mysql_escape_string($code);
            
            return $code;
            
            
        }

	static function get($key){

		$code = $_GET[$key];
		$code = stripslashes($code);
		$code = mysql_escape_string($code);
                    

		return $code;

	}

	static function redirect($application,$controller){

		$url = "http://".$_SERVER['SERVER_NAME']."/".WORKING_FOLDER."$application/$controller";
		
		header("Location: $url");

	}

	static function getAuth(){



	}

	static function isPost(){

		$result = false;

		if($_SERVER['REQUEST_METHOD']=="POST"){


			$result = true;

		}

		return $result;


	}

	static function isGet(){


		$result = false;

		if($_SERVER['REQUEST_METHOD']=="GET"){


			$result = true;

		}

		return $result;

	}

	static function cleanVar($var){

		$code = $var;
		$code = stripslashes($code);
		$code = mysql_escape_string($code);
		$code = htmlentities($code);

		return $code;

	}

	static function mapPost(&$class){

		$classname = get_class($class);
		$properties = get_class_vars($classname);

		foreach ($properties as $key=>$value){

			$value = HttpHandler::post($key);			
			$class->{$key} = $value;	
				
		}

	}



}