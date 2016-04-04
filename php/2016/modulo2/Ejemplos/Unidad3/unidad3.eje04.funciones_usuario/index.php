<HTML>
<HEAD><TITLE>Ejemplo 4 - Unidad 3 - Curso Iniciación de PHP 5</TITLE></HEAD>
<BODY>

<?php

// Funciones creadas por el usuario

echo "<H1><CENTER>Funciones creadas por el usuario</H1></CENTER><P>";
function ver_cuadrado_y_doble($num)
{
         $cuadrado=($num*$num);
         $doble=($num*2);
         echo "El cuadrado de <B>$num</B> es <B>$cuadrado</B>
              y el doble es <B>$doble</B>.<P>";
}
echo "<H3><CENTER>La función de usuario ver_cuadrado_y_doble(\$num)
     recibe un número y calcula y muestra su cuadrado y su doble.
     </H3></CENTER>";

$num1=4;
ver_cuadrado_y_doble($num1);
$num2=5;
ver_cuadrado_y_doble($num2);
$num3=6;
ver_cuadrado_y_doble($num3);
$num4=7;
ver_cuadrado_y_doble($num4);

echo "<H3><CENTER>
		La función de usuario hacer_matriz(\$pal1,\$pal2,\$pal3) 
		recibe tres palabras, las convierte en una matriz y devuelve 
		el resultado, que vemos con la función de usuario 
		ver(\$contenido, \$indice).</H3></CENTER>";

function ver ($contenido, $indice)
{
   echo "Indice: <B>$indice</B>   
   		Contenido:<B> $contenido</B><br>\n";
}

function hacer_matriz($pal1,$pal2,$pal3)
{
         $todas="$pal1,$pal2,$pal3";
         $matriz=explode(",",$todas);
         reset($matriz);
         return $matriz;
}

$texto1="perro";
$texto2="rinoceronte";
$texto3="jirafa";

echo "<H3><CENTER>Inicialmente las variables \$texto1,\$texto2 y 
		\$texto3contienen:</H3></CENTER>";
echo "<B>\$texto1=$texto1</B><P>";
echo "<B>\$texto2=$texto2</B><P>";
echo "<B>\$texto3=$texto3</B><P>";
echo "<H3><CENTER>Después de ejecutarse las dos funciones de usuario
     mencionadas, tenemos el array \$matriz, cuyos elementos contienen:
     </H3></CENTER>";

$matriz=hacer_matriz($texto1,$texto2,$texto3);
array_walk($matriz,'ver');

echo "<H3><CENTER>Aquí hemos pasado los datos por referencia (también se puede decir 'por valor').</H3></CENTER>";

echo "<H3><CENTER>La función de usuario cambiar(&\$pal1,&\$pal2,&\$pal3)
     recibe tres palabras, las invierte y sustituye sus vocales
     por puntos.</H3></CENTER>";

function cambiar(&$pal1,&$pal2,&$pal3)
{
         $pal1=strtr($pal1,'aeiou','.....');
         $pal2=strtr($pal2,'aeiou','.....');
         $pal3=strtr($pal3,'aeiou','.....');
         $pal1=strrev($pal1);
         $pal2=strrev($pal2);
         $pal3=strrev($pal3);
}

$texto1="perro";
$texto2="rinoceronte";
$texto3="jirafa";

echo "<H3><CENTER>Inicialmente las variables \$texto1,\$texto2 
		y \$texto3 contienen:</H3></CENTER>";
echo "<B>\$texto1=$texto1</B><P>";
echo "<B>\$texto2=$texto2</B><P>";
echo "<B>\$texto3=$texto3</B><P>";
echo "<H3><CENTER>Después de la transformación las variables \$texto1,
		\$texto2 y \$texto3 contienen:</H3></CENTER>";
cambiar($texto1,$texto2,$texto3);
echo "<B>\$texto1=$texto1</B><P>";
echo "<B>\$texto2=$texto2</B><P>";
echo "<B>\$texto3=$texto3</B><P>";

?>
</BODY>
</HTML>

