<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<?php  link_css(); ?>
<title>Edicion de Usuarios</title>
</head>
<body>
<h1>Edicion de Usuario</h1>
<div id="act"></div>
<div id="modulos""></div>
<div id="estado"></div>
<div id="submenus"></div>
<div id="estado"></div>
<div id="contenido">

<form action="" method="post" name="usuario" id="crear">
<input type="hidden" name="id" value="<?php echo $usuario['id'] ?>">
<table>
	<tr>
		<td align="right"></td>
		<td align="left"><?php echo $error['nombre']; ?></td>
	</tr>

	<tr valign="baseline">

		<td nowrap="nowrap" align="right">Nombre</td>
		<td><input type="text" name="nombre"
			value="<?php echo $usuario['nombre']?>" size="32" /></td>
	</tr>
	<tr>
		<td align="right"></td>
		<td align="left"><?php echo $error['apellido']; ?></td>
	</tr>
	<tr valign="baseline">
		<td nowrap="nowrap" align="right">Apellido</td>
		<td><input type="text" name="apellido"
			value="<?php echo $usuario['apellido']?>" size="32" /></td>
	</tr>
	<tr>
		<td align="right"></td>
		<td align="left"><?php echo $error['usuario']; ?></td>
	</tr>
	<tr valign="baseline">
		<td nowrap="nowrap" align="right">Usuario</td>
		<td><input type="text" name="usuario"
			value="<?php echo $usuario['usuario']?>" size="32" /></td>
	</tr>
	<tr>
		<td align="right"></td>
		<td align="left"><?php echo $error['contrasena']; ?></td>
	</tr>
	<tr valign="baseline">
		<td nowrap="nowrap" align="right">Contrasena</td>
		<td><input type="password" name="contrasena" value="" size="32" /></td>
	</tr>

	<tr valign="baseline">
		<td nowrap="nowrap" align="right">Repita la Contrasena</td>
		<td><input type="password" name="contrasenar" value="" size="32" /></td>
	</tr>
	<tr>
		<td align="right"></td>
		<td align="left"><?php echo $error['correo']; ?></td>
	</tr>
	<tr valign="baseline">
		<td nowrap="nowrap" align="right">Correo</td>
		<td><input type="text" name="correo"
			value="<?php echo $usuario['correo']?>" size="32" /></td>
	</tr>
	<tr valign="baseline">
		<td nowrap="nowrap" align="right">Grupo</td>
		<td><select name="grupo" size=1>
		  <option value="<?php echo $selected['id'];?>" selected="selected"><?php echo $selected['nombre']?></option>
		<?php foreach ($grupos as $item):?>
			<option value="<?php echo $item['id']; ?>"><?php echo $item['nombre']; ?></option>
			<?php endforeach;?>
		</select></td>
	</tr>
	<tr valign="baseline">
		<td nowrap="nowrap" align="right">&nbsp;</td>
		<td><input type="submit" value="Guardar" /></td>
	</tr>
</table>

</form>
			<?php link_to('backend/usuario/listar', 'Regresar')?></div>
<div id="footer"></div>
</body>
</html>
