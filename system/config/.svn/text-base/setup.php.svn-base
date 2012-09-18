<?php



function curPageName() {
	return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
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

function getWorkingFolder(){

	// If I'm calling from a different
	$serverlocation = "http://".$_SERVER["SERVER_NAME"];
	$rootlocation = $serverlocation.'/'.curPageName();

	$pagename = curPageName();
	$original_location = curPageURL();

	$workingfolder = str_replace($serverlocation,"", $original_location);
	$workingfolder = str_replace($pagename,"", $workingfolder);
	$workingfolder = substr($workingfolder, 0,strlen($workingfolder)-1);
	echo $workingfolder;
	return $workingfolder;

}

function setEnv($env=""){


	$selection = $env;
	
	if($env == "prod"){
	
		require_once 'settings.prod.php';
	}
	
	if($env == "dev"){
	
		require_once 'settings.dev.php';
		
	}
	
	if(empty($selection)){
	
	
		die('Failed to load settings');
	
	}
	
	

}


function getEcho(){

	echo "Hello";

}
setEnv("dev");






