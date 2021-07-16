<!DOCTYPE html>
<html lang="es">
	<head>
		<?php (TEMPLATE)::basicHead('Nuevo usuario',__DIR__)?>
	</head>
	<body>
		<?php 
		(TEMPLATE)::header('Nuevo Usuario');
		(TEMPLATE)::nav(7);
		?>
		
		<form class="formulario" method="post" action="/usuario/store">
		<div class="w60 m-auto">
			<label>Usuario:</label>
				<input type="text" name="usuario">
				<label>Nombre del usuario</label>
				<input type="text" name="nombre">
				<label>Primer apellido</label>
				<input type="text" name="apellido1">
				<label>Segundo apellido</label>
				<input type="text" name="apellido2">
				<label>Contraseña</label>
				<input type="password" name="clave">
				<label>Email:</label>
				<input type="email" name="email">
				<label>Nivel de privilegio:</label>
				<input type="number"  min=0 name="privilegio">
				<?php if ($admin) {?>
				<label>
				<input type="checkbox" name="administrador"> Es administrador
				</label>
				<?php }?>
				<input type="submit" name="<?php echo T_SAVE?>" value="Guardar">
		</div>
				
		</form>
		</body>
</html>
