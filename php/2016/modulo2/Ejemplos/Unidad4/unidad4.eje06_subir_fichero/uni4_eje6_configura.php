<?php
// En este fichero, que citamos con include en uni4_eje6.php,
// guardamos las frases que van a aparecer según la operación
// que se haya realizado y declaramos las variables que necesitamos
// en el script uni4_eje6_sube.php, que sube al servidor el fichero.

$directorio=getcwd()."/";

$fr_aceptacion= "<P>Se ha subido al servidor el fichero seleccionado.
						</P><CENTER><H3>La operación se ha realizado 
						correctamente.</H3></CENTER>";

$fr_noaceptacion= "<CENTER><H3>No se ha podido subir el fichero.
						</H3><P>Vuelva Atrás en su navegador y rellene 
						correctamente los datos del fichero 1.</CENTER>";

$fr_repetido= "<CENTER><H3>No se ha podido subir el fichero 
						porque ya existe.</H3><P>Vuelva Atrás en 
						su navegador y ponga otro nombre de fichero 
						diferente.</CENTER>";

$destino="uni4_eje6_sube.php";

$machacar="NO";  // Si el fichero existe, no se sobreescribe el que hay.

$subir_cualquiera="SI";  // Para subir cualquier tipo de fichero.

/*
Para subir sólo algún tipo de fichero:
1.- "text/plain" para ficheros .txt, .htm, .php, .bat, etc.
2.- "application/x-zip-compressed" y "application/octet-stream" para .exe)
3.- "application/vnd.ms-powerpoint" para ficheros de PowerPoint
4.- "application/vnd.ms-excel" para ficheros de Excel
5.- "application/msword" para ficheros de Word
6.- "image/bmp", "image/gif", "image/x-xbitmap", "image/jpeg",
    "image/pjpeg", "image/jpg" para ficheros de imágenes
7.- "audio/mpeg" para los ficheros mp3

*/

/*Para subir sólo el tipo de ficheros de texto plano: .txt, .htm, .php, etc.*/
$subir_solo="text/plain"; 


?>
