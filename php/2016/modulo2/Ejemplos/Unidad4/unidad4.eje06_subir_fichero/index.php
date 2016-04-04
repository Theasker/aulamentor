<HTML>
<HEAD>
<TITLE>Ejemplo 6 - Unidad 4 - Curso Iniciación de PHP 5</TITLE>
</HEAD><BODY>
<?php
include "uni4_eje6_configura.php";

echo "
<div style='border:2px solid #ddd;background-color:#e6fcee;padding:8px;margin:6px 0 6px 0;'>
<H2>SUBIR FICHERO AL SERVIDOR WEB</H2>
<FORM ENCTYPE=multipart/form-data METHOD=post ACTION=$destino>
Buscar fichero: <INPUT TYPE=File NAME=fichero SIZE=35>
<INPUT TYPE='hidden' name='MAX_FILE_SIZE' VALUE='51200000000000'>
<BR><INPUT TYPE=submit NAME=submit VALUE='Subir al servidor'></div>";

?>
</BODY></HTML>