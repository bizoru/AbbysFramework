<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Vtrack - Modulo de Administraci&oacute;n</title>
        <?php lnk_css(); ?>
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
                        <p> Lo sentimos no se han encontrado resultados para la fecha seleccionada </p>
                        <br>
                        <?php lnk_param('backend', 'vehiculos', 'reporte','Regresar', $vehiculo['id']) ?>
                    </div>
              </div>
        </div>
   </div>
</body>
</html>
