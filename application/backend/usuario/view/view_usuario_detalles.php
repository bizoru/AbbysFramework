<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Listado de Usuarios</title>
<?php  link_css(); ?>
</head>
<body>
<h1>Detalles de Usuario</h1>
<div id="act"></div>
<div id="modulos""></div>
<div id="estado"></div>
<div id="submenus"></div>
<div id="estado"></div>
<div id="contenido">
<p>Los detalles del usuario guardado son</p>

<p>Nombre: <?php echo $usuario['nombre'] ;?></p>
<p>Apellido: <?php echo $usuario['apellido'] ;?></p>
<p>Correo electronico: <?php echo $usuario['correo'] ;?></p>
<p>Usuario: <?php echo $usuario['usuario']; ?></p>




<?php link_to('backend/usuario/listar', 'Regresar')?></div>
<div id="footer"></div>
</body>
</html>
