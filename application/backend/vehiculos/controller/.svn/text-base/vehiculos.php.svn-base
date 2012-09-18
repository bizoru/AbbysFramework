<?php
class Vehiculos extends Application{

	/**
	 * The constructor should call its module name and the constructor
	 * @TODO Find a way to improve the constructor
	 *
	 */

        function listar(){
            
            $this->loadModel('model_vehiculos');
            $modelvehiculos = new model_vehiculos();
            $vehiculos = $modelvehiculos->getAll();
            
            $data = array('vehiculos'=>$vehiculos);
            
            
            $this->loadView('view_vehiculos_listar',$data);
            
        }
        
        function ver($id){
            
            $data = array('id'=>$id);
            
            
            $this->loadView('view_vehiculos_ver',$data);
        }



        function index(){
		
		$this->loadModel('model_usuario','login');
                $this->loadModel('model_permisos','permisos');
                $this->loadModel('model_modulos','modulos');
                    
                
                $modelpermisos =  new model_permisos();
                
                

                
		$user = SessionMan::getSessionValue('user');
                
		
		$modelo =  new model_usuario();
		$usuario = $modelo->getById($user['id']);
		$usuario = $usuario[0];
		
		$info = array("usuario"=>$usuario);
		//$model = new model_backend();
		//$model->testCon();
			
		//echo "In the controller loaded the modulename: ".$this->modulename."<br>";

		
        $this->loadView('view_admin',$info);

	}
        
        function actual($id){
            // Call Models
            $this->loadModel('model_vehiculos');
            $this->loadModel('model_reporte','reporte');
            
            
            $modelvehiculo = new model_vehiculos();
            $modelreporte = new model_reporte();
            
            // What is the vehicle?
            $vehiculo = $modelvehiculo->getById($id);
            $vehiculo = $vehiculo[0];
            
            // Wich is the last report of this vehicle?
            $lastreport = $modelreporte->getLastById($vehiculo['nombre']);
            $lastreport = $lastreport[0];
            
            // Give me coordinates of this last report
            $reporte = $modelreporte->getByPosition($lastreport['fecha'],$lastreport['nombre']);
            $reporte = $reporte[0];
            
            $data = array('reporte'=>$reporte,'vehiculo'=>$vehiculo);
            
            $this->loadView('view_vehiculos_actual',$data);
            
            
            
        }
        
        function reporte($id){
            
            
            $this->loadModel('model_reporte','reporte');
            $this->loadModel('model_vehiculos');
            
            $modelreporte =  new model_reporte();
            $modelvehiculos = new model_vehiculos();
            
            
            $vehiculo = $modelvehiculos->getById($id);
            
            $vehiculo = $vehiculo[0];
            
            $nombre = $vehiculo['nombre'];
            
            $reportes = $modelreporte->getByVehicleName($nombre);
            
            $data = array('reportes'=>$reportes,'vehiculo'=>$vehiculo);
            
            $this->loadView('view_vehiculos_reporte_detalles',$data);
            
            
        }
        
        function jsonGetPosition($id){
            
            
            $this->loadModel('model_vehiculos');
            $this->loadModel('model_reporte','reporte');
            
            $modelvehiculos = new model_vehiculos();
            $modelreporte = new model_reporte();
            
            
            
        }





}