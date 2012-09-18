<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Title</title>
<?php link_css();?>
</head>
<body>
<h1>Title</h1>

<div id="contenido">


<table border="1">

	<tr>
		<th>Column Name</th>
		<th>Acciones</th>
		
	</tr>

	<?php foreach ($items as $item):?>
	<tr>
		<td><?php echo $item['nombre']; ?></td>
		
		<td><?php link_to_parameter('cliente/editar','Editar',$item['id'])?>
		<?php link_to_parameter('cliente/eliminar','Eliminar',$item['id'])?>
		</td>
	</tr>
	<?php endforeach;?>

</table>

<br>
<?php lnk('@home', 'Regresar')?>
</div>
<div id="footer"></div>
</html>