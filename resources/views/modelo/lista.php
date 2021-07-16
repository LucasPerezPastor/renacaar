<!DOCTYPE html>
<html lang="es">
	<head>
		<?php (TEMPLATE)::basicHead('Listado de modelos de coches',__DIR__)?>
	</head>
	<body>
		
		
		<?php 
		(TEMPLATE)::header('Listado de modelos de coches');
		(TEMPLATE)::nav(2);
		?>
		
		<!--  Formulario de búsqueda de modelos de coches -->
		
		<form class="formulariobusqueda" method="post" action="/modelo/search">
			<div class="w100 ">
				<?php echo TemplateBasico::linkErase(['dir'=>__DIR__,'alt'=>'Quitar filtros','title'=>'Quitar filtros'], ['controller'=>'modelo','method'=>'list'])?>
				<input type="submit" name="<?php echo T_SEARCH?>" value="Buscar">
			</div>		
			<div>
				<label>Campo:</label>
				<?php 
				TemplateBasico::selectValues('campo',$valoresCampo,$campo)?>
			</div>
			<div>
				<label>Valor:</label>
				<input type="text" name="valor" value="<?php echo (!empty($valor))?$valor:'';?>">
			</div>
			<div>
				<label>Orden:</label>
				<?php TemplateBasico::selectValues('orden',$valoresCampo,$orden)?>
			</div>
			<div>
				<?php TemplateBasico::selectRadio('sentido', $valoresRadio, $sentido)?>
			</div>
		</form>
		
		
		
		<table class="templatetable">
		<tr>
			<th>Nombre</th>
			<th>Descripcion</th>
			<th>Operaciones</th>
		</tr>
		<?php 
		  foreach ($modelos as $modelo) {
		     ?>
		     <tr>
		     	<?php 
		     	    echo "<td>$modelo->nombre</td>";
		     	    echo "<td>$modelo->descripcion</td>";
		     	    echo '<td>'.TemplateBasico::linkShowEditDelete(__DIR__,'modelo', $modelo->id).'</td>';
		     	?>
		     
		     </tr>
		<?php 
		  }
		?>
		</table>
		</body>
</html>
