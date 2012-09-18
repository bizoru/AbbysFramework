<?php

require_once dirname(__FILE__) . '/debug/debugger.php';
require_once dirname(__FILE__) . '/db/model.php';
require_once dirname(__FILE__) . '/db/dbcon.php';
require_once dirname(__FILE__) . '/routing/router.php';
require_once 'excel.inc.php';
require_once 'httphandler.php';
require_once 'sessionman.php';
require_once 'resources.php';
require_once 'filemanager.php';
require_once 'mailer.php';

class Application {

    protected $application;
    protected $controller;
    protected $method;
    protected $var;
    protected $uri;
    private $db;

    function __construct() {

        $this->db = true;
        $this->setUri();
        $this->checkSystem();
        $this->checkAuth();
    }

    /**
     * Uri is an array containing controller method and var keys
     * If the controllername is the same as the base framework then switch to the
     * default controller
     * @param $url
     */
    function setUri() {

        $router = new Router();
        $this->uri = $router->parseURL();
        $this->application = $this->uri['application'];
        $this->controller = $this->uri['controller'];
        $this->method = $this->uri['method'];
        $this->var = $this->uri['var'];
    }

    function loadController() {


        // Seek out the file and load the object
        $controller = FileManager::loadController($this->application, $this->controller);

        if (method_exists($controller, $this->method)) {

            $controller->{$this->method}($this->var);
        } else {

            $this->controller = ERROR;
            $error = FileManager::loadController($this->controller, $this->application);
            $error->error404();
        }
    }

    function loadView($view, $vars="") {


        $application = $this->application;

        FileManager::loadView($application, $this->controller, $view, $vars);
    }
    
       // Lets see if this works
    function loadRemoteView($controller, $view, $vars="") {

        $application = $this->application;

        FileManager::loadView($application, $controller, $view, $vars);
    }
    

    function loadModel($model, $controller="") {
        if (empty($controller)) {


            FileManager::loadModel($this->application, $this->controller, $model);
        } else {


            FileManager::loadModel($this->application, $controller, $model);
        }
    }

    function loadRemoteModel($application, $controller, $model) {

        $this->application = $application;

        $this->loadModel($model, $controller);
    }

    function checkSystem() {

        if (CHECK_DB) {
            $db = new SQLEngine();

            if (!$db->checkDB()) {

                $this->db = false;
                $this->controller = ERROR_CONTROLLER;
                $this->method = "errorSQL";
            }
        }
    }

    /**
     * Get the current realm to logged user
     * @TODO
     * Take care of url by preventing the user to request login url again
     */
    function checkAuth() {
        

        if (AUTH) {

            
            if ($this->db) {
                
                $auth = SessionMan::getSessionValue('auth');
                
                if (empty($auth)) {

                    
                    $this->controller = AUTH_CONTROLLER;
                } else {

                    // Lock not admin users to access this place.

                    $usuario = SessionMan::getSessionValue('user');
                    FileManager::loadModel('backend', 'login', 'model_usuario');
                    $model = new model_usuario();
                    $dbuser = $model->getById($usuario['id']);
                    $dbuser = $dbuser[0];
                }
            }
        }
    }

    // this is an experimental feauture for future use
    // compact the view
    function compact($vars) {

        $result = array();
        foreach ($vars as $var) {
            $varname = ${$var};
            $result[$varname] = $var;
        }
        return $result;
    }

}

?>