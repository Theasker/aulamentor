<html>
  <head>
    <meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
  </head>
  <body>
<?php
  require 'encuesta_class.php';
  $mi_encuesta = new encuesta_class();
  session_start();
  if (!isset($_SESSION["votado"])){
    if(isset($_REQUEST['Votar']) && isset($_REQUEST['encuesta'])){
      $mi_encuesta->ficheroamatriz();
      $mi_encuesta->votacion(); //e realiza la votacion
      $_SESSION["votado"] = "si";
    } 
  }
  else echo "<center>¡Sólo se puede votar una vez!</center>";
  $mi_encuesta->resultados();
?>
  </body>
</html>