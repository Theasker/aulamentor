<HTML>
<HEAD><TITLE>Ejemplo 7b - Unidad 2 - Curso Iniciación de PHP 5</TITLE></HEAD>
<BODY>
<CENTER>

<?php
  // Leemos todas las variable $_REQUEST 
  if (!isset($_REQUEST["nom"])) $nom=""; 
  else $nom=$_REQUEST["nom"];
  if (!isset($_REQUEST["apel"])) $apel="";
  else $apel=$_REQUEST["apel"];  
  if (!isset($_REQUEST["repe"])) $repe='No';
  else $repe='S&iacute;';
  if (!isset($_REQUEST["hombre"])) $sexo='Hombre';
  else if (!isset($_REQUEST["mujer"])) $sexo='Mujer';
  else $sexo='No indicado';
  if (!isset($_REQUEST["curso"])) $curso='';
  else $curso=$_REQUEST["curso"];
  if (!isset($_REQUEST["notas"])) $notas="";
  else $notas=$_REQUEST["notas"];

  echo "<H2>Los datos introducidos son:</H2><P>";
  echo "Nombre: '$nom' <P>";
  echo "Apellidos: '$apel' <P>"; 
  echo "Repetidor: '$repe' <P>";
  echo "Sexo: '$sexo' <P>";
  echo "Curso: '$curso' <P>";
  echo "Notas: '$notas' <P>";
  
  echo  "<BR><BR><INPUT type='button' value='Volver a la página anterior'onClick='history.back()'>";
?>

</CENTER>
</BODY>
</HTML>