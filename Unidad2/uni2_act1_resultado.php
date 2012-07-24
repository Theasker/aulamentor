<html>
  <head>
    <title>
      Actividad obligatoria. Unidad 2.
      Buscar las capitales de provincia
    </title>
  </head>
  <body BGCOLOR="#339967">
    <center>
      <br><hr><h1>Capitales de Provincia</h1><hr><br>
      El resultado para la comunidad de <b><?echo $_POST["provincias"];?></b> es:<br><br>
      <table border=1 WIDTH=200>
        <th ALIGN="center">Ciudad</th>
        <th ALIGN="center">Código</th>
        <?
          require("uni2_act1_arrayprovincias.php");

          /*
          foreach ($matriz_provincias as $elemento=>$indice){
            foreach ($indice as $elemento2=>$indice2){
              echo $elemento."=>".$elemento2."=>".$indice2."<br>";
            }
          }
          */
          foreach($matriz_provincias[$_POST["provincias"]] as $elemento=>$indice){
            echo "<tr>";
            echo "<td>".$elemento."</td>";
            echo "<td>".$indice."</td>";
            echo "</tr>";
          }
        ?>
      </table>
      <?echo  "<br><br><INPUT type='button' value='Volver a la página anterior'onClick='history.back()'>";?>
    </center>
  </body>
</html>


