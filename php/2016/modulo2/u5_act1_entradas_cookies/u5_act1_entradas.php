<?php
require('u5_act1_entradasClass.php');
require('u5_act1_entradasHtml.php');
require('vardump.php');

$scriptName = basename($_SERVER["SCRIPT_NAME"]);

$entradas = new entradas($scriptName);
$html = new html($scriptName);
$aviso = '';

// Se ha pulsado sobre una butaca
if (isset($_GET['estado'])){
	$fila = $_GET['fila'];
  $columna = $_GET['columna'];
	switch ($_GET['estado']){
		case 0: // Butaca libre
			if (isset($_COOKIE["butaca"]["reservados"])){
				// controlo que no se han sobrepasado las butacas reservadas
				if ((int)$_COOKIE["butaca"]["reservados"] < 5){
					// Sumo 1 al nº de reservas
					$cont = (int)$_COOKIE["butaca"]["reservados"] + 1;
					setcookie("butaca[reservados]",$cont);
					// Cambio el estado del asiento a ocupado
					// con el índice del nº de reserva
					$entradas->cambioEstado('reservar');
					setcookie("butaca[$fila][$columna]",1);
					$aviso = 'Gracias por comprar en esta página';
				}else{ // Ya tiene 5 reservas
					$aviso = 'Sólo se permite comprar 5 entradas como máximo';
					$acceso = false;
				}
			}else{ // La primera vez que se pulsa sobre una butaca libre
				$cont = 0;
				setcookie("butaca[reservados]",$cont);
				// Cambio el estado del asiento a ocupado
				// con el índice del nº de reserva
				$entradas->cambioEstado('reservar');
				setcookie("butaca[$fila][$columna]",1);
				$aviso = 'Gracias por comprar en esta página';
			}
			break;
		case 1: // Butaca ocupada
			if (isset($_COOKIE["butaca"][$fila][$columna])){
				$entradas->cambioEstado('cancelar');
				$cont = (int)$_COOKIE["butaca"]["reservados"] - 1;
				setcookie("butaca[reservados]",$cont);
				$aviso = 'Gracias por devolver la entrada';
			}else{
				$aviso = 'La butaca está ya ocupada y no se puede reservar ni devolver';
			}
			break;
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
		.centrado{width:800px; margin: 0 auto;}
		.titulo{margin-top: 15px; padding: 5px; color: white;}
		.textWhite{color: white;}
		.resaltado{background:red;}
		/*table{font-size: 12px;}*/
		td{width: 20px;}
		tr{margin-top: 10px;}
		div{margin-top: 2px;}
		.centrado {text-align: center !important;	}
		.verde{
			background-color: greenyellow;
		  border-right-style: solid;
		  border-left-style: solid;
		  border-top-style: solid;
		  border-bottom-style: solid;
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
<?php
	echo '<div class="container centrado">';
	$html->titulo($aviso);

	$entradas->obra();
	$entradas->butacas();
	
	echo '$_COOKIE';
	vardump::ver($_COOKIE);
	echo '$_GET';
	vardump::ver($_GET);