<!DOCTYPE html>
<html lang="es">
	<head>
		<?php (TEMPLATE)::basicHead('Baja del alquiler de un coche',__DIR__)?>
	</head>
	<body>
		
		<?php 
		(TEMPLATE)::header('Baja del alquiler de un coche');
		(TEMPLATE)::nav()
		?>	
		<h2>Confirma la baja del alquiler</h2>
		
		
		
		<form class="formulario" method="post" action="/alquilado/destroy">
			<div>
				<p>Estás a punto de dar de baja un alquiler  <?php echo $alquilado?> </p>
				<p>Confirmar la baja del alquiler:</p>				
				<input type="hidden" name="id" value="<?php echo $alquilado->id?>">
				<input type="hidden" name="idpiloto" value="<?php echo $alquilado->idpiloto?>">					
				<input type="submit" name="<?php echo T_DELETE?>" value="Borrar">
			</div>
		</form>
		<div class="card-links">
			<?php echo (TEMPLATE)::linkShow(__DIR__,'piloto',$piloto->id,false,"Detalles del conductor $piloto->nombre","Detalles del conductor $piloto->nombre")?>
		</div>
		</body>
</html>
