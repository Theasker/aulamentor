<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Unidad 2 - Actividad 3 - Tabla Periódica</title>
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
		<img src="images/imagen.jpg" alt="foto">
		<br><h1>Tabla Periódica de los Elementos</h1>
		<hr>
		<?php require('u2_act2_tablaPeriodicaDatos.php');?>
		<form action="u2_act2_tablaPeriodicaResult.php" method="post">
			<p>
				Seleccione el grupo que desea consultar: 
				<select name="grupo">
					<?php
						for ($x=0 ; $x < count($elementos) ; $x++){
							echo '<option value="',$x,'">',$elementos[$x][0],'</option>';
						}
					?>
				</select>
				<input type="submit" value="buscar">
			</p>
		</form>

	</div>
</body>
</html>