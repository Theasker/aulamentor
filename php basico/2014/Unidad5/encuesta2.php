<html>
  <head>
    <meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
  </head>
  <body>
<?php
  require 'encuesta2_class.php';
  $mi_encuesta = new encuesta_class();
  session_start();
  
  if (!isset($_REQUEST['accion']) || isset($_REQUEST['volver'])){
    if (isset($_REQUEST['volver'])) $_REQUEST["accion"]="";
    $mi_encuesta->mostrarencuesta();
  }
  //comprobamos si se ha votado y si se ha hecho más de 3
  if (!isset($_SESSION["encuesta"]) || $_SESSION["encuesta"]["votado"] < 3){
    if(isset($_REQUEST['Votar']) && isset($_REQUEST['encuesta'])){
      $mi_encuesta->ficheroamatriz();
      if (!isset($_SESSION["encuesta"]["votado"])) $_SESSION["encuesta"]["votado"] = 0; 
      $mi_encuesta->votacion(); //se realiza la votacion+       
    } 
  }
  else{
    echo "<center>¡Sólo se puede votar 3 veces!</center>";
  }
  if (isset($_REQUEST['accion']) && $_REQUEST['accion'] == "mostrar"){
    $mi_encuesta->resultados();
  }
  var_dump($_SESSION);
?>
  </body>
</html>