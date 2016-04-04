<?php

   /* Fijamos las constantes de la conexión al servidor MySQL.
   El nombre del servidor es el que admite por defecto el servidor
   local.*/

	define("SERVIDOR", "localhost");
	define("USUARIO", "root");
	define("CLAVE", "");
	
	/* Función que conecta con el servidor MySQL y, si se indica, selecciona la BD indicada como parámetro.*/
	function conectaBD($BD='')
	{
		/* Intentamos establecer una conexión con el servidor.*/
		try {
			if ($BD=='')
				$db = new PDO("mysql:host=".SERVIDOR.";charset=utf8", USUARIO, CLAVE);
			else $db = new PDO("mysql:host=" . SERVIDOR . ";dbname=" . $BD.";charset=utf8", USUARIO, CLAVE);
			$db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
			return($db);
		} catch (PDOException $e) {
			die ("<p><H3>No se ha podido establecer la conexión.
                  <P>Compruebe si está activado el servidor de bases de 
                  datos MySQL.</H3></p>\n <p>Error: " . $e->getMessage() . "</p>\n");
			exit();
		} // end try
	}
	

?>
