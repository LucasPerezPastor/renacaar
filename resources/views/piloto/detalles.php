<!DOCTYPE html>
<html lang="es">
	<head>
		<?php (TEMPLATE)::basicHead('Detalles de un conductor',__DIR__)?>
		<meta charset="UTF-8">
		<title>Detalles del conductor</title>
		<link rel="stylesheet" href="<?php echo Find::style(__DIR__,'style')?>">
	</head>
	<body>
		
		<?php 
		(TEMPLATE)::header('Detalles del conductor');
		(TEMPLATE)::nav();
		?>
		<div class="card w60">
			<div class="card-head"><?php echo $piloto->nombre?></div>
			<div class="card-title">Nombre</div>
			<div class="card-text"><?php echo $piloto->nombre.' '.$piloto->apellidos?></div>
			<div class="card-title">DNI</div>
			<div class="card-text"><?php echo $piloto->dni?></div>
			<div class="card-title">Email</div>
			<div class="card-text"><?php echo $piloto->email?></div>
			<div class="card-title">Telefono</div>
			<div class="card-text"><?php echo $piloto->telefono?></div>
			<div class="card-title">Fecha de nacimiento</div>
			<div class="card-text"><?php echo $piloto->nacimiento?></div>
		</div>		
		<?php 
		if ($alquilados)   // si hay alquileres disponibles
		{ 
		    ?>
		    <h2>Tiene los siguientes coches alquilados:</h2>
		   <table class="templatetable">
        		<tr>
        			<th>Coche</th>
        			<th>Numero Serie</th>
        			<th>Operaciones</th>
        		</tr>
		    <?php 
		      foreach ($cochesAlquilados as $alquilado) 
		      {
		          //echo "<li>$capitan [".TemplateBasico::linkShowEditDelete('capitan', $capitan->id)."]</li>";
		          //echo "<li>$alquilado <a href='/alquilado/delete/{$alquilado->id}'>Borrar</a>";
		         ?>
		         <tr>
		          <td><?php echo $alquilado['nombre']?></td>
		          <td><?php echo $alquilado['nserie']?></td>
		          <td>
		          	<?php echo TemplateBasico::linkShowEdit(__DIR__,'coche', $alquilado['idcoche'])?>
		          	<?php echo TemplateBasico::linkDelete(__DIR__,'alquilado', $alquilado['idalquiler'])?>
	          	  </td>
		         </td>
		          <?php 
		      }       
		    ?>
		    </table>
		    <?php 
		}else     //si no hay alquileres
		{
		    ?>
		    <h2>No tiene ningún coche en alquiler</h2>
		    <?php 
		}
		?>
		
		<div class="card-links">
		<?php echo TemplateBasico::linkEditDeleteListAddSub(__DIR__,'piloto', $piloto->id,'piloto','alquilado','alquiler')?>
		</div>
		</body>
</html>

