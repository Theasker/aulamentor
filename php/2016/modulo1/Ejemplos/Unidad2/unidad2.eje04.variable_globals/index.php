<HTML>
<HEAD><TITLE>Ejemplo 4 - Unidad 2 - Curso Iniciación de PHP 5</TITLE></HEAD>
<BODY>
<?php

// Asignamos a las variables $v y $x los valores 3 y 6 respectivamente.
// Observa que no las declaramos como globales, luego son locales.
$x = 3; 
$y = 6; 

   Function Sumar()
   {
   		/* Observa que las variables $v, $x y $z no son declaradas
   	 	como globales pero accedemos a ellas globalmente mediante
   		la matriz $GLOBALS.*/
      	$GLOBALS["z"] = $GLOBALS["x"] * $GLOBALS["y"];
   }

Sumar();

echo "La variable \$x=3 multiplicada por la variable \$y=6
      produce el resultado 18, que asignamos a la variable \$z.";
echo "<BR>";
echo "<BR>";
echo "Luego \$z vale $z.";

?>
</BODY>
</HTML> 
