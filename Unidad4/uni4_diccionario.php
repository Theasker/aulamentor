<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="uni4_diccionario_estilo.css" />
  </head>
<body>
<?php
require 'uni4_diccionario_htmls.php';
require 'uni4_diccionario_class.php';

// Inicialización de las variables necesarias para leer el fichero
$mi_diccionario = new diccionario();
$mi_diccionario->directorio = '.'; //Directorio de trabajo el actual
$mi_diccionario->fichero = "uni4_diccionario.txt";

titulo();
encabezados();
if (!isset($_REQUEST['accion'])){
  $_REQUEST['accion'] = null;
  //$mi_diccionario->mostrararray();
  //formularioagregar();
  //formulariobuscar();
}  
if($_REQUEST['accion']=="mostrar"){
  $mi_diccionario->ficheroamatriz();
  $mi_diccionario->mostrararray();
  formularioagregar();
  formulariobuscar();
}elseif(isset($_REQUEST['btnagregar'])){
  if (($_REQUEST['palabra']<>"") and ($_REQUEST['traduccion']<>"")){
    $mi_diccionario->agregar();
  }  
  formularioagregar();
  formulariobuscar(); 
}elseif($_REQUEST['accion']=="borrarregistro"){
  $mi_diccionario->borrarregistro($_REQUEST['elemento']);
}elseif($_REQUEST['accion']=="ordenarpalabra"){
  $mi_diccionario->ficheroamatriz2();
  asort($mi_diccionario->diccionario);
  $mi_diccionario->mostrararray();
  formularioagregar();
  formulariobuscar();
}elseif($_REQUEST['accion']=="ordenartraduccion"){  
  $mi_diccionario->ficheroamatriz();
  asort($mi_diccionario->diccionario);
  $mi_diccionario->mostrararray();
  formularioagregar();
  formulariobuscar();
}elseif($_REQUEST['accion']=="editarregistro"){  
  $mi_diccionario->ficheroamatriz();
  $mi_diccionario->mostrarparaeditar($_REQUEST['elemento']);
  formularioagregar();
  formulariobuscar();
}elseif(isset($_REQUEST['btnguardar'])){
  $mi_diccionario->guardarregistro();
  $mi_diccionario->mostrararray();
  formularioagregar();
  formulariobuscar();
}elseif(isset($_REQUEST['btnbuscar'])){
  $mi_diccionario->buscar();
  formularioagregar();
  formulariobuscar();
}
echo '<table class="c">';
echo '<tr><td>El nº de registros del diccionario es ';
echo $mi_diccionario->contador."</td>";
echo '<td class="boton"><A href=uni4_diccionario.php?accion=mostrar>Ver listado inicial</A>';
echo "</td></tr></table>";
echo '<p>NOTA: no se puede repetir una palabra o traduccion en este diccionario.</p>';

var_dump($_REQUEST);
?>
</body>
</html>