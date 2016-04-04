<?PHP // Aquí se inicia el código PHP.

	echo "<HTML>
			<HEAD>
				<TITLE> 
					Ejemplo 2 - Unidad 1 - Curso Iniciación de PHP 5
				</TITLE>
			</HEAD>
			<BODY>

			<P>Estás usando el navegador
			<B>";

			$navegador = $_SERVER['HTTP_USER_AGENT'];
   			echo($navegador);
   			
			echo "</B>.</P>
			</BODY>
		</HTML>";
?><!-- Aquí se cierra el código PHP. -->