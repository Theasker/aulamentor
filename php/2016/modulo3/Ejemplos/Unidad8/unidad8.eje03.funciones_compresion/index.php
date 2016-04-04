<?php

	print "<HTML>\n<HEAD><TITLE>Ejemplo 3 - Unidad 8 - Curso Iniciación de PHP 5</TITLE></HEAD>\n<BODY>";
  
	print("<CENTER><H1>Comprimir ficheros</H1></CENTER>
			<P>");

	$nombre_fichero_zip = "comprimido.txt.gz";
	
	if (file_exists($nombre_fichero_zip)) 
  		@unlink($nombre_fichero_zip) 
    		or die("No se puede borrar fichero comprimido. Compruebe que no 
    				lo tiene abierto con otra aplicación");
	
	echo "Nombre del fichero: <B>\"$nombre_fichero_zip\"</B>.<P>";
    
	$texto ="Éste es el texto del fichero que hemos comprimido.\n";
	$texto.="En esta segunda línea escribimos más texto.\n";
	$texto.="En esta tercera línea seguimos el texto.\n";
	$texto.="En esta cuarta línea acabamos el texto.\n";
  	print ("<H4>2.- Creamos la variable \$texto y le asignamos el 
			contenido siguiente:<PRE>$texto</PRE> para escribirlo 
			después en el fichero comprimido.</H4><P>");

	$fichero_zp = gzopen($nombre_fichero_zip,"w9");
	echo "<H4>3.- Con la orden \"\$fichero_zp = gzopen
			($nombre_fichero_zip, \"w9\");\" abrimos el fichero 
			anterior en modalidad de sólo escritura (w) con la 
			máxima compresión posible (9) y asignamos a la variable 
			\$fichero_zp el valor del manejador de este fichero, que 
			es el siguiente:</H4><P>";
	echo $fichero_zp."<P>";

	gzwrite($fichero_zp,$texto);
	print ("<H4>4.- Con la orden \"gzwrite(\$fichero_zp, \$texto);\" 
			escribimos en el fichero anterior de forma comprimida 
			el texto que hay en la variable \$texto.</H4><P>");

	gzclose($fichero_zp);
	print ("<H4>5.- Con la orden \"gzclose(\$fichero_zp);\" 
			cerramos el fichero comprimido en el que acabamos de 
			escribir.</H4><P>");

	$fichero_zp=gzopen($nombre_fichero_zip,"r");
	print ("<H4>6.- Con la orden \"\$fichero_zp = gzopen
			($nombre_fichero_zip, \"r\");\" abrimos el fichero 
			anterior en modalidad de sólo lectura (r) y asignamos 
			a la variable \$fichero_zp el valor del manejador de 
			este fichero, que es el siguiente:</H4><P>");
	echo  $fichero_zp."<P>";
  
	print ("<H4>7.- Con la orden \"print gzread(\$fichero_zp,7);\" 
			leemos los siete primeros caracteres y los mostramos en 
			la pantalla.</H4><P>");
	print gzread($fichero_zp,7)."<P>";
  
	gzseek($fichero_zp,25);
	print ("<H4>8.- Con la orden \"gzseek(\$fichero_zp,25);\" 
			movemos el puntero de lectura a la posición 25, 
			como puede verse con la orden \"gztell(\$fichero_zp)\"
			.</H4><P>");
	echo "El puntero de lectura está en la posición <B>".
			gztell($fichero_zp)."</B><P>";
  
	print ("<H4>9.- Con la orden \"gzpassthru(\$fichero_zp);\"
			leemos desde la posición 26 hasta el final del fichero 
			y mostramos su contenido en la pantalla.</H4><P>");
	print "<PRE>\n";
	gzpassthru($fichero_zp)."<P>";
	print "</PRE>";
	print ("<H4>10.- Con la orden \"gzrewind(\$fichero_zip);\" 
			llevamos el puntero de lectura al principio del fichero 
			y mostramos en la pantalla su contenido completo 
			comprobando a la vez si se produce algún error.
			</H4><P>");	
	gzrewind($fichero_zp);
	print "<PRE>";
	if (readgzfile($nombre_fichero_zip) != strlen($texto))
	{
		echo "Se ha producido algún error.<P>";
	}
	print "</PRE><P>";

	print ("<H4>11.- A continuación, leemos el texto del fichero
			con la función \"gzgetc()\" y lo cerramos.</H4><P>");
	print "<PRE>\n";
	gzrewind($fichero_zp);
	for ($i=0; !gzeof($fichero_zp); $i++)
	{
		print gzgetc($fichero_zp);
	}
	print "</PRE>";
	gzclose($fichero_zp);

	
	print "</BODY>\n</HTML>";

?>
