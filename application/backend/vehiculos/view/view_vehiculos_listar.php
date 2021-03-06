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
                    <h1> Listado de Vehiculos </h1>
                    <br>
                        <div id="tabla">
                            <table>
                                <tr class="title">
                                    <th>Nombre del Vehiculo</th>
                                    <th>Ultimo Reporte </th>
                                    <th>Acciones</th>
                                </tr>
                                <?php foreach ($vehiculos as $vehiculo): ?>
                                    <tr class="row">
                                        <td><?php echo $vehiculo['nombre'] ?></td>
                                        <td><?php echo $vehiculo['fecha'] ?></td>
                                        <td>
                                        <?php image_link('backend/vehiculos/reporte','book.png', $vehiculo['id'], 'Ver Reporte' )?>
                                          <?php image_link('backend/vehiculos/actual','actual.png', $vehiculo['id'], 'Ver Posicion Actual' )?>
                                        </td>
                                        
                                        
                                    </tr> 
                                <?php endforeach; ?>

                            </table>    
                        </div>


                </div>
            </div>
        </div>
    </body>
</html>
