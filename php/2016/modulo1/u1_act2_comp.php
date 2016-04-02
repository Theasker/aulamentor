<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Módulo 1 - Actividad 2</title>
	<style type="text/css">
	  p { color: black; font-family: Verdana; }
	</style>
</head>

<body>
	<h1>Evolución población mundial</h1>
	<table>
		<tr>
			<th>Periodo <br> (año)</th>
			<th>Población</th>
			<th>% aumento</th>
		</tr>
		<?php
		
		$poblacion = array( 
			'1970' => 3692492000,
			'1975' => 4068109000,
			'1980' => 4434682000,
			'1985' => 4830978000,
			'1990' => 5263593000,
			'1995' => 5674328000,
			'2000' => 6070581000,
			'2005' => 6453628000,
			'2008' => 6709132760,
			'2010' => 6854196000,
			'2011' => 7000000000);
			
		// Guardo las claves en un array
		foreach ($poblacion as $key => $value){
			$keys[] = $key;
		}
		
		// string number_format ( float $number , int $decimals = 0 , string $dec_point = "." , string $thousands_sep = "," )
		// Aumento = 100 * ((población_año_siguiente / población_año_previo) -1)
		
		$total = 0;
		for ($x = 1;$x < count($poblacion); $x++){
			/*
			if ($x == 0){
				$previous = $poblacion['1970'];
				$next = $poblacion['1975'];
			}else{
				$previous = $poblacion[$keys[$x - 1]];
				$next = $poblacion[$keys[$x + 1]];
			}
			*/
			$previous = $poblacion[$keys[$x - 1]];
			$next = $poblacion[$keys[$x]];
			
			$aumento = (($next / $previous)-1) * 100;
			$total = $total + $aumento;
			echo $total,'<br>';
			$aumento = number_format($aumento,2);

			echo '<tr>';
			echo '<td>',$keys[$x],'</td>','<td>',number_format(($poblacion[$keys[$x]]),0,',','.'),'</td>','<td>',$aumento,'</td>';
			echo '</tr>';
		} 

		?>
	</table>
	<?php
		$previous = $poblacion[$keys[0]];
		$next = $poblacion[$keys[count($poblacion)-1]];
		$total = (($next / $previous)-1) * 100;
		echo '<br>El aumento total de la población es de ',number_format($total, 2); 
	?>
	
</body>
</html>
