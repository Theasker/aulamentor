<HTML>
<HEAD>
<TITLE>Ejemplo 3a - Unidad 3 - Curso Iniciación de PHP 5</TITLE>
<STYLE type="text/css">
	<!--
	A {font-family: Arial; color: #00FF00}
	
	-->
</STYLE>
</HEAD>
<BODY>

<CENTER>
<HR>
  <H1><FONT color="#006600">Funciones con matrices</FONT></H1>
  <HR><P>
  <FONT face="Georgia, Times New Roman, Times, serif" size="3">
  	Haga click en el tipo de función para ver los ejemplos: </FONT>
  <P>
    
  <FONT face="Arial, Helvetica, sans-serif" color="#00FF00">
  
  <TABLE width="50%" border="0" cellpadding="2" cellspacing="2">
  <?php
	/* Definimos una matriz con las opciones del menú  */
	$matriz_opciones = array(1=>"Crear e inicializar matrices",
							2=>"Recorrer los elementos de una matriz",
							3=>"Matrices y cadenas de caracteres",
							4=>"Ordenar matrices",
							5=>"Modificar matrices",
							6=>"Extraer información de las matrices",
							7=>"Tratar matrices como si fueran pilas",
							8=>"Otras funciones");
							
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

