<!doctype html>
<html lang="es">
<head>
	
	<meta charset="UTF-8">
	<title>Unicad 5 - Activadad 1 - Entradas de Cine</title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="bootstrap-theme.min.css">
	<script src="jquery-1.12.4.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="bootstrap.min.js"></script>
	
	<!-- Notificaciones - > 	http://fabien-d.github.io/alertify.js/ -->
	<script src="alertify.min.js"></script>
	<link rel="stylesheet" href="alertify.core.css" />
	<link rel="stylesheet" href="alertify.bootstrap.css" />
	
	<style>
		body{background-color: #cccccc;font-family: Times;}
		.centrado{width:800px; margin: 0 auto;}
		.titulo{margin-top: 15px; padding: 5px;}

		
	</style>
</head>
<body>
	<div class="container centrado">
		<div class="row">
			<div class="col-md-4 bg-success">
				
			</div>
			<div class="col-md-8 titulo bg-success">
				<h1>Rutas senderismo</h1>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-7 bg-success">xxx</div>
			<div class="col-md-5 bg-warning">xxx</div>
		</div>
		
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
				
				<?php
				require('conection.php');
				require('u7_act1_bbdd_controller.php');

				$scriptName = basename($_SERVER["SCRIPT_NAME"]);
				
				$bd = conectaBD();
				$rutas = new rutas($bd);
				$resultado = $rutas->datos();

				if($resultado){
					echo '<form action="u7_act1_bbdd_submit" method="post">';
					foreach($resultado as $valor){
						echo "<tr>";
						echo "<td>",$valor['titulo'],"</td>";
						echo "<td>",$valor['descripcion'],"</td>";
						echo "<td>",$valor['desnivel'],"</td>";
						echo "<td>",$valor['distancia'],"</td>";
						echo "<td>",$valor['dificultad'],"</td>";
						echo <<<EOT
						<td class="text-center">
							<div class="btn-group text-center" role="group">
							  <a class="btn btn-xs btn-success" href="$scriptName?action=editVer&id=$id&orden=$orden">Editar</a>
							  <a class="btn btn-xs btn-danger" href="$this->scriptName?action=del&id=$id&orden=$orden">Borrar</a>
							</form>
						</td>
EOT;
						echo '<a href="',scriptName,'?action=editar">email me</a>
						echo "<td>[ ",$valor['id']," ]</td>";
						echo "<tr>";
					}
					echo '</form>';
				}
	
				?>
				
			</table>
		</div>
		
	</div>

</body>
</html>