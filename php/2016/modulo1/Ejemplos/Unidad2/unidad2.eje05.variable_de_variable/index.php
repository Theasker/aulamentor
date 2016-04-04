<HTML>
<HEAD><TITLE>Ejemplo 5 - Unidad 2 - Curso Iniciación de PHP 5</TITLE></HEAD>
<BODY>
<?php
	// Definimos 2 variables de tipo cadena
    $nombre = "María";
    $n = "nombre";
	// Mostramos información al usuario
    echo "La variable \$nombre contiene \"María\".";
    echo "<BR>";
    echo "La variable \$n contiene \"nombre\".";
    echo "<BR>";
    // Observa la sintaxis para citar una variable variable: ${$n}.
    // Es como si hubiéramos escrito: ${'nombre'}
    echo "La variable variable $\{\$n} contiene también ". ${$n} . ".";    
?>
</BODY>
</HTML> 
