<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Listado de Usuarios</title>
<?php  link_css(); ?>
</head>
<body>
<h1>Listado de Usuarios</h1>
<div id="act"></div>
<div id="modulos""></div>
<div id="estado"></div>
<div id="submenus"></div>
<div id="estado"></div>
<div id="contenido">


<table border="1">

	<tr>
		<th>Usuario</th>
		<th>Nombre</th>
		<th>Apellido</th>
		<th>Correo</th>
		<th>Grupo</th>
		<th>Creado</th>
		<th>Acciones</th>
	</tr>

	<?php foreach ($usuarios as $usuario):?>
	<tr>
		<td><?php echo $usuario['usuario']; ?></td>
		<td><?php echo $usuario['nombre']; ?></td>
		<td><?php echo $usuario['apellido']; ?></td>
		<td><?php echo $usuario['correo']; ?></td>
		<td><?php echo $usuario['grupo']; ?></td>
		<td><?php echo $usuario['fecha_creacion']; ?></td>
		<td><?php link_to_parameter('backend/usuario/editar','Editar',$usuario['id'])?>
		<?php link_to_parameter('backend/usuario/eliminar','Eliminar',$usuario['id'])?>
		
		</td>
	</tr>
	<?php endforeach;?>

</table>

<br>
<?php link_to('backend', 'Regresar')?>
</div>
<div id="footer"></div>
</body>
</html>
