<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style type="text/css">
		body {  background-color: #003399; color:white;}
	  h1 { text-align: center;}
	  #container { width: 600px;  margin: 0 auto; text-align: center;}
	  table,th,td {border: 1px solid #000;width: 200px;  margin: 0 auto;}
	  #num {text-align: right; }
	</style>
</head>
<body>
	<div id="container">
		<hr>
		<img src="images/imagen.jpg" alt="foto">
		<br><h1>Tabla Periódica de los Elementos</h1>
		<hr>
		<?php
			require('u2_act2_tablaPeriodicaDatos.php');
			$key = $_POST['grupo'];
			echo '<p>El grupo <strong>\'',$elementos[$key][0],'\'</strong> está formado por los siguientes elementos: </p>';
			//$cont = count($elementos[$key][1]);
			echo '<table>';
			echo '<tr> <th>Nombre</th> <th>Nº<br>atómico</th> </tr>';
			
			foreach($elementos[$key][1] as $key => $value){
				echo '<tr>';
				echo '<td>',$key,'</td>','<td>',$value,'</td>';
				echo '</tr>';
			};
			echo '</table>';
			echo '<p>Número total: <strong>',count($elementos[$key][1]),'</strong></p>';
			echo  "<BR><INPUT type='button' value='<- Volver atrás'onClick='history.back()'>";
			var_dump($elementos[$key][1]);
		?>
	</div>
</body>
</html>