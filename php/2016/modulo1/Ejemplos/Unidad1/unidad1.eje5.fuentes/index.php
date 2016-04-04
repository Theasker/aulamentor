<HTML> 
  <HEAD><TITLE>Ejemplo 5 - Unidad 1 - Curso Iniciación de PHP 5</TITLE></HEAD>
  <BODY><DIV style="text-align: center;"> 
<?php 
	
	echo "<HR>
			<H1>Unidad 1 - Ejemplo 5</H1>
			<HR>
			<H3>Leemos de una matriz de tres elementos una fuente
                y un tamaño, y escribimos un texto en el que cada
                línea tiene la fuente y el tamaño del elemento
                correspondiente.
			</H3>
			<HR>";
	
	$matriz_fuentes = array(0=>array(0=>"Arial",1=>8),
							1=>array(0=>"Courier New",1=>6),
							2=>array(0=>"sans-serif",1=>4));
	
	printf("<FONT face=\"%s\" size=%d>Ésta es la primera 
				línea</FONT>",$matriz_fuentes[0][0],
				$matriz_fuentes[0][1]);
				
	echo "<P>"; //Nuevo párrafo
	printf("<FONT face=\"%s\" size=%d>Ésta es la segunda 
				línea</FONT>",$matriz_fuentes[1][0],
				$matriz_fuentes[1][1]);
				
	echo "<P>"; //Nuevo párrafo
	printf("<FONT face=\"%s\" size=%d>Ésta es la tercera 
				línea</FONT>",$matriz_fuentes[2][0],
				$matriz_fuentes[2][1]);
						
?>

	</DIV></BODY>
</HTML>