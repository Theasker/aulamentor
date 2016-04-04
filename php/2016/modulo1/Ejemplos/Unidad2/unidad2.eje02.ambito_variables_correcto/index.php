<HTML>
<HEAD><TITLE>Ejemplo 2 - Unidad 2 - Curso Iniciación de PHP 5</TITLE></HEAD>
<BODY>
<?php
  // Esta variable solo existe en el ámbito principal del script
  $texto="Volverán las oscuras golondrinas...";
  function ver_texto()
  {
  	 global $texto;
     echo "<BR>";
     // Fíjate cómo mostramos escapamos el carácter "$"
     echo "Ahora se ve el contenido de la variable
            \$texto, pues tiene un ámbito global.";
     echo "<BR>";
	 // No aparece un error en la ejecución de la siguiente sentencia ya que
	 // esta variable está definida en el ámbito global.
     echo $texto;
  }
  // Invocamos la función local anterior
  ver_texto();
?>
</BODY>
</HTML>