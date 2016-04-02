<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Módulo 1 - Actividad 1</title>
	
</head>

<body>
	<h1>Boletín de notas</h1>
	<table>
		<tr>
			<th>Asignatura</th>
			<th>Trimestre 1</th>
			<th>Trimestre 2</th>
			<th>Trimestre 3</th>
			<th>Media</th>
		</tr>
		<?php
			// Lengua fisica latin inglés
			$notas = array(
				'Matemáticas' => array(3,10,7),
        'Lengua' => array(8,5,3),
        'Fisica' => array(7,2,1),
        'Latín' => array(4,7,8),
        'Inglés' => array(6,2,3)
    	);
    	
    	$mediat = 0;
    	foreach($notas as $asignatura => $key){
    		echo '<tr>';
    		echo '<td>',$asignatura,'</td>';
    		echo '<td>',$key[0],'</td>';
    		echo '<td>',$key[1],'</td>';
    		echo '<td>',$key[2],'</td>';
    		$media = (($key[0]+$key[1]+$key[2])/3);
    		$mediat = $mediat + $media;
    		echo '<td>',number_format($media, 1),'</td>';
    		echo '</tr>';
    	};
    	echo '</table>';
    	
    	echo '<br>La media es ',number_format($mediat / 5, 1);
    	
		?>
	</table>
	
</body>
</html>
