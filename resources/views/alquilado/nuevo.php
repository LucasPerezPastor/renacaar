<!DOCTYPE html>
<html lang="es">
	<head>
		<?php (TEMPLATE)::basicHead('Nuevo alquiler',__DIR__)?>
	</head>
	<body>
		<?php 
		(TEMPLATE)::header('Nueva alquiler');
		(TEMPLATE)::nav()
		?>	
		
		<form class="formulario" method="post" action="/alquilado/store">
			<div>
				<input type="hidden" name="idpiloto" value="<?php echo $piloto->id?>">
				<label>Selecciona una de los coches disponibles:</label>	
				<?php (TEMPLATE)::selectValues('nombre',$cochesDisponibles)?>	
				<input type="submit" name="<?php echo T_SAVE?>" value="Guardar">
			</div>
		</form>
		<div class="card-links">
		<?php echo (TEMPLATE)::linkShow(__DIR__,'piloto',$piloto->id,false,"Detalles del conductor $piloto->nombre","Detalles del conductor $piloto->nombre")?>
		</div>
		</body>
</html>
