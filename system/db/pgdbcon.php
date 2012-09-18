<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pgdbcon
 *
 * @author Steven
 */

require_once 'dbengine.php';

class PgDBConnection implements DBEngine{
    
   
    private $connection_string;
    
    function PgDBConnection(){
         
         $this->connection_string = "host=localhost dbname=".DB_DATABASE." user=".DB_USER." password=".DB_PASSWD;
        
    } 
    
    function checkDB(){
        
        
        if (!pg_connect($this->connection_string)){
            
            return false;
        }
        
        return true;
        
    }
    
   function doQuery($query=""){
       
       
       $collection = array();
       $link = pg_connect($this->connection_string);
       $result = pg_query($link,$query);
       
       if(!$result):
           print "<div id='error'><p>Error with your query!<br>".pg_last_error().'</p></div>';
       endif;
       
       while($row = pg_fetch_assoc($result)):
           
           array_push($collection, $row);
           
       endwhile;
       
       pg_free_result($result);
       pg_close();
       return $collection;
       
   }
  
}

?>
