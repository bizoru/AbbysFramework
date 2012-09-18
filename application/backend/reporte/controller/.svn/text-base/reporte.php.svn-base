<?php
class Reporte extends Application{

	/**
	 * The constructor should call its module name and the constructor
	 * @TODO Find a way to improve the constructor
	 *
	 */

	

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

		
              $this->loadView('view_reporte',$info);

	}
        
        function ver(){
            
            $this->loadView('view_reporte');
            
        }
        
        function visualiza(){
            
            
            $this->loadModel('model_reporte');
            $this->loadModel('model_vehiculos','vehiculos');
            
            if(HttpHandler::isPost()){
                
                
                
                $fecha = HttpHandler::post('fecha');
                $idvehiculo = HttpHandler::post('id');
                
                if(!empty($fecha)){
                
                $modelreporte = new model_reporte();
                $modelvehiculos = new model_vehiculos();
                
                $vehiculo = $modelvehiculos->getById($idvehiculo);
                $vehiculo = $vehiculo[0];
                
                
                $reportes = $modelreporte->getByDate($fecha,$vehiculo['nombre']);
                
                if(!empty ($reportes)){
                    $count = count($reportes);
                    $data = array('fecha'=>$fecha,'vehiculo'=>$vehiculo,'reportes'=>$reportes,'count'=>$count);
                
                $this->loadView('view_reporte_vehiculo',$data);
                }else{
                    
                    
                    $data = array('vehiculo'=>$vehiculo);
                    $this->loadView('view_reporte_empty',$data);
                }
                
                
                
                
                }else{
                    
                    $vehiculo['id'] = $idvehiculo;
                    $error = 'Debe Ingresar una fecha';
                    $data = array('vehiculo'=>$vehiculo,'error'=>$error);
                    
                    $this->loadRemoteView('vehiculos','view_vehiculos_reporte_detalles',$data);
                }
                
                
                
                
            }
            
            
        }





}