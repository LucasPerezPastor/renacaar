<!DOCTYPE html>
<html lang="es">
	<head>
		<?php (TEMPLATE)::basicHead('Recuperar clave',__DIR__)?>
	</head>
	<body>
		
		<?php 
		(TEMPLATE)::header('Portada del angar de naves');
		(TEMPLATE)::nav();
		?>
		<h2>Formulario de recuperación de clave</h2>
		<p> Acceso a la aplicación</p>
		
		<form class="formulario" method="post" action="/forgotpassword/send">
			<div>
				<label>Usuario.</label>
				<input type="text" name="usuario" required>
				<label>Email:</label>
				<input type="text" name="email" required>
				<input type="submit" name="<?php echo T_GENERATED;?>" value="Generar clave nueva">
			</div>			
		</form>
		<br>
		<a href="/forgotpassword">Olvidé mi contraseña</a>
		</body>
</html>
