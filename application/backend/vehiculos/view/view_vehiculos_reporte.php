<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Vtrack - Modulo de Administraci&oacute;n</title>
        <?php lnk_css(); ?>
        <?php link_javascript('jquery.min.js'); ?>
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
                    <h1> Listado de reportes para el vehiculo <?php echo $vehiculo['nombre'] ?></h1>
                    
                    
                    
                        <div id="tabla">
                            <table>
                                <tr class="title">
                                    <th>Fecha</th>
                                    <th>Tipo Evento</th>
                                    <th>Ip Asignada </th>
                                    <th>Velocidad</th>
                                    <th>Aceleracion</th>
                                    <th>Pasajeros</th>                                    
                                    <th>Parametro 1</th>     
                                </tr>
                                <?php foreach ($reportes as $reporte): ?>
                                    <tr class="row">
                                        <td><?php echo $reporte['fecha_hora'] ?></td>
                                        <td><?php echo $reporte['tipo'] ?></td>
                                        <td><?php echo $reporte['ip'] ?></td>
                                        <td><?php echo $reporte['velocidad'] ?></td>
                                        <td><?php echo $reporte['aceleracion'] ?></td>
                                        <td><?php echo $reporte['parametro2'] ?></td> 
                                        <td><?php echo $reporte['parametro1'] ?></td> 
                                    </tr> 
                                <?php endforeach; ?>

                            </table>    
                        </div>


                </div>
            </div>
        </div>
    </body>
</html>
