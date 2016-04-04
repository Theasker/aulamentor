<HTML>
	<HEAD>
		<TITLE> 
			Ejemplo 1 - Unidad 1 - Curso Iniciación de PHP 5
		</TITLE>
	</HEAD>
	<BODY>
	
	<!--  Las líneas anteriores contienen sólo código HTML. 
	Si lo necesitas, mira el Apéndice 2. -->

	<?PHP   
		// Aquí se inicia el código PHP.
		// Obtenemos el valor de la variable global HTTP_USER_AGENT
		// de PHP que indica los datos del navegador del usuario. 
   		$navegador = $_SERVER['HTTP_USER_AGENT'];
	?>   <!-- Aquí se cierra el código PHP. -->

	<P>Estás usando el navegador<B>
	
	<?PHP    // Aquí se inicia de nuevo el código PHP.
   		echo($navegador);
	?>    <!-- Aquí se cierra el código PHP. -->

	<!-- A partir de esta línea sigue el código HTML. -->
	</B>.</P>
	
	</BODY>
</HTML>