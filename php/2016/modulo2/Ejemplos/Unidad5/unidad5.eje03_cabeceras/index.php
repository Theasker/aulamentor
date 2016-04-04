<?php
header("Cache-Control: no-cahe, must-revalidate");
header("Refresh: 10; URL=".$_SERVER["PHP_SELF"]);

   /* En las dos cabeceras anteriores especificamos que
      la página devuelta no se guarde en la memoria caché
      del ordenador cliente, sino que refresque cada 10
      minutos accediendo simpre a la misma direcció. */
      
echo "<CENTER><H3>Con la función header() hemos 
		especificado que esta página no se 
		guarde en la memoria caché, sino que se llame 
		a sí misma desde la página original cada 10 segundos. 
		Puede comprobarse dejando la página sin actualizar 
		durante 10 segundos o pulsando sobre Actualizar.
		</H3></CENTER><P>";

setlocale(LC_ALL,"spanish");
$hora=gettimeofday();
echo strftime("%A, %d de %B de %Y, a las %H:%M:%S",
			$hora["sec"])."<P><P>";
echo "Se repite la carga de la página.<P>";
echo strftime("%A, %d de %B de %Y, a las %H:%M:%S",time())
			."<P><P>";
?>

<HTML><HEAD><TITLE>Ejemplo 3 - Unidad 5 - Curso Iniciación de PHP 5</TITLE></HEAD>
<BODY>

<CENTER>
	<A HREF="<?php echo $_SERVER["PHP_SELF"]; ?>">Actualizar</A>
</CENTER>

</BODY>
</HTML>