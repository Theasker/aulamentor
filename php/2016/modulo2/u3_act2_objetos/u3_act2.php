<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Módulo 2 - Unidad 3 - Actividad 2 (Aula Mentor)</title>
	<style>
		body{background-color: rgb(0, 128, 0);color: white;}
		.container{width:900px; text-align: center;margin: 0 auto;}
		.titulo{width:400px; text-align: center;display: table-cell;}
		.form{width:400px;display: table-cell;}
		h3{text-decoration: underline;}
		table,th,td {border: 1px solid #000;margin: 0 auto;text-align:left;}
		td,th{padding-left: 10px;padding-right:10px;}
		td{color:black;}
	</style>
</head>
<body>
	<div class="container">
		<hr>
		<div class="titulo">
			<h2>BOTIQUIN</h2>
			<img src="botiquin.jpg" alt="botiquin">
		</div>
		<div class="form">
			<h3>Operaciones con el botiquín</h3>
			<form action="u3_act2.php" method="post">
				<label for="">
					<strong>Buscar medicamento</strong>
					<input type="text" name="buscartxt">
					<input type="submit" value="buscar" name="buscar">
					<p><input type="submit" value="Ver listado completo de medicinas" name="full"></p>
					<p><input type="submit" value="Ver listado ordenado por nombre" name="sortName"></p>
				</label>
			</form>
		</div>
		<hr>
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
