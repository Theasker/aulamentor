<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Módulo 2 - Actividad 4</title>
	<style type="text/css">
		body {  background-color: #003399; color:white;}
	  h1 { text-align: center;}
	  #container { width: 600px;  margin: 0 auto; text-align: center;}
	  table,th,td {border: 1px solid #000;width: 400px;  margin: 0 auto;}
	</style>
</head>

<body>
	<div id="container">
		<hr>
		<img src="images/motos_gp.png" alt="motosgp">
		<br><h1>CLASIFICACION</h1>
		<hr>
		<?php require('unidad2_act4_datos.php');?>
		<form action="unidad2_act4_result.php" method="post">
			<p>
				Seleccione el nombre del piloto a consultar: 
				<select name="piloto">
					<?php
						foreach ($pilotos as $key => $value){
							echo '<option value="',$key,'">',$value['nombre'],'</option>';
						};
					?>
				</select>
				<input type="submit" value="buscar">
			</p>
		</form>

	</div>
	
</body>
</html>