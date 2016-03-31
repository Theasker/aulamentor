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
    case 'guardar':
    	$misnotas->guardar();
    	$misnotas->mostrar();
    	break;
    case 'informes':
    	$misnotas->resultadoinf = "";
    	$misnotas->informes();
    	break;
    case 'inf_asig_trim':
    	$misnotas->inf_asig_trim();
    	break;
    case 'inf_alumno':
    	$misnotas->inf_alumno();
    	break;
    case 'inf_media_asig':
    	$misnotas->inf_media_asig();
    	break;
    case 'inf_media_alum':
    	$misnotas->inf_media_alum();
    	break;
  }
}else $misnotas->mostrar();
?>
</center>
</body>
</html>
