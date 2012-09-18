<?php
/**
 * Setting configuration for Development Servers
 * 
 *  Instructions:
 *  2. Set DB_DATABASE to the default website database
 *	3. Set DB_PASSWD to the default website password for db
 *  4. Set DB_HOST to the default website db host
 *	5. Set WORKING_FOLDER to the working folder if is root let it to be root
 *  define("DB_USER","root");
 *	define("DB_HOST","localhost");
*	define("DB_PASSWD","root");
*	define("WORKING_FOLDER","Workspace/MPV2/");
 */
	define("UPLOAD_LOCATION","system/glue/uploads/");
	define("MAX_FILE_SIZE",2000);
	define("DEFAULT_CONTROLLER","admin");
	define("DEFAULT_APPLICATION","backend");
	define("ERROR_CONTROLLER","error");
	define("STYLE","system/glue/images/");
	define("CSS","system/glue/css/");
	define("DEFAULT_CSS","system/glue/css/glue.css");
	define("JAVASCRIPT","system/glue/js/default.js");
	define("JAVASCRIPT_FOLDER","system/glue/js/");
	define("CSS_FOLDER","system/glue/css/");
        define("CSS_SYSTEM_FOLDER","system/glue/css/general/");
        define("CSS_JQUERY_FOLDER","system/glue/vendors/jquery/css/");
        define("VENDORS","system/glue/vendors/");
	define("DB_ERROR_MODULE","errorSQL");
	define("BASE_FRAMEWORK","Application");
	define("SITE_DOWN_MODULE","sitedown");
	define("DB_DATABASE","vtrack");
	define("BASE_PATH", "http://".$_SERVER["SERVER_NAME"]);
	define("APPLICATION_PATH","application"); 
	define("MODEL_PATH","application/model/");//no
	define("VIEW_PATH","application/view/");//no
	define("VIEW_ERROR_PATH","application/view/error/");//no
	define("DEFAULT_METHOD","index");
	define("DEBUG_ON",false);
	define("AUTH_CONTROLLER","login");
	define("DB_USER","root");
	define("DB_HOST","localhost");
	define("DB_PASSWD","root");
	define("WORKING_FOLDER","frameworkbase/frameworkbase/");
	define("CHECK_DB",true);
	define("AUTH",true);
        define("HOST_SMTP","");
        define("DB_DRIVER","PG");        
