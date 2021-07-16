<!DOCTYPE html>
<html lang="es">
	<head>
		<?php (TEMPLATE)::basicHead('Contacto',__DIR__)?>
	</head>
	<body>
		
		<?php 
		(TEMPLATE)::header('Contactar');
		(TEMPLATE)::nav(6);
		?>
		<form class="formulario" method="post" action="/contact/send">
			<div>
				<label>Email</label>
    			<input type="email" name="email" required>
    			<label>Nombre</label>
    			<input type="text" name="nombre" required>
    			<label>Asunto</label>
    			<input type="text" name="asunto" required>
    			<label>Mensaje</label>
    			<textarea name="mensaje" required></textarea>
    			<input type="submit" name="<?php echo T_SEND?>" value ="Enviar">
			</div>
			
		
		</form>
	</body>
</html>
