<?php

/**
 *
 * Template for Application Controller
 * @author Steven
 *
 */
class Tipo extends Application {

    function index() {

        $this->listar();
    }

    function crear() {


        $this->loadView('view_tipo_crear');
    }

    function listar() {

        $this->loadModel('model_tipo');
        $model = new model_tipo();
        $tipos = $model->getAll();
        $data = array("tipos" => $tipos);
        $this->loadView('view_tipo_listar', $data);
    }

    function guardar() {


        if (HttpHandler::isPost()) {

            $this->loadModel('model_tipo');
            // Map Post to user
            $tipo = new model_tipo();

            HttpHandler::mapPost($tipo);


            if ($tipo->isValid()) {

                $tipo->insert($tipo);
                $info = array('tipo' => $tipo->getInstance());
                $this->loadView('view_tipo_detalles', $info);
            } else {

                $info = array('error' => $tipo->getForm()->messages, 'tipo' => $tipo->getInstance());
                $this->loadView('view_tipo_crear', $info);
            }
        } else {

            $this->crear();
        }
    }

    // empty id ??
    function eliminar($id) {

        $this->loadModel('model_tipo');

        $model = new model_tipo();

        if (HttpHandler::isPost()) {

            $id = HttpHandler::post('id');
            $model->delete($id);
            $this->listar();
        } else {

            $tipo = $model->getById($id);

            $data = array("tipo" => $tipo[0]);
            $this->loadView('view_tipo_confirm', $data);
        }
    }

    function editar($id) {

        $this->loadModel('model_tipo');

        $model = new model_tipo();
        $tipo = $model->getById($id);


        $data = array("tipo" => $tipo[0]);
        $this->loadView('view_tipo_editar', $data);
    }

    function update($tipo) {

        $this->loadModel('model_tipo');
        $tipo = new model_tipo();


        if (HttpHandler::isPost()) {

            HttpHandler::mapPost($tipo);

            if ($tipo->isValid()) {

                $tipo->update($tipo);
                $this->listar();
            } else {

                $info = array('error' => $tipo->getForm()->messages, 'tipo' => $tipo->getInstance());
                $this->loadView('view_tipo_editar', $info);
            }
        }
    }

}