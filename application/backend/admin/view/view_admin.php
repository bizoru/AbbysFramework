<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Abbys Framework</title>
        <?php lnk_css(); ?>
    </head>
    <body>

        <div id="contenedor">
            <?php load_snippet('header.snippet') ?>
            <div id="left">
                <div class="titulo"><h2>Example Module</h2></div>
                <div id="estado"><p> Welcome <?php echo $usuario['nombre'] . " " . $usuario['apellido'] ?></p></div>
                <?php load_snippet('menu.snippet') ?>    

            </div>

            <div id="contenidoadmin">
                <br>
                <br>
                <p> Welcome to Abbys Framework!, You have build your first module! </p>
            </div>
        </div>
    </body>
</html>
