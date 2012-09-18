    <?php
class model_reporte extends Model{
    
        public $id,$fecha_hora,$movil,$tipo,$ip,$fecha,$velocidad,$aceleracion,$parametro1,$parametro2,$altura,$num_satelites,$posicion;
        public $selectByVehicleId = "select * from reporte where movil =':movil' order by fecha_hora desc";
        public $selectByDate = "select * from reporte where fecha_hora > ':fecha_hora 00:00:00' and fecha_hora < ':fecha_hora 23:59:59' and movil =':movil'";
        public $selectByPosition = "select id,movil,ST_X(posicion) as lon,ST_Y(posicion) as lat from reporte where fecha_hora=':fecha_hora' and movil=':movil'";
        public $selectLastReportById = "select vehiculos.id ,max(fecha_hora) as fecha,nombre from reporte,vehiculos where reporte.movil = vehiculos.nombre and nombre=':nombre' group by vehiculos.id,nombre,movil";
        
	function __construct(){
            
            parent::__construct();
            $this->setup();
        


	}

        function getLastById($nombre){
            
            $params = array('nombre'=>$nombre);
            $query = $this->prepareStatement($this->selectLastReportById, $params);
            $result = $this->getSQLEngine()->doQuery($query);
            return $result;
            
            
        }
        
        function getByPosition($date,$movil){
            
            $params = array('fecha_hora'=>$date,'movil'=>$movil);
            $query = $this->prepareStatement($this->selectByPosition, $params);
            $result = $this->getSQLEngine()->doQuery($query);
            return $result;
            
            
        }
        
        function getByDate($date,$movil){
            
            $params = array('fecha_hora'=>$date,'movil'=>$movil);
            $query = $this->prepareStatement($this->selectByDate, $params);
            $result = $this->getSQLEngine()->doQuery($query);
            return $result;
            
        }
        function getByVehicleName($movil){
            
            $params = array('movil'=>$movil);
            $query = $this->prepareStatement($this->selectByVehicleId, $params);
            $result = $this->getSQLEngine()->doQuery($query);
            return $result;
            
            
        }
        
	function getResult(){


		$this->testCon();



	}
        
        function setup(){
            
            
            
        }








}