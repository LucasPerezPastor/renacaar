<!DOCTYPE html>
<html lang="es">
	<head>
		<?php (TEMPLATE)::basicHead('Borrado del coche',__DIR__)?>
	</head>
	<body>
		<?php 
		(TEMPLATE)::header('Borrado del coche');
		(TEMPLATE)::nav();
		?>
		<h2>Confirma el borrado del coche</h2>
		
		<form class="formulario" method="post" action="/coche/destroy">
			<div>
			<p>Estás a punto de borrar el coche <?php echo $coche->id?> del modelo de coche <?php echo $modelo->nombre?></p>
			<p>Se trata del coche <?php echo $coche->nombre?>  con un precio de <?php echo $coche->precio?></p>
			<p>Confirmar el borrado del coche:</p>				
			<input type="hidden" name="id" value="<?php echo $coche->id?>">
			<input type="hidden" name="idmodelo" value="<?php echo $coche->idmodelo?>">					
			<input type="submit" name="<?php echo T_DELETE?>" value="Borrar">
			</div>
				
		</form>
		<div class="card-links">
		<?php echo (TEMPLATE)::linkShow(__DIR__,'modelo',$modelo->id,false,"Detalles del modelo de coche $modelo->nombre","Detalles del modelo de coche $modelo->nombre")?>
		</div>
		</body>
</html>
