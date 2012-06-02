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
    //si es una nueva sesión o ha caducado en la que estábamos
    if(!isset($_SESSION["contador"])){
      //esto pasa cuando intentamos anular un asiento de otra sesión
      if($_REQUEST['estado'] == 1){
        $mensaje = "Esa entrada es de otra sesión y no se puede devolver";
      }
      elseif($_REQUEST['estado'] == 0){
        $_SESSION["contador"] = 1;
        $_SESSION[$fila][$columna] = $_REQUEST['estado'];
        $mensaje = "Gracias por comprar en este cine";
        $mi_cine->cambiarestado();
      }
    }
    //estamos dentro de la sesión y si existe el asiento guardado 
    //en esta sesión significa que se había comprado
    elseif(isset($_SESSION[$fila][$columna])){
      $mensaje = "Gracias por devolver la entrada de cine";
      $mi_cine->cambiarestado();
    }
    else{
      
    }
    
  }
  echo $mensaje;
  $mi_cine->mostrarmatriz();
  
  var_dump($_REQUEST);
  var_dump($_SESSION);
?>
  </body>
</html>