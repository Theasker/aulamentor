<HTML>
<HEAD>
<TITLE>Ejemplo 4 - Unidad 4 - Curso Iniciación de PHP 5</TITLE>
	<STYLE type="text/css">
		<!--
		A {font-family: Arial; color: #00FF00}
	
		-->
	</STYLE>
</HEAD>
<BODY>

<CENTER>
<HR>
	<H1><FONT color="#006600"> Copiar, borrar y renombrar un fichero</FONT></H1>

<HR><P>
  <FONT face="Georgia, Times New Roman, Times, serif" size="3">Haga clic
  en el tipo de función para ver el resultado de los ejemplos. Es importante que lo hagas por orden. </FONT>
  <P>

  <FONT face="Arial, Helvetica, sans-serif" color="#00FF00">    
  <TABLE width="75%" border="0" cellpadding="2" cellspacing="2">
    <TR> 
      <TD bgcolor="#333333"> 
        <A href="index.php?tipo=1">Copiar un fichero
        </A>
      </TD>
    </TR>
    <TR> 
      <TD bgcolor="#333333"> 
        <A href="index.php?tipo=2">Borrar ficheros 
        </A>
      </TD>
    </TR>
    <TR> 
      <TD bgcolor="#333333"> 
        <A href="index.php?tipo=3">Renombrar el fichero copiado
        </A>
      </TD>
    </TR>
    <TR> 
      <TD bgcolor="#333333"> 
        <A href="index.php?tipo=4">Conocer atributos, tamaño y 
        tipo del fichero renombrado</A>
      </TD>
    </TR>
  </TABLE>
  </FONT>


<?php

if (isset($_GET["tipo"])) {

	// Copiar, borrar y renombrar un fichero. Se usa el fichero Fichero.txt
	// que debe estar en la carpeta de este proyecto.
	
	$directorio_trabajo = getcwd();

	chdir($directorio_trabajo);

/******** Copiar un fichero *********/
if ($_GET["tipo"]==1)
{

	echo "<H1>Copiar un fichero</H1><P>
			<H3>Con la función copy() copiamos el fichero Fichero.txt 
			al fichero Nuevo.txt y vemos que ambos tienen los mismos 
			contenidos.</H3>";
			
	copy("Fichero.txt","Nuevo.txt");	
	
	echo "<H4>Contenido del fichero Fichero.txt</H4><P>";
	$id_fichero= @fopen("Fichero.txt","r") 
				or die("<B>El fichero \"Ficheros_3.txt\" no se ha podido 
								abrir.</B><P>");
	readfile('Fichero.txt');
	echo "<P>";
	fclose($id_fichero);
	echo "<H4>Contenido del fichero Nuevo.txt</H4><P>";
	$id_fichero= @fopen("Nuevo.txt","r") or die("<B>El fichero \"Nuevo.txt\" 
												no se ha podido abrir.</B><P>");
	readfile('Nuevo.txt');
	echo "<P>";
	fclose($id_fichero);

} // END Copiar un fichero

else  

/***** Borrar un fichero ******/
if ($_GET["tipo"]==2)
{
	echo "<H1>Borrar un fichero</H1><P>
			<H3>Con la función unlink() borramos el fichero Nuevo.txt.
			</H3>";
	if (file_exists("Nuevo.txt")) unlink("Nuevo.txt");
	else echo "ERROR: El fichero Nuevo.txt no existe. Haz copia con opción 1.";
	if (file_exists("Ficheros_3.txt")) unlink("Ficheros_3.txt");
	echo "<P>";

} // END Borrar un fichero

else  

/***** Renombrar un fichero ******/
if ($_GET["tipo"]==3){
	
	echo "<H1>Renombrar un fichero</H1><P>
			<H3>Con la función rename() renombramos el fichero Nuevo.txt 
			y lo denominamos Ficheros_3.txt.</H3>";
	if (file_exists("Nuevo.txt")) {
   		rename("Nuevo.txt","Ficheros_3.txt");
		echo "<P>";
		echo "<H4>El fichero Nuevo.txt renombrado a Ficheros_3.txt tiene este contenido:</H4><P>";
		$id_fichero= @fopen("Ficheros_3.txt","a") 
						or die("<B>El fichero \"Ficheros_3.txt\" no se 
									ha podido abrir.</B><P>");
		readfile('Ficheros_3.txt');
		echo "<P>";
		fclose($id_fichero);
	} else echo "<P>ERROR: no existe el fichero Nuevo.txt. Haz la copia con la opción 1.";
} // END Renombrar un fichero

else  

/***** Conocer atributos, tamaño y tipo de un fichero ******/
if ($_GET["tipo"]==4)
{

	echo "<H1>Tamaño, tipo y atributos de un fichero</H1><P>";
	if (file_exists("Ficheros_3.txt"))
	{
		echo "<H4>El fichero Ficheros_3.txt existe y tiene estas
				características:</H4><P>";
		$tama=filesize("Ficheros_3.txt");
		echo "Tamaño: <B>$tama</B> bytes.<P>";
		$tipo=filetype("Ficheros_3.txt");
		echo "Tipo de fichero: <B>$tipo.</B><P>";
		
		if (is_dir("Ficheros_3.txt")) 
			echo "<B>Es el nombre de un directorio.</B><P>";
		else echo "<B>No es el nombre de un directorio.</B><P>";
		if (is_executable("Ficheros_3.txt")) 
			echo "<B>Es un fichero que el usuario puede ejecutar.</B><P>";
		else echo "<B>No es un fichero que el usuario pueda ejecutar.</B><P>";
		if (is_file("Ficheros_3.txt")) 
			echo "<B>Es un fichero normal.</B><P>";
		else echo "<B>No es un fichero normal.</B><P>";
		if (is_link("Ficheros_3.txt")) 
			echo "<B>Es un enlace simbólico.</B><P>";
		else echo "<B>No es un enlace simbólico.</B><P>";
		if (is_writable("Ficheros_3.txt")) 
			echo "<B>Se puede escribir en este fichero.</B><P>";
		else echo "<B>No se puede escribir en este fichero.</B><P>";
		if (is_readable("Ficheros_3.txt")) 
			echo "<B>Se puede leer este fichero.</B><P>";
		else echo "<B>No se puede leer este fichero.</B><P>";

		$estado=stat("Ficheros_3.txt");
		$contenido=array ("Dispositivo:","i-nodo:","Permisos:",									
				"Número de enlace:", "Propietario:",
				"Grupo:", "Tipo de dispositivo:","Tamaño:", 
				"Instante del último acceso:",
				"Instante de la última modificación:",
				"Instante del último cambio:","Tamaño del bloque:",
				"Número de bloques asignados:");

		echo "<H3>Miramos ahora el estado de este fichero.
				<P></H3>";
		$numero_elementos=count($contenido);
		for ($i=0; $i < $numero_elementos-1; $i++)
		{
    		echo "$contenido[$i] <B>$estado[$i]</B><P>";
		}
	}
	else
    echo "ERROR: el fichero Ficheros_3.txt no existe. Usa la opción 3 para crearlo.<P>";
} //END Conocer atributos, tamaño y tipo de un fichero

}//END si existe variable $_GET["tipo"]

?>
</CENTER>
</BODY>
</HTML>

