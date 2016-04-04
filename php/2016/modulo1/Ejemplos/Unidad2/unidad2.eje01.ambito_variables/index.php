<HTML>
<HEAD><TITLE>Ejemplo 1 - Unidad 2 - Curso Iniciación de PHP 5</TITLE></HEAD>
<BODY>
<?php
  // Esta variable solo existe en el ámbito principal del script
  $texto="Volverán las oscuras golondrinas...";
  function ver_texto()
  {
     echo "<BR>";
     echo "No se ve el contenido de la variable \$texto,
     		pues sólo tiene un ámbito local. Por eso se 
     		muestra el mensaje de error siguiente:";
     echo "<BR>";
	 // Aparece un error en la ejecución de la siguiente sentencia ya que
	 // esta variable está definida en el ámbito global, no en el ámbito de
	 // esta función.
     echo $texto;
  }
  // Invocamos la función local anterior
  ver_texto();
?>
</BODY>
</HTML>