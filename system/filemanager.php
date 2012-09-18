<?php

class FileManager {
	/**
	 * If the file requested is not found the controller file will be the error
	 * controller instead
	 * @param $controller
	 */
	static function loadController($application,$controller){
			
		$result = "";
		$current_directory = getcwd();
		
		
		$file = strtolower($current_directory.'/'.APPLICATION_PATH."/".$application."/".$controller."/controller/".$controller.".php");
		
		
		if(!file_exists($file)){
			$controller = ERROR_CONTROLLER;
			$error_file= strtolower($current_directory.'/'.APPLICATION_PATH."/".DEFAULT_APPLICATION."/".$controller."/controller/".$controller.".php");
			require_once $error_file;
			
		}else{
				
			require_once $file;
			
		}

		$controller = new $controller();
		return $controller;
		
	}

	static function loadModel($application,$controller,$model){

		$current_directory = getcwd();
		$file = strtolower($current_directory.'/'.APPLICATION_PATH."/".$application."/".$controller."/model/".$model.".php");

		

		if(file_exists($file)){

			require_once($file);

		}



	}

	/**
	 * @param Application Name $application
	 * @param Controller $controller
	 * @param View $view
	 * @param Vars $vars
	 */
	static function loadView($application,$controller,$view,$vars=""){

	
	
		if(is_array($vars) && count($vars) > 0){
			extract($vars, EXTR_PREFIX_SAME, "wddx");
		}


		$current_directory = getcwd();
		$file = strtolower($current_directory.'/'.APPLICATION_PATH."/".$application."/".$controller."/view/".$view.".php");

		
		
		if(file_exists($file)){

			require_once($file);

		}else{

			$file = strtolower($current_directory.'/'.APPLICATION_PATH."/".DEFAULT_APPLICATION."/error/view/view_error.php");
			require_once($file);

		}


	}

	static function loadFile(){




		$max_file_size = MAX_FILE_SIZE*1024;

		if ((($_FILES["file"]["type"] == "image/png")|| ($_FILES["file"]["type"] == "image/jpeg")|| ($_FILES["file"]["type"] == "image/pjpeg"))&& ($_FILES["file"]["size"] < $max_file_size)){

			$result = array();

			$current_directory = getcwd();

			$location = $current_directory.'/'.UPLOAD_LOCATION;

			if ($_FILES["file"]["error"] > 0)
			{
				echo "Error: " . $_FILES["file"]["error"] . "<br />";
				$result['error'] = "Error subiendo el mapa base";
			}
			else
			{
				$result['file_name'] = $_FILES["file"]["name"];
				$result['file_type'] = $_FILES["file"]["type"];
				$result['file_size'] = ($_FILES["file"]["size"] / 1024)." KB";

			}

			if (file_exists($location . $_FILES["file"]["name"]))
			{
				$result['error'] = "El archivo que cargo ya existe";
			}
			else
			{

				copy($_FILES["file"]["tmp_name"], $location.$_FILES["file"]["name"]);
				$result['location'] = $location.$_FILES["file"]["name"];


			}

		}else{


			$result['error'] = "El archivo especificado no cumple con las condiciones para un mapa base";
				
		}
		
		// Fix
		$result['file'] = $result['file_name'];

		return $result;

	}


}