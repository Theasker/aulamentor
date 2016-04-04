<HTML>
<HEAD>
<TITLE>Ejemplo 1a - Unidad 8 - Curso Iniciación de PHP 5</TITLE>
<STYLE type="text/css">
	<!--
	A {font-family: Arial; color: #00FF00}
	
	-->
</STYLE>
</HEAD>
<BODY>

<CENTER>
<HR>
  <H1>Funciones matemáticas</H1><P>
  <H2>Tipos de funciones</H2><P>
  <HR><P>
  <FONT face="Georgia, Times New Roman, Times, serif" size="3">
  	Haga click en el tipo de función para ver los ejemplos: </FONT>
  <P>
    
  <FONT face="Arial, Helvetica, sans-serif" color="#00FF00">
  
  <TABLE width="50%" border="0" cellpadding="2" cellspacing="2">
  <?php
	/* Definimos una matriz con las opciones del menú  */
	$matriz_opciones = array(1=>"Trigonométricas",
							2=>"Redondeos, máximos y mínimos",
							3=>"Exponentes y logaritmos",
							4=>"Números aleatorios");
							
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

