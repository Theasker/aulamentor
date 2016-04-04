<HTML>
	<HEAD><TITLE>Ejemplo 12 - Unidad 2 - Curso Iniciación de PHP 5</TITLE></HEAD>
	<BODY bgcolor="#66CCFF"><CENTER>
	<HR>
  <H1><FONT color="blue">Excepciones</FONT></H1>
  <HR>
<?php 

echo "<B>Si intentamos imprimir la \$variable que no existe aparece el error de tipo Notice (aviso): </B><FONT color=red>";
echo $variable;

echo " </FONT><P><P><P><B>Si intentamos imprimir la \$variable controlando la existencia de ésta con una excepción: </B>";
try {
	if (!isset($variable))
		throw new Exception('no existe la variable $variable');
	else 
		echo " <P><P>Si intentamos imprimir la \$variable: $variable";
} catch (Exception $e) {
	echo "<BR><FONT color=red>ERROR - se ha producido el error: " . $e->getMessage() . "</FONT>";
}


echo '<P><P>El bloque try/catch no finaliza la ejecución total del script.';
?>
</CENTER>
</BODY></HTML>
