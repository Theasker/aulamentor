<?php
// Controlo las entradas solicitadas
if (isset($_COOKIE['reservados'])){
	$cont = (int)$_COOKIE['reservados'] + 1;
}

setcookie("reservados", $cont, time()+360);  /* expire in 10 m hour */


?>
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
	require('u5_act1_entradasClass.php');
	require('u5_act1_entradasHtml.php');
	
	$scriptName = basename($_SERVER["SCRIPT_NAME"]);
	
	$entradas = new entradas($scriptName);
	$html = new html($scriptName);
	
	
	echo '<div class="container centrado">';
	$html->titulo('prueba');
	
	switch ($_GET['estado']){
		case 0:
			//$html->
			//$entradas->cambioEstado();
			break;
		case 1:
			
			break;
	}
	
	if (isset($_COOKIE['reservados'])){
		
	}

	$entradas->obra();
	$entradas->butacas();
	
	var_dump($_COOKIE);
	echo '$_GET';
	var_dump($_GET);
	echo '$_POST';
	var_dump($_POST);
	
	
	
?>
	</div>
</body>
</html>