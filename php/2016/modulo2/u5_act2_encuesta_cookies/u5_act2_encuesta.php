<?php
require('u5_act2_encuestaClass.php');
require('u5_act2_encuestaHtml.php');

$scriptName = basename($_SERVER["SCRIPT_NAME"]);

$encuesta = new encuesta($scriptName);
$html = new html($scriptName);
$aviso = '';

echo '<div class="container centrado">';
if (isset($_POST["enviar"]) && isset($_POST["encuesta"])){
	// Si no existe la cookie es que no se ha votado o ha caducado
	if (isset($_COOKIE["votado"])){ // Ya se había votado
		$aviso = " ¡Sólo se permite votar una vez!";
	}else{
		$aviso = "¡Gracias por votar!";
		setcookie("votado", "si", time()+30);  /* expire in 30 s. */
		$encuesta->votar();
	}
}
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
		.resultados{font-size: 1.2em;}
	</style>
</head>
<body>
<?php
	$html->encuesta($encuesta->getTitulo(),$encuesta->getDatos(),$aviso);
	$html->resultados($encuesta->getTitulo(),$encuesta->getDatos());
	echo '</div>';
	?>
</body>
</html>