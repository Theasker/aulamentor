<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Módulo 2 - Unidad 4 - Actividad 1 (Aula Mentor)</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<style>
		.fondo{background-color:#C0C0C0;}
		.centered{width:600px; margin: 0 auto;}
		.logo{padding-top:10px;padding-left:10px;padding-right:10px;}
	</style>
</head>
<body class="fondo">
	<div class="container-fixed centered">
		
		<div class="page-header alert-success">
		  <div class="media-left logo">
		    <img class="media-object" src="cerdito.gif" alt="cerdito">
		  </div>
		  <div class="media-body logo">
		    <h1 class="media-heading text-center">Monedero</h1>
		  </div>
		  <div class="media-right logo">
		    <img class="media-object" src="cerdito.gif" alt="cerdito">
		  </div>
		</div>

		<div>
			<?php
			require('u4_act1_class.php');
			
			error_reporting(E_ALL); 
			ini_set("display_errors", 1); 
			
			$monedero = new monedero();
			
			echo "<table class=\"table\">
				<tr>
					<th class=\"text-center alert-success\">Concepto</th>
					<th class=\"text-center alert-success\">Fecha</th>
					<th class=\"text-center alert-success\">Importe (€)</th>
					<th class=\"text-center alert-success\">Operaciones</th>";
			
			$monedero->readFile();
			
			echo "</tr></table>";
	
			?>	
		</div>
	</div>
</body>
</html>
