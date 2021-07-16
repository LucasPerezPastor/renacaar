<!DOCTYPE html>
<html lang="es">
	<head>
		<?php (TEMPLATE)::basicHead('Actualización de los conductores',__DIR__)?>
	</head>
	<body>
		
		<?php 
		(TEMPLATE)::header('Actualización de los conductores');
		(TEMPLATE)::nav();
		?>
		
		<?php echo (empty($GLOBALS['mensaje'])?'':'<p>'.$GLOBALS['mensaje'].'</p>')?>
		<form class="formulario" method="post" action="/piloto/update">
		<div>
			<input type="hidden" name="id" value="<?php echo $piloto->id?>">
			<label>Nombre del piloto</label>
				<input type="text" name="nombre" value="<?php echo $piloto->nombre?>">
				<label>Apellidos</label>
				<input type="text" name="apellidos" value="<?php echo $piloto->apellidos?>">
				<label>DNI</label>
				<input type="text" name="dni" value="<?php echo $piloto->dni?>">
				<label>Email</label>
				<input type="email" name="email" value="<?php echo $piloto->email?>">
				<label>Teléfono</label>
				<input type="text" name="telefono" value="<?php echo $piloto->telefono?>">
				<label>Fecha de nacimiento</label>
				<input type="date" name="nacimiento" value="<?php echo $piloto->nacimiento?>">
				<input type="submit" name="<?php echo T_UPDATE?>" value="Actualizar">
		</div>
		</form>
		<div class="card-links">
		<?php echo (TEMPLATE)::linkList(__DIR__,'piloto','Listar conductores','Listar conductores')?>
		</div>
		</body>
</html>
