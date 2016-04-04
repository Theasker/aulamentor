<HTML>
<HEAD><TITLE>Ejemplo 1 - Unidad 4 - Curso Iniciación de PHP 5</TITLE>
<style type="text/css">
  table, td, th
	{border:1px solid green;}
	th
	{background-color:green;
	color:white;}
	td.col1 { font-size:20px; color:green; text-align:center;}
	td.col2 { font-size:20px; color:black; text-align:left;}
	td.col3 { font-size:20px; font-weight:bold; color:black; text-align:left;}
  </style>
</HEAD>
<BODY><H1><CENTER>Abrir y Cerrar un fichero</H1></CENTER><P>
<TABLE border=1><TR><th>Operación</th><th>Descripción</th><th>Resultado</th></TR>

<?php

/* Establecer un directorio y Abrir y Cerrar ficheros
   Los ficheros usados deben estar en el directorio 
   "c:\CursoPHP5\curso\Alumnos\ficheros_del_curso" y son
   Ficheros_1.php, Ficheros_2.txt y Ficheros_3.txt.*/

// Con getcwd() obtenemos el directorio de trabajo
$directorio_trabajo = getcwd();

// OPERACION 1: Cambiamos al directorio de trabajo (es el actual). Esto sirve para abrir ficheros en otros directorios
echo "<TR><TD class=col1>1</TD><TD class=col2>En primer lugar, fijamos como directorio por defecto 
		\"$directorio_trabajo\" ya que en él están los ficheros de tipo 
		txt o php con los que vamos a practicar. <P>El alumno debe 
		fijar aquí su propio directorio de trabajo.</TD>";

if (chdir($directorio_trabajo))
   echo "<TD class=col3>El directorio \"$directorio_trabajo\" existe y ha quedado 
   		fijado como actual.</TD></TR>";
else
   die ("<TD class=col3>El directorio \"$directorio_trabajo\" no existe y no se 
   		ha podido fijar como actual. NO SE CONTINUA LA EJECUCUION.</TD></TR>");

// OPERACION 2: Abrimos un fichero
echo "<TR><TD class=col1>2</TD><TD class=col2>En segundo lugar, abrimos el fichero 
		\"Ficheros_1.php\".</TD>";

if (fopen("Ficheros_1.php","r"))
   echo "<TD class=col3>El fichero \"Ficheros_1.php\" existe y ha quedado abierto 
   		en modo lectura.</TD></TR>";
else
   echo "<TD class=col3>El fichero \"Ficheros_1.php\" no existe.</TD></TR>";

// OPERACION 3: Abrimos fichero con error
echo "<TD class=col1>3</TD><TD class=col2>En tercer lugar, intentamos abrir el fichero
     \"Fichero_1.php\", que no existe, y usamos die() para mostrar
      un mensaje y acabar la interpretación del código.";
echo "Esta operación está comentada para poder seguir con el resto
     de instrucciones.<P>Si se quiere ver cómo funciona, hay que quitar
     los comentarios del código fuente.</TD><TD class=col3>Operación comentada</TD></TR>";
/*
$fichero1="Fichero_5.php";
$id_fichero1 = @fopen($fichero1,"r")
               or die("<TD>El fichero \"Fichero_5.php\"
                   no se ha podido abrir.</TD></TR>");
*/

// OPERACION 4: Abrimos fichero con 2 variables
echo "<TR><TD class=col1>4</TD><TD class=col2>En cuarto lugar, intentamos abrir el fichero
     \"Ficheros_1.php\", que existe, y usamos dos variables: \$fichero
      para el nombre del fichero y \$id_fichero para crear su identificador.
      </TD>";
$fichero1="Ficheros_1.php";
$id_fichero1 = @fopen($fichero1,"r") 
                or die("<TD class=col3>El fichero \"Fichero_1.php\" 
                               no se ha podido abrir.</TD>");
echo "<TD class=col3>El fichero \"Ficheros_1.php\" existe y ha quedado abierto 
		en modo lectura.</TD></TR>";

// OPERACION 5: Abrimos fichero que no existe con 2 variables
echo "<TR><TD class=col1>5</TD><TD class=col2>En quinto lugar, intentamos abrir el fichero
     \"Ficheros_2.txt\", que no existe, usando dos variables: \$fichero
      (nombre del fichero) y \$id_fichero (identificador), en modo
      escritura con el parámetro \"w\". Como no existe, se crea con tamaño 0.
      </TD>";
$fichero2="Ficheros_2.txt";
$id_fichero2=@fopen($fichero2,"w");
echo "<TD class=col3>El fichero \"Ficheros_2.txt\" no existía y se ha creado, o existía
     y se ha quedado vacío.</TD></TR>";

// OPERACION 6: Abrimos fichero en modo escritura
echo "<TR><TD class=col1>6</TD><TD class=col2>En sexto lugar, intentamos abrir el fichero
     \"Ficheros_3.txt\", que existe, usando dos variables: \$fichero
      (nombre del fichero) y \$id_fichero (identificador), en modo
      escritura con el parámetro \"a\". Se abre y queda preparado
      para poder añadir contenidos a los que ya tenía.</TD>";
$fichero3="Ficheros_3.txt";
$id_fichero3=@fopen($fichero3,"a");
echo "<TD class=col3>El fichero \"Ficheros_3.txt\" ya existía, se ha abierto y colocado
     el puntero al final del mismo para poder añadir contenidos.</TD></TR>";

// OPERACION 7: Cerramos los ficheros anteriores
echo "<TR><TD class=col1>7</TD><TD class=col2>Finalmente, con la función fclose() cerramos los tres
     ficheros abiertos y utilizados en este ejemplo.</TD>";
if (fclose($id_fichero1) && fclose($id_fichero2) && fclose($id_fichero3)) echo "<TD class=col3>Operación realizada correctamente</TD></TR>";
else echo "<TD class=col3>ERROR: La operación NO se ha realizado correctamente</TD></TR>";
?>
</TABLE>
</BODY>
</HTML>

