<HTML>
<HEAD><TITLE>Ejemplo 3 - Unidad 2 - Curso Iniciación de PHP 5</TITLE></HEAD>
<BODY>
<?php
  function ver_valor_estatico()
  {
     echo "<BR>";
     // Definimos una variable estática, es decir, no pierde su valor cuando
     // acaba la ejecución de la función
     static $valor=0;
     echo $valor;
     $valor++;
  }
  echo "La variable \$valor dentro de la función ver_valor_estatico() aumenta cada vez que invocamos la función.";
  ver_valor_estatico();
  ver_valor_estatico();
  ver_valor_estatico();
  
  function ver_valor()
  {
  	echo "<BR>";
  	// Definimos una variable sin modificador, es decir, pierde su valor cuando
  	// acaba la ejecución de la función
  	$valor=0;
  	echo $valor;
  	$valor++;
  }
  echo "<BR><BR>La variable \$valor dentro de la función ver_valor() no aumenta cada vez que invocamos la función.";
  ver_valor();
  ver_valor();
  ver_valor();
?>
</BODY>
</HTML> 
