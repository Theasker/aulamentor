<HTML>
<HEAD><TITLE>Ejemplo 3b - Unidad 3 - Curso Iniciación de PHP 5</TITLE>
	<style type="text/css">
    p { margin-left:5em; }
  </style>
  </HEAD>
<BODY>

<?php
	
	function ver ($contenido, $indice)
	{ echo "<B>$indice. $contenido</B><br>\n"; }
	
	function ver2($contenido, $indice)
	{echo "<BR>El índice $indice contiene $contenido\n";}


/******** Crear e inicializar matrices *********/
if ($_GET["tipo"]==1)
{
	
	// Función array()

	$persona=array("Josefa","Pérez","Rubio",60);
	$datos=array("nombre"=>"Josefa","apellido1"=>"Pérez",
					   "apellido2"=>"Rubio","edad"=>60);
	$notas=array(0=>array(0=>1,1=>2,2=>3),
                     1=>array(0=>4,1=>5,2=>6),
                     2=>array(0=>7,1=>8,2=>9));
                     
	echo "<CENTER>
				<H1>Función array()</H1><P>
				<H3>Hemos creado e inicializado tres matrices. Con 
				ellas vamos a realizar diferentes operaciones.</H3>
			</CENTER>
			<PRE>
				\$persona=array(\"Josefa\",\"Pérez\",\"Rubio\",60)<P>
				\$datos=array(\"nombre\"=>\"Josefa\",
				             \"apellido1\"=>\"Pérez\",
				             \"apellido2\"=>\"Rubio\",
				             \"edad\"=>60)<P>
				\$notas=array(0=>array(0=>1,1=>2,2=>3),
              				     1=>array(0=>4,1=>5,2=>6),
              				     2=>array(0=>7,1=>8,2=>9));
			</PRE><P>";

	// Función range()

	echo "<CENTER>
				<H1>Función range()</H1><P> 
				<H3>Con la función range(2,6) creamos la matriz \$parte
    					que contiene estos elementos<P>
    			</H3>
    		</CENTER>";
	$parte=range(2,6);
	echo "<PRE>";
	for ($i=0; $i < count($parte); $i++)
  		echo "$parte[$i] - ";
	print "</PRE><P>";
	echo "<CENTER><H3>Con la función range(25,50) creamos la matriz 
			\$lista_numeros que contiene estos elementos<P></H3>
			</CENTER>";
	$lista_numeros=range(25,50);
	echo "<PRE>";
	for ($i=0; $i < count($lista_numeros); $i++)
  		echo "$lista_numeros[$i] - ";
  	echo "</PRE>";
  		
} // END Crear e inicializar matrices

else  

/***** Recorrer los elementos de una matriz ******/
if ($_GET["tipo"]==2)
{
	$persona=array("Josefa","Pérez","Rubio",60);
	$datos=array("nombre"=>"Josefa","apellido1"=>"Pérez",
					   "apellido2"=>"Rubio","edad"=>60);
	$notas=array(0=>array(0=>1,1=>2,2=>3),
                     1=>array(0=>4,1=>5,2=>6),
                     2=>array(0=>7,1=>8,2=>9));

	//  Función reset()

	echo "<CENTER><H1>Función reset()</H1></CENTER><P>
			Con la instrucción <B>reset(\$persona)</B>
			colocamos el puntero en el primer elemento y mostramos 
			su contenido, que es <B>".reset($persona)."</B>.<P>";

	//  Función end()

	echo "<CENTER><H1>Función end()</H1></CENTER><P>
			Con la instrucción <B>end(\$persona) </B>colocamos el 
			puntero en el último elemento y mostramos su contenido, 
			que es <B>".end($persona)."</B>.<P>";
	if (!next($persona)) echo "<B>Se acabó. </B>Con next() se ha 
									sobrepasado el último elemento.<P>";
	//  Función count()

	echo "<CENTER><H1>Función count()</H1></CENTER><P>
			Con un bucle <B>for</B> combinado con el valor devuelto por 
			la función<B>count(\$persona) </B> recorremos los elementos 
			de la matriz y mostramos su contenido, que es<P>";
	$numero_elementos=count($persona);
	for ($i=0; $i < $numero_elementos; $i++)
    	echo "<B> $persona[$i] </B><P>";

	echo "En cambio, para recorrer la matriz bidimensional <B>\$notas</B>
			no podemos utilizar <B>count()</B> y necesitamos dos bucles 
			<B>for</B>.<P>";
      		
	for ($i=0; $i < 3; $i++)
	{
    	for ($j=0; $j < 3; $j++)
        	echo "<B>".$notas[$i][$j]." - </B>";
	}

	//  Función next()

	echo "<CENTER><H1>Función next()</H1></CENTER><P>
			Ahora el puntero está sobre el primer elemento al haberse 
			ejecutado la función <B>reset().</B><P>";
	echo "El primer elemento contiene <B>".reset($persona)."</B>.<P>";
	echo "<B>".next($persona)."</B> Con la función next() lo hemos colocado 
			sobre el segundo elemento.<P>";
	echo "<B>".next($persona)."</B> Con la función next() lo hemos colocado 
			sobre el tercero elemento.<P>";
	echo "<B>".next($persona)."</B> Con la función next() lo hemos colocado 
			sobre el cuarto y último elemento.<P>";
	if (!next($persona)) echo "<B>Se acabó. </B>Con un nuevo next() se ha 
			sobrepasado el último elemento.<P>";

	//  Función prev()

	echo "<CENTER><H1>Función prev()</H1></CENTER><P>
			Ahora el puntero está sobre el último elemento al haberse 
			ejecutado la función end().<P>";
	echo "El último elemento contiene <B>".end($persona)."</B>.<P>";
	echo "<B>".prev($persona)."</B> Con la función prev() lo hemos colocado 
			sobre el tercer elemento.<P>";
	echo "<B>".prev($persona)."</B> Con la función prev() lo hemos colocado 
			sobre el segundo elemento.<P>";
	echo "<B>".prev($persona)."</B> Con la función prev() lo hemos colocado 
			sobre el primer elemento.<P>";
	if (!prev($persona)) echo "<B>Se acabó.</B> Con un nuevo prev() se ha 
			sobrepasado el primer elemento.<P>";

	//  Función current()

	echo "<CENTER><H1>Función current()</H1></CENTER><P>";
	reset($persona);
	for ($i=0; $i < count($persona); $i++)
	{
    	echo "<B>".current($persona)."</B><P>";
    	next($persona);   // Ahora movemos el puntero con next().
	}
	if (!current($persona)) echo "<B>Se acabó. </B>Ahora current() devuelve 
					False,pues se ha sobrepasado el último elemento.<P>";

	//  Función key()

	echo "<CENTER><H1>Función key()</H1></CENTER><P>
			Con un bucle <B>for</B> combinado con el valor devuelto por la 
			función <B>count(\$datos) </B> recorremos los elementos de la 
			matriz y mostramos su índice y su contenido, que es<P>";
	$numero_elementos=count($datos);
	for ($i=0; $i < $numero_elementos; $i++)
	{
    	$indice=key($datos);
    	echo "Indice:<B> $indice. </B>Contenido: <B>$persona[$i] </B><P>";
    	next($datos);
	}

} //END Recorrer los elementos de una matriz
else  

/***** Matrices y cadenas de caracteres ******/
if ($_GET["tipo"]==3)
{

	// Función explode()

	$texto="blanco;amarillo;rojo;verde;azul;negro";
	$colores=explode(";",$texto);
	echo "<CENTER><H1>Función explode()</H1><P>
			<H3>
				Hemos creado la variable \$texto=\"$texto\"<P>
				En la matriz \$colores creada con la función explode() 
				tenemos los elementos siguientes:
     		</H3>
     		</CENTER><P>";

	$numero_elementos=count($colores);
	for ($i=0; $i < $numero_elementos; $i++)
    	echo "Elemento $i:<B> $colores[$i]. </B><P>";

	// Función implode()

	echo "<CENTER><H1>Función implode()</H1><P>
			<H3><CENTER>Ahora convertimos en la cadena <B>\$texto </B>
				los elementos de la matriz <B>\$colores</B> usando la 
				función <B>implode(\$colores)</B>.
			</H3>
		</CENTER><P>";
	$texto=implode(";",$colores);
	echo "La variable <B>\$texto</B> contiene de nuevo <B>\"$texto\"</B>.";

} // END Matrices y cadenas de caracteres
else  

/******** Ordenar matrices *********/
if ($_GET["tipo"]==4)
{

	// Función arsort()

	echo "<CENTER><H1>Función arsort()</H1></CENTER><P>";
	$palabras= array("1"=>"amazona","2"=>"león","3"=>"zozobra",
							"4"=>"sabueso", "5"=>"bondad","6"=>"obús");
	echo "<CENTER><H3>Hemos creado e inicializado la matriz \$palabras
      		que contiene estos elementos</H3></CENTER><P>";
	$numero_elementos=count($palabras);
	for ($i=1; $i <= $numero_elementos; $i++)
	{
    	$indice=key($palabras);
    	echo "Indice: <B>$indice</B>. Contenido: <B>$palabras[$i]</B><P>";
    	next($palabras);
	}
	arsort($palabras);
	echo "<CENTER><H3>Hemos aplicado la función <B>arsort()</B> a esta 
			matriz y ahora contiene los elementos siguientes</H3></CENTER><P>";
	for ($i=1; $i <= $numero_elementos; $i++)
	{
    	$indice=key($palabras);
    	echo "Indice: <B>$indice</B>. Contenido: <B>$palabras[$indice]</B><P>";
    	next($palabras);
	}

	// Función asort()

	echo "<CENTER><H1>Función asort()</H1></CENTER><P>";
	$palabras= array("1"=>"amazona","2"=>"león","3"=>"zozobra","4"=>"sabueso",
           				"5"=>"bondad","6"=>"obús");
	echo "<H3><CENTER>Hemos creado e inicializado la matriz \$palabras
			que contiene estos elementos</H3></CENTER><P>";
	$numero_elementos=count($palabras);
	for ($i=1; $i <= $numero_elementos; $i++)
	{
    	$indice=key($palabras);
    	echo "Indice: <B>$indice</B>. Contenido: <B>$palabras[$i]</B><P>";
    	next($palabras);
	}
	asort($palabras);
	echo "<CENTER><H3>Hemos aplicado la función <B>asort()</B> a esta matriz 
			y ahora contiene los elementos siguientes </H3></CENTER><P>";
	for ($i=1; $i <= $numero_elementos; $i++)
	{
    	$indice=key($palabras);
    	echo "Indice: <B>$indice</B>. Contenido: <B>$palabras[$indice]</B><P>";
    	next($palabras);
	}

	// Función krsort()

	echo "<CENTER><H1>Función krsort()</H1></CENTER><P>";
	$palabras= array("1"=>"amazona","2"=>"león","3"=>"zozobra",
						"4"=>"sabueso", "5"=>"bondad","6"=>"obús");
	echo "<CENTER><H3>Hemos creado e inicializado la matriz \$palabras
			que contiene estos elementos</H3></CENTER><P>";
	$numero_elementos=count($palabras);
	for ($i=1; $i <= $numero_elementos; $i++)
	{
    	$indice=key($palabras);
    	echo "Indice: <B>$indice</B>. Contenido: <B>$palabras[$i]</B><P>";
    	next($palabras);
	}

	krsort($palabras);
	echo "<CENTER><H3>Hemos aplicado la función <B>krsort()</B> a esta matriz 
			y ahora contiene los elementos siguientes</H3></CENTER><P>";
	for ($i=1; $i <= $numero_elementos; $i++)
	{
    	$indice=key($palabras);
    	echo "Indice: <B>$indice</B>. Contenido: <B>$palabras[$indice]</B><P>";
    	next($palabras);
	}

	// Función ksort()

	echo "<CENTER><H1>Función ksort()</H1></CENTER><P>";
	$palabras= array("1"=>"amazona","2"=>"león","3"=>"zozobra",
							"4"=>"sabueso", "5"=>"bondad","6"=>"obús");
	echo "<H3><CENTER>Hemos creado e inicializado la matriz \$palabras que 
			contiene estos elementos</H3></CENTER><P>";
	$numero_elementos=count($palabras);
	for ($i=1; $i <= $numero_elementos; $i++)
	{
    	$indice=key($palabras);
    	echo "Indice: <B>$indice</B>. Contenido: <B>$palabras[$i]</B><P>";
    	next($palabras);
	}
	ksort($palabras);
	echo "<CENTER><H3>Hemos aplicado la función <B>ksort()</B> a esta matriz 
			y ahora contiene los elementos siguientes</H3></CENTER><P>";
	for ($i=1; $i <= $numero_elementos; $i++)
	{
    	$indice=key($palabras);
    	echo "Indice: <B>$indice</B>. Contenido: <B>$palabras[$indice]</B><P>";
    	next($palabras);
	}

	// Función shuffle()

	echo "<CENTER><H1>Función shuffle()</H1></CENTER><P>";
	$palabras= array("1"=>"amazona","2"=>"león","3"=>"zozobra",
							"4"=>"sabueso", "5"=>"bondad","6"=>"obús");
	echo "<CENTER><H3>Hemos creado e inicializado la matriz \$palabras
      		que contiene estos elementos</H3></CENTER><P>";
	$numero_elementos=count($palabras);
	for ($i=1; $i <= $numero_elementos; $i++)
	{
    	$indice=key($palabras);
    	echo "Indice: <B>$indice</B>. Contenido: <B>$palabras[$i]</B><P>";
    	next($palabras);
	}
	shuffle($palabras);
	echo "<CENTER><H3>Hemos aplicado la función <B>shuffle()</B> a esta matriz y
			ahora contiene los elementos siguientes </H3></CENTER><P>";
	do
	{
    	$indice=key($palabras);
    	$valor=current($palabras);
    	echo "El elemento <B>$indice</B> tiene el valor <B>$valor</B>.<P>";
	}
	while (next($palabras));

	// Función uasort()

	echo "<CENTER><H1>Función uasort()</H1></CENTER><P>";

	function compara($a,$b)
	{
 		if (substr($a,3,1)>substr($b,3,1)) return true;
 		else return false;
	}
	echo "<CENTER><H3>Hemos creado e inicializado la matriz \$colores
			que contiene estos elementos</H3></CENTER><P>";
	$colores=array("a"=>"blanco","b"=>"azul","c"=>"rojo",
						 "d"=>"amarillo","e"=>"verde");
	for (reset($colores);$indice=key($colores);next($colores))
    	echo "Indice: <B>$indice</B> Contenido: <B>$colores[$indice]</B><P>";
    	
	echo "<CENTER><H3>Hemos aplicado la función <B>uasort()</B> a esta matriz 
				y ahora contiene los elementos siguientes<P></H3>
				<H4>La función de usuario <B>compara()</B> hace que los 
					elementos se ordenen<P>de menor a mayor según el cuarto 
					carácter de su contenido.
				</H4>
			</CENTER><P>";
      
	uasort($colores,"compara");
	for (reset($colores);$indice=key($colores);next($colores))
    	echo "Indice: <B>$indice</B> Contenido: <B>$colores[$indice]</B><P>";

	// Función uksort()

	echo "<CENTER><H1>Función uksort()</H1><P>
				<H3>Hemos creado e inicializado la matriz \$colores 
				que contiene estos elementos</H3>
			</CENTER><P>";
      		
	$colores=array("a"=>"blanco","b"=>"azul","c"=>"rojo",
						 "d"=>"amarillo","e"=>"verde");
						 
	for (reset($colores);$indice=key($colores);next($colores))
    	echo "Indice: <B>$indice</B> Contenido: <B>$colores[$indice]</B><P>";
    	
	echo "<CENTER><H3>Hemos aplicado la función <B>uksort()</B> a esta matriz 
				y ahora contiene los elementos siguientes</H3><P>
				<H4>La función de usuario <B>compara()</B> hace que los 
					elementos se ordenen<P>de mayor a menor según el cuarto 
					carácter de su índice.
				</H4>
			</CENTER><P>";
	uksort($colores,"compara");
	for (reset($colores);$indice=key($colores);next($colores))
    	echo "Indice: <B>$indice</B> Contenido: <B>$colores[$indice]</B><P>";

} // END Ordenar matrices
else  

/******** Modificar matrices ***********/
if ($_GET["tipo"]==5)
{

	// Función array_merge()

	echo "<CENTER><H1>Función array_merge()</H1><P>
				<H3>Hemos creado e inicializado la matriz \$colores que 
				contiene estos elementos</H3></CENTER><P>";
	$colores= array("primero"=>"blanco","segundo"=>"azul","tercero"=>"rojo",
							"cuarto"=>"amarillo","quinto"=>"verde");
	for (reset($colores);$indice=key($colores);next($colores))
    	echo "Indice: <B>$indice</B> Contenido: <B>$colores[$indice]</B><P>";
	
	echo "<CENTER><H3>Hemos creado e inicializado la matriz \$sabores
			que contiene estos elementos</H3></CENTER><P>";
	$sabores= array("sexto"=>"dulce","septimo"=>"amargo","octavo"=>"salado",
							"noveno"=>"soso","decimo"=>"menta");
	for (reset($sabores);$indice=key($sabores);next($sabores))
    	echo "Indice: <B>$indice</B> Contenido: <B>$sabores[$indice]</B><P>";
    	
	echo "<CENTER><H3>Con la función <B>array_merge()</B> hemos unido las 
			dos matrices en otra<P>que hemos llamado \$color_sabor que contiene 
			los elementos siguientes</H3></CENTER><P>";
	$color_sabor=array_merge($colores,$sabores);
	for (reset($color_sabor);$indice=key($color_sabor);next($color_sabor))
    	echo "Indice: <B>$indice</B> Contenido: <B>$color_sabor[$indice]</B><P>";

	// Función array_pad()

	echo "<CENTER><H1>Función array_pad()</H1></CENTER><P>";
	$sabores= array("dulce","amargo","salado","soso","menta");
	echo "<CENTER><H3>Hemos creado e inicializado la matriz \$sabores
			que contiene estos elementos</H3></CENTER><P>";
	for ($i=0; $i < count($sabores); $i++)
    	echo "Contenido: <B>$sabores[$i]</B><P>";
	echo "<CENTER><H3>Con la función <B>array_pad()</B> hemos añadido
			tres elementos más con el contenido <B>\"indeterminado\"</B>.
			<P>Ahora la matriz queda así:</H3></CENTER><P>";
			
	$completa=array_pad($sabores,8,"indeteminado");
	for ($i=0; $i < count($completa); $i++)
    	echo "Contenido: <B>$completa[$i]</B><P>";

	// Función array_splice()

	echo "<CENTER><H1>Función array_splice()</H1></CENTER><P>";
	$sabores= array("dulce","amargo","salado","soso","menta");
	$otros=array("fresa","limón");
	
	echo "<CENTER><H3>Hemos creado e inicializado la matriz \$sabores
			que contiene estos elementos</H3></CENTER><P>";
	for ($i=0; $i < count($sabores); $i++)
    	echo "Contenido: <B>$sabores[$i]</B><P>";
    	
	echo "<CENTER><H3>Hemos creado e inicializado también la matriz \$otros
			que contiene estos elementos</H3></CENTER><P>";
	for ($i=0; $i < count($otros); $i++)
    	echo "Contenido: <B>$otros[$i]</B><P>";
    	
	echo "<CENTER><H3>Con la función array_splice() hemos insertado
			los elementos de la matriz \$otros a partir del elemento
			tercero de la matriz original.</H3></CENTER><P>";
	$nueva=array_splice($sabores,2,2,$otros);
	for ($i=0; $i < count($sabores); $i++)
    	echo "Contenido: <B>$sabores[$i]</B><P>";
    	
	echo "<CENTER><H3>En cambio, la matriz \$nueva contiene los elementos
			eliminados de la matriz \$sabores original.</H3></CENTER><P>";
	for ($i=0; $i < count($nueva); $i++)
    	echo "Contenido: <B>$nueva[$i]</B><P>";

	// Función array_walk()

	echo "<CENTER><H1>Función array_walk()</H1></CENTER><P>";

	$muebles = array ("z"=>"mesa", "y"=>"silla", "x"=>"armario", "v"=>"cómoda");
	function cambia (&$contenido, $indice, $anexo)
	{
   		$contenido = "$anexo: $contenido";
	}

	echo "<CENTER><H3>Hemos creado e inicializado la matriz \$muebles
			que contiene estos índices y elementos.</H3></CENTER><P>";
	array_walk ($muebles,'ver');
	print "<P>";
	reset ($muebles);
	array_walk ($muebles, 'cambia', 'Nombre');
	print "<P>";
	reset ($muebles);
	echo "<CENTER><H3>Con la función array_walk() hemos antepuesto al 
			contenido de cada elemento <P>el prefijo \"Nombre:\" y hemos 
			vuelto a usar la función array_walk() <P>para ver su contenido 
			una vez modificado</H3></CENTER><P>";
	array_walk ($muebles,'ver');
	print "<P>";

	// Función compact()

	echo "<CENTER><H1>Función compact()</H1></CENTER><P>";
	$Insuficiente="Calificaciones: 0, 1, 2, 3 y 4";
	$Suficiente="Calificaciones: 5 y 6";
	$Notable="Calificaciones 7 y 8";
	$Sobresaliente="Calificaciones 9 y 10";
	
	echo "<CENTER><H3>Hemos creado e inicializado tres variables cuyo 
			nombre hemos guardado en la matriz \$califica. Una cuarta 
			variable la pasamos directamente como argumento de la 
			función. La nueva matriz tiene los elementos siguientes:
			</H3></CENTER><P>";
	$califica=array ("Insuficiente","Suficiente","Notable");
	$nueva_matriz=compact ($califica,"Sobresaliente");
	array_walk($nueva_matriz,'ver');
	print "<P>";

}// END Modificar matrices
else  

/***** Extraer información de las matrices ******/
if ($_GET["tipo"]==6)
{

	// Función array_count_value()

	echo "<CENTER><H1>Función array_count_value()</H1></CENTER><P>
			<H3><CENTER>Hemos creado e inicializado la matriz \$tempe,
			que contiene los elementos siguientes:</H3></CENTER><P>";
	$tempe=array ("01/01/2001"=>12,"10/01/2001"=>14,"15/01/2001"=>12,
						"01/02/2001"=>15,"10/02/2001"=>16,"15/02/2001"=>16,
						"01/03/2001"=>12,"10/03/2001"=>14,"15/03/2001"=>15,
						"01/04/2001"=>12,"10/04/2001"=>16,"15/04/2001"=>15,
						"01/05/2001"=>14,"10/05/2001"=>20,"15/05/2001"=>22);
	array_walk($tempe,'ver');
	print "<P>";
	$nueva=array_count_values($tempe);
	echo "<CENTER><H3>Con la función array_count_values() creamos la 
			matriz \$nueva,<P>que contiene los elementos siguientes:</H3>
			</CENTER><P>";
	array_walk($nueva,'ver');
	print "<P>";
	
	// Función array_keys()

	echo "<CENTER><H1>Función array_keys()</H1></CENTER><P>";

	echo "<CENTER><H3>Hemos creado e inicializado la matriz \$tempe,
			que contiene los elementos siguientes:</H3>
			</CENTER><P>";
	$tempe=array ("01/01/2001"=>12,"10/01/2001"=>14,"15/01/2001"=>12,
						"01/02/2001"=>15,"10/02/2001"=>16,"15/02/2001"=>16,
						"01/03/2001"=>12,"10/03/2001"=>14,"15/03/2001"=>15,
						"01/04/2001"=>12,"10/04/2001"=>16,"15/04/2001"=>15,
						"01/05/2001"=>14,"10/05/2001"=>20,"15/05/2001"=>22);
	array_walk($tempe,'ver');
	print "<P>";
	$nueva=array_keys($tempe);
	echo "<CENTER><H3>Con la función array_keys() creamos la matriz
			\$nueva,<P>que contiene los elementos siguientes:</H3></CENTER><P>";
	array_walk($nueva,'ver');
	print "<P>";
	$nueva=array_keys($tempe,14);
	echo "<CENTER><H3>Añadiendo el valor 14 como segundo argumento de la función 
			<P>la matriz \$nueva sólo contiene los elementos siguientes:</H3>
			</CENTER><P>";
	array_walk($nueva,'ver');
	print "<P>";

	// Función array_slice()

	echo "<CENTER><H1>Función array_slice()</H1></CENTER><P>";
	$altura=array("muy alto","alto","medio","bajo","muy bajo");
	echo "<CENTER><H3>Hemos creado e inicializado la matriz \$altura,
			que contiene los elementos siguientes:</H3></CENTER><P>";
	array_walk($altura,'ver');
	print "<P>";
	$nueva=array_slice($altura,2,2);
	echo "<H3><CENTER>Con la función array_slice(\$altura,2,2) creamos la matriz 
			\$nueva,<P>que contiene los elementos siguientes:</H3></CENTER><P>";
	array_walk($nueva,'ver');
	print "<P>";
	$nueva=array_slice($altura,2);
	echo "<CENTER><H3>Con la función array_slice(\$altura,2) creamos la matriz
			\$nueva,<P>que contiene los elementos siguientes:</H3></CENTER><P>";
	array_walk($nueva,'ver');
	print "<P>";
	$nueva=array_slice($altura,-2);
	echo "<CENTER><H3>Con la función array_slice(\$altura,-2) creamos la matriz
			\$nueva,<P>que contiene los elementos siguientes:</H3></CENTER><P>";
	array_walk($nueva,'ver');
	print "<P>";

	// Función array_values()

	echo "<CENTER><H1>Función array_values()</H1></CENTER><P>";
	$con_indices=array ("uno"=>"muy alto","dos"=>"alto","tres"=>"medio",
								"cuatro"=>"bajo","cinco"=>"muy bajo");
	echo "<CENTER><H3>Hemos creado e inicializado la matriz \$con_indices,
			que contiene los elementos siguientes:</H3></CENTER><P>";
	array_walk($con_indices,'ver');
	print "<P>";
	$nueva=array_values($con_indices);
	echo "<CENTER><H3>Con la función array_values(\$con_indices) creamos la 
			matriz \$nueva,<P>que contiene los elementos siguientes:</H3>
			</CENTER><P>";
	array_walk($nueva,'ver');
	print "<P>";

	// Función each()

	echo "<CENTER><H1>Función each()</H1></CENTER><P>";
	$con_indices=array ("uno"=>"muy alto","dos"=>"alto","tres"=>"medio",
								"cuatro"=>"bajo","cinco"=>"muy bajo");
	echo "<CENTER><H3>Hemos creado e inicializado la matriz \$con_indices,
			que contiene los elementos siguientes:</H3></CENTER><P>";
	array_walk($con_indices,'ver');
	print "<P>";
	echo "<CENTER><H3>Hemos desplazado el puntero al tercer elemento.</H3>
			</CENTER><P>";
	reset($con_indices);
	next($con_indices);
	next($con_indices);
	echo "<CENTER><H3>Con la función each(\$con_indices) creamos la matriz
			\$nueva, que contiene los elementos siguientes:</H3></CENTER><P>";
	$nueva=each($con_indices);
	array_walk($nueva,'ver');

	echo "<CENTER><H3>Con la función each(\$con_indices) creamos la matriz
			\$nueva del siguiente elemento, que contiene: </H3></CENTER><P>";
	$otra=each($con_indices);
	array_walk($otra,'ver');

	// Función extract()

	echo "<CENTER><H1>Función extract()</H1></CENTER><P>";
	$altura=array ("uno"=>"muy alto","dos"=>"alto","tres"=>"medio",
						"cuatro"=>"bajo","cinco"=>"muy bajo");
	echo "<CENTER><H3>Hemos creado e inicializado la matriz \$altura,
			que contiene los elementos siguientes:</H3></CENTER><P>";
	array_walk($altura,'ver');
	print "<P>";
	extract($altura);
	echo "<CENTER><H3>Hemos aplicado la función extract(\$altura) y ahora 
			tenemos cinco variables que tienen <P>como nombre el índice de 
			los elementos de la matriz y como valor su contenido,<P>como 
			puede verse.</H3>
			</CENTER><P>";
	print "<P>";
	echo "<B>\$uno=\"$uno\"=, \$dos=\"$dos\", \$tres=\"$tres\",
			\$cuatro=\"$cuatro\", \$cinco=\"$cinco\"</B>";
	print "<P>";
	$uno="el primero";
	echo "<CENTER><H3>Ahora hemos creado previamente la variable \$uno,
			que contienen \"el primero\",<P>hemos aplicado la función
			extract(\$altura,EXTR_SKIP) y tenemos estos resultados:</H3>
			</CENTER><P>";
	extract($altura,EXTR_SKIP);
	echo "<B>\$uno=\"$uno\"=, \$dos=\"$dos\", \$tres=\"$tres\",
			\$cuatro=\"$cuatro\", \$cinco=\"$cinco\"</B>";
	print "<P>";
	echo "<CENTER><H3>Ahora hemos aplicado la función
			extract(\$altura,EXTR_PREFIX_SAME,\"bis\")<P>
			y tenemos estos resultados:</H3></CENTER><P>";
	$uno="el primero";
	extract($altura,EXTR_PREFIX_SAME,"bis");
	echo "<B>\$uno=\"$uno\"=, \$dos=\"$dos\", \$tres=\"$tres\",
			\$cuatro=\"$cuatro\", \$cinco=\"$cinco\", 
			\$bis_uno=\"$bis_uno\"</B>";
	print "<P>";

	// Función in_array()

	echo "<CENTER><H1>Función in_array()</H1></CENTER><P>";
	$altura=array ("uno"=>"muy alto","dos"=>"alto","tres"=>"medio",
						"cuatro"=>"bajo","cinco"=>"muy bajo");
	echo "<CENTER><H3>Hemos creado e inicializado la matriz \$altura,
			que contiene los elementos siguientes:</H3></CENTER><P>";
	array_walk($altura,'ver');
	print "<P>";
	$busca="alto";
	echo "<CENTER><H3>Ahora hemos creado \$busca, que contiene \"alto\".
			</H3></CENTER><P>";
	if (in_array($busca,$altura)) echo "<B>La matriz contiene la cadena 
													dada.</B>";
	else echo "<B>La matriz no contine la cadena dada.</B><P>";
	$busca="casa";
	echo "<CENTER><H3>Ahora hemos creado \$busca, que contiene \"casa\".
			</H3></CENTER><P>";
	if (in_array($busca,$altura)) echo "<B>La matriz contiene la cadena 
													dada.</B>";
	else echo "<B>La matriz no contiene la cadena dada.</B><P>";

	// La construcción list()

	echo "<CENTER><H1>Construcción list()</H1></CENTER><P>";
	$comunidad = array ("CA1"=>"Aragón","CA2"=>"Andalucía","CA3"=>"Galicia",
								"CA4"=>"Murcia","CA5"=>"Valencia","CA6"=>"Canarias");
	echo "<CENTER><H3>Hemos creado e inicializado la matriz \$comunidad,
			que contiene los elementos siguientes:</H3></CENTER><P>";
	array_walk($comunidad,'ver');
	print "<P>";
	echo "<CENTER><H3>Ahora recorremos sus elementos combinando en un bucle while la 
			función each() con la construcción list().</H3></CENTER><P>";
	reset($comunidad);
	while (list($indice,$valor)=each($comunidad))
	{     
		print ("El elemento <B>$indice</B> contiene el valor <B>$valor</B><P>");
	}

} // END Extraer información de las matrices

else  

/***** Tratar matrices como si fueran pilas ******/
if ($_GET["tipo"]==7)
{

	// Funciones array_pop(), array_push, array_shift y array_unshift

	echo "<CENTER><H1>Función array_pop()</H1></CENTER><P>";
	$comunidad = array ("CA1"=>"Aragón","CA2"=>"Andalucía","CA3"=>"Galicia",
								"CA4"=>"Murcia","CA5"=>"Valencia","CA6"=>"Canarias");
	echo "<CENTER><H3>Hemos creado e inicializado la matriz \$comunidad, que contiene 
			los elementos siguientes:</H3></CENTER><P>";
	array_walk($comunidad,'ver');
	print "<P>";
	echo "<CENTER><H3>Hemos ejecutado la función array_pop(\$comunidad) y la matriz 
			anterior ha perdido el último elemento, como puede verse. </H3></CENTER><P>";
	array_pop($comunidad);
	reset($comunidad);
	array_walk($comunidad,'ver');
	print "<P>";
	
	echo "<CENTER><H1>Función array_push()</H1></CENTER><P>";
	echo "<CENTER><H3>Hemos ejecutado la función array_push(\$comunidad) añadiendo 
			los elementos \"Extremadura\" y \"Cantabria\" y la matriz anterior 
			ha ganado dos elementos, como puede verse.</H3></CENTER><P>";
	array_push($comunidad,"Extremadura","Cantabria");
	reset($comunidad);
	array_walk($comunidad,'ver');
	print "<P>";
	
	echo "<CENTER><H1>Función array_shift()</H1></CENTER><P>";
	echo "<CENTER><H3>Hemos ejecutado la función array_shift(\$comunidad) 
			eliminando el primer elemento de la matriz anterior y desplazando  los 
			demás una posición a la izquierda, como puede verse.</H3></CENTER><P>";
	array_shift($comunidad);
	reset($comunidad);
	array_walk($comunidad,'ver');
	print "<P>";
	echo "<CENTER><H1>Función array_unshift()</H1></CENTER><P>";
	echo "<CENTER><H3>Hemos ejecutado la función array_unshift(\$comunidad)
			añadiendo los elementos \"Madrid\" y \"Castilla León\" al principio 
			de la matriz anterior, como puede verse.</H3></CENTER><P>";
	array_unshift($comunidad,"Madrid","Castilla León");
	reset($comunidad);
	array_walk($comunidad,'ver');
	print "<P>";

} // END Tratar matrices como si fueran pilas

else  

/***** Nuevas funciones PHP 5 ******/
if ($_GET["tipo"]==8)
{
	// Funciones array_combine(), array_walk_recursive() y array_uintersect()

	echo "<CENTER><H1>Función array_combine()</H1></CENTER><P>";	
	$matriz1 = array('uno', 'dos', 'tres');
	$matriz2 = array('primero', 'segundo', 'tercero');	
	echo "<CENTER><H3>Hemos creado e inicializado las matrices \$matriz1 y \$matriz2, que contienen 
			los elementos siguientes:</H3></CENTER><P>";
	echo "<PRE>\$matriz1=";
	print_r($matriz1);
	print "<P>";
	echo "\$matriz2=";
	print_r($matriz2);
	print "</PRE><P>";	
	echo "<CENTER><H3>Hemos ejecutado la función array_combine(\$matriz1, \$matriz2) y la matriz 
			resultante \$matriz_resultado es la siguiente. </H3></CENTER><P>";
	$matriz_resultado = array_combine($matriz1, $matriz2);
	echo "<PRE>\$matriz_resultado=";
	print_r($matriz_resultado);		
	print "</PRE><P>";
	
	echo "<CENTER><H1>Función array_walk_recursive()</H1></CENTER><P>";	
	$matriz = array('a'=>'uno', 'b'=>'dos', 'c'=>'tres', 'd'=> array('primero', 'segundo', 'tercero'));
	
	echo "<CENTER><H3>Hemos creado e inicializado la matriz \$matriz, que contiene 
			los elementos siguientes:</H3></CENTER><P>";
	echo "<PRE>\$matriz = ";
	print_r($matriz);
	print "</PRE>";		
	echo "<CENTER><H3>Hemos ejecutado la función array_walk_recursive(\$matriz, 'ver2') y el resultado 
	      es el siguiente. </H3></CENTER><P>";
	array_walk_recursive($matriz, 'ver2');
	print "<P>";
	
	echo "<CENTER><H1>Función array_uintersect()</H1></CENTER><P>";	
	$matriz1 = array('uno', 'dos', 'tres', 'cinco');
	$matriz2 = array('dos', 'cuatro', 'cinco');	
	echo "<CENTER><H3>Hemos creado e inicializado las matrices \$matriz1 y \$matriz2, que contienen 
			los elementos siguientes:</H3></CENTER><P>";
	echo "<PRE>\$matriz1=";
	print_r($matriz1);
	print "<P>";
	echo "\$matriz2=";
	print_r($matriz2);
	print "</PRE><P>";	
	echo "<CENTER><H3>Hemos ejecutado la función array_uintersect(\$matriz1, \$matriz2, 'strcasecmp') y la matriz 
			resultante \$matriz_resultado es la siguiente. </H3></CENTER><P>";
	$matriz_resultado = array_uintersect($matriz1, $matriz2, 'strcasecmp');
	echo "<PRE>\$matriz_resultado = ";
	print_r($matriz_resultado);
	print "</PRE>";
	print "<P>";

} // END Nuevas funciones PHP 5

echo  "<BR><CENTER><INPUT type='button' value='<- Volver a la página anterior'onClick='history.back()'></CENTER>";

?>
</BODY>
</HTML>

