<?php

//INSERT INTO %s (<COLUMS>) VALUES (\"VALUES\",..)"%(Dictionary[field])
class model_usuario extends Model {

	public $id,$usuario,$contrasena,$contrasenar,$nombre,$apellido,$correo,$grupo_id,$activo,$fecha;
	private $table="usuario";
	private $checkUser = "select * from usuario where usuario.usuario =':usuario' and usuario.contrasena=':password'";
	private $checkByUser = 'SELECT * from usuario where usuario=":usuario"';
	private $checkById =  'SELECT * from usuario where id=:id';
	private $selectAll = 'SELECT * from usuario';
	private $insertRecord  = 'INSERT INTO usuario values (null,":usuario",":contrasena",":nombre",":apellido",":correo",":fecha",:activo,:grupo_id);';
	private $updateRecord = 'UPDATE usuario SET nombre=":nombre", contrasena=":contrasena",usuario=":usuario",correo=":correo",grupo_id=:grupo_id where id=:id';
	private $deleteRecord = "DELETE from usuario where id=:id";
	
	
	function __construct(){

		parent::__construct();
		$this->setup();
	}
	
	function testUsuario(){

		//$params = array("usuario"=>"admin");
		//$query = $this->prepareStatement($this->checkByUser, $params);
		$result = $this->getSQLEngine()->doQuery($this->selectAll);


	}

	function checkUser($usuario){

		$params = array("usuario"=>$usuario->usuario,"password"=>$usuario->password);
		$query = $this->prepareStatement($this->checkUser, $params);
                
		$result = $this->getSQLEngine()->doQuery($query);
		return $result;
	}

	function insert($usuario){

		$fecha = date('Y-m-d H:i:s');


		$params = array("fecha"=>$fecha,"usuario"=>$usuario->usuario,"contrasena"=>md5($usuario->contrasena),"nombre"=>$usuario->nombre,"apellido"=>$usuario->apellido,"correo"=>$usuario->correo,"activo"=>$usuario->activo,"grupo_id"=>$usuario->grupo_id);

		$query = $this->prepareStatement($this->insertRecord, $params);

		debug($query,'insert_user');

		$result = $this->getSQLEngine()->doQuery($query);

		return $result;


	}

	function getAll(){

		$query = $this->selectAll;
		$result = $this->getSQLEngine()->doQuery($query);

		return $result;


	}
	
	function updateUser($usuario){
	
		$params = array("id"=>$usuario->id,"usuario"=>$usuario->usuario,"contrasena"=>md5($usuario->contrasena),"nombre"=>$usuario->nombre,"apellido"=>$usuario->apellido,"correo"=>$usuario->correo,"grupo_id"=>$usuario->grupo_id);
		$query = $this->prepareStatement($this->updateRecord, $params);
		$this->getSQLEngine()->doQuery($query);
		
	}
	
	function delete($id){
	
		$params = array("id"=>$id);
		$query =  $this->prepareStatement($this->deleteRecord, $params);
		$this->getSQLEngine()->doQuery($query);

	}

	function setup(){

		$this->getForm()->setValidator('checkPassword', 'contrasena', array('contrasena','contrasenar'));
		$this->getForm()->setValidator('checkEmpty', 'nombre', array('nombre'));
		$this->getForm()->setValidator('checkEmpty', 'usuario', array('usuario'));
		$this->getForm()->setValidator('checkEmpty', 'apellido', array('apellido'));
		$this->getForm()->setValidator('checkEmpty', 'correo', array('correo'));
		$this->getForm()->setValidator('checkEmpty', 'grupo', array('grupo_id'));

	}

	function getById($id){

		$params =  array("id"=>$id);
		$query = $this->prepareStatement($this->checkById, $params);
		$result =  $this->getSQLEngine()->doQuery($query);
		return $result;


	}

}