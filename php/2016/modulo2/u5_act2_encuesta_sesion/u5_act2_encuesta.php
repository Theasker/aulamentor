<?php
require('u5_act2_encuestaClass.php');
require('u5_act2_encuestaHtml.php');
require('vardump.php');

$scriptName = basename($_SERVER["SCRIPT_NAME"]);

$encuesta = new encuesta($scriptName);
$html = new html($scriptName);
$aviso = '';

session_start();

?>
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
	<style>
		body{background-color: #cccccc;font-family: Times;}
		.centrado{width:500px; margin: 0 auto;}


	</style>
</head>
<body>
<?php
	echo '<div class="container centrado">';
	$html->encuesta();
	
	echo '$_SESSION';
	vardump::ver($_SESSION);
	echo '$_POST';
	vardump::ver($_POST);

	echo '</div>';