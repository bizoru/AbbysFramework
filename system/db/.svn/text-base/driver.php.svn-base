<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of driver
 *
 * @author Steven
 */

require_once 'dbcon.php';
require_once 'pgdbcon.php';

class Driver implements DBEngine{
    
    private $dbengine;
    
    function Driver(){
        
        if(DB_DRIVER == "PG"){
            
            $this->dbengine = new PgDBConnection();
            
        }
        if(DB_DRIVER == "MYSQL"){
            
            $this->dbengine = new MySQLDBConnection();
            
        }
    }
    
    public function doQuery($query = "") {
        
        return $this->dbengine->doQuery($query);
    }
    
    public function checkDB() {
        return $this->dbengine->checkDB();
        
    }
    
    
    
}

?>
