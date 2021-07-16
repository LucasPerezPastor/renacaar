<!DOCTYPE html>
<html lang="es">
	<head>
		<?php (TEMPLATE)::basicHead('Error',__DIR__)?>
	</head>
	<body>
		<?php 
		(TEMPLATE)::header('Error');
		(TEMPLATE)::nav();
		?>
		
		<div class="card-message w60">
			<h2>Error en la operación solicitada</h2>
			<p class='error'><?php echo $mensaje?></p>
		</div>	
		
		
		
	</body>
</html>
