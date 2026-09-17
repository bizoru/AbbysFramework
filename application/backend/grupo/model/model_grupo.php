<?php

class model_grupo extends Model {

	public $id, $nombre;
	private $table = "grupo";
	private $selectAll = 'SELECT * from grupo';
	private $checkById = 'SELECT * from grupo where id=:id';

	function __construct(){

		parent::__construct();
	}

	function getAll(){

		$query = $this->selectAll;
		$result = $this->getSQLEngine()->doQuery($query);

		return $result;
	}

	function getById($id){

		$params = array("id"=>$id);
		$query = $this->prepareStatement($this->checkById, $params);
		$result = $this->getSQLEngine()->doQuery($query);

		return $result;
	}

}
