<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php

class model_vehiculos extends Model {

    public $id, $nombre;
    public $selectAll = 'select vehiculos.id ,max(fecha_hora) as fecha,nombre from reporte,vehiculos where reporte.movil = vehiculos.nombre group by vehiculos.id,nombre,movil';
    public $selectById = 'select * from vehiculos where id =:id';
    
    
    
    function __construct() {

        parent::__construct();
        $this->setup();
    }

    function getAll() {

        $query = $this->selectAll;
        $result = $this->getSQLEngine()->doQuery($query);
        return $result;
    }
    
    function getById($id){
        
        $params = array('id'=>$id);
        $query = $this->prepareStatement($this->selectById, $params);
        $result = $this->getSQLEngine()->doQuery($query);
        return $result;
        
    }

    function getResult() {


        $this->testCon();
    }

    function setup() {
        
    }

}
