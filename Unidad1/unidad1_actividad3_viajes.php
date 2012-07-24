<html>
  <head>
    <title>
      Actividad 3. Unidad 1.
      Distancias entre ciudades.
    </title>
  </head>
  <body BGCOLOR="#339967">
    <?
    $matriz_viajes = array(0=>array(0=>"Madrid",1=>"Segovia",2=>90201),
                            1=>array(0=>"Madrid",1=>"A Coruña",2=>596887),
                            2=>array(0=>"Barcelona",1=>"Cádiz",2=>1152669),
                            3=>array(0=>"Bilbao",1=>"Valencia",2=>622233),
                            4=>array(0=>"Sevilla",1=>"Santander",2=>832067),
                            5=>array(0=>"Oviedo",1=>"Badajoz",2=>682429));
    echo "<center><br>";
    echo "<hr><br><h1>Viaje</h1><hr><br>";
    echo "<table border=1 WIDTH=350>";
    echo "<tr>
      <th ALIGN=\"center\">Origen</th>
      <th ALIGN=\"center\">Destino</th>
      <th ALIGN=\"center\">Distancia (km)</th>
      </tr>";
    $comp = 0; //inicialización de la variable para comparar logitudes
    for ($i=0;$i<6;$i++){
      echo "<tr>";
      echo "<td ALIGN=\"center\" width=\"34%\">".$matriz_viajes[$i][0]."</td>";
      echo "<td ALIGN=\"right\" width=\"33%\">".$matriz_viajes[$i][1]."</td>";
      echo "<td ALIGN=\"right\" width=\"33%\">";
      printf("%2.3f</td>",($matriz_viajes[$i][2])/1000);
      //comparamos para ver si el cambio es más alto
      if ($matriz_viajes[$i][2] > $comp){
        //guardamos en nombre de las ciudades mayor en la coparación
        $compnom = $matriz_viajes[$i][0]." a ".$matriz_viajes[$i][1];
        $comp = $matriz_viajes[$i][2]; //guardamos el cambio
      }
      echo "</tr>";
    }
    echo "</table>";
    printf("<br><b>El trayecto más largo es de %s con %2.3f km</b>",$compnom,($comp/1000));
    echo "</center>";
    ?>
  </body>
</html>