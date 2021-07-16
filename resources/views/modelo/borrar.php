<!DOCTYPE html>
<html lang="es">
	<head>
		<?php (TEMPLATE)::basicHead('Borrado de un modelo de coche',__DIR__)?>
	</head>
	<body>
		
		
		<?php 
		(TEMPLATE)::header('Borrado del modelo de coche');
		(TEMPLATE)::nav()
		?>	
		
		<h2>Confirma el borrado del modelo de coche</h2>
		
		<form class="formulario" method="post" action="/modelo/destroy">
			<div>
				<p>Confirmar el borrado del modelo del coche <?php echo $modelo->nombre?></p>				
				<input type="hidden" name="id" value="<?php echo $id?>">				
				<input type="submit" name="<?php echo T_DELETE?>" value="Borrar">
			</div>
		</form>
		<div class="card-links">
		<?php echo (TEMPLATE)::linkList(__DIR__,'modelo','Listar modelos de coches','Listar modelos de coches')?>
		</div>
	</body>
</html>
