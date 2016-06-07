<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Módulo 2 - Unidad 4 - Actividad 1 (Aula Mentor)</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<style>
		body{background-color:#C0C0C0;}
		.centrado{width:700px; margin: 0 auto;}
		.btn{margin-right:5px;}
		.verde{background:#669900;}
		th, .textWhite{color: white;}
		.resaltado{background:teal;}
		.red{color:red;}
	</style>
</head>
<body>
	<div class="centrado">
		<p>
			<div class="panel-body verde">
				<div class="col-xs-2"><img src="cerdito.gif" alt="cerdito"></div>
			  <div class="col-xs-8"><h1 class="text-center">Monedero</h1></div>
			  <div class="col-xs-2"><img src="cerdito.gif" alt="cerdito"></div>
			</div>
		</p>

		<div>
			<?php
			require('u4_act1_class.php');
			require('u4_act1_class_html.php');
			
			$monedero = new monedero();

			$script = $monedero->getScriptName();
			$html = new html($script);
			if(isset($_GET['orden'])){
				$orden = $_GET['orden'];
			}else if(isset($_POST['orden'])){
				$orden = $_POST['orden'];
			}
			
			echo '<table class="table table-condensed table-hover table-bordered table-fixed no-margin">';
			if (isset($_GET["orden"])){ // $_GET
				if (isset($_GET["buscar"])){
					$html->cabeceraOrden("desordenado");
					$monedero->find($_GET['buscar']);
				}else if($_GET['action']=='del'){
					$monedero->del($_GET['orden']);
				}else if($_GET['action']=='editVer'){
					$html->cabeceraOrden($_GET["orden"]);
					$monedero->ordenar($_GET["orden"]);
					$monedero->editVer($_GET['orden']);
				}else{
					$html->cabeceraOrden($_GET["orden"]);
					$monedero->ordenar($_GET["orden"]);
					$monedero->show($_GET["orden"]);
				}
			}else if($_POST['action']=='add'){
				$html->cabeceraOrden($orden);
				$monedero->add($_POST['orden']);
			}else if($_POST['action']=='edit'){
				$monedero->edit();
			}else{ // Si no se ha pulsado ninguna cabecera para ordenaer
				$html->cabeceraOrden("desordenado");
				$monedero->ordenar("desordenado");
				$monedero->show($_GET["orden"]);
			};
			
			
			$html->formAdd($_GET['orden']); // formulario para añadir registros
			echo "</table>";
			
			$html->formFind();

			echo '<hr>';
			echo '<p><div class="col-xs-8 text-left">El nº de registros del monedero es ',$monedero->getRows(),'</div>';
			echo '<div class="col-xs-4">','<a class="btn btn-xs btn-success text-right" href="',$script,'">Ver listado inicial</a>','</div></p>';
			echo '<p class="red">El balance del monedero es de <strong>',$monedero->getTotal(),' euros </strong></p>';
			echo '<p class="text-center">NOTA: es obligatorio rellenar el campo Concepto.</p>';

			?>	
		</div>
	</div>
</body>
</html>