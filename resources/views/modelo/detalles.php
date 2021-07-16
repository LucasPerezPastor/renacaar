<!DOCTYPE html>
<html lang="es">
	<head>
		<?php (TEMPLATE)::basicHead('Detalles del modelo de coche',__DIR__)?>
	</head>
	<body>
		
		<?php 
		(TEMPLATE)::header('Detalles del modelo');
		(TEMPLATE)::nav()
		?>	
		<div class="card w60">
			<div class="card-head"><?php echo $modelo->nombre?></div>
			<div class="card-title">Peso</div>
			<div class="card-text"><?php echo $modelo->peso?></div>
			<div class="card-title">Velocidad</div>
			<div class="card-text"><?php echo $modelo->velocidad?></div>
			<div class="card-title">Descripcion</div>
			<div class="card-text"><?php echo $modelo->descripcion?></div>
		</div>		
		<?php 
		if ($coches)   // si hay coches disponibles
		{ 
		    ?>
		    <h2>Coches disponibles:</h2>
		    <table class="templatetable">
        		<tr>
        			<th>Coche</th>
        			<th>Numero Serie</th>
        			<th>Operaciones</th>
        		</tr>
		    <?php 
		      foreach ($coches as $coche) 
		      {
		          ?>
		          <tr>
		          <td><?php echo $coche->nombre?></td>
		          <td><?php echo $coche->nserie?></td>
		          <td><?php echo TemplateBasico::linkShowEditDelete(__DIR__,'coche', $coche->id)?></td>
		         
		         </td>
		         
		      <?php 
		      //echo "<li>$coche [".TemplateBasico::linkShowEditDelete(__DIR__,'coche', $coche->id)."]</li>";
		      
		      }       
		    ?>
		    </table>
		    <?php 
		}else     //si no hay coches
		{
		    ?>
		    <p>No hay coches disponibles de este modelo</p>
		    <?php 
		}
		?>
		<div class="card-links">
		<?php echo TemplateBasico::linkEditDeleteListAddSub(__DIR__,'modelo', $modelo->id,'modelo de coche','coche','coche')?>
		</div>
		</body>
</html>

