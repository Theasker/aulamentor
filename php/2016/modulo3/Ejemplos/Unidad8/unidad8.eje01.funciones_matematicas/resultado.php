<HTML>
<HEAD><TITLE>Ejemplo 1b - Unidad 8 - Curso Iniciación de PHP 5</TITLE></HEAD>

<BODY>

<?php

if ($_GET["tipo"]==1)
/******** Funciones trigonométricas *********/
{
	print("<CENTER><H2>Trigonométricas</H2></CENTER><P>");
	
	$num=120.678;
	echo "Valor usado como argumento de las funciones = <B>$num</B><P>";

	if (acos($num))
		echo "Arcocoseno - función acos() = <B>".acos($num)."</B><P>";
    else
		echo "Arcocoseno - función acos() = <B>No se puede hallar</B><P>";

	if (asin($num))
		echo "Arcoseno - función asin() = <B>".asin($num)."</B><P>";
	else
		echo "Arcoseno - función asin() = <B>No se puede hallar</B><P>";

	if (atan($num))
		echo "Arcotangente - función atan() = <B>".atan($num). "</B><P>";
	else
		echo "Arcotangente - función atan() = <B>No se puede hallar</B><P>";

	if (cos($num))
		echo "Coseno - función cos() = <B>".cos($num)."</B><P>";
	else
		echo "Coseno - función cos() = <B>No se puede hallar</B><P>";

	if (sin($num))
		echo "Seno - función sin() = <B>".sin($num)."</B><P>";
	else
		echo "Seno - función sin() = <B>No se puede hallar</B><P>";

	if (tan($num))
		echo "Tangente - función tan() = <B>".tan($num)."</B><P>";
	else
		echo "Tangente - función tan() = <B>No se puede hallar</B><P>";
}
elseif ($_GET["tipo"]==2)
/******** Redondeos, máximos y mínimos *********/
{
	print("<CENTER><H2>Redondeos, máximos y mínimos</H2></CENTER><P>");
    
	echo "Valor absoluto de -120 y de 120 - función abs() = <B>" .abs(-120)."</B><P>";

	echo "Valor entero superior de la fracción 120.678 - función ceil() = <B>".ceil(120.678)."</B><P>";

	echo "Valor entero inferior de la fracción 120.678 - función floor() = <B>".floor(120.678)."</B><P>";

	echo "Valor mayor entre 120 y 240 - función max() = <B>".max(120,240)."</B><P>";

	echo "Valor menor entre 120 y 240 - función min() = <B>".min(120,240)."</B><P>";

	echo "Valor redondeado de la fracción 120.678 - función round() = <B>".round(120.678)."</B><P>";

	echo "En cambio, el valor redondeado de la fracción 120.478 - función round() = <B>".round(120.478)."</B><P>";
}
elseif ($_GET["tipo"]==3)
/******** Exponentes y logaritmos *********/
{
	print("<CENTER><H2>Exponentes y logaritmos</H2></CENTER><P>");

	echo "Exponente de e (base del logaritmo natural= 2.71828182845904) elevado a 3 - función 
			exp() = <B>".exp(3)."</B><P>";
         
	echo "Logaritmo del número 120.678 - función log() = <B>" .log(120.678)."</B><P>";

	echo "Logaritmo en base 10 del número 120.678 - función log10() = <B>".log10(120.678)."</B><P>";
         
	echo "Valor de elevar 5 a la potencia 3 - función pow() = <B>" .pow(5,3)."</B><P>";

	echo "Valor de la raíz cuadrada de 25 - función sqrt() = <B>" .sqrt(25)."</B><P>";
}
else
/******** Números aleatorios *********/
{
	print("<CENTER><H2>Números aleatorios</H2></CENTER><P>");

	echo "Mayor número aleatorio posible - función getrandmax() = <B>".number_format(getrandmax(),0,',','.')."</B><P>";

	echo "Mayor número aleatorio posible - función mt_getrandmax() = <B>".number_format(mt_getrandmax(),0,',','.')."</B>
			<P>";

	srand((double)microtime()*1000000);
	echo "Con la instrucción <B>\"srand((double)microtime()*
			1000000);\"</B> hemos inicializado la búsqueda del 
			número aleatorio introduciendo una semilla de generación 
			de números aleatorios. Si ahora aplicamos la función 
			 <B> \"rand()\"</B>, encontramos el número aleatorio 
			 <B>".number_format(rand(),0,',','.')."</B>. Para ver 
			 cómo va cambiando, puedes actualizar la página.<P>";

	mt_srand((double)microtime()*1000000);
	echo "Con la instrucción <B>\"mt_srand((double)microtime()*
			1000000);\"</B> hemos inicializado la búsqueda del 
			número aleatorio mejorado introduciendo una semilla 
			de generación de números aleatorios mejorados. 
			Si ahora aplicamos la función <B> \"mt_rand()\"</B>, 
			encontramos el número aleatorio mejorado <B>" 
			.number_format(mt_rand(),0,',','.')."</B>. Para ver 
			cómo va cambiando, puedes actualizar la página.<P>";

	srand((double)microtime()*1000000);
	echo "Con la instrucción <B>\"srand((double)microtime()*
			1000000);\"</B> hemos inicializado la búsqueda del 
			número aleatorio introduciendo una semilla de 
			generación de números aleatorios. Si ahora aplicamos 
			la función <B> \"rand(1000,5000)\"</B>, encontramos 
			el número aleatorio <B>" 
			.number_format(rand(1000,5000),0,',','.')."</B>. 
			Para ver cómo va cambiando, puedes actualizar la 
			página.<P>";

	mt_srand((double)microtime()*1000000);
	echo "Con la instrucción <B>\"mt_srand((double)microtime()*
			1000000);\"</B> hemos inicializado la búsqueda del 
			número aleatorio mejorado introduciendo una semilla 
			de generación de números aleatorios mejorados. Si 
			ahora aplicamos la función <B>
			\"mt_rand(1000000,100000000)\"</B>, encontramos el 
			número aleatorio mejorado <B>"
			.number_format(mt_rand(1000000,100000000),0,',','.')
			."</B>.Para ver cómo va cambiando, puedes actualizar 
			la página.<P>";
}

?>
<BR><CENTER><INPUT type='button' value='<- Volver a la página anterior'onClick='history.back()'></CENTER>
</BODY>
</HTML>