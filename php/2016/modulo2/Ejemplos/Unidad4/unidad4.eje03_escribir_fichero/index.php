<HTML>
<TITLE>Ejemplo 3 - Unidad 4 - Curso Iniciación de PHP 5</TITLE>
<HEAD>
	<STYLE type="text/css">
		<!--
		A {font-family: Arial; color: #00FF00}
	
		-->
	</STYLE>
</HEAD>
<BODY>

<CENTER>
<HR>
  <H1><FONT color="#006600">Modificar el contenido de un fichero</FONT></H1>
  <HR><P>
		<H3>Abrimos el fichero Fichero.txt, que suponemos vacío,
			en diversos modos de escritura para ver lo que ocurre en cada caso 
			si escribimos en el mismo el texto \"Verde que te quiero verde\", 
			más la fecha y hora de escritura, más los códigos de salto de línea, 
			que no se ven al mostrase el contenido de fichero, pero sí se 
			ejecutan al añadirlo.
		</H3><P>
  <FONT face="Georgia, Times New Roman, Times, serif" size="3">Haga click en el 
  tipo de función para ver el resultado de los ejemplos: </FONT>
  <P>
    
  <FONT face="Arial, Helvetica, sans-serif" color="#00FF00">
  <TABLE width="75%" border="0" cellpadding="2" cellspacing="2">
    <TR> 
      <TD bgcolor="#333333"> 
        <A href="index.php?tipo=1">Con los modos de apertura "a" y "a+"
        </A>
      </TD>
    </TR>
    <TR> 
      <TD bgcolor="#333333"> 
        <A href="index.php?tipo=2">Con el modo de apertura "r+"
          </A>
      </TD>
    </TR>
    <TR> 
      <TD bgcolor="#333333"> 
        <A href="index.php?tipo=3">Con los modos de apertura "w" y "w+"
          </A>
      </TD>
    </TR>
    <TR> 
      <TD bgcolor="#333333"> 
        <A href="index.php?tipo=4">Función fwrite() con los modos 
        de apertura "a" y "a+"</A>
      </TD>
    </TR>
  </TABLE>
  </FONT>

</CENTER>

<?php


if (isset($_GET["tipo"])) {

	// Abrir un fichero y modificar su contenido. Se usa el fichero
	// Fichero.txt que debe estar en C:\CursoPHP5\curso\Alumnos\ficheros_del_curso.
	
	// Con getcwd() obtenemos el directorio de trabajo
	$directorio_trabajo = getcwd();
	chdir($directorio_trabajo);

/******** Con los modos de apertura "a" y "a+" *********/
if ($_GET["tipo"]==1)
{
	$fichero="Fichero.txt";
	$id_fichero= @fopen("Fichero.txt","a")
				or die("<B>El fichero \"Fichero.txt\" no se ha podido 
						abrir.</B><P>");
	echo "<H3><B>1.- Con los modos \"a\" y \"a+\" de apertura, después de 
			ejecutarse la función fputs(), el fichero contiene:</B></H3><P>";
	fputs($id_fichero,"Verde que te quiero verde ".date("d/m/Y - G:i:s")
			.chr(13).chr(10)); // chr(13) ychr(10) producen un salto de línea.
	fclose($id_fichero); // Lo cerramos para que se ponga la marca de final
                      	 // de fichero. Luego, lo abrimos en modo de sólo
                      	 // lectura para ver su contenido.
	$id_fichero= @fopen("Fichero.txt","r")
             		or die("<B>El fichero \"Fichero.txt\" no se ha podido 
             				abrir.</B><P>");
	while (!feof($id_fichero))
	{
		$linea=fgets($id_fichero,256);
		echo "<B>$linea </B><P>";
	}
	echo "<H3><B>Observa que el texto se añade al final del fichero.
			Actualizando varias veces la página web puedes comprobarlo.
			</B></H3><P>";

} // END Con los modos de apertura "a" y "a+"

else  

/***** Con el modo de apertura "r+" ******/
if ($_GET["tipo"]==2)
{

	$fichero="Fichero.txt";
	$id_fichero= @fopen("Fichero.txt","r+")
				or die("<B>El fichero \"Fichero.txt\" no se ha 
						podido abrir.</B><P>");
	echo "<H3><B>2.- Con el modo \"r+\" de apertura, después de ejecutarse
			la función fputs(), el fichero contiene:</B></H3><P>";
	fputs($id_fichero,"Verde que te quiero verde ".date("d/m/Y - G:i:s").
				chr(13).chr(10)); //chr(13) y chr(10) producen un salto de línea.
	fclose($id_fichero); // Lo cerramos para que se ponga la marca de final
					 // de fichero. Luego, lo abrimos en modo de sólo
					 // lectura para ver su contenido.
	$id_fichero= @fopen("Fichero.txt","r")
             	or die("<B>El fichero \"Fichero.txt\" no se ha podido 
             				abrir.</B><P>");
	while (!feof($id_fichero))
	{
		$linea=fgets($id_fichero,256);
		echo "<B>$linea </B><P>";
	}
	echo "<H3><B>Observa que el texto se añade al principio del fichero
			sustituyendo la primera línea y conservando las restantes.
			Actualizando varias veces la página web puedes comprobarlo.
			</B></H3><P>";


} // END Con el modo de apertura "r+"

else  

/***** Con los modos de apertura "w" y "w+". ******/
if ($_GET["tipo"]==3)
{
	$fichero="Fichero.txt";
	$id_fichero= @fopen("Fichero.txt","w")
				or die("<B>El fichero \"Fichero.txt\" no se ha podido 
							abrir.</B><P>");
	echo "<H3><B>3.- Con los modos \"w\" y \"w+\" de apertura, después de
			ejecutarse la función fputs(), el fichero contiene:</B></H3><P>";
	fputs($id_fichero,"Verde que te quiero verde ".date("d/m/Y - G:i:s").
			chr(13).chr(10)); // chr(13) y chr(10) producen un salto de línea.
	fclose($id_fichero); // Lo cerramos para que se ponga la marca de final
					 // de fichero. Luego, lo abrimos en modo de sólo
					 // lectura para ver su contenido.
	$id_fichero= @fopen("Fichero.txt","r")
				or die("<B>El fichero \"Fichero.txt\" no se ha podido 
						abrir.</B><P>");
	while (!feof($id_fichero))
	{
		$linea=fgets($id_fichero,256);
		echo "<B>$linea</B><P>";
	}
	echo "<H3><B>Observa que el texto se escribe sustituyendo por completo
			el contenido anterior del fichero si lo tenía. Actualizando varias 
			veces la página web puedes comprobarlo.</B></H3><P>";

} // END Con los modos de apertura "w" y "w+"

else  

/***** Función fwrite() con los modos de apertura "a" y "a+" ******/
if ($_GET["tipo"]==4)
{

	$fichero="Fichero.txt";
	$id_fichero= @fopen("Fichero.txt","a")
				or die("<B>El fichero \"Fichero.txt\" no se ha podido 
						abrir.</B><P>");
	echo "<H3><B>4.- Con los modos \"a\" y \"a+\" de apertura, después de
			ejecutarse la función fwrite(), el fichero contiene:</B></H3><P>";

	fwrite($id_fichero,"Verde que te quiero verde ".date("d/m/Y - G:i:s")
			.chr(13).chr(10)); // chr(13) y chr(10) producen un salto de línea.
	fclose($id_fichero);// Lo cerramos para que se ponga la marca de final
                      	// de fichero. Luego, lo abrimos en modo de sólo
                      	// lectura para ver su contenido.
	$id_fichero= @fopen("Fichero.txt","r")
				or die("<B>El fichero \"Fichero.txt\" no se ha podido 
						abrir.</B><P>");
	while (!feof($id_fichero))
	{
		$linea=fgets($id_fichero,256);
		echo "<B>$linea </B><P>";
	}
	echo "<H3><B>Observa que con la función fwrite() el texto se añade al
			final del fichero. Actualizando varias veces la página web puedes
			comprobar que se comporta como fputs().</B></H3><P>";

} // END Función fwrite() con los modos de apertura "a" y "a+"

}//END si existe variable $_GET["tipo"]

?>
</BODY>
</HTML>

