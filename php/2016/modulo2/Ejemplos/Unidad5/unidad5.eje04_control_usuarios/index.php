<?php

if (!isset($_SERVER['PHP_AUTH_USER']) || ($_SERVER['PHP_AUTH_USER'] != "curso") 
		|| ($_SERVER['PHP_AUTH_PW'] != "123"))
{
	header('WWW-Authenticate: Basic realm="Curso de PHP 5"');
	header('Status: 401 Unauthorized');
	header('HTTP/1.0 401 Unauthorized');	
	echo 'Se requiere autorización.';	
}
else
{
    echo "<HTML><HEAD>
             <TITLE>Ejemplo 4 - Unidad 5 - Curso Iniciación de PHP 5</TITLE>
          </HEAD><BODY>";
    echo "<P><FONT color=red><H2>Autorizado por PHP</H2><P></FONT>";
    echo "Nombre de usuario: <B>".$_SERVER['PHP_AUTH_USER']."</B><P>";
    echo "Contraseña: <B>".$_SERVER['PHP_AUTH_PW']."</B><P>";
    echo "<A href=usuario_apache/index.php>Pulsa aquí para la validación usuario Apache</A>
		<P><U>Nota:</U> debes seguir el manual del curso que indica cómo se da de alta un usuario en Apache para que funcione esta segunda parte.";
    echo "</BODY></HTML>";	    
}

?>


