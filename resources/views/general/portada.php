<!DOCTYPE html>
<html lang="es">
	<head>
	<?php (TEMPLATE)::basicHead('Portada',__DIR__)?>
	</head>
	<body>
		
		<?php 
		(TEMPLATE)::header('Portada RENACAAR');
		(TEMPLATE)::nav(1);
		?>
		<div class="card-portada">
			<p>Aplicación de ejemplo que aplica un MVC(Modelo Vista Controlador).</p>
    		<p>Creada en PHP (basado en un Framework educacional de <a class="no-link" href="http://www.robertsallent.com/" target="_blank">Robert Sallent</a>) , CSS, sin JavaScript.</p>
    		<p>Dispone de control de usuarios.<p>
    		<p>Los usuarios logados* pueden acceder a los menús de:</p>
    		<ul>
    			<li>Creación de modelos de coches.</li>
    			<li>Modificación de los modelos de coches.</li>
    			<li>Eliminación de los modelos de coches.</li>
    			<li>Creación de coches de un modelo.</li>
    			<li>Modificación de coches de un modelo.</li>
    			<li>Eliminación de coches de un modelo.</li>
    			<li>Creación de conductores.</li>
    			<li>Modificación de conductores.</li>
    			<li>Eliminación de conductores.</li>
    			<li>Creación de alquileres de coches de un conductor.</li>
    			<li>Modificación de alquileres de coches de un conductor.</li>
    			<li>Eliminación de alquileres de coches de un conductor.</li>
    			<li>Creación de usuarios.</li>
    			<li>Modificación de condutores.</li>
    			<li>Eliminación de condutores.</li>
    		</ul>
    		<p>*Nota:Los usuarios logados pueden acceder a todos los menús comentados pero dará un error de permisos a la hora de guardar.</p>
    		
    		<p>Puede usar el usuario <span class="strong"><?php echo SHOW_USER?> </span> con password <span class="strong"><?php echo SHOW_PASSWORD_USER?></span> para probar la aplicación.</p>
    	
		</div>
	</body>
</html>

