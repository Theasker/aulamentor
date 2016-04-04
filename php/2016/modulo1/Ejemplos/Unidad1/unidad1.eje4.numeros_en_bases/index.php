<HTML> 
<HEAD><TITLE>Ejemplo 4 - Unidad 1 - Curso Iniciación de PHP 5</TITLE></HEAD> 
<BODY> 

<DIV style="text-align: center;">  
<H3>TABLA DE LOS 20 PRIMEROS NÚMEROS EN DIFERENTES 
        BASES</H3> 
<TABLE BORDER="2" align=center> 
	<TR>
    <TH> &nbsp;&nbsp;Decimal&nbsp;&nbsp;</TH> 
    <TH> &nbsp;&nbsp;Binario&nbsp;&nbsp;&nbsp;</TH> 
    <TH> &nbsp;&nbsp;Octal&nbsp;&nbsp;&nbsp;</TH> 
    <TH> &nbsp;&nbsp;Hexadecimal&nbsp;&nbsp;</TH>
    </TR> 
     
<?php   // Aquí se inicia el código PHP. 

  echo "<BR>"; // Salto de línea para dejar un espacio entre 
              // el título y la tabla. 

  /* Abrimos un bucle para repetir la operación 20 veces. 
   En la Unidad 2 se estudia esta estructura de control.*/     
  for ($a=0;$a<21;$a++) 
  { 
      echo "<TR>";   // Nueva fila de tabla. 
      printf("<TD>&nbsp;%02d</TD><TD>&nbsp;%06b</TD> 
                <TD>&nbsp;%02o</TD><TD>&nbsp;%02X</TD>" 
                ,$a,$a,$a,$a); 
          /* Observa que en la cadena de formato, entre paréntesis, 
          hemos incluido los códigos HTML (<TD>&nbsp;...</TD>) 
          y la directiva (%02d, %06b, %02o y %02X) de cada una 
          de las formas de presentar el valor de la varible $a. */ 
          
      print "</TR>"; 
  } 

   /* Aquí acaba el código PHP. No podemos poner este comentario a 
   continuación del signo ?>, pues estaría fuera del código PHP.*/ 
?> 

</TABLE> 
</DIV> 
</BODY> 
</HTML> 
