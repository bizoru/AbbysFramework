<?php

class Login extends Application {

    function index() {


        $this->access();
    }

    function setSession($params=array()) {

        // Set the session for the user
        SessionMan::setSessionValue(true, 'auth');
        SessionMan::setSessionValue($params['user'], 'user');
        
    }

    function access() {

        if (HttpHandler::isPost()) {

            $this->loadModel('model_usuario');
            $usuario = new model_usuario();
            $usuario->usuario = HttpHandler::post('usuario');
            $usuario->password = md5(HttpHandler::post('password'));
            $result = $usuario->checkUser($usuario);


            if (!empty($result)) {

                $logeduser = $result[0];
                $data = array("user" => $logeduser);
                $this->setSession($data);
                $this->checkGlobalAccess(); // Check user level of access
                
            } else {


                $info = array("error" => "Contrasena o usuario invalidos");
                $this->loadView('view_login', $info);
            }
        } else {

            $this->loadView('view_login');
        }
    }

    function logout() {


        session_destroy();
        session_unset();

        $this->loadView('view_login_end');
    }

    function checkGlobalAccess() {

        $usuario = SessionMan::getSessionValue('user');
        $this->loadModel('login','model_usuario');
        $model = new model_usuario();
        $dbuser = $model->getById($usuario['id']);
        $dbuser = $dbuser[0];

        
        // 1 Administradores 2 Vendedores
        // Si el usuario es un vendedor llevar al link de vendedores de lo contrario al link de administradores
        if($dbuser['grupo_id']==2){
            
           HttpHandler::redirect($this->application, 'vendedores');
            
        }else{
            
            
            HttpHandler::redirect($this->application, 'admin');
            
        }
            
        
        
    }

}