<!DOCTYPE html>
<html lang="es">
	<head>
		<?php (TEMPLATE)::basicHead('Nuevo conductor',__DIR__)?>
	</head>
	<body>
		<?php 
		(TEMPLATE)::header('Nuevo conductor');
		(TEMPLATE)::nav(5);
		?>
		
		<form class="formulario" method="post" action="/piloto/store">
		<div>
			<label>Nombre del piloto</label>
				<input type="text" name="nombre">
				<label>Apellidos</label>
				<input type="text" name="apellidos">
				<label>DNI</label>
				<input type="text" name="dni">
				<label>Email</label>
				<input type="email" name="email">
				<label>Teléfono</label>
				<input type="text" name="telefono">
				<label>Fecha de Nacimiento</label>
				<input type="date" name="nacimiento">
				
				<input type="submit" name="<?php echo T_SAVE?>" value="Guardar">
		</div>
				
		</form>
		</body>
</html>
