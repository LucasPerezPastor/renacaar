<!DOCTYPE html>
<html lang="es">
	<head>
		<?php (TEMPLATE)::basicHead('Actualización de coches',__DIR__)?>
	</head>
	<body>
		<?php 
		(TEMPLATE)::header('Actualización de los coches');
		(TEMPLATE)::nav();
		?>
		

		<form class="formulario" method="post" action="/coche/update">
			<div>
				<input type="hidden" name="id" value="<?php echo $coche->id?>">
    			<input type="hidden" name="idmodelo" value="<?php echo $coche->idmodelo?>">
    			<label>Nombre del coche</label>
    			<input type="text" name="nombre" value="<?php echo $coche->nombre?>">
    			<label>Número de serie</label>
    			<input type="text" name="nserie" value="<?php echo $coche->nserie?>">
    			<label>Precio del coche</label>
    			<input type="number" min=0 step="0.01" name="precio" value="<?php echo $coche->precio?>">
    			<input type="submit" name="<?php echo T_UPDATE?>" value="Actualizar">
			</div>
		</form>
		<div class="card-links">
		<?php echo (TEMPLATE)::linkShow(__DIR__,'modelo',$modelo->id,false,"Detalles del modelo de coche $modelo->nombre","Detalles del modelo de coche $modelo->nombre")?>
		</div>
		</body>
</html>
