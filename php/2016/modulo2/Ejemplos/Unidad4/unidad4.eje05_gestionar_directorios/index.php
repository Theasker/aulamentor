<HTML>
<HEAD><TITLE>Ejemplo 5 - Unidad 4 - Curso Iniciación de PHP 5</TITLE></HEAD>
<BODY>

<?php

// Operaciones con directorios

$directorio_trabajo = getcwd();

echo "DOCUMENT_ROOT: ".$_SERVER['DOCUMENT_ROOT']."<BR>";
echo "PHP_SELF: ".$_SERVER["PHP_SELF"]."<BR>";
echo "\$directorio_trabajo: ". $directorio_trabajo; 

echo "<CENTER><H1>Función chdir()</H1></CENTER><P>";
chdir($directorio_trabajo); // Aquí fijamos como actual este directorio.

if (is_dir($directorio_trabajo)) 
	echo "<B>\"$directorio_trabajo\" es el nombre del directorio actual.
			</B><P>";

echo "<CENTER><H1>Función opendir()</H1></CENTER><P>";
$id_dircurso= @opendir($_SERVER['DOCUMENT_ROOT']."/curso/")
             or die("<B>El directorio \"/curso/\" no
             se ha podido abrir.</B><P>");
echo "<B>Hemos abierto el directorio del servidor: ". $_SERVER['DOCUMENT_ROOT']."/curso/</B><P>";

echo "<CENTER><H1>Clase dir()</H1></CENTER><P>";
$directorio = dir($directorio_trabajo);
// Aquí creamos un objeto de la clase dir().
echo "Puntero: <B>".$directorio->handle."</B><P>";
echo "Camino: <B>".$directorio->path."</B><P>";
while($fichero=$directorio->read())
{
   echo "$fichero<P>";
}
$directorio->close();

echo "<CENTER><H3>Con la clase dir() hemos abierto un directorio,
     hemos mostrado su puntero y su camino,<P>y hemos visto todos
     los ficheros que contiene. Además, lo hemos cerrado.
     </H3></CENTER><P>";

echo "<CENTER><H1>Función closedir()</H1></CENTER><P>";
closedir($id_dircurso);
echo "<CENTER><H3>Con la función closedir() hemos cerrado
     el directorio abierto: \"/cursoPHP4/\".</H3>
     </CENTER><P>";

echo "<CENTER><H1>Función readdir()</H1></CENTER><P>";
$id_dircurso= @opendir($directorio_trabajo)
             or die("<B>El directorio \"$directorio_trabajo\" no
             se ha podido abrir.</B><P>");
while ($fichero=readdir($id_dircurso))
{
      if (is_dir($fichero))
         print ("$fichero <B>es un directorio.</B><P>");
      else
         print ("$fichero <B>es un fichero.</B><P>");
}
echo "<CENTER><H3>Con la función readdir() hemos leído los
     ficheros y directorios de \"$directorio_trabajo\".</H3>
     </CENTER><P>";

echo "<CENTER><H1>Función rewinddir()</H1><P>
		<H3>Si queremos volver a leer el mismo directorio,
		tenemos que llevar el puntero de lectura al principio con
		la función rewinddir(). <P>Comenta la instrucción siguiente y
     	verás que no se lee por estar el puntero al final.</H3>
     	</CENTER><P>";
rewinddir($id_dircurso);
while ($fichero=readdir($id_dircurso))
{
      if (is_dir($fichero))
         print ("$fichero <B>es un directorio.</B><P>");
      else
         print ("$fichero <B>es un fichero.</B><P>");
}

echo "<CENTER><H1>Función mkdir()</H1><P>
		<H3>Con la función mkdir() creamos el directorio
		\"Pruebas\" dentro de \"$directorio_trabajo\". <P>Puedes comprobar
     	que ha sido creado, si no existía, con el Explorador de Windows.<P>
        Como con la orden siguiente se borra, deberás comentar la función
        rmdir() <P>para ver que se crea antes de borrarse.</H3>
     	</CENTER><P>";
$nuevo_dir="Pruebas";
if (!file_exists($nuevo_dir)) mkdir($nuevo_dir,0);

echo "<CENTER><H1>Función rmdir()</H1><P>
		<H3>Con la función rmdir() eliminamos el directorio
     	\"Pruebas\" que hay dentro de \"$directorio_trabajo\". <P>Puedes
     	comprobar que ha sido borrado, si existía y estaba vacío,
     	con el Explorador de Windows.</H3></CENTER><P>";
$directorio="Pruebas";
if (file_exists($directorio)) @rmdir($directorio)
   or die("<B>El directorio \"Pruebas\" no se ha podido borrar
   al no estar vacío.</B><P>");

?>
</BODY>
</HTML>

