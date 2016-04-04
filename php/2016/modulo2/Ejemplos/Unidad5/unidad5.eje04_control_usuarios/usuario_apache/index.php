<?php

if (isset($_SERVER['REMOTE_USER']))
{
	echo "<HTML><HEAD>
	             <TITLE>Ejemplo 4 - Unidad 5 - Curso Iniciación de PHP 5</TITLE>
	      </HEAD><BODY>";
	echo "<P><FONT color=red><H2>Autorizado por Apache</H2><P>
			</FONT>";
    echo "Nombre de usuario: <B>".$_SERVER['REMOTE_USER']."</B>";
    echo "</BODY></HTML>";
}

?>


