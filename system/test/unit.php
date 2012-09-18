<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__).'/../config/settings.dev.php';
require_once dirname(__FILE__) . '/../db/model.php';
require_once dirname(__FILE__) . '/../db/dbcon.php';
require_once dirname(__FILE__) . '/../routing/router.php';
require_once dirname(__FILE__) . '/../httphandler.php';
require_once dirname(__FILE__) . '/../sessionman.php';
require_once dirname(__FILE__) . '/../resources.php';
require_once dirname(__FILE__) . '/../filemanager.php';
require_once dirname(__FILE__) . '/../mailer.php';
require_once 'assistant.php';

class unit {
    
    function unit(){
        
        print md5("admin");
        
        
        
        
    }
    
    
}

?>
