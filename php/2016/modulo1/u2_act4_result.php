<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style type="text/css">
		body {  background-color: #003399; color:white;}
	  h1 { text-align: center;}
	  #container { width: 600px;  margin: 0 auto; text-align: center;}
	  table,th,td {border: 1px solid #000;width: 400px;  margin: 0 auto;}
	  #num {text-align: right; }
	</style>
</head>
<body>
	<div id="container">
		<hr>
		<img src="images/motos_gp.png" alt="motosgp">
		<br><h1>INFORMACION PILOTO</h1>
		<hr>
		<?php
			require('unidad2_act4_datos.php');
			$key = $_POST['piloto'];
			echo '<p>La clasificación del piloto <strong>\'',$pilotos[$key]['nombre'],'\'</strong> es: </p>';
			echo '<table>';
			echo '<tr> <th>Gran<br>Premio</th> <th>Posición</th> <th>Puntos</th> </tr>';
			$acum = 0;
			for ($x = 0 ; $x<7 ; $x++){
				echo '<tr>';
				echo '<td>',$premios[$x],'</td>';
				echo '<td id="num">',$pilotos[$key][0][$x],'</td>';
				if (($pilotos[$key][0][$x])=='Abandono'){
					echo '<td id="num">0</td>';
				}else{
					echo '<td id="num">',$puntos[$pilotos[$key][0][$x]],'</td>';
					$acum = $acum + $puntos[$pilotos[$key][0][$x]];
				}
				echo '</tr>';
			};
			
			echo '</table>';
			echo '<p>Número total de puntos conseguidos en el campeonato: <strong>',$acum,'</strong></p>';
			echo  "<BR><INPUT type='button' value='<- Volver atrás'onClick='history.back()'>";
		?>
	</div>
</body>
</html>