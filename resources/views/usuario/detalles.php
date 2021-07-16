<!DOCTYPE html>
<html lang="es">
	<head>
		<?php (TEMPLATE)::basicHead('Detalles de un usuario',__DIR__)?>
	</head>
	<body>
		
		<?php 
		(TEMPLATE)::header('Detalles del usuario');
		(TEMPLATE)::nav()
		?>	
		<div class="card w60">
			<div class="card-head"><?php echo $usuario->usuario?></div>
			<div class="card-title">Nombre</div>
			<div class="card-text"><?php echo $usuario->nombre?></div>
			<div class="card-title">Apellidos</div>
			<div class="card-text"><?php echo $usuario->apellido1.','.$usuario->apellido2?></div>
			<div class="card-title">Email</div>
			<div class="card-text"><?php echo $usuario->email?></div>
		</div>
		<div class="card-links">
				<?php echo TemplateBasico::linkEditDeleteList(__DIR__,'usuario', $usuario->id)?>
		</div>
		
		</body>
</html>

