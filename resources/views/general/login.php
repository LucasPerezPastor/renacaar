<!DOCTYPE html>
<html lang="es">
	<head>
		<?php (TEMPLATE)::basicHead('Login',__DIR__)?>
	</head>
	<body>
		
		<?php 
		(TEMPLATE)::header('Portada del angar de naves');
		(TEMPLATE)::nav(10);
		?>
		<h2>Formulario de Login</h2>
		<p> Acceso a la aplicación</p>
		
		<form class="formulario" method="post" action="/login/login">
		<div class="w60 m-auto">
			<label>Usuario o email:</label>
			<input type="text" name="usuario" required>
			<label>Clave:</label>
			<input type="password" name="clave" required>
			<input type="submit" name="<?php echo T_IDENTIFY;?>" value="Identificar">
		</div>
			
		</form>

		<!--  <a href="/forgotpassword">Olvidé mi contraseña</a> -->
		</body>
</html>


