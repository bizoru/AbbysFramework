<?php

require_once __DIR__ . '/../vendor/autoload.php';

// Define constants needed by the framework
if (!defined('DB_HOST')) define('DB_HOST', 'localhost');
if (!defined('DB_USER')) define('DB_USER', 'test');
if (!defined('DB_PASSWD')) define('DB_PASSWD', 'test');
if (!defined('DB_DATABASE')) define('DB_DATABASE', 'test');
if (!defined('DB_DRIVER')) define('DB_DRIVER', 'MYSQL');
if (!defined('WORKING_FOLDER')) define('WORKING_FOLDER', '');
if (!defined('DEFAULT_CONTROLLER')) define('DEFAULT_CONTROLLER', 'admin');
if (!defined('DEFAULT_APPLICATION')) define('DEFAULT_APPLICATION', 'backend');
if (!defined('DEFAULT_METHOD')) define('DEFAULT_METHOD', 'index');
if (!defined('DEBUG_ON')) define('DEBUG_ON', false);
if (!defined('ERROR_CONTROLLER')) define('ERROR_CONTROLLER', 'error');
if (!defined('APPLICATION_PATH')) define('APPLICATION_PATH', 'application');
if (!defined('BASE_PATH')) define('BASE_PATH', 'http://localhost');
if (!defined('UPLOAD_LOCATION')) define('UPLOAD_LOCATION', 'system/glue/uploads/');
if (!defined('MAX_FILE_SIZE')) define('MAX_FILE_SIZE', 2000);
if (!defined('STYLE')) define('STYLE', 'system/glue/images/');
if (!defined('DEFAULT_CSS')) define('DEFAULT_CSS', 'system/glue/css/glue.css');
if (!defined('CSS_FOLDER')) define('CSS_FOLDER', 'system/glue/css/');
if (!defined('CSS_SYSTEM_FOLDER')) define('CSS_SYSTEM_FOLDER', 'system/glue/css/general/');
if (!defined('CSS_JQUERY_FOLDER')) define('CSS_JQUERY_FOLDER', 'system/glue/vendors/jquery/css/');
if (!defined('VENDORS')) define('VENDORS', 'system/glue/vendors/');
if (!defined('JAVASCRIPT')) define('JAVASCRIPT', 'system/glue/js/default.js');
if (!defined('JAVASCRIPT_FOLDER')) define('JAVASCRIPT_FOLDER', 'system/glue/js/');

// Stub the debug function
if (!function_exists('debug')) {
    function debug($message, $location = "") {
        // no-op in tests
    }
}

// Load framework files (messages.php defines validation constants via require_once in validator.php)
require_once __DIR__ . '/../system/db/validator.php';
require_once __DIR__ . '/../system/db/form.php';
require_once __DIR__ . '/../system/httphandler.php';
require_once __DIR__ . '/../system/routing/router.php';
require_once __DIR__ . '/../system/auth.php';
require_once __DIR__ . '/../system/sessionman.php';
require_once __DIR__ . '/../system/db/dbengine.php';

// Load Model class source without triggering the DB dependency chain
// (sqlengine.php -> driver.php -> dbcon.php requires real mysqli)
// We load the raw file and the test uses a TestableModel subclass that skips DB init
if (!class_exists('SQLEngine')) {
    // Stub SQLEngine so Model can be loaded without a real DB connection
    class SQLEngine {
        function __construct() {}
        function doQuery($query = '') { return []; }
        function checkDB() { return false; }
    }
}
require_once __DIR__ . '/../system/db/model.php';
require_once __DIR__ . '/../system/routes.php';
require_once __DIR__ . '/../system/excel.inc.php';
require_once __DIR__ . '/../system/filemanager.php';
