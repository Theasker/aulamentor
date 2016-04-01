<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<?php
require('coleccion.php');

$films = new coleccion;

$films->show_films();

?>	
</body>
</html>
