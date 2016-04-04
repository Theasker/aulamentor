<HTML>
<HEAD><TITLE>Ejemplo 2 - Unidad 8 - Curso Iniciación de PHP 5</TITLE></HEAD>
<BODY>

<?php

	print("<CENTER><H1>Tratamiento de errores</H1></CENTER><P>");
	$ficheroLogs = ini_get('error_log');
	echo "<H4>1.- El fichero de log es '<B>$ficheroLogs'.</B></H4><P>";
	
	$n_error=error_reporting();
	echo "<H4>2.- El nivel actual de los mensajes de error es '<B>$n_error'.</B></H4><P>";
	error_reporting(0);
	$n_error=error_reporting();
	echo "<H4>3.- Hemos asignado el nivel '<b>$n_error</b>' a los mensajes 
			de error. A partir de ahora en la pantalla no se verán los mensajes de error.</H4><P>";
	
	/* Fijamos erróneamente las variables de la conexión al servidor MySQL. */   
	$DBHost="localhost";
	$DBUser="otro_nombre";
	$DBPass="12345";
	/* Intentamos establecer una conexión con el servidor.*/
	try {
		$db = new PDO("mysql:host=".$DBHost, $DBUser, $DBPass);
		$db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
	} catch (PDOException $e) {
		$dia_hora=strftime("%d del %m de %Y, a las %H:%M");
		$mensaje="No se puede conectar con MySQL";
		$mensaje.=" el día $dia_hora. Compruebe los datos.\n";
		echo "<H4>4.- Hemos intentado conectar con el servidor MySQL usando 
	              datos erróneos del usuario. El mensaje de
			error que se ha producido lo hemos enviado ahora al
			fichero '$ficheroLogs'. Edita
			este fichero para que puedas verlo.</H4><P>";
		error_log($mensaje);
	} // end try

	if (!isset($mi_edad))
	{
		$dia_hora=strftime("%d del %m de %Y, a las %H:%M");
		$mensaje="No existe la variable '\$mi_edad'.";
		$mensaje.=" Día y hora del mensaje: $dia_hora. Declárela.\n";		
		error_log($mensaje);
	}
	echo "<H4>5.- Hemos intentado utilizar la variable
			'\$mi_edad', aunque no existe. El mensaje de
			error que se ha producido lo hemos enviado al
			fichero '$ficheroLogs'. Edita el fichero para que puedas verlo.
			</H4><P>";

	error_reporting(E_ALL);
	echo "<H4>6.- Hemos intentado mostrar el contenido de la
			variable '\$mi_edad', aunque no existe. Ahora hemos
			reestablecido el nivel original de los mensajes de error
			y en la pantalla se ha mostrado el texto previsto en PHP
			para este tipo de error, que es el siguiente:</H4>";
	echo $mi_edad;
?>

</BODY>
</HTML>


