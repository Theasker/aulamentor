<?php
	/* MUY IMPORTANTE: Las Cookies están contenidas en la cabecera de la página HTTP
	 (al principio de todo), por lo que setcookie() SIEMPRE debe ser
	invocada antes de que hagamos alguna salida al navegador del cliente (echo, print...).
	Fíjate que esta página empieza con <?php sin espacios ni nada
	
	*/

	// Variable con el resultado de la operación, para no hacer "echo" antes de enviar 
	// la cookie al navegador.
	$resultadoStr="";
	// Si el usuario desea crear la cookie
	if (isset($_POST["crearcookie"])) {
		// Validamos que ha escrito el nombre del usuario
		if (trim($_POST["tu_nombre"])=='') 
			$resultadoStr .= "ERROR: debes indicar el nombre del usuario.";
		else 
		// Validamos que ha incluido una duración entre 1 y 60 segundos
		if (is_numeric($_POST["duracion"]) && $_POST["duracion"]>0 && $_POST["duracion"]<61){
			// Establecemos la cookie con el nombre y duración establecida
   			if (setcookie("usuario", $_POST["tu_nombre"], time()+$_POST["duracion"]))
   				$resultadoStr .= "La cookie ha sido creada. ¡Pulsa el botón 
   					'Actualizar página' para ver el resultado!<P>";
   			else // Si no se puede establecer la cookie es que el navegador no la acepta
   				$resultadoStr .= "ERROR: el navegador no acepta Cookies<P>";
		} else $resultadoStr .= "ERROR: en el campo duración debes indicar un número entero entre 1 y 60.";	
   	}
   	// Operación borrado de cookie
   	else if (isset($_POST["borrarcookie"])){
   		setcookie("usuario");
   		$resultadoStr .= "La cookie ha sido borrada. ¡Pulsa el botón 
   			'Actualizar página' para ver el resultado!<P>";		
   	} else
    // si existe la cookie, mostramos su información 
   	if (isset($_COOKIE["usuario"]) and $_COOKIE["usuario"]!="" )
   	$resultadoStr .= "Hola, ".$_COOKIE["usuario"].". Bienvenido a nuestra página web.<P>
   					La cookie <B>usuario</B> tiene el valor 
					<B>".$_COOKIE["usuario"]."</B><P>";
	else
	$resultadoStr .= "¡No hay ninguna cookie almacenada!";
	
	// Añadimos al resultado el formulario
  	$resultadoStr = "<FORM ACTION=\"index.php\" METHOD=POST>
	  	Nombre de usuario: <INPUT TYPE=\"text\" NAME=\"tu_nombre\"><P>
	  	Duración cookie (entre 1 y 60 segundos): <INPUT TYPE=\"text\" NAME=\"duracion\" value=10>
	  	<P><INPUT TYPE=\"submit\" VALUE=\"Crear cookie\" name=\"crearcookie\">
	  	<INPUT TYPE=\"submit\" VALUE=\"Borrar cookie\" name=\"borrarcookie\">
	  	<INPUT TYPE=\"submit\" VALUE=\"Actualizar página\" name=\"actualizacookie\">
	  	</FORM>"
  	. $resultadoStr;

  	// Mostramos la página HTML
	echo "<HTML><HEAD><TITLE>Ejemplo 1 - Unidad 5 - Curso Iniciación de PHP 5</TITLE></HEAD>
			<BODY>
				<H1><CENTER>CREACION Y DESTRUCCION COOKIE</H1>
				$resultadoStr
			</BODY>
		</HTML>";

?>
