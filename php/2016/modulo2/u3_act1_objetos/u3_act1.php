<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Módulo 2 - Unidad 3 - Actividad 1 (Aula Mentor)</title>
	<style>
		body{background-color: #FF9900;}
		h2,h3,th,.rojo{color:red;}
		.container{width:900px; text-align: center;margin: 0 auto;}
		.titulo{width:400px; text-align: center;display: table-cell;}
		.form{width:400px;display: table-cell;}
		h3{text-decoration: underline;}
		table,th,td {border: 1px solid #000;margin: 0 auto;text-align:left;font-weight: bold;}
		td,th{padding-left: 10px;padding-right:10px;}
	</style>
</head>
<body>
	<div class="container">
		<hr>
		<div class="titulo">
			<h2>COLECCION DE PELICULAS</h2>
			<img src="peliculas.png" alt="peliculas">
		</div>
		<div class="form">
			<h3>Operaciones con la colección</h3>
			<form action="u3_act1.php" method="post">
				<label for="">
					<span class="rojo"><strong>Buscar película</strong></span>
					<input type="text" name="buscartxt">
					<input type="submit" value="buscar" name="buscar">
					<p><input type="submit" value="Ver listado completo de películas" name="full"></p>
					<p><input type="submit" value="Ver listado ordenado por titulo" name="sortTitle"></p>
				</label>
			</form>
		</div>
		<hr>
		<?php
		require('u3_act1_class.php');
		
		$films = new coleccion;
		
		if (isset($_POST['full'])) $films->show_films();
		if (isset($_POST['sortTitle'])) $films->sortTitle();
		if (isset($_POST['buscar'])) $films->find($_POST['buscartxt']);

		?>	
	</div>
</body>
</html>
