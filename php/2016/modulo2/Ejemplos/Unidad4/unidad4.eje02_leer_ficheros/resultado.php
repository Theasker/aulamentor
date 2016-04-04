<HTML>
<HEAD><TITLE>Ejemplo 2b - Unidad 4 - Curso Iniciación de PHP 5</TITLE>
<style type="text/css">
  table, td, th
	{border:1px solid green;}
	th
	{background-color:green;
	color:white;}
	td.col1 { font-size:20px; color:green; text-align:center;}
	td.col2-3 { font-size:20px; color:black; text-align:left;}
  </style>
</HEAD>
<BODY>
<TABLE border=1><TR><th>Operación</th><th>Descripción</th><th>Resultado</th></TR>

<?php

	// Recorrer un fichero y leer su contenido. Se usan los mismos
	// ficheros que en el ejemplo anterior Fichero_1.php, Fichero_2.txt
	// y Fichero_3.txt, están en el directorio del proyecto.

	// Con getcwd() obtenemos el directorio de trabajo
	$directorio_trabajo = getcwd();
	// OPERACION 1: establecemos directorio de trabajo
	echo "<TR><TD class=col1>1</TD><TD class=col2-3>En primer lugar, fijamos como directorio por defecto
			\"$directorio_trabajo\" ya que en él están los ficheros de tipo
			txt o php con los que vamos a practicar. <P>El alumno debe
			fijar aquí su propio directorio de trabajo.</TD>";

	if (chdir($directorio_trabajo)) echo "<TD class=col2-3>La operación se ha realizado correctamente</TD></TR>";
	else echo "<TD class=col2-3>Error: la operación NO se ha realizado correctamente</TD></TR>";

/******** Recorrer un fichero *********/
if ($_GET["tipo"]==1)
{
	// OPERACION 2: recorremos un fichero de texto
	echo "<TR><TD class=col1>2</TD><TD class=col2-3>Recorrer un fichero.<P> En segundo lugar, abrimos el fichero 
			\"Ficheros_1.php\" en modo de sólo lectura.</TD>";
     
	$fichero="Ficheros_1.php";
	$id_fichero= @fopen("Ficheros_1.php","r")
				or die("<TD class=col2-3>El fichero \"Ficheros_1.php\" no se ha podido 
						abrir.</TD></TR>");
	echo "<TD class=col2-3>La operación se ha realizado correctamente</TD></TR>";
	
	// OPERACION 3: Movemos posición del puntero en el fichero
	echo "<TR><TD class=col1>3</TD><TD class=col2-3>En tercer lugar, colocamos el puntero en la primera
			posición del fichero \"Ficheros_1.php\" con la función rewind(),
			aunque no hace falta, pues ya lo está.</TD>";
	if (rewind($id_fichero)) echo "<TD class=col2-3>La operación se ha realizado correctamente</TD></TR>";
	else echo "<TD class=col2-3>ERROR: la operación NO se ha realizado correctamente</TD></TR>";

	// OPERACION 4: Movemos puntero de nuevo 
	echo "<TR><TD class=col1>4</TD><TD class=col2-3>En cuarto lugar, movemos el puntero 75 caracteres
			(bytes) adelante desde el principio con la función fseek().
			</TD>";
	if (fseek($id_fichero,75)==0) echo "<TD class=col2-3>La operación se ha realizado correctamente</TD></TR>";
	else echo "<TD class=col2-3>ERROR: la operación NO se ha realizado correctamente</TD></TR>";
	
	// OPERACION 5: mostramos la posición actual del puntero
	echo "<TR><TD class=col1>5</TD><TD class=col2-3>En quinto lugar, preguntamos en qué posición
			está el puntero con la función ftell().</TD>";
	$puntero=ftell($id_fichero);
	echo "<TD class=col2-3>El puntero está en la posición $puntero.</TD></TR>";

	// OPERACION 6: movemos puntero de forma relativa
	fseek($id_fichero,ftell($id_fichero)+10);
	echo "<TR><TD class=col1>6</TD><TD class=col2-3>En sexto lugar, movemos de forma relativa
			el puntero combinando las funciones fseek() y ftell()
			haciendo que avance 10 posiciones, y decimos de nuevo
			dónde ha quedado.</TD>";
	$puntero=ftell($id_fichero);
	echo "<TD class=col2-3>El puntero ahora ha pasado a la posición $puntero.</TD></TR>";
	
	// OPERACION 7: movemos puntero posicion 3000
	echo "<TR><TD class=col1>7</TD><TD class=col2-3>En séptimo lugar, movemos el puntero a la posición
		3.000, que no tiene, con la función fseek() y comprobamos qué 
		valor lógico devuelve la función feof().</TD>";

	fseek($id_fichero,3000);  

	if (!feof($id_fichero))
	{
   		echo "<TD class=col2-3>El fichero no tiene 3.000 caracteres.</TD></TR>";
	}
	else
	{
     	echo "<TD class=col2-3>El fichero tiene al menos 3.000 caracteres.</TD></TR>";
	}
	
	// OPERACION 8: cerramos el fichero
	echo "<TR><TD class=col1>8</TD><TD class=col2-3>Finalmente, con la función fclose() cerramos el
			fichero abierto que hemos estado usando.</TD>";
	if (fclose($id_fichero)) echo "<TD class=col2-3>La operación se ha realizado correctamente</TD></TR>";
	else echo "<TD class=col2-3>ERROR: la operación NO se ha realizado correctamente</TD></TR>";
	
} // END Recorrer un fichero

else  

/***** Leer el contenido de un fichero ******/
if ($_GET["tipo"]==2)
{
	
	// OPERACION 1: leemos contenido fichero
	echo "<TR><TD class=col1>1</TD><TD class=col2-3>Leer el contenido de un fichero<P>
			<H3>Abrimos ahora el fichero \"Ficheros_3.txt\"
			en modo de sólo lectura, para leer del mismo sus 84 primeros
			caracteres con la función fread().</TD>";
	$fichero="Ficheros_3.txt";
	$id_fichero= @fopen("Ficheros_3.txt","r")
             		or die("<TD class=col2-3>El fichero \"Ficheros_3.txt\" no
             				se ha podido abrir.</TD></TR>");
	$texto=fread($id_fichero,85);
	print ("<TD class=col2-3>El contenido de los 84 primeros caracteres es: <B>$texto</B><P>");
	$texto=fread($id_fichero,10);
	print ("El contenido de los 9 siguientes caracteres es: <B>$texto</B></TD></TR>");
	
	// OPERACION 2: movemos posicion puntero al principio fichero y leemos caracteres
	echo "<TR><TD class=col1>2</TD><TD class=col2-3>Ahora llevamos el puntero al comienzo del fichero
			y volvemos a leer del mismo sus 84 primeros caracteres con la 
			función fgets() para ver que sólo se lee hasta el final de 
			línea.</TD>";
	rewind($id_fichero);
	$texto=fgets($id_fichero,85);
	print ("<TD class=col2-3>El contenido de los 84 primeros caracteres es: <B>$texto
			</B>, pero sólo se muestra los que hay en una línea.</TD></TR>");
	
	// OPERACION 3: leemos todas las líneas de un fichero
	echo "<TR><TD class=col1>3</TD><TD class=col2-3>Con esta misma función podemos recorrer el fichero línea 
			a línea de esta forma:</TD><TD class=col2-3>";
	rewind($id_fichero);
	while (!feof($id_fichero))
	{
		$linea=fgets($id_fichero,256);
		echo "<B>$linea </B><P>";
	} 
	echo "</TD></TR>";
	
	// OPERACION 4: desplazamos puntero y leemos
	echo "<TR><TD class=col1>4</TD><TD class=col2-3>Ahora desplazamos el puntero 50 posiciones
			adelante y leemos los 14 caracteres siguientes.</TD>";
	rewind($id_fichero);
	fseek($id_fichero,ftell($id_fichero)+50);
	$posicion1=ftell($id_fichero);
	$texto=fread($id_fichero,15);
	$posicion2=(ftell($id_fichero)-2);
	print ("<TD class=col2-3>El contenido de los caracteres comprendidos entre la
			posición <B>$posicion1</B> y la posición <B>$posicion2</B>
			es: <B>$texto</TD></TR>");
	
	// OPERACION 5: nueva lectura de caracteres
	echo "<TR><TD class=col1>5</TD><TD class=col2-3>Ahora desplazamos el puntero 2 posiciones
			hacia atrás y leemos sólo el carácter de esa posición,
			que es sobre la que queda el puntero, con la función
			fgetc().</TD>";
	fseek($id_fichero,ftell($id_fichero)-3);
	$posicion1=ftell($id_fichero);
	$texto=fgetc($id_fichero);
	print ("<TD class=col2-3>El contenido del carácter que está en la posición
			<B>$posicion1</B> es: <B>$texto</B></TD></TR>");
	
	// OPERACION 6: abrimos fichero HTML
	echo "<TR><TD class=col1>6</TD><TD class=col2-3>Ahora abrimos el fichero \"Ficheros_4.txt\",
			que contiene códigos HTML, para ver que leyendo su 
			3000 primeros caracteres con fread() se leen e interpretan 
			todas las etiquetas propias de este lenguaje.</TD>";
	$fichero="Ficheros_4.txt";
	$id_fichero= @fopen("Ficheros_4.txt","r")
				or die("<TD class=col2-3><B>El fichero \"Ficheros_4.txt\" no se ha 
						podido abrir.</B></TD></TR>");
	$texto=fread($id_fichero,3000);
	print ("<TD class=col2-3><B>$texto</B></TD></TR>");
	
	// OPERACION 7: leer contenido primera línea
	rewind($id_fichero);
	$texto=fgetss($id_fichero,3000);
	print ("<TR><TD class=col1>7</TD><TD class=col2-3>En cambio, el contenido de la primera línea del fichero
			leída con la función fgetss() es: <P><B>$texto</B><P>");
	echo "<CENTER><H3>Con esta misma función podemos recorrer el fichero
			línea a línea sin las etiquetas de HTML de esta forma:</TD>";
	rewind($id_fichero);
	echo "<TD class=col2-3>";
	while (!feof($id_fichero))
	{
		$linea=fgetss($id_fichero,256);
		echo "<B>$linea </B><P>";
	}
	echo "</TD></TR>";

	// OPERACION 8: leemos fichero a matriz
	echo "<TR><TD class=col1>8</TD><TD class=col2-3>Con la función file() podemos crear una matriz que 
			contiene los elementos siguientes:</TD>";

	$fichero="Ficheros_3.txt";
	$matriz=file($fichero);
	echo "<TD class=col2-3>";
	for ($i=0;$i<count($matriz);$i++)
	{
		print ("<B> Elemento $i:</B> $matriz[$i]<P>");
	}
	echo "</TD></TR>";
	
	// OPERACION 9: pasamos contenido a la página
	$id_fichero= @fopen("Ficheros_3.txt","r")
				or die("<B>El fichero \"Ficheros_3.txt\" no
						se ha podido abrir.</B><P>");
	echo "<TR><TD class=col1>9</TD><TD class=col2-3>Con la función readfile() podemos leer el contenido
			de un fichero y enviarlo a la página del cliente. Aparecerá de la
			forma siguiente:</TD>";
	echo "<TD class=col2-3>";
	readfile('Ficheros_3.txt');
	echo "</TD></TR>";

	// OPERACION 10: pasamos contenido página cliente
	echo "<TR><TD class=col1>10</TD><TD class=col2-3>Con la función fpassthru() también podemos leer el
			contenido del fichero Ficheros_3.txt y enviar su contenido a la
			página del cliente. Aparacerá de la forma siguiente:</TD><TD class=col2-3>";
	fpassthru($id_fichero);
	echo "</TD></TR>";

} // END Leer el contenido de un fichero

?>
</TABLE>
</BODY>
</HTML>
