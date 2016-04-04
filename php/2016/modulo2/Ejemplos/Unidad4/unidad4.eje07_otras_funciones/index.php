<HTML>
<HEAD>
<TITLE>Ejemplo 7 - Unidad 4 - Curso Iniciación de PHP 5</TITLE>
	<STYLE type="text/css">
		<!--
		A {font-family: Arial; color: #00FF00}
	
		-->
	</STYLE>
</HEAD>
<BODY>

<CENTER>
<HR>
	<H1><FONT color="#006600"> Otras funciones de ficheros</FONT>
	</H1>
<HR><P>
  <FONT face="Georgia, Times New Roman, Times, serif" size="3">
  Haga click en el tipo de función para ver el resultado de los 
  ejemplos: </FONT><P>
    
  <TABLE width="75%" border="0" cellpadding="2" cellspacing="2">
    <TR> 
      <TD bgcolor="#333333"> 
        <P>
        <FONT face="Arial, Helvetica, sans-serif" color="#00FF00">
        <A href="index.php?tipo=1">Presentar los ficheros 
           de un directorio en una ventana desplegable
        </A></FONT></P>
      </TD>
    </TR>
    <TR> 
      <TD bgcolor="#333333"> 
        <P>
        <FONT face="Arial, Helvetica, sans-serif" color="#00FF00">
        <A href="index.php?tipo=2">Transformar un fichero de 
            tipo HTML en otro de texto
        </A></FONT></P>
      </TD>
    </TR>
  </TABLE>

</CENTER>


<?php

if (isset($_GET["tipo"])) {

	$directorio_trabajo = getcwd() ."/";
	chdir($directorio_trabajo);

	/* Presentar los ficheros de un directorio en una ventana desplegable */
	if ($_GET["tipo"]==1)
	{
	
	
	echo "<CENTER><H2>Presentar los ficheros de un directorio en una
			ventana desplegable</H2></CENTER><P>";
	echo "<H3>1.-Todos los ficheros de \"$directorio_trabajo\"
			</H3><P>";
	echo "<SELECT NAME=\"$directorio_trabajo\">";
	$puntero=opendir($directorio_trabajo);
	$fichero=readdir($puntero);  // sobrepasamos el directorio .
	$fichero=readdir($puntero);  // y ..
	while ($fichero)
	{
	      $fichero=readdir($puntero);
	      if (ereg("$",$fichero))
	
	      /* La función ereg() permite buscar cadenas coincidentes. 
	         Pertenece a las funciones para expresiones regulares, 
	         como eregi() y split(), entre otras. */
	         
	      // Aquí usamos la función is_dir para mostrar sólo los ficheros 
	      // que no sean directorios
	      if (!is_dir($fichero))
	       echo "<OPTION VALUE='$fichero'> $fichero </OPTION>";
	}
	echo "</SELECT>";
	
	echo "<H3>2.-Sólo los de tipo php</H3><P>";
	echo "<SELECT NAME=\"$directorio_trabajo\">";
	$puntero=opendir($directorio_trabajo);
	$fichero=readdir($puntero);
	while ($fichero)
	{
	      $fichero=readdir($puntero);
	      if (ereg("php$",$fichero))
	         echo "<OPTION VALUE='$fichero'> $fichero </OPTION>";
	}
	echo "</SELECT></CENTER>";
	
	echo "<H3>3.-Sólo los de tipo txt</H3><P>";
	
	echo "<SELECT NAME=\"$directorio_trabajo\">";
	$puntero=opendir($directorio_trabajo);
	$fichero=readdir($puntero);
	while ($fichero)
	{
	      $fichero=readdir($puntero);
	      if (ereg("txt$",$fichero))
	         echo "<RIGHT><OPTION VALUE='$fichero'> $fichero </OPTION>";
	}
	echo "</SELECT>";
	
	} // END Presentar los ficheros
	
	else  
	
	/* Transformar un fichero de tipo HTML en otro de texto */
	if ($_GET["tipo"]==2)
	{
	
	echo "<CENTER><H3>Transformamos uni4_eje7_fichero.html
	     en otro tipo texto mostrando en la pantalla <P>las líneas del nuevo
		 fichero, que ya no contiene etiquetas HTML.</H3></CENTER><P>";
	chdir($directorio_trabajo);
	$origen_html=fopen("uni4_eje7_fichero.html","r");
	echo "<P>Abrimos el fichero '".$directorio_trabajo."\uni4_eje7_fichero.html' es sólo escritura.";
	$destino_txt=@fopen("uni4_eje7_fichero.txt","w")
	    or die ("No se puede crear el fichero destino.");
	echo "<P>Escribimos el fichero de texto en el fichero '".$directorio_trabajo."\uni4_eje7_fichero.txt'.";
	while (!feof($origen_html))
	{
	      $linea=fgetss($origen_html,256,"");
	      echo "$linea <P>";
	      fputs($destino_txt,trim($linea)."\n");
	}
	fclose($origen_html);
	fclose($destino_txt);
	}//END Transformar un fichero de tipo HTML en otro de texto

} //END if $_GET["tipo"]

?>

</BODY>
</HTML>