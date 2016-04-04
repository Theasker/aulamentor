<HTML>
<HEAD><TITLE>Ejemplo 9 - Unidad 2 - Curso Iniciación de PHP 5</TITLE></HEAD>
<BODY>
<H1> <CENTER>Números de 1 a 1.000 múltiplos de 4 </CENTER></H1><P>
<?php

$i=1;
$z=0;
$suma=0;

while ($i<1001)
   // Se abre un bucle que repite las operaciones 1000 veces.

{

	/* Con esta estructura se salta al principio del bucle 
	   sin ejecutar las intrucciones siguientes cuando 
	   el valor de $i contenga de 500 a 699.*/
	/*   if ($i > 499 and $i < 700)
	     {             
	        $i++;      
	        continue;  
	     }
	*/
      
     // Si el resto de dividir el número entre 4 es cero...    
     if ($i % 4 == 0)  
     {  
         printf("%04d -",$i);
        $z++;
        $suma+=$i;
     } // Aquí acaba la estructura condicional.

	/* Si la suma de los múltiplos de 4 es mayor de 100.000
	   Se sale del bucle. Este código está comentado.*/
	/*   if ($suma>100000) 
	         {break;}       
	*/
     $i++;

}   /* Aquí se cierra el bucle. Se abandona cuando 
    la variable $i valga 1.001.*/

?>

<CENTER>
<H2>Suma de estos números : 
    <?php printf("%06d",$suma); ?> 
<P>

En total hay 
    <?php echo $z; ?> 
números </CENTER></H2>
</BODY>
</HTML>
