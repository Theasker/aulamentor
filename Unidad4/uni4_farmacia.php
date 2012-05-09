<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="uni4_farmacia_estilo.css" />
  </head>
  <body>
<?php
require 'uni4_farmacia_htmls.php';
require 'uni4_farmacia_class.php';

// Inicialización de las variables necesarias para leer el fichero
$mi_farmacia = new farmacia();
$mi_farmacia->directorio = '.'; //Directorio de trabajo el actual
$mi_farmacia->fichero = "uni4_farmacia.txt";

var_dump($_REQUEST);
titulo();
encabezados();
if (!isset($_REQUEST['accion'])){
  $_REQUEST['accion'] = "mostrar";
}  
if($_REQUEST==null || $_REQUEST['accion']=="mostrar"){
  $mi_farmacia->ficheroamatriz();
  $mi_farmacia->mostrarmatriz();
}
elseif($_REQUEST['accion']=="ordenarmedicamento"){
  $mi_farmacia->ficheroamatriz();
  //ordenamos el array por nombre pasamos como parámetros el array y el campo a ordenar
  $mi_farmacia->OrdenarArray($mi_farmacia->farmacia, "nombre");
  $mi_farmacia->mostrarmatriz();
}
elseif($_REQUEST['accion']=="ordenarcantidad"){
  $mi_farmacia->ficheroamatriz();
  //ordenamos el array por cantidad pasamos como parámetros el array y el campo a ordenar
  $mi_farmacia->OrdenarArray($mi_farmacia->farmacia, "cantidad");
  $mi_farmacia->mostrarmatriz();
}
elseif($_REQUEST['accion']=="ordenarimporte"){
  $mi_farmacia->ficheroamatriz();
  //ordenamos el array por importe pasamos como parámetros el array y el campo a ordenar
  $mi_farmacia->OrdenarArray($mi_farmacia->farmacia, "importe");
  $mi_farmacia->mostrarmatriz();
}
elseif($_REQUEST['accion']=="editarregistro"){
  $mi_farmacia->ficheroamatriz();
  $mi_farmacia->mostrarmatrizeditar();
}
if (isset($_REQUEST['btnguardar'])){
  $mi_farmacia->guardarregistro();
} 
elseif($_REQUEST['accion']=="borrarregistro"){
  $mi_farmacia->ficheroamatriz();
}
//if(isset($_REQUEST['']))

echo "</table>";
formularioagregar();
formulariobuscar();




echo 'El nº de medicamentos es ';
echo $mi_farmacia->contador;
echo '<table><td class="boton"><A href=uni4_farmacia.php?accion=mostrar>Ver listado inicial</A>';
echo "</td></tr></table>";
echo "El medicamento más caro es ".$mi_farmacia->farmacia[$mi_farmacia->max]['nombre']. " con ".$mi_farmacia->farmacia[$mi_farmacia->max]['importe']." €";
echo '<p>NOTA: no se puede repetir el nombre de un medicamento en esta farmacia.</p>';
?>
  </body>
</html>