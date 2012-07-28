<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="uni7_notas.css" />
  </head>
  <body>
    <center>
    <table class="titulo" width="100%">
      <tr><td><h2><u>Notas de clase</u></h2></td></tr>
    </table>

<?php
require 'uni7_notas_class.php';

$misnotas = new notas();
var_dump($_REQUEST);
if(isset($_REQUEST['opcion'])){
  switch($_REQUEST['opcion']){
    case 'agregar':
      $misnotas->agregar();
      $misnotas->mostrar();
      break;
    case 'borrar':
      $misnotas->borrar();
      $misnotas->mostrar();
      break;
    case 'editar':
      $misnotas->mostrar();
      break;
  }
}else $misnotas->mostrar();
?>
