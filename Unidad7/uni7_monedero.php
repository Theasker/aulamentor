<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="uni7_monedero.css" />
  </head>
  <body>
    <center>
    <table class="titulo" width="100%">
      <tr><td>Monedero</td></tr>
    </table>
      <p><p>
<?php
require ("uni7_monedero_class.php");
$mi_monedero=new monedero();
if(isset($_REQUEST['opcion'])){
  switch ($_REQUEST['opcion']){
    case 'agregar':
      $mi_monedero->agregar();
      $mi_monedero->mostrar();
      break;
    case 'borrar':
      $mi_monedero->borrar();
      $mi_monedero->mostrar();
      break;
    case 'editar': //damos al boton editar un registro
      $mi_monedero->mostrar_para_editar();
      break;
    case 'guardar': // damos al botón guardar de la edición de un registro
      $mi_monedero->guardar();
      $mi_monedero->mostrar();
      break;
    case 'informes':
      $mi_monedero->informes();
      break;
    case 'calcularglobal':
      $mi_monedero->inf_calcularglobal();
      break;
    case 'calcularfechas':
      $mi_monedero->inf_calcularfechas();
      break;
    case 'calcularingresoscodigo':
      $mi_monedero->inf_calcularingresoscodigo();
      break;
    case 'calculargastoscodigo':
      $mi_monedero->inf_calculargastoscodigo();
      break;    
  }  
}
else $mi_monedero->mostrar();
?>
