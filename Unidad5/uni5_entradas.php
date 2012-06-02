<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="uni5_entradas.css" />
  </head>
  <body>
<?php
  require 'uni5_entradas_class.php';
  $mi_cine = new uni5_entradas_class();
  session_start();
  //entramos si se ha pinchado en una localidad
  $mensaje = "";
  if(isset($_REQUEST['estado'])){
    $fila = $_REQUEST['fila'];
    $columna = $_REQUEST['columna'];
    if(!isset($_SESSION["contador"])){
      $_SESSION["contador"] = 1;
      $_SESSION[$fila][$columna] = $_REQUEST['estado'];
      //esto pasa cuando intentamos anular un asiento de otra sesión
      if($_REQUEST['estado'] == 1){
        $mensaje = "Esa entrada es de otra sesión y no se puede devolver";
      }
      elseif($_REQUEST['estado'] == 0){
        $mensaje = "Gracias por comprar en este cine";
        $mi_cine->cambiarestado();
      }   
      
      
    }
    elseif(isset($_SESSION[$fila][$columna])){
      
    }
    
  }
  echo $mensaje;
  $mi_cine->mostrarmatriz();
  
  var_dump($_REQUEST);
  var_dump($_SESSION);
?>
  </body>
</html>