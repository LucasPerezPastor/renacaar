<!DOCTYPE html>
<html lang="es">
	<head>
		<?php (TEMPLATE)::basicHead('Nuevo modelo de coche',__DIR__)?>
	</head>
	<body>

		<?php 
		(TEMPLATE)::header('Nuevo modelo');
		(TEMPLATE)::nav(3);
		?>
		
		<form class="formulario" method="post" action="/modelo/store">
		<div>
				<label>Nombre del modelo de coche</label>
				<input type="text" name="nombre">
				<label>Peso del coche</label>
				<input type="number" min=0 name="peso">
				<label>Velocidad del coche</label>
				<input type="number" min=0 name="velocidad">
				<label>Descripción del coche</label>
				<input type="text" name="descripcion">
				
				<input type="submit" name="<?php echo T_SAVE?>" value="Guardar">
		</div>
				
		</form>
		
		
		</body>
</html>
