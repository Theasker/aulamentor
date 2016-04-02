<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Módulo 1 - Actividad 3</title>
	<style type="text/css">
		body {  background-color: rgb(51,153,102);}
	  h1 { text-align: center;}
	  #container { width: 600px;  margin: 0 auto; text-align: center;}
	  table,th,td {border: 1px solid #000;width: 400px;  margin: 0 auto;}
	</style>
</head>

<body>
	<div id="container">
		<hr><br><h1>Viaje</h1><br><hr>
		
		<table>
			<tr>
				<th>Origen</th>
				<th>Destino</th>
				<th>Distancia <br> (Km)</th>
			</tr>
			<?php
			
			$travel = array(
				array('Madrid','Segovia',90.201),
				array('Madrid','A Coruña',596.887),
				array('Barcelona','Cádiz',1152.669),
				array('Bilbao','Valencia',622.233),
				array('Sevilla','Santander',832.067),
				array('Oviedo','Badajoz',682.429));
				
			$mayor = array('key'=>null,'distancia'=>0);
			for ($i = 0; $i < count($travel);$i++){
				if ($travel[$i][2] > $mayor['distancia']){
					$mayor['key'] = $i;
					$mayor['distancia'] = $travel[$i][2];
				}
				printf('<tr>
	      	<td align="CENTER">%s</td>
	      	<td align="CENTER">%s</td>
	      	<td align="RIGHT">%.3f</td>
	      	</tr>',
	      	$travel[$i][0],$travel[$i][1],$travel[$i][2]);
			}
			
			?>
		</table>
		<?php
			echo '<br>El trayecto más largo es de ',$travel[$mayor['key']][0];
			echo ' a ',$travel[$mayor['key']][1],' con ',$travel[$mayor['key']][2],' Km'
		?>
	</div>
	
</body>
</html>
