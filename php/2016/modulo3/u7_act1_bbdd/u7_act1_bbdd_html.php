<?php
class html{
	static function titlePag(){
		echo <<<HTML
		<div class="row">
			<div class="col-md-4 titulo bg-success text-center">
				<img src="senderismo.gif" width="240" height="70">
			</div>
			<div class="col-md-8 titulo bg-success">
				<h1 class="text-center">Rutas senderismo</h1>
			</div>
		</div>
HTML;
	}
	static function menu($scriptName){
		?>
		<br>
		<div class="row">
			<div class="col-md-7">
				<form action="<?= $scriptName ?>" method="post" class="form-horizontal" role="form">
					
					<div class="form-group">
						<label for="tipoBusqueda" class="col-lg-6 control-label">Buscar por el campo </label>
						<div class="col-lg-6">
							<select name="tipoBusqueda" class="form-control input-sm">
								<option value="titulo">Título</option>
								<option value="descripcion" selected>Descripcion</option>
							</select>
						</div>
					</div>
					<div class="form-group">
				    <div class="col-lg-9">
				      <input type="text" class="form-control input-sm" name="buscartexto" placeholder="Introduce un texto">
				    </div>
				    
				    <div class="col-lg-3">
				    	<input type="submit" class="btn btn-success form-control input-sm" name="buscar" value="buscar">
				    </div>
				  </div>
				</form>
			</div>
			
			<div class="col-md-5 text-center btn-group" role="group">
				<p><a class="btn btn-primary" href="<?= $scriptName ?>?action=new">Nueva ruta</a></p>
			  <p><a class="btn btn-primary" href="<?= $scriptName ?>?action=listado">Listado completo</a></p>
			</div>
		</div>
		<?php
	}
	
	static function cabeceraTabla(){
		echo <<<HTML
		<div class="row">
			<table class="table table-condensed table-hover table-bordered table-fixed no-margin">
				<tr>
					<th class="col-md-2 success text-center">Titulo</th>
					<th class="col-md-4 success text-center">Descripción</th>
					<th class="col-md-1 success text-center">Desnivel</th>
					<th class="col-md-1 success text-center">Distancia<br>(Km)</th>
					<th class="col-md-1 success text-center">Dificultad</th>
					<th class="col-md-3 success text-center">Operaciones</th>
				</tr>
HTML;
	}
	static function mostrarDatos($scriptName,$resultado){
		$km = 0;
		self::cabeceraTabla();
		if($resultado){
			foreach($resultado as $reg){
				//var_dump($reg);
				$id = $reg['id'];
				$km = $km + (float)$reg['distancia'];
				echo "<tr>";
				echo "<td>",$reg['titulo'],"</td>";
				echo "<td>",$reg['descripcion'],"</td>";
				echo "<td>",$reg['desnivel'],"</td>";
				echo "<td>",$reg['distancia'],"</td>";
				echo "<td>",$reg['dificultad'],"</td>";
				echo <<<EOT
				<td class="text-center">
					<div class="btn-group text-center" role="group">
						<a class="btn btn-xs btn-warning" href="$scriptName?action=coment&id=$id">Comentar</a> 
					  <a class="btn btn-xs btn-success" href="$scriptName?action=edit&id=$id">Editar</a> 
					  <a class="btn btn-xs btn-danger" href="$scriptName?action=del&id=$id">Borrar</a>
					</div>
				</td>
EOT;
				echo "</tr>";
			}
		}
		self::tableFoot($resultado->rowCount(),$km);
	}
	static function tableFoot($cont,$km){
		echo <<<HTML
			</table>
		</div>
HTML;
		echo '<div class="row text-center">';
		echo '<div class="text-success">El n° total de rutas es: ',$cont,'</div>';
		echo '<div class="text-success">La ruta más larga tiene: ',$km,' Km</div>';
		echo '</div>';
	}
	
	static function rutaNew($scriptName,$reg){
		$dificultad = array("Baja","Media","Alta");
		?>
			<hr>

			<form class="form-horizontal" role="form" method="post" action="<?=$scriptName?>" name="new" id="new">
				
			  <div class="form-group">
			    <label for="titulo" class="col-lg-3 control-label">Título</label>
			    <div class="col-lg-7">
			      <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="descripcion" class="col-lg-3 control-label">Descripción</label>
			    <div class="col-lg-7">
			      <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Contraseña">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="desnivel" class="col-lg-3 control-label">Desnivel (m.)</label>
			    <div class="col-lg-7">
			      <input type="number" class="form-control" id="desnivel" name="desnivel" placeholder="Desnivel">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="distancia" class="col-lg-3 control-label">Distancia (Km.)</label>
			    <div class="col-lg-7">
			      <input type="number" step="0.01" class="form-control" id="distancia" name="distancia" placeholder="Distancia">
			    </div>
			  </div>
			  
			  <div class="form-group">
			    <label for="dificultad" class="col-lg-3 control-label">Dificultad</label>
			    <div class="col-lg-7">
			      <select name="dificultad" class="form-control input-sm">
							<option value="1" selected>Baja</option>
							<option value="2">Media</option>
							<option value="3">Alta</option>
						</select>
			    </div>
			  </div>
			  
			  <div class="form-group">
			    <label for="notas" class="col-lg-3 control-label">Notas</label>
			    <div class="col-lg-7">
			    	<textarea rows="4" cols="50" class="form-control" id="notas" name="notas" placeholder="Notas"></textarea>
			    </div>
			  </div>
			  
			  <div class="form-group text-center">
			    <div class="col-lg-offset-3 col-lg-7">
			      <input type="submit" class="btn btn-success" name="altaRuta" value="Alta Ruta">
			    </div>
			  </div>
			</form>

		<?php
	}
	
	
}
?>