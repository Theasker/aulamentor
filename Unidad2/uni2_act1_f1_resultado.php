<html>
  <head>
    <title>
      Actividad obligatoria. Unidad 2.
      Equipos ganadores de la NBA
    </title>
  </head>
  <body BGCOLOR="003399" text="white">
    <center>
      <br><hr>
      <img alt="logoF1.gif" src="logoF1.gif">
      <h1>FÓRMULA 1</h1><hr><br>
        La clasificación de <b>'<?php echo $_POST["piloto"]; ?>'</b> es:<br>
        <table border=1 WIDTH=200>
        <th ALIGN="center">Gran Premio</th>
        <th ALIGN="center">Posición</th>
        <th ALIGN="center">Puntos</th>
          <?php
          require "uni2_act1_f1_matrices.php";
          $acum = 0;
          foreach ($matriz_pilotos[$_POST["piloto"]] as $elemento=>$indice){
            echo "<tr>";
            echo "<td>$elemento</td>";
            echo "<td>$indice</td>";
            /* Comprobamos que la posición está en el array de posiciones
             * y sino ponemos un 0 en la casilla de puntos */
            if (!empty($posiciones[$indice])){
              echo "<td>$posiciones[$indice]</td>";
              $acum = $acum + $posiciones[$indice];
            }
            else
              echo "<td>0</td>";
          }
            echo "</tr>";
          ?>
        </table>
        <?php echo "<br>Número total de puntos conseguidos en el campeonato: <b>$acum</b>" ?>
         <br><br><INPUT type='button' value='<- Volver atrás' onClick='history.back()'>
    </center>
  </body>
</html>