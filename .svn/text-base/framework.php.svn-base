<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

 $boot = ".htaccess";
 $devfile = ".htaccess.dev";
 $prodfile = ".htaccess.prod";
 $boot_file = false;

 
 if(file_exists($boot)):
     unlink($boot);
 endif;
 
 if($argv[1] == "dev"){
  
     echo "Cambiando el estado a desarrollo";
     $result = copy($devfile, $boot);
     echo "\nOK";
 }
 
 if($argv[1] == "prod"){
     
     echo "Cambiando el estado a productivo";
     $result = copy($prodfile, $boot);
     echo "\nOK";
 }
 
 if($argv[1] == "status"){
     
     
     echo "Status of Deploy";
     
     
     
 }
 
 if(!$argv[1]){
     
      
 $use = "
     Utilizacion de framework
     php -f framework.php dev
     
     dev - Regla de Rewrite Mode para Desarrollo
     prod - Regla de Rewrite Mode para Produccion
     
   ";
 
 echo $use;
     
     
     
 }
 

 

?>

