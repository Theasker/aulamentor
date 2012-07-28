<html>
<head>
   <meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
</head>
<body bgcolor="#CDCDCD">
<?
require 'uni4_biblioteca_htmls.php';
require 'uni4_biblioteca_class.php';
$mi_biblioteca = new biblioteca();
$mi_biblioteca->directorio = '.';
$mi_biblioteca->fichero = "uni4_biblioteca.txt";

encabezado1();
//resumen1($resumen1);
//encabezadosmatriz();
$resumen1 = "";
if (!isset($_REQUEST['accion'])) $_REQUEST['accion'] = null;
if ($_REQUEST['accion']=="mostrar"){
  resumen1($resumen1);
  encabezadosmatriz();
  $mi_biblioteca->mostrarlibros();
  formularioagregar();
}elseif ($_REQUEST['accion']=="editar"){
  resumen1($resumen1);
  encabezadosmatriz();
  $mi_biblioteca->mostrarlibroseditar($_REQUEST['codigo']);
  formularioagregar();
}elseif ($_REQUEST['accion']=="borrar"){
  resumen1($resumen1);
  encabezadosmatriz();
  $mi_biblioteca->borrar($_REQUEST['codigo']);
  $mi_biblioteca->mostrarlibros();
  formularioagregar();
}elseif (isset($_REQUEST['btnagregar'])){
  if ($_REQUEST['Autor']<>'' or $_REQUEST['Titulo']<>'' or $_REQUEST['Editorial']<>''){
    $mi_biblioteca->agregar($_REQUEST['Autor'],$_REQUEST['Titulo'],$_REQUEST['Editorial']);
  }else $resumen1 = "Hay que introducir algún dato";
  resumen1($resumen1);
  encabezadosmatriz();
  $mi_biblioteca->mostrarlibros();
  formularioagregar();
}elseif (isset($_REQUEST['btnguardar'])){
  resumen1($resumen1);
  encabezadosmatriz();
  $mi_biblioteca->guardar();
  formularioagregar();
}elseif (isset($_REQUEST['btnbuscar'])){
  resumen1("Los libros que contienen '".$_REQUEST['buscar']."' son");
  encabezadosmatriz();
  $mi_biblioteca->buscar();
  formularioagregar();
}
echo '<table width="100%"><tr>';
echo '<td width=70%>El nº total de libros es: '.$mi_biblioteca->contador."</td>";
echo '<td align="right">';
pie();
echo "</td></tr></table>";
?>
</body>
</html>
