<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <?php link_css(); ?>
        <?php link_javascript('jquery.min.js'); ?>
        <?php link_javascript('ddaccordion.js'); ?>
        <?php link_javascript('accordion.js'); ?>
        <?php link_javascript('crearcliente.js') ?>
        <title>Creaci&oacute;n de Usuarios</title>
    </head>
    <body>
        <h1>Creaci&oacute;n de Usuarios</h1>
        <div id="contenedor">
            <?php load_snippet('header.snippet') ?>
            <div class="titulo"><h2>Creaci&oacute;n de Clientes</h2></div>
            <?php load_snippet('menu.snippet') ?>    
        <div id="contenidoadmin">
            <fieldset id="form">
            <form action="guardar" method="post" name="usuario" id="crear">
                <input type="hidden" name="id" value="<?php echo $usuario['id'] ?>">
                <table>
                    <tr>
                        <td align="right"></td>
                        <td align="left"><?php echo $error['nombre']; ?></td>
                    </tr>

                    <tr valign="baseline">

                        <td nowrap="nowrap" align="right">Nombre</td>
                        <td><input type="text" name="nombre"
                                   value="<?php echo $usuario['nombre'] ?>" size="32" /></td>
                    </tr>
                    <tr>
                        <td align="right"></td>
                        <td align="left"><?php echo $error['apellido']; ?></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap="nowrap" align="right">Apellido</td>
                        <td><input type="text" name="apellido"
                                   value="<?php echo $usuario['apellido'] ?>" size="32" /></td>
                    </tr>
                    <tr>
                        <td align="right"></td>
                        <td align="left"><?php echo $error['usuario']; ?></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap="nowrap" align="right">Usuario</td>
                        <td><input type="text" name="usuario"
                                   value="<?php echo $usuario['usuario'] ?>" size="32" /></td>
                    </tr>
                    <tr>
                        <td align="right"></td>
                        <td align="left"><?php echo $error['contrasena']; ?></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap="nowrap" align="right">Contrase&ntilde;a</td>
                        <td><input type="password" name="contrasena" value="" size="32" /></td>
                    </tr>

                    <tr valign="baseline">
                        <td nowrap="nowrap" align="right">Repita la Contrase&ntilde;a</td>
                        <td><input type="password" name="contrasenar" value="" size="32" /></td>
                    </tr>
                    <tr>
                        <td align="right"></td>
                        <td align="left"><?php echo $error['correo']; ?></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap="nowrap" align="right">Correo</td>
                        <td><input type="text" name="correo"
                                   value="<?php echo $usuario['correo'] ?>" size="32" /></td>
                    </tr>
                    <tr>
                        <td align="right"></td>
                        <td align="left"><?php echo $error['grupo']; ?></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap="nowrap" align="right">Grupo</td>
                        <td><select name="grupo_id" size=1>
                                <option value="" selected="selected">Seleccione</option>
                                <?php foreach ($grupos as $item): ?>
                                    <option value="<?php echo $item['id']; ?>"><?php echo $item['nombre']; ?></option>
                                <?php endforeach; ?>
                            </select></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap="nowrap" align="right">&nbsp;</td>
                        <td><input type="submit" value="Guardar" /></td>
                    </tr>
                </table>

            </form
            </fieldset>
            <?php back_to('backend', 'Regresar') ?>
        </div>
            </div>
        <div id="footer"></div>
    </body>
</html>
