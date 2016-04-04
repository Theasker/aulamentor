<HTML>
<HEAD><TITLE>Ejemplo 2b - Unidad 3 - Curso Iniciación de PHP 5</TITLE></HEAD>
<BODY>

<?php

/****** Comprobar la validadez de una fecha *******/

if ($_GET["tipo"]==1)
{


// Función checkdate()

echo "<H1><CENTER>Función checkdate()</H1></CENTER><P>";

echo "¿Es válida la fecha <B>29 de febrero de 5500</B>?
		&nbsp;&nbsp;&nbsp;";
echo "<FONT face='Georgia, Times New Roman' size='4'><B>";
if (checkdate(2,29,5500))
   echo "Sí";
else
   echo "No";
echo "<P></font face='Georgia, Times New Roman' size='4'></B>";

echo "¿Es válida la fecha <B>28 de febrero de 400</B>?&nbsp;&nbsp;&nbsp;";
echo "<FONT face='Georgia, Times New Roman' size='4'><B>";
if (checkdate(2,28,400))
   echo "Sí";
else
   echo "No";
echo "<P></font face='Georgia, Times New Roman' size='4'></B>";

echo "¿Es válida la fecha <B>31 de junio de 2001</B>?&nbsp;&nbsp;&nbsp;";
echo "<FONT face='Georgia, Times New Roman' size='4'><B>";
if (checkdate(6,31,2001))
   echo "Sí";
else
   echo "No";
echo "<P></font face='Georgia, Times New Roman' size='4'></B>";

echo "¿Es válida la fecha <B>30 de noviembre de 2014</B>?&nbsp;&nbsp;&nbsp;";
echo "<FONT face='Georgia, Times New Roman' size='4'><B>";
if (checkdate(11,30,2014))
   echo "Sí";
else
   echo "No";
echo "<P></font face='Georgia, Times New Roman' size='4'></B>";

}

/****** Dar formato a una fecha ******/

elseif ($_GET["tipo"]==2)
{

// Función date()

echo "<H1><CENTER>Función date()</H1></CENTER><P>";
echo "La instrucción <B>date(\"D F Y\") </B>muestra <B>".
		date("D F Y").".</B><P>";
echo "La instrucción <B>date(\"d-n-Y\") </B>muestra <B>".
		date("d-n-Y").".</B><P>";
echo "La instrucción <B>date(\"H:i:s\") </B>muestra <B>".
		date("H:i:s").".</B><P>";
echo "La instrucción <B>date(\"j-M-y\",2000) </B>muestra <B>".
		date("j M y",2000).".</B><P>";
echo "La instrucción <B>date(\"d\") de date(\"n\") de date(\"Y\")
		</B>muestra <B>".date("d")." del ".date("n")." de "
		.date("Y")."</B><P>";

}

/****** Extraer información de una fecha ******/

elseif ($_GET["tipo"]==3)
{

// Función getdate()

echo "<H1><CENTER>Función getdate()</H1></CENTER><P>";
$fecha=getdate();
echo "El array <B>\$fecha </B> ha recibido de <B>getdate()</B>
                la información siguiente:<P>";
echo "Segundos: <B> ".$fecha["seconds"]."</B>.<P>";
echo "Minutos: <B> ".$fecha["minutes"]."</B>.<P>";
echo "Horas: <B> ".$fecha["hours"]."</B>.<P>";
echo "Día del mes: <B> ".$fecha["mday"]."</B>.<P>";
echo "Número del día de la semana <B> ".$fecha["wday"]."</B>.<P>";
echo "Número de mes: <B> ".$fecha["mon"]."</B>.<P>";
echo "Año: <B> ".$fecha["year"]."</B>.<P>";
echo "Día del año: <B> ".$fecha["yday"]."</B>.<P>";
echo "Nombre del mes: <B> ".$fecha["month"]."</B>.<P>";


// Función mktime()

echo "<H1><CENTER>Función mktime()</H1></CENTER><P>";
$momento=mktime(10,15,20,10,2,14);
echo "El momento que corresponde a la fecha <B>2 de octubre de 
		2014, a las 10 horas, 15 minutos y 20 segundos</B> 
		obtenido con la función <B>mktime()</B> es: 
		<B>$momento</B>.<P>";
$fecha=getdate($momento);
$dia=$fecha["mday"];
$mes=$fecha["month"];
$ann=$fecha["year"];
echo "Si ahora proporcionamos este valor como argumento de la función
		<B>getdate(),</B> obtenemos la fecha <B> $dia de $mes 
		de $ann</B>.<P>";
}

/****** Formatear una fecha con valores locales ******/

elseif ($_GET["tipo"]==4)
{

// Función strftime()

setlocale(LC_ALL,"spanish");
echo "<H1><CENTER>Función strftime()</H1></CENTER><P>";
$momento=mktime(10,15,20,10,2,14);

echo "Asignamos a <B>\$momento</B> el momento que corresponde al 
		<B>2 de octubre de 2014 10:15:20</B> obtenido con 
		la función <B>mktime()</B>.<P>";
echo "A continuación, mostraremos los mismos datos que con 
		la función <B>getdate()</B>, pero usando aquí 
		la función <B> strftime().</B>.<P>";
echo "El array <B>\$fecha </B> ha recibido de <B>getdate()</B> 
		la información siguiente:<P>";
echo "Segundos: <B> ".strftime("%S",$momento)." </B> obtenido 
		con la cadena de formato <B>\"%S\"</B>.<P>";
echo "Minutos: <B> ".strftime("%M",$momento)." </B> obtenido 
		con la cadena de formato <B>\"%M\"</B>.<P>";
echo "Horas: <B> ".strftime("%H",$momento)." </B> obtenido 
		con la cadena de formato <B>\"%H\"</B>.<P>";
echo "Día del mes: <B> ".strftime("%d",$momento)."</B> obtenido 
		con la cadena de formato <B>\"%d\"</B>.<P>";
echo "Número del día de la semana: <B> ".strftime("%w",$momento).
		"</B> obtenido con la cadena de formato <B>\"%w\"</B>.<P>";
echo "Número del mes: <B> ".strftime("%m",$momento)." </B> 
		obtenido con la cadena de formato <B>\"%m\"</B>.<P>";
echo "Año: <B> ".strftime('%Y',$momento)." </B> obtenido 
		con la cadena de formato <B>\"%Y\"</B>.<P>";
echo "Nombre del día de la semana: <B> ".strftime("%A",$momento).
		"</B> obtenido con la cadena de formato <B>\"%A\"</B>.<P>";
echo "Nombre del mes: <B> ".strftime("%B",$momento)."</B> 
		obtenido con la cadena de formato <B>\"%B\"</B>.<P>";
echo "Día del año: <B> ".strftime("%j",$momento)."</B> 
		obtenido con la cadena de formato <B>\"%j\"</B>.<P>";

}
/****** Más funciones de fecha ******/

elseif ($_GET["tipo"]==5)
{

// Función idate()

echo "<H1><CENTER>Función idate()</H1></CENTER><P>";
$momento=mktime(10,15,20,10,2,14);

echo "Asignamos a <B>\$momento</B> el momento que corresponde al 
		<B>2 de octubre de 2014 10:15:20</B> obtenido con 
		la función <B>mktime()</B>.<P>";

echo "El resultado de la función <B>idate('d', \$momento)</B> es '<B>".
		idate('d', $momento)."</B>'.<P>";		
echo "El resultado de la función <B>idate('m', \$momento)</B> es '<B>".
		idate('m', $momento)."</B>'.<P>";
echo "El resultado de la función <B>idate('y', \$momento)</B> es '<B>".
		idate('y', $momento)."</B>'.<P>";


// Función date_sunset(), date_sunrise()

echo "<H1><CENTER>Función date_sunset() y date_sunrise()</H1></CENTER><P>";

/* Coordenadas geográficas de la ciudad de Segovia
Latitud: 40.57 Norte
Longitud: 4.07 Oeste
Zenith ~= 90.6
offset: +2 GMT
*/

setlocale(LC_ALL,"spanish");
echo "La hora de salida del sol de hoy ". strftime('%A, %d %B %Y'). 
      ", en la ciudad de Segovia es : <B>" .date_sunrise(time(), SUNFUNCS_RET_STRING, 40.57, -4.07, 90.6, 2)."</B>";
echo "<P>";
echo "La hora de puesta de sol de hoy ". strftime('%A, %d %B %Y'). 
      ", en la ciudad de Segovia es : <B>" .date_sunset(time(), SUNFUNCS_RET_STRING, 40.57, -4.07, 90.6, 2)."</B>";

}

echo  "<BR><CENTER><INPUT type='button' value='<- Volver a la página anterior'onClick='history.back()'></CENTER>";

?>
</BODY>
</HTML>

