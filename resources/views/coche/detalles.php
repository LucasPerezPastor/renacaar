<!DOCTYPE html>
<html lang="es">
	<head>
		<?php (TEMPLATE)::basicHead('Detalles de un coche',__DIR__)?>
	</head>
	<body>
		
		<?php 
		(TEMPLATE)::header('Detalles del coche');
		(TEMPLATE)::nav();
		?>
		<div class="card w60">
			<div class="card-head"><?php echo $coche->nombre?></div>
			<div class="card-title">Numero de serie</div>
			<div class="card-text"><?php echo $coche->nserie?></div>
			<div class="card-title">Precio</div>
			<div class="card-text"><?php echo $coche->precio?></div>
		</div>		
		<div class="card-links">
		<?php echo (TEMPLATE)::linkShow(__DIR__,'modelo',$modelo->id,false,"Detalles del modelo de coche $modelo->nombre","Detalles del modelo de coche $modelo->nombre")?>
		</div>
	</body>
</html>

