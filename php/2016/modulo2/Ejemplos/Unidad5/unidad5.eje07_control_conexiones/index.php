<?php
	
// Función que devuelve un literal en función del estado actual de la conexión	
function ver_estado()	
{   
   switch (connection_status()){
   	case CONNECTION_ABORTED: return "Conexión abortada";	        
	case CONNECTION_TIMEOUT: return"Conexión caducada";	        
	default: return "Conexión normal";
   }    
}


/* Fíjate que hemos usado la función error_log()
   para guardar el resultado del estado de la conexión.
   Esto se hace así porque la función  "guarda_estado" 
   dentro de "register_shutdown_function" no se permite 
   ningún tipo de salida hacia el navegador o 
   a un fichero normal.         
*/ 
function guarda_estado()
{
   // Creamos el texto de log con una fecha y el estado de conexión actual
   $texto=date("Y-m-d H:i:s: ")."la anterior sesión terminó con estado '".ver_estado()."'.\n";
   // Guardamos el registro en el fichero acceso.txt del directori odel proyecto
   error_log($texto,3, dirname($_SERVER['SCRIPT_FILENAME'])."/acceso.txt");
}

// Registramos la función guarda_estado() para almacenar el estado de la conexión cuando PHP termina la ejecución de 
// esta página 
register_shutdown_function("guarda_estado");

// Indicamos que no se ignone la cancelación de descarga de esta página
ignore_user_abort(false);
// El tiempo máximo de ejecución de esta página es de 10 segundos
set_time_limit(25);    
echo "<HTML><HEAD><TITLE>Ejemplo 7 - Unidad 5 - Curso Iniciación de PHP 5</TITLE></HEAD><BODY>";
echo "<H1><CENTER>Gestión de conexiones</H1></CENTER><P>";
echo "<H3><CENTER>El usuario se está conectando. Pulse 
           <B>\"Detener\"</B>mientras se muestran los puntos 
           para desconectarse o no lo haga si no quiere 
           desconectarse. Conviene que pruebe las dos cosas 
           y luego actualice la página para ver el resultado.
      </H3></CENTER><P>";
/* paramos la página 2 segundos para poder pararla con 
   el navegador pulsando el botón "Detener" */
sleep(2);
// Iniciamos un bucle que va pintanto puntos en la página del visitante
for ($i=0;$i<6000;$i++)
{
   for ($j=0;$j<200;$j++)
   { 
   	  // Si la conexión no se ha parado imprimimos un punto "."
      if (!connection_aborted())  print("<B>.</B>");
      // Si no, salimos del bucle
      else break;
   }
   // Enviamos al navegador la información imprimida hasta ahora
   ob_flush();
   // Si la conexión no se ha parado imprimimos un salto de línea HTML
   if (!connection_aborted()) echo "<P>";
   // Si no, salimos del bucle
   else break;
}

//  Si la conexión no se ha parado imprimimos la palabra "FIN".
if (!connection_aborted()) echo "FIN";

?>
</BODY>
</HTML>

