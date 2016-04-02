<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Módulo 2 - Unidad 3 - Actividad 1 (Aula Mentor)</title>
	<style>
		body{background-color: #FF9900;}
		h2,h3, .rojo{color:red;}
		.container{width:900px; text-align: center;margin: 0 auto;}
		.titulo{width:400px; text-align: center;display: table-cell;}
		.form{width:400px;display: table-cell;}
		h3{text-decoration: underline;}
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
			<form action="u3_act1_form.php">
				<label for="">
					<span class="rojo"><strong>Buscar película</strong></span>
					<input type="text">
					<input type="submit" value="buscar">
					<p><input type="submit" value="Ver listado completo de películas" name="full"></p>
					<p><input type="submit" value="Ver listado ordenado por titulo" name="title"></p>
				</label>
			</form>
		</div>
		<hr>
		<?php
		require('u3_act1_class.php');
		
		$films = new coleccion;
		
		$films->show_films();
		
		?>	
	</div>
</body>
</html>
