<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Vtrack - Modulo de Administraci&oacute;n</title>
        <?php lnk_css(); ?>
        <?php load_open_layers(); ?>
        <?php js_vendors('jquery','jquery.min.js'); ?>
        <?php link_javascript('vmapa.js'); ?>
    </head>
    <body>

        <div id="contenedor">
            <?php load_snippet('header.snippet') ?>
            <div id="left">
                <div class="titulo"><h2>Modulo de Administraci&oacute;n</h2></div>
                <div id="estado"><p> Bienvenido <?php echo $usuario['nombre'] . " " . $usuario['apellido'] ?></p></div>
                <?php load_snippet('menu.snippet') ?>    
            </div>
            <div id="contenidoadmin">
                <input type="hidden" id="vehiculo_id" value="<?php echo $vehiculo['id'] ?>">
                <input type="hidden" id="lat" value="<?php echo $reporte['lat']?>">
                <input type="hidden" id="lon" value="<?php echo $reporte['lon']?>">
                <input type="hidden" id="marker" value="<?php echo image_url('bus.png')?>">
                <div id="modulo">
                    <h1>Mapa de Posiciones para el vehiculo <span class="veh"><?php echo $vehiculo['nombre']?></span> </h1>
                    <div id="mapa">
                        
                        
                    </div>
                    
                    <div id="select_fecha">
                        
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
