<!DOCTYPE html>
<html lang="es">
	<head>
		<?php (TEMPLATE)::basicHead('Actualización de los usuarios',__DIR__)?>
	</head>
	<body>
		
		
		<?php 
		(TEMPLATE)::header('Actualización del usuarios');
		(TEMPLATE)::nav()
		?>	
		
		<?php echo (empty($GLOBALS['mensaje'])?'':'<p>'.$GLOBALS['mensaje'].'</p>')?>
		<form class="formulario" method="post" action="/usuario/update">
		<div class="w90 m-auto">
			<input type="hidden" name="id" value="<?php echo $usuario->id?>">
			
			<label>Usuario:</label>
				<input type="text" name="usuario" value="<?php echo $usuario->usuario?>">
				<label>Nombre del piloto</label>
				<input type="text" name="nombre" value="<?php echo $usuario->nombre?>">
				<label>Primer apellido</label>
				<input type="text" name="apellido1" value="<?php echo $usuario->apellido1?>">
				<label>Segundo apellido</label>
				<input type="text" name="apellido2" value="<?php echo $usuario->apellido2?>">
				<label>Contraseña</label>
				<input type="password" name="clave">
				<label>Email:</label>
				<input type="email" name="email" value="<?php echo $usuario->email?>">
				<label>Nivel de privilegio:</label>
				<input type="number"  min=0 name="privilegio" value="<?php echo $usuario->privilegio?>">
				<label>
				<input type="checkbox" name="administrador" <?php echo $usuario->administrador?'checked':''?>> Es administrador
				</label><br>
				<input type="submit" name="<?php echo T_UPDATE?>" value="Actualizar">
			
		</div>
			
			
		</form>
		<div class="card-links">
		<?php echo (TEMPLATE)::linkList(__DIR__,'usuario','Listar usuarios','Listar usuarios')?>
		</div>
		</body>
</html>
