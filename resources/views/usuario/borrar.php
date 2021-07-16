<!DOCTYPE html>
<html lang="es">
	<head>
		<?php (TEMPLATE)::basicHead('Borrado de un usuario',__DIR__)?>
	</head>
	<body>
		
		
		<?php 
		(TEMPLATE)::header('Borrado del usuario');
		(TEMPLATE)::nav()
		?>	
		
		<h2>Confirma el borrado del usuario</h2>
		
		<form method="post" action="/usuario/destroy">
				<p>Confirmar el borrado del usuario <?php echo $usuario->usuario?></p>				
				<input type="hidden" name="id" value="<?php echo $id?>">				
				<input type="submit" name="<?php echo T_DELETE?>" value="Borrar">
		</form>
		<div class="card-links">
		<?php echo (TEMPLATE)::linkList(__DIR__,'usuario','Listar usuarios','Listar usuarios')?>
		</div>
	</body>
</html>
