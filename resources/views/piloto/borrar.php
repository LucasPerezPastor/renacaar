<!DOCTYPE html>
<html lang="es">
	<head>
		<?php (TEMPLATE)::basicHead('Dar de baja un conductor',__DIR__)?>
	</head>
	<body>
		
		<?php 
		(TEMPLATE)::header('Dar de baja a un conductor');
		(TEMPLATE)::nav();
		?>
		<h2>Confirmación baja conductor</h2>
		
		<form class="formulario" method="post" action="/piloto/destroy">
				<p>Confirmar que quiere dar de baja al conductor <?php echo $piloto->nombre?></p>				
				<input type="hidden" name="id" value="<?php echo $id?>">				
				<input type="submit" name="<?php echo T_DELETE?>" value="Borrar">
		</form>
		<div class="card-links">
		<?php echo (TEMPLATE)::linkList(__DIR__,'piloto','Listar conductores','Listar conductores')?>
		</div>
	</body>
</html>
