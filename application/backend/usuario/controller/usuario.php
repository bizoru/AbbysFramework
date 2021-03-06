<?php

class Usuario extends Application {

    function index() {


        $this->listar();
    }

    function crear() {

        $this->loadModel('model_usuario', 'login');
        $this->loadModel('model_grupo', 'grupo');


        $grupo = new model_grupo();
        $grupos = $grupo->getAll();
        $data = array("grupos" => $grupos);
        $this->loadView('view_usuario_crear', $data);
    }

    function listar() {

        $this->loadModel('model_usuario', 'login');
        $this->loadModel('model_grupo', 'grupo');



        $usuario = new model_usuario();
        $grupo = new model_grupo();
        $result = array();

        $usuarios = $usuario->getAll();


        foreach ($usuarios as $s) {

            $g = $grupo->getById($s['grupo_id']);
            $gruponombre = $g[0];

            $s['grupo'] = $gruponombre['nombre'];
            array_push($result, $s);
        }


        $data = array("usuarios" => $result);

        $this->loadView('view_usuario_listar', $data);
    }

    function guardar() {

        $this->loadModel('model_usuario', 'login');
        $this->loadModel('model_grupo', 'grupo');


        if (HttpHandler::isPost()) {


            // Map Post to user
            $usuario = new model_usuario();

            HttpHandler::mapPost($usuario);

            // Improve this
            $usuario->activo = true;
            $usuario->amarres = 0;
            $usuario->cabanas = 0;


            if ($usuario->isValid()) {
                // Check the user then save or return error
                $usuario->insert($usuario);
                $info = array('usuario' => $usuario->getInstance());
                $this->loadView('view_usuario_detalles', $info);
            } else {

                $grupo = new model_grupo();
                $grupos = $grupo->getAll();
                $info = array('error' => $usuario->getForm()->messages, 'usuario' => $usuario->getInstance(), "grupos" => $grupos);
                $this->loadView('view_usuario_crear', $info);
            }
        } else {


            $this->loadView('view_usuario_crear');
        }
    }

    function buscar() {
        
    }

    function eliminar($id) {

        $this->loadModel('model_usuario', 'login');
        $this->loadModel('model_grupo', 'grupo');
        $this->loadModel('model_reserva', 'reservas');
        $this->loadModel('model_unidades', 'unidades');

            $modelreservas = new model_reserva();
            $modelunidades = new model_unidades();
            
        $reservas = $modelreservas->getByUsuarioId($id);


        if (HttpHandler::isPost()) {

        
            

            if (!empty($reservas)) {
                
                $this->loadView('view_usuario_eliminar_fail');
                
            }else{
            
                $modelo = new model_usuario();
                $modelo->delete(HttpHandler::post('id'));
                $this->listar();
            
            
            }
        } else {

            $modelo = new model_usuario();
            $usuario = $modelo->getById($id);
            $usuario = $usuario[0]; // Fix

            $data = array("usuario" => $usuario);
            $this->loadView('view_usuario_eliminar', $data);
        }
    }

    function myView($id){ 

         $this->loadModel('model_enthusiast','people');

         $people = $this->getPeopleById($id);

          $view = array('people'=>$people);

          $this->loadView('view_people_list',$view);


    }



    function editar($id) {

        $this->loadModel('model_usuario', 'login');
        $this->loadModel('model_grupo', 'grupo');



        if (HttpHandler::isPost()) {

            $usuario = new model_usuario();
            $usuario->nombre = HttpHandler::post('nombre');
            $usuario->apellido = HttpHandler::post('apellido');
            $usuario->correo = HttpHandler::post('correo');
            $usuario->contrasena = HttpHandler::post('contrasena');
            $usuario->usuario = HttpHandler::post('usuario');
            $usuario->id = HttpHandler::post('id');
            $usuario->grupo_id = HttpHandler::post('grupo');

            $usuario->updateUser($usuario);

            $info = array('usuario' => $usuario->getInstance());

            $this->loadView('view_usuario_detalles', $info);
        } else {

            $modelo = new model_usuario();
            $modelgrupo = new model_grupo();
            $models = $modelgrupo->getAll();

            $usuario = $modelo->getById($id);


            if (!empty($usuario)) {

                $usuario = $usuario[0];
            }

            $grupo = $usuario['grupo_id'];

            $selected = array();
            $index = 0;
            foreach ($models as $item) {

                if ($item['id'] == $grupo) {

                    $selected = $item;
                    unset($models[$index]);
                }
                $index++;
            }


            $data = array("usuario" => $usuario, "grupos" => $models, "selected" => $selected);

            $this->loadView('view_usuario_editar', $data);
        }
    }

}