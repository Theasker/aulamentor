<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Módulo 2 - Unidad 4 - Actividad 1 (Aula Mentor)</title>
	<style>
		body{background-color: #C0C0C0;}
		h1{color:white;}
		#title {width:600px;text-align:center;margin: 0 auto;margin-top:20px;background-color:#669900;height:85px;}
		#left {float:left;width:100px;margin-top:10px;}
		#center {display: inline-block;margin:0 auto;color:white;}
		#right {float:right;width:100px;margin-top:10px;}
		
	</style>
</head>
<body>
	<div id="title">
	  <div id="left"><img src="cerdito.gif" alt="cerdito"></div>
	  <div id="center"><h1>Monedero</h1></div>
	  <div id="right"><img src="cerdito.gif" alt="cerdito"></div>
	</div>
			

		
		<?php
		require('u3_act2_class.php');
		
		$films = new coleccion;
		
		if (isset($_POST['full'])) $films->show();
		if (isset($_POST['sortName'])) $films->sortName();
		if (isset($_POST['buscar'])) $films->find($_POST['buscartxt']);

		?>	
	</div>
</body>
</html>
