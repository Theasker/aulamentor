<html>
  <head>
    <title>
      Actividad obligatoria. Unidad 2.
      Equipos ganadores de la NBA
    </title>
  </head>
  <body BGCOLOR="#66CBFF">
    <center>
      <br><hr><h1>Equipos ganadores de la NBA</h1><hr><br>
      El equipo <b>'<?echo $_POST["equipos"];?>'</b> ha ganado la/s temporada/s:<br><br>
      <table border=1 WIDTH=40>
        <th ALIGN="center">Año</th>
        <?
          require("uni2_act2_arrayequipos.php");
          foreach($matriz_equipos[$_POST["equipos"]] as $elemento=>$indice){
            echo "<tr>";
            echo "<td>".$indice."</td>";
            echo "</tr>";
          }
        ?>
      </table>
      <?echo  "<br><br><INPUT type='button' value='Volver a la página anterior'onClick='history.back()'>";?>
    </center>
    <DIV align="right">
      <br><br><br><br>
      NBA es una marca registrada de NBA Media Ventures, LLC
    </DIV>
  </body>
</html>