<HTML>
<HEAD><TITLE>Ejemplo 3 - Unidad 1 - Curso Iniciación de PHP 5</TITLE></HEAD>
<BODY>

<?php // Aquí se inicia el código PHP.

  print "<H1><CENTER>Uso de la orden print. Funciona como echo.</H1>
             </CENTER><H2>";
  /* Mostramos el texto anterior con un tamaño de letra grande 
     y centrado.*/
  $pares=0;
  
  /* Abrimos un bucle para repetir la operación 20 veces.
  En la Unidad 2 se estudia esta estructura de control.*/
  for (;$pares<40;) 
  {
	print " -- $pares "; // Observa que la variable se expande.
	if ($pares==40)      // Si la variable $pares vale 40...
		break;          // Salimos del bucle.
		$pares+=2;      // Sumamos 2 al valor actual de la variable.
   	}

   print "</H2><P><H3>&nbsp;&nbsp;&nbsp;&nbsp; Relación de los 20 
   			primeros números pares.</H3>";
     /* Mostramos el texto anterior con un tamaño de letra pequeño.
     Como HTML sólo respeta un espacio en blanco, con el comando
     &nbsp; hacemos que la frase deje 5 espacios a la izquierda. */

   /* Aquí acaba el código PHP. No podemos poner este comentario a
   continuación del signo ?>, pues estaría fuera del código PHP.*/
?>

</BODY>
</HTML>


