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
								<option value="titulo" selected>Título</option>
								<option value="descripcion">Descripcion</option>
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
		$dificultad = array('Baja','Media','Alta');
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
				echo "<td>",$dificultad[$reg['dificultad']],"</td>";
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
	
	static function commentFoot(){
		echo '<div class="row text-center">';
		echo '<div class="text-success">Se ha dado de alta correctamente el comentario.</div>';
		echo '</div>';
	}
	
	static function rutaNew($scriptName,$resultado){
		if($_GET['action'] == 'edit'){
			$datos = $resultado->fetch();

			$id = $datos['id'];
			$tit = $datos['titulo'];
		  $desc = $datos['descripcion'];
		  $desnivel = (int)$datos['desnivel'];
		  $distancia = (float)$datos['distancia'];
		  $dif = (int)$datos['dificultad'];
		  var_dump($dif,(int)$datos['dificultad']);
		  $notas = $datos['notas'];
		  $submit = "Guardar ruta";
		  $submitname = "guardarRuta";
		}else{
			$id = '';
			$tit = '';
		  $desc = '';
		  $desnivel = '';
		  $distancia = '';
		  $dif = '';
		  $notas = '';
		  $submit = "Alta ruta";
		  $submitname = "altaRuta";
		}
		?>
			<hr>
			<form class="form-horizontal" role="form" method="post" action="<?=$scriptName?>" name="new" id="new">
				
				<input type="hidden" name="id" value="<?=$id?>">
				
			  <div class="form-group">
			    <label for="titulo" class="col-lg-3 control-label">Título</label>
			    <div class="col-lg-7">
			      <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" value="<?=$tit?>">
			    </div>
			  </div>
			  
			  <div class="form-group">
			    <label for="descripcion" class="col-lg-3 control-label">Descripción</label>
			    <div class="col-lg-7">
			      <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion" value="<?=$desc?>">
			    </div>
			  </div>
			  
			  <div class="form-group">
			    <label for="desnivel" class="col-lg-3 control-label">Desnivel (m.)</label>
			    <div class="col-lg-7">
			      <input type="number" class="form-control" id="desnivel" name="desnivel" placeholder="Desnivel" value="<?=$desnivel?>">
			    </div>
			  </div>
			  
			  <div class="form-group">
			    <label for="distancia" class="col-lg-3 control-label">Distancia (Km.)</label>
			    <div class="col-lg-7">
			      <input type="number" step="0.01" class="form-control" id="distancia" name="distancia" placeholder="Distancia" value="<?=$distancia?>">
			    </div>
			  </div>
			  
			  <div class="form-group">
			    <label for="dificultad" class="col-lg-3 control-label">Dificultad</label>
			    <div class="col-lg-7">
			      <select name="dificultad" class="form-control input-sm" id="dificultad">
			      	<?php
			      		switch ($dif){
			      			case 0:
			      				echo '<option value="0" selected>Baja</option>';
			      				echo '<option value="1">Media</option>';
			      				echo '<option value="2">Alta</option>';
			      				break;
			      			case 1:
			      				echo '<option value="0">Baja</option>';
			      				echo '<option value="1" selected>Media</option>';
			      				echo '<option value="2">Alta</option>';
			      				break;
			      			case 2:
			      				echo '<option value="0">Baja</option>';
			      				echo '<option value="1">Media</option>';
			      				echo '<option value="2" selected>Alta</option>';
			      				break;
			      		}
			      	?>
						</select>
			    </div>
			  </div>
			  
			  <div class="form-group">
			    <label for="notas" class="col-lg-3 control-label">Notas</label>
			    <div class="col-lg-7">
			    	<textarea rows="4" cols="50" class="form-control" id="notas" name="notas" placeholder="Notas"><?=$notas?></textarea>
			    </div>
			  </div>
			  
			  <div class="form-group text-center">
			    <div class="col-lg-offset-3 col-lg-7">
			      <input type="submit" class="btn btn-success" name="<?=$submitname?>" value="<?=$submit?>">
			    </div>
			  </div>
			  
			</form>
		<?php
	}
	
	static function comment($scriptName,$resultado,$comentarios){
		$dificultad = array('Baja','Media','Alta');
		$datos = $resultado->fetch();
		$id = $datos['id'];
		$tit = $datos['titulo'];
	  $desc = $datos['descripcion'];
	  $desnivel = (int)$datos['desnivel'];
	  $distancia = (float)$datos['distancia'];
	  $dif = (int)$datos['dificultad'];
	  $notas = $datos['notas'];
		?>
			<hr>
			<form class="form-horizontal" role="form" method="post" action="<?=$scriptName?>" name="new">
				<input type="hidden" name="id" value="<?=$id?>">
				
				<div id="new">
					<div class="form-group">
				    <label for="titulo" class="col-lg-3 control-label bg-success">Título</label>
				    <div class="col-lg-7"><?=$tit?></div>
				  </div>
				  
				  <div class="form-group">
				    <label for="descripcion" class="col-lg-3 control-label bg-success">Descripción</label>
				    <div class="col-lg-7"><?=$desc?></div>
				  </div>
				  
				  <div class="form-group">
				    <label for="desnivel" class="col-lg-3 control-label bg-success">Desnivel (m.)</label>
				    <div class="col-lg-7"><?=$desnivel?></div>
				  </div>
				  
				  <div class="form-group">
				    <label for="distancia" class="col-lg-3 control-label bg-success">Distancia (Km.)</label>
				    <div class="col-lg-7"><?=$distancia?></div>
				  </div>
				  
				  <div class="form-group">
				    <label for="dificultad" class="col-lg-3 control-label bg-success">Dificultad</label>
				    <div class="col-lg-7"><?=$dificultad[$dif]?></div>
				  </div>
				  
				  <div class="form-group">
				    <label for="notas" class="col-lg-3 control-label bg-success">Notas</label>
				    <div class="col-lg-7"><?=$notas?></div>
				  </div>
				</div>
			  <div class="row centrado">
			  	<table class="table table-condensed table-hover table-bordered table-fixed no-margin">
			  		<tr>
			  			<th class="col-md-2 bg-success text-center">Nombre</th>
			  			<th class="col-md-2 bg-success text-center">Fecha</th>
			  			<th class="col-md-7 bg-success text-center">Comentario</th>
			  			<th class="col-md-1 bg-success text-center"></th>
			  		</tr>
		  <?php
		  	if($comentarios){
		  		foreach($comentarios as $com){
		  			echo "<tr>";
						echo "<td>",$com['nombre'],"</td>";
						$date = new DateTime($com['fecha']);
						echo "<td>",$date->format('d-m-Y'),"</td>";
						echo "<td>",$com['texto'],"</td>";
		  			echo "<td></td>";
		  			echo "</tr>";
		  		}
		  	}
		  ?>		
		  
					  <div class="form-group">
					  	<tr>
			  				<td>
			  					<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
			  				</td>
			  				<td>
			  					<input type="hidden" name="fecha" value="<?=date("Y-m-d")?>">
			  					<?php
			  						echo date("d-m-Y");
			  					?>
			  				</td>
			  				<td>
			  					<input type="text" class="form-control" id="comentario" name="comentario" placeholder="Comentario">
			  				</td>
			  				<td>
			  					<input type="submit" class="form-control" name="addComment" value="Añadir">
			  				</td>
			  			</tr>
					    
					  </div>
					  
		  		</table>
			  </div>
			</form>
		<?php
	}
}
?>