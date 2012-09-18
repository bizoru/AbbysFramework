<?php

class Router {

	function parseURL(){

		// Set the new url by deleting the workspace url
		$url = 	str_replace(WORKING_FOLDER,"",$_SERVER['REQUEST_URI']);

		debug($url,'get_url');


		$request = ltrim($url,'/');
		debug($request,'get_url_request');

		//echo  "The request processed is now: ".$request."<br>";

		// If not requested to get anything get the default controller
		if(empty($request)){

			$url = $url.DEFAULT_APPLICATION.'/'.DEFAULT_CONTROLLER;

		}




		// Split into parts
		$location = preg_split('[\\/]', $url, -1, PREG_SPLIT_NO_EMPTY);

		//Create vars included into the URL
		$route['application'] = $location[0];
		$route['controller'] = $location[1];
		$route['method'] = $location[2];
		$route['var'] = $location[3];

		
		if(empty($route['controller'])){
		
			$route['controller'] = DEFAULT_CONTROLLER;
		
		}
		
		if(empty($route['method'])){

			$route['method'] = DEFAULT_METHOD;

		}
		


		$this->cleanUri($route);

		
		return $route;

	}

	function curPageURL() {
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}

	function curPageName() {
		return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
	}

	function cleanUri(&$uri){

		foreach ($uri as $key => $value) {
			$content = htmlentities($value);
			$content = mysql_escape_string($content);
			$uri[$key] = $content;

		}

	}

	function getCurrentURL(){
	
		return "http://".$_SERVER["SERVER_NAME"]."/".WORKING_FOLDER;
	}
}
