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
	if (comprobarReserva()){
		switch ($_GET['estado']){
			case 0: // Butaca libre
				$entradas->cambioEstado('reservar');
				$nReservados = (int)$_COOKIE["butaca"]["reservados"];
				setcookie("butaca[$nReservados][fila]",$_GET['fila']);
				break;
			case 1: // Butaca ocupada
				if (isset($_COOKIE["butaca"])){
					foreach ($_COOKIE["butaca"] as $row){
						vardump::ver($row);
					}
				}else{
					
				}
				//$cont = (int)$_COOKIE['reservados'];
				$aviso = 'La butaca está ya ocupada y no se puede reservar ni devolver';
				break;
			case 2: // Butaca reservada
				//$cont = (int)$_COOKIE['reservados'] - 1;
				$entradas->cambioEstado('cancelar');
				break;
		}
	}
}

function comprobarReserva(){
	// Compruebo las butacas reservadas
	$acceso = true;
	if (isset($_COOKIE["butaca"]["reservados"])){
		// controlo que no se han sobrepasado las butacas reservadas
		if ((int)$_COOKIE["butaca"]["reservados"] < 5){
			echo '$cont = (int)$_COOKIE["butaca"]["reservados"] + 1;'; 
			$cont = (int)$_COOKIE["butaca"]["reservados"] + 1;
			setcookie("butaca[reservados]",$cont);
		}else{ // se ha sobrepasado el límite de reservas
			echo 'aviso';
			$aviso = 'Ha reservado más de 5 butacas';
			$acceso = false;
		}
	}else{
		echo 'cont=0';
		$cont = 0;
		setcookie("butaca[reservados]",$cont);
	}
	return $acceso;
}

?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Unicad 5 - Activadad 1 - Entradas de Cine</title>
	<meta name="viewport" content="width=device-width,initial-scale=1">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

	<script   src="jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
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
	//$html->titulo($aviso);

	//$entradas->obra();
	$entradas->butacas();
	
	echo '$_COOKIE';
	vardump::ver2($_COOKIE);
	echo '$_GET';
	vardump::ver($_GET);
	echo '$_POST';
	vardump::ver($_POST);
?>
	</div>
</body>
</html>