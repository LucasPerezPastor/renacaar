<!DOCTYPE html>
<html lang="es">
	<head>
	<?php (TEMPLATE)::basicHead('Éxito',__DIR__)?>
	</head>
	<body>
		<?php 
		(TEMPLATE)::header('Éxito');
		(TEMPLATE)::nav();
		?>
		
		<div class="card-message w60">
			<h2>Éxito en la operación solicitada</h2>
			<p class='error'><?php echo $mensaje?></p>
		</div>	
		
	</body>
</html>
