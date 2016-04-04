<HTML>
<HEAD><TITLE>Ejemplo 6 - Unidad 2 - Curso Iniciación de PHP 5</TITLE></HEAD>
<BODY>
<?php

$variable="89.53Pepe es madrileño";
echo "La variable \$variable contiene la cadena \"$variable\".";
echo "<P>";
echo 'La función doubleval() devuelve el valor '.doubleval($variable);
echo "<P>";
echo 'La función intval() devuelve el valor '.intval($variable)." en base 10.";
echo "<P>";

     
?>
</BODY>
</HTML>