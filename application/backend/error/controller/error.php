<?php
class Error extends Application{


	function index(){

		$this->loadView('view_error');


	}
	
	function error404(){
		
		$this->loadView('view_error_404');
	
	}

	function errorView(){
	
	
		$this->loadView('view_error');
	
	}

	function errorSQL(){
		
		


	
		$this->loadView('view_error_sql');
		
	}

	function errorAcceso(){
	
		$this->loadView('view_error_acceso');
	
	}
	function errorDown(){
	
	
		$this->loadView('view_error_down');
	
	}




}