<HTML>
	<HEAD><TITLE>Ejemplo 6 - Unidad 1 - Curso Iniciación de PHP 5</TITLE></HEAD>
	<BODY><DIV style="text-align: center;">
	<HR><H1>Conversor de moneda</H1><HR>

	<TABLE BORDER=2 align=center>
	<TR>
		<TH> Moneda</TH>
		<TH> Tasa de Cambio </TH>
		<TH> Resultado </TH>
	</TR>	
<?php
	$nume_euros=50; //queremos convertir 50 euros
	
	echo "<BR>";   // Salto de línea para dejar un espacio entre el título y la tabla.
	echo "<P><H3> Cantidad en euros = $nume_euros<P>";
	
	$matriz_monedas =  array(0=>array(0=>"Chelín Austriaco",1=>13.76,2=>2),
							1=>array(0=>"Escudo Portugués",1=>200.48,2=>0),
							2=>array(0=>"Florín Holandés",1=>2.20,2=>2),
							3=>array(0=>"Franco Belga",1=>40.34,2=>0),
							4=>array(0=>"Franco Francés",1=>6.56,2=>2),
							5=>array(0=>"Franco Luxemburgués",1=>40.34,2=>0),
							6=>array(0=>"Libra Irlandesa",1=>0.79,2=>2),
							7=>array(0=>"Lira Italiana",1=>1936.27,2=>0),
							8=>array(0=>"Marco Alemán",1=>1.96,2=>2),
							9=>array(0=>"Marco Finlandés",1=>5.95,2=>2),
							10=>array(0=>"Peseta",1=>166.39,2=>2));



  	for ($i=0;$i<sizeof($matriz_monedas);$i++) /* Abrimos un bucle para repetir la operación el tamaño de la matriz
         En la Unidad 2 se estudia esta estructura de control.*/
  	{
      echo "<TR>";   // Nueva fila de tabla.
      $resultado=number_format(($nume_euros*$matriz_monedas[$i][1]),$matriz_monedas[$i][2],",",".");
      $moneda=number_format($matriz_monedas[$i][1],2,",",".");
      printf("<TD>%s</TD><TD>%s</TD><TD>%s</TD>",$matriz_monedas[$i][0],$moneda,$resultado);
         
      print "</TR>";
  }
?>

</TABLE>
</DIV></BODY>
</HTML>