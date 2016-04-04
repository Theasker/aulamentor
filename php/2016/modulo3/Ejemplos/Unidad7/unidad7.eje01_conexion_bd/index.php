﻿<HTML>
<HEAD><TITLE>Ejemplo 1 - Unidad 7 - Curso Iniciación de PHP 5</TITLE>
<STYLE type="text/css">
	<!--A {font-family: Arial; color: #00FF00}-->
</STYLE></HEAD>
<BODY>
<CENTER>
<FONT face="Arial, Helvetica, sans-serif" color="#00FF00">
<TABLE width="40%" border="0" cellpadding="2" cellspacing="2">

<?php 
	
	/* Definimos una matriz con las opciones del menú  */
	$matriz_opciones = array(1=>"Conectar servidor BD",
							2=>"Crear BD 'pruebas'",
							3=>"Borrar BD 'pruebas'",
							4=>"Crear tabla 'agenda'",
							5=>"Borrar tabla agenda");
							
	for ($i=1; $i<=sizeof($matriz_opciones); $i++) {						
	 echo ' <TR> 
			  <TD bgcolor="#333333"> 
				<A href="index.php?tipo='.$i.'"> '. $i. '. '. $matriz_opciones[$i].'
				</A>
			  </TD>
			</TR>';
	}

	?>

</TABLE>
</FONT>

<?php 
   
   require("uni7_utilidades.php");
   if (!isset($_GET["tipo"])) exit;
   
   /******** Conectar servidor MySQL *********/
   if ($_GET["tipo"]==1) {
	   /* Intentamos establecer una conexión con el servidor.*/
	   $db = conectaBD();
	   
	   /* Si la conexión se ha podido establecer, se informa de ello
	    y de los datos de la misma.*/
	   echo "<H3>Se ha establecido correctamente la conexión.</H3>";
	   echo "<H4>Los datos de la conexión son:
	            <BR>Servidor: " . SERVIDOR . "<BR>Usuario: " . USUARIO . " 
	            <BR>Clave: " . CLAVE. "</H4>";
	} else // end if
	// Creación BD 'pruebas'
	if ($_GET["tipo"]==2) {
		/* Intentamos establecer una conexión con el servidor.*/
		$db = conectaBD();
	   // Ejecutamos la SQL de Creación de BD directamente
	   // en el servidor MySQL.
	   /* Intentamos crear la base de datos "pruebas". 
	    * Si se consigue hacerlo, se informa de ello. 
	    * Si no, también se informa y se indica cuál es el
	    * motivo del fallo con el mensaje de error.*/
	   if ($db->query('CREATE DATABASE pruebas'))
	   {
	      print("<H3>La base de datos \"pruebas\" se ha 
	              creado correctamente.<P>Con el explorador 
	              puedes observar que se ha creado<P>la carpeta 
	              \"pruebas\" en C:\\XAMPP\bin\mysql\data.
	              </H3>");
	   }
	   else // Si no se ejecuta correctamente mostramos el error al usuario
	   {
	      echo"<H3>No se ha podido crear la base de datos
	                \"pruebas\". Errores: </H3><PRE>";
	      print_r($db->errorInfo());
	      echo "</PRE>";
	   }
	   // Desconectamos y volvemos a conectar a la BD pruebas
	   $db=null;
	} // end if
	else 
	// Borrar BD pruebas
	if ($_GET["tipo"]==3) {
		/* Intentamos establecer una conexión con el servidor.*/
		$db = conectaBD();
		/* Intentamos borrar la base de datos "pruebas".
		 * Si se consigue hacerlo, se informa de ello.
		* Si no, también se informa y se indica cuál es el
		* motivo del fallo con el mensaje de error.*/
		if ($db->query('DROP DATABASE pruebas'))
			print("<CENTER><H3>La base de datos \"pruebas\" ha sido borrada.<P>
	       Con el explorador puedes observar que ya no existe <P>
	       la carpeta \"pruebas\" en C:\\XAMPP\mysql\data.</H3></CENTER>");
		else { // Si no se ejecuta correctamente mostramos el error al usuario
			echo"<H3>No se ha podido borrar la base de datos
                \"pruebas\". Errores: </H3><PRE>";
			print_r($db->errorInfo());
			echo "</PRE>";
		}
	} // end if
	else
	// Crear tabla 'agenda'
	if ($_GET["tipo"]==4) {
		/* Intentamos establecer una conexión con el servidor.*/
		$db = conectaBD("pruebas");
		 
		echo "<H3>Se ha establecido correctamente la conexión.";
		echo "<H4>Los datos de la conexión son:
		            <BR>Servidor: " . SERVIDOR . "<BR>Usuario: " . USUARIO . "<BR>Clave: " . CLAVE. "<BR>Base de datos: pruebas</H4>";
		// Creamos la consulta que crea la tabla en la BD
		$consulta = "create table agenda (registro INT NOT NULL ";
		$consulta.="AUTO_INCREMENT, nombre CHAR(50),direccion CHAR(100),";
		$consulta.="telefono CHAR(15), email CHAR(50), KEY (registro) )";
		// Ejecutamos la consulta de creación de la tabla
		if ($db->query($consulta))
		{
			echo "<H3>Se ha creado la tabla \"agenda\" correctamente.</H3><P>";
		}
		else // Si no se ejecuta correctamente mostramos el error al usuario
		{
			echo"<H3>No se ha podido crear la tabla \"agenda\". Errores: </H3><PRE>";
			print_r($db->errorInfo());
		    echo "</PRE>";
		}
	} // end if
	else
	// Borrar tabla 'agenda'
	if ($_GET["tipo"]==5) {
		/* Intentamos establecer una conexión con el servidor.*/
		$db = conectaBD("pruebas");
		/* Intentamos borrar la tabla "agenda".
		 * Si se consigue hacerlo, se informa de ello.
		 * Si no, también se informa y se indica cuál es el
		 * motivo del fallo con el número y el mensaje de error.*/
		if ($db->query('DROP TABLE agenda'))
			print("<CENTER><H3>La tabla \"agenda\" ha sido borrada.<P></H3></CENTER>");
		else {
			echo"<H3>No se ha podido borrar la tabla
		                \"agenda\". Errores: </H3><PRE>";
			print_r($db->errorInfo());
			echo "</PRE>";
		}
	} // end if


?>
  
</CENTER>
</BODY> 
</HTML>
