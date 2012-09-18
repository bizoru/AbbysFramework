<?php
/*
 * Default routes on system
 * 
 */

class Routes{
    

    static $home = array("id"=>"@home","route"=>array("application"=>'backend',"module"=>'admin',"method"=>'index'));
    static $vhome = array("id"=>"@vhome","route"=>array("application"=>'backend',"module"=>'vendedores',"method"=>'index'));
    static $uniconf = array("id"=>"@uniconf","route"=>array("application"=>'backend',"module"=>'unidades',"method"=>'configuracion'));
    static $tipos = array("id"=>"@tipos","route"=>array("application"=>'backend',"module"=>'tipo',"method"=>'listar'));
    static $reporte = array("id"=>"@reporte","route"=>array("application"=>'backend',"module"=>'reporte',"method"=>'ver'));
    static $vehlistar = array("id"=>"@vehlistar","route"=>array("application"=>'backend',"module"=>'vehiculos',"method"=>'listar'));
        
}
    
?>
