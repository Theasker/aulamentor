<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="uni5_entradas.css" />
  </head>
  <body>
    <center>
    <table class="verdeoscuro" width="100%">
      <tr><td><h1>Comprar entradas de cine</h1></td></tr>
    </table>
      <h1>¡Bienvenid@ a la p�gina de reserva de localidades!</h1><hr>
<?php
  require 'uni5_entradas_class.php';
  $mi_cine = new uni5_entradas_class();
  //$this->cine["peli"] = array("sala"=>$temp[0],"titulo"=>$temp[1],"hora"=>$temp[2],"dia"=>$temp[3]);
  echo '<table><tr>';
  echo '<td class="verdeoscuro">Número de sala</td>';
  echo '<td>'.$mi_cine->cine["peli"]["sala"].'</td>';
  echo '<td class="verdeoscuro">Nombre película</td>';
  echo '<td>'.$mi_cine->cine["peli"]["titulo"].'</td></tr>';
  echo '<tr><td class="verdeoscuro">Sesión</td>';
  echo '<td>Hora : '.$mi_cine->cine["peli"]["hora"].'</td>';
  echo '<td>Día: </td>';
  echo '<td>'.$mi_cine->cine["peli"]["dia"].'</td>';
  echo '</tr></table>Pantalla<hr width="200px">';
  session_start();
  //entramos si se ha pinchado en una localidad
  $mensaje = "";
  //entramos cuando pulsamos en un asiento
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
        $_SESSION["asientos"]=array();
        $_SESSION["asientos"][$fila][$columna] = 1;
        $mensaje = "Gracias por comprar en este cine";
        $mi_cine->cambiarestado();
      }
    }else{ //entra en el bucle cuando la sesión está activa
      switch ($_REQUEST['estado']){
        case "0":
          //comprobamos que no se han comprado más de 5 entradas en la misma sesión
          if($_SESSION["contador"] < 5){
            $mensaje = "Gracias por comprar en este cine";
            $_SESSION["contador"]++;
            $_SESSION["asientos"][$fila][$columna] = 1;
            $mi_cine->cambiarestado();
          }
          else $mensaje = "Sólo se pueden comprar 5 entradas por sesión";
          break;
        case "1":
          if(isset($_SESSION["asientos"][$fila][$columna])){
            $mensaje = "Gracias por devolver la entrada";
            $_SESSION["contador"]--;
            unset($_SESSION["asientos"][$fila][$columna]);
            $mi_cine->cambiarestado();
          }
          break;
      }
    }
  }
  echo $mensaje;
  $mi_cine->mostrarmatriz();
?>
      <p>Nota: se puede reservar un máximo de 5 localidades por persona</p>
      <table>
        <tr><td class="verde">__</td><td>Butaca libre.</td></tr>
        <tr><td class="naranja">__</td><td>Butaca reservada.</td></tr>
        <tr><td class="rojo">__</td><td>Butaca ocupada.</td></tr>
      </table>
    </center>
  </body>
</html>