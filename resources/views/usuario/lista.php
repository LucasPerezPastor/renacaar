<!DOCTYPE html>
<html lang="es">
	<head>
		<?php (TEMPLATE)::basicHead('Listado de usuarios',__DIR__)?>
	</head>
	<body>
		
		
		<?php 
		(TEMPLATE)::header('Listado de usuarios');
		(TEMPLATE)::nav(2);
		?>
		
		<!--  Formulario de búsqueda de usuarios-->
		<form class="formulariobusqueda" method="post" action="/usuario/search">
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
			<th>Usuario</th>
			<th>Nombre</th>
			<th>Primer Apellido</th>
			<th>Email<th>
		</tr>
		<?php 
		  foreach ($usuarios as $usuario) {
		     ?>
		     <tr>
		     	<?php 
		     	    echo "<td>$usuario->usuario</td>";
		     	    echo "<td>$usuario->nombre</td>";
		     	    echo "<td>$usuario->apellido1</td>";
		     	    echo "<td>$usuario->email</td>";
		     	    echo '<td>'.TemplateBasico::linkShowEditDelete(__DIR__,'usuario', $usuario->id).'</td>';
		     	?>
		
		     </tr>
		<?php 
		  }
		?>
		</table>
		</body>
</html>
