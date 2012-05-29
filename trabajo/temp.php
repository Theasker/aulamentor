<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="temp.css" />
  </head>
  <body>
 <?php
   echo "<table>";
   for ($filas = 0 ; $filas < 16; $filas++){
     for ($columnas = 0 ; $columnas < 21; $columnas++){
       if ($columnas == 0 && $filas < 15) echo "<td>".($filas+1)."</td>";
       else {
         if ($filas < 15) echo "<td><a href=temp.php?accion=pulsar&estado=ocupado>__</a></td>";
          else{
            if ($columnas == 0) echo "<td></td>";
            else echo "<td>$columnas</td>";
          }
       }
     }
     echo "</tr>";
   }
   echo "</table>";
   var_dump($_REQUEST);
 ?>
  </body>
</html>