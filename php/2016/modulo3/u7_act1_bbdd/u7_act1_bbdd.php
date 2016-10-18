<!doctype html>
<html lang="es">
<head>
	<!--
	Notificaciones - > 	http://fabien-d.github.io/alertify.js/
	-->
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
	
	<style>
		body{background-color: #cccccc;font-family: Times;}
		.centrado{width:800px; margin: 0 auto;}
		.titulo{margin-top: 15px; padding: 5px;}
	</style>
</head>
<body>
	<div class="container centrado">
		<div class="row">
			<div class="col-md-4">
				
				
			</div>
			<div class="col-md-8 titulo">
				<h1>Rutas senderismo</h1>
			</div>
		</div>
			
		<div class="row">
			<?php
			require('conection.php');
			require('u7_act1_bbdd_controller.php');
			
			$bd = conectaBD();
			$rutas = new rutas($bd);
			
			?>
		</div>
	</div>

</body>
</html>