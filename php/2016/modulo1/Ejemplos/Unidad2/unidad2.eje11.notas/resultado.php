<HTML>
	<HEAD><TITLE>Ejemplo 11b - Unidad 2 - Curso Iniciación de PHP 5</TITLE></HEAD>
	<BODY bgcolor="#66CCFF"><CENTER>
	<H1><FONT color="blue">Boletín de notas</FONT></H1>
  	<HR>

	<P><FONT face="Georgia, Times New Roman, Times, serif" size="3">El resultado obtenido por el alumno es:</FONT></P>

	<TABLE BORDER=2>
	<TR>
		<TD width=100 align="CENTER"><B><FONT color="blue"> Asignatura </FONT></B></TD>
		<TD width=100 align="CENTER"><B><FONT color="blue"> Trimestre 1 </FONT></B></TD>
		<TD width=100 align="CENTER"><B><FONT color="blue"> Trimestre 2 </FONT></B></TD>
		<TD width=100 align="CENTER"><B><FONT color="blue"> Trimestre 3 </FONT></B></TD>
		<TD width=100 align="CENTER"><B><FONT color="blue"> Media </FONT></B></TD>
	</TR>
<?php
	echo "<BR>";   // Salto de línea para dejar un espacio entre el título y la tabla.
	echo "<P>";
	
	require("literales.php");

	$matriz_notas =  array(0=>array(0=>asignatura1,1=>$_POST["asig1_1"],2=>$_POST["asig1_2"], 3=>$_POST["asig1_3"]),
			       1=>array(0=>asignatura2,1=>$_POST["asig2_1"],2=>$_POST["asig2_2"], 3=>$_POST["asig2_3"]),
			       2=>array(0=>asignatura3,1=>$_POST["asig3_1"],2=>$_POST["asig3_2"], 3=>$_POST["asig3_3"]),
			       3=>array(0=>asignatura4,1=>$_POST["asig4_1"],2=>$_POST["asig4_2"], 3=>$_POST["asig4_3"]),
			       4=>array(0=>asignatura5,1=>$_POST["asig5_1"],2=>$_POST["asig5_2"], 3=>$_POST["asig5_3"]));

	$media_total=0.0;
  	for ($i=0;$i<sizeof($matriz_notas);$i++) /* Abrimos un bucle para repetir la operación el tamaño de la matriz
         En la Unidad 2 se estudia esta estructura de control.*/
  	{
      echo "<TR>";   // Nueva fila de tabla.
      $resultado=($matriz_notas[$i][1]+$matriz_notas[$i][2]+$matriz_notas[$i][3])/3;
      printf("<TD align=CENTER>%s</TD>", $matriz_notas[$i][0]);
      printf("<TD align=RIGHT>%s</TD>", la_nota($matriz_notas[$i][1]) );
      printf("<TD align=RIGHT>%s</TD>", la_nota($matriz_notas[$i][2]) );
      printf("<TD align=RIGHT>%s</TD>", la_nota($matriz_notas[$i][3]) );
      printf("<TD align=RIGHT>%s</TD>", la_nota($resultado) );
      $media_total+=$resultado;
         
      print "</TR>";
  	}
  echo "</TABLE><P><H3><B>";
  $media_total=$media_total/sizeof($matriz_notas);
  printf("La media total es <FONT color=blue> %s </FONT>", la_nota($media_total) );	 
  echo  "<BR><INPUT type='button' value='Volver a la página anterior'onClick='history.back()'>";
  
?>

</CENTER></BODY>
</HTML>