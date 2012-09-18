<?php
class Admin extends Application{

	/**
	 * The constructor should call its module name and the constructor
	 * @TODO Find a way to improve the constructor
	 *
	 */

	

	function index(){
		
		$this->loadModel('model_usuario','login');
              //  $this->loadModel('model_permisos','permisos');
                $this->loadModel('model_modulos','modulos');
                    
                
             //   $modelpermisos =  new model_permisos();
                
                

                
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





}