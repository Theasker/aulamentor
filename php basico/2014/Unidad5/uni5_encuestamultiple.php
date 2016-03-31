<html>
  <head>
    <meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
  </head>
  <body>
<?php
  require 'uni5_encuestamultiple_class.php';
  $mi_encuesta = new encuestamultiple_class();
  session_start();
  $mensaje = "";
 
  //var_dump($_REQUEST);
  //var_dump($mi_encuesta);
  if(isset($_REQUEST["votar"])){
    if(!isset($_SESSION["votos"])){
      $mi_encuesta->votar();
      $_SESSION["votos"] = 1;
      $mensaje = "¡Gracias por votar!";
    }
  }
  
  echo $mensaje;
  $mi_encuesta->mostrarencuesta();
  $mi_encuesta->mostrarresultados();
  echo "Nº total de votos: $mi_encuesta->votos";
?>
  </body>
</html>