<!DOCTYPE html>
<html lang="es">
	<head>
		<?php (TEMPLATE)::basicHead('Nuevo coche',__DIR__)?>
	</head>
	<body>
		<?php 
		(TEMPLATE)::header('Nueva coche');
		(TEMPLATE)::nav();
		?>
		
		<form class="formulario" method="post" action="/coche/store">
		<div>
			<input type="hidden" name="idmodelo" value="<?php echo $modelo->id?>">
			<label>Nombre del coche</label>
			<input type="text" name="nombre">
			<label>Número de serie</label>
			<input type="text" name="nserie">
			<label>Precio del coche</label>
			<input type="number" min=0 name="precio">
			<input type="submit" name="<?php echo T_SAVE?>" value="Guardar">
		</div>
			
		</form>
		<div class="card-links">
		<?php echo (TEMPLATE)::linkShow(__DIR__,'modelo',$modelo->id,false,"Detalles del modelo de coche $modelo->nombre","Detalles del modelo de coche $modelo->nombre")?>
		</div>
		</body>
</html>
