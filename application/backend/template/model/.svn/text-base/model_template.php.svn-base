<?php 
/**
 * 
 * Template for model 
 * @author Steven
 *
 */

class model_ extends Model {

	//public $id,$nombre;
	//private $table="grupo";
	//private $selectAll = 'SELECT * from model_';
	//private $insertRecord  = 'INSERT INTO grupo values (null,":nombre");';

	function __construct(){

		parent::__construct();
		$this->setup();
		
	}

	function insert($__){

//		$fecha = date('Y-m-d H:i:s', $phpdate );
//		
//		$params = array("fecha"=>$fecha,"usuario"=>$usuario->usuario,"contrasena"=>md5($usuario->contrasena),"nombre"=>$usuario->nombre,"apellido"=>$usuario->apellido,"correo"=>$usuario->correo,"activo"=>$usuario->activo,"grupo_id"=>$usuario->grupo_id,"cabanas"=>$usuario->cabanas,"amarres"=>$usuario->amarres);
//		
//		$query = $this->prepareStatement($this->insertRecord, $params);
//		debug($query,'insert_user');
//		$result = $this->getSQLEngine()->doQuery($query);
//
//		return $result;


	}
	
	function getAll(){
	
		$query = $this->selectAll;
		$result = $this->getSQLEngine()->doQuery($query);
		
		return $result;
	
	
	}

	function setup(){
	

		//$this->getForm()->setValidator('checkEmpty', 'nombre', array('nombre'));
		
	
	}


}