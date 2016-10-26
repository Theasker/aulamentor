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
		input{width: 200px }
		#new{width: 600px;margin: 0 auto; }
	</style>
</head>
<body>
	<?php
		require('conection.php');
		require('u7_act1_bbdd_controller.php');
		require('u7_act1_bbdd_html.php');
	?>
	<div class="container centrado">
		<?php
			$scriptName = basename($_SERVER["SCRIPT_NAME"]);
			html::titlePag();
			html::menu($scriptName);
			
			$bd = conectaBD();
			$rutas = new rutas($bd);

			
			// Mostramos todos los datos
			if($_GET['action'] == 'listado'){
				$resultado = $rutas->datos();
				html::mostrarDatos($scriptName,$resultado);	
			}else	if($_GET['action'] == 'new'){
				html::rutaNew($scriptName,null);
			}else if($_GET['action'] == 'edit'){
				
			}else if($_GET['action'] == 'coment'){
				
			}else if($_GET['action'] == 'del'){
				
			}else if(isset($_POST['altaRuta'])){
				$rutas->newReg();
				$resultado = $rutas->datos();
				html::mostrarDatos($scriptName,$resultado);	
			}
			else{
				$resultado = $rutas->datos();
				html::mostrarDatos($scriptName,$resultado);
			}
			
			echo '<div class="row">';
			echo "GET<br>";
			var_dump($_GET);
			echo "POST<br>";
			var_dump($_POST);
			echo '</div>';
		?>
	</div>
</body>
</html>