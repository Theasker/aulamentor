<?php
  $id = @mysql_connect("localhost", "root", "") or die("No se ha establecido la conexión");
  echo $id;
  @mysql_close($id) or die("No se ha podido cerrar la conexión");
?>
