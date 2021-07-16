<!DOCTYPE html>
<html lang="es">
	<head>
		<?php (TEMPLATE)::basicHead('Listado de conductores',__DIR__)?>
	</head>
	<body>
		<?php 
		(TEMPLATE)::header('Listado de conductores');
		(TEMPLATE)::nav(4);
		?>
		
		<!--  Formulario de búsqueda de conductores -->
		<form class="formulariobusqueda" method="post" action="/piloto/search">
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
			<th>Apellidos</th>
			<th>DNI</th>
			<th>Operaciones</th>
		</tr>
		<?php 
		  foreach ($pilotos as $piloto) {
		     ?>
		     <tr>
		     	<?php 
		     	    echo "<td>$piloto->nombre</td>";
		     	    echo "<td>$piloto->apellidos</td>";
		     	    echo "<td>$piloto->dni</td>";
		     	    echo '<td>'.TemplateBasico::linkShowEditDelete(__DIR__,'piloto', $piloto->id).'</td>';
		     	?>
		 
		     </tr>
		<?php 
		  }
		?>
		</table>
		</body>
</html>
