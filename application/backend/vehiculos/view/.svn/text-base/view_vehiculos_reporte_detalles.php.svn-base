<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Vtrack - Modulo de Administraci&oacute;n</title>
        <?php lnk_css(); ?>
        <?php css_jquery() ?>
        <?php js_vendors('jquery', 'jquery.min.js') ?>
        <?php js_vendors('jquery', 'jquery.ui.core.js') ?>
        <?php js_vendors('jquery', 'jquery.ui.datepicker.js') ?>
        <?php js_vendors('jquery', 'jquery.ui.datepicker-es.js') ?>
        <?php link_javascript('calendar.js') ?>

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
                <div id="modulo">
                    <h1> Listado de reportes para el vehiculo <span class="veh"><?php echo $vehiculo['nombre'] ?></span></h1>

                    <div id="detalles">
                        <p> Seleccione la fecha en la cual desea visualizar el reporte </p>
                        <br>
                            <p class="error"> <?php echo $error ?> </p>
                            <label for="fecha">Fecha:</label>
                            <form action="<?php submit_to('backend','reporte', 'visualiza')?>" method="post">
                                <input type="hidden" name="id" value="<?php echo $vehiculo['id']?>" >
                            <input type="text" name="fecha" id="fecha" readonly="readonly">
                                <input type="submit" value="Consultar" >
                                    </form>
                    </div>
              </div>
        </div>
   </div>
</body>
</html>
