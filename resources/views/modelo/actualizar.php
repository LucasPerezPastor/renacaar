<!DOCTYPE html>
<html lang="es">
	<head>
		<?php (TEMPLATE)::basicHead('Actualización del modelo de coches',__DIR__)?>
	</head>
	<body>
		
		
		<?php 
		(TEMPLATE)::header('Actualización del modelo de coches');
		(TEMPLATE)::nav()
		?>	
		
		<?php echo (empty($GLOBALS['mensaje'])?'':'<p>'.$GLOBALS['mensaje'].'</p>')?>
		<form class="formulario" method="post" action="/modelo/update">
		<div>
			<input type="hidden" name="id" value="<?php echo $modelo->id?>">
			<label>Nombre del modelo de coche</label>
			<input type="text" name="nombre" value="<?php echo $modelo->nombre?>">	
			<label>Peso del coche</label>
			<input type="number" min=0 name="peso" value="<?php echo $modelo->peso?>">
			<label>Velocidad del coche</label>
			<input type="number" min=0 name="velocidad" value="<?php echo $modelo->velocidad?>">
			<label>Descripción del coche</label>
			<input type="text" name="descripcion" value="<?php echo $modelo->descripcion?>">
			<input type="submit" name="<?php echo T_UPDATE?>" value="Actualizar">
		</div>
		</form>
		<div class="card-links">
		<?php echo (TEMPLATE)::linkList(__DIR__,'modelo','Listar modelos de coches','Listar modelos de coches')?>
		</div>
		</body>
</html>
