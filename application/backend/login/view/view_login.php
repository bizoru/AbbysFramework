<!DOCTYPE html> <!-- HTML5 Doctype-->
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Abbys Framework</title>
        <?php lnk_css(); ?>
        <title>Ingreso al Modulo de Administraci&oacute;n</title>
    </head>
    <body>
        <div id="contenedor-login">
            <div id="cabecera"><p>Abbys Framework</p></div>
            <div id="contenido-login">
                <form  method="post" name="loginform">
                    <fieldset id="login">
                        <ol>
                            <li><?php echo $error ?></li>
                            <li></li>
                            <li><label>User: </label><input class="cajas" type="text" name="usuario"  /></li>
                            <li><label>Password: </label><input class="cajas" type="password" name="password"  /></li>
                        </ol>
                        <p align="center"><input type="submit" name="aceptar" class="btn-aceptar" value="Login" /></p>
                    </fieldset>
                </form>
            </div>
        </div>
    </body>
</html>
