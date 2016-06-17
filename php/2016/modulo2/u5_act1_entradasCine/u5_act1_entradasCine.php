<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Unicad 5 - Activadad 1 - Entradas de Cine</title>
	<meta name="viewport" content="width=device-width,initial-scale=1">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

	<script   src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<style>
		body{background-color: #cccccc;font-family: Times;}
		.centrado{width:800px; margin: 0 auto;}
		.titulo{margin-top: 15px; padding: 5px; color: white;}
		.textWhite{color: white;}
		.resaltado{background:red;}
		table{font-size: 12px;}
		.verde{
			background-color: greenyellow;
		  border-right-style: solid;
		  border-left-style: solid;
		  border-top-style: solid;
		  border-right-width: 1px;
		  border-left-width: 1px;
		  border-bottom-width: 1px;
		  border-top-width: 1px;
		}
		.verdeoscuro{
		  background-color: green;
		  color: white;
		  border-right-style: none;
		  border-left-style: none;
		  border-bottom-style: none;
		  border-top-style: none;
		  text-align: center;
		}
		.naranja{
		  background-color: orange;
		  border-right-style: solid;
		  border-left-style: solid;
		  border-top-style: solid;
		  border-right-width: 1px;
		  border-left-width: 1px;
		  border-bottom-width: 1px;
		  border-top-width: 1px;
		}
		.rojo{
		  background-color: red;
		  border-right-style: solid;
		  border-left-style: solid;
		  border-top-style: solid;
		  border-right-width: 1px;
		  border-left-width: 1px;
		  border-bottom-width: 1px;
		  border-top-width: 1px;
		}
		.limpio{
		  border-right-style: none;
		  border-left-style: none;
		  border-bottom-style: none;
		  border-top-style: none;
		  text-align: center;
		}

	</style>
</head>
<body>
	<div class="container centrado">
		<div class="row verdeoscuro titulo">
			 <div class="col-md-12 text-center"><h1>Comprar entradas de teatro</h1></div>
		</div>
		<div class="row">
			<div class="col-md-12 text-center">
				<h2>¡Bienvenid@ a la página de reserva de localidades</h2>
			</div>
			<hr>
		</div>
<?php
	require('u4_act2_entradasCineClass.php');
	require('u4_act2_entradasCineHtml.php');
	
	$scriptName = basename($_SERVER["SCRIPT_NAME"]);
	
	$entradas = new entrdas($scriptName);
	$html = new html($scriptName);
	
	/*
	echo '$_GET';
	var_dump($_GET);
	echo '$_POST';
	var_dump($_POST);
	*/
?>
	</div>
</body>
</html>