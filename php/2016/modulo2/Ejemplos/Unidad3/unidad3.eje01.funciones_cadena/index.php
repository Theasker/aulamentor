<HTML>
<HEAD>
<TITLE>Ejemplo 1a - Unidad 3 - Curso Iniciación de PHP 5</TITLE>
<STYLE type="text/css">
	<!--
	A {font-family: Arial; color: #00FF00}
	
	-->
</STYLE>
</HEAD>
<BODY>

<CENTER>
<HR>
  <H1><FONT color="#006600">Ejemplos de funciones de cadenas</FONT></H1>
  <HR><P>
  <FONT face="Georgia, Times New Roman, Times, serif" size="3">
  	Haga click en el tipo de función para ver los ejemplos: </FONT>
  <P>
    
  <FONT face="Arial, Helvetica, sans-serif" color="#00FF00">
  
  <TABLE width="50%" border="0" cellpadding="2" cellspacing="2">
  <?php
	/* Definimos una matriz con las opciones del menú  */
	$matriz_opciones = array(1=>"Adaptar las cadenas al contexto",
							2=>"Limpiar cadenas de caracteres",
							3=>"Mayúsculas y minúsculas",
							4=>"Longitud de una cadena",
							5=>"Repetir y Modificar una cadena",
							6=>"Buscar/Sustituir en el interior de una cadena ",
							7=>"Trabajar con subcadenas",
							8=>"Invertir el texto de una cadena",
							9=>"Separar una cadena de texto",
							10=>"Pasar datos desde una cadena",
							11=>"Comparar cadenas",
							12=>"Carácter ASCII",
							13=>"Código ASCII",
							14=>"Dar formato a un número",
							15=>"Otras funciones");
							
	for ($i=1; $i<=sizeof($matriz_opciones); $i++) {						
	 echo ' <TR> 
			  <TD bgcolor="#333333"> 
				<A href="resultado.php?tipo='.$i.'">'. $matriz_opciones[$i].'
				</A>
			  </TD>
			</TR>';
	}
							
  ?>
   
  </TABLE>
  </FONT>

</CENTER>
</BODY>
</HTML>

