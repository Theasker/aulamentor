<html>
  <head>
    <title>
      Actividad 1. Unidad 1.
      Alum@s escolarizados por cada 1000 habitantes
    </title>
  </head>
  <body BGCOLOR="#66CBFF">
    <?php
    $matriz_alumnos = array(0=>array(0=>"Andalucía",1=>593.6),
                          1=>array(0=>"Aragón",1=>600.3),
                          2=>array(0=>"Asturias",1=>582.9),
                          3=>array(0=>"Baleares",1=>489.7),
                          4=>array(0=>"Canarias",1=>573.2),
                          5=>array(0=>"Cantabria",1=>551.5),
                          6=>array(0=>"Castilla y León",1=>645.3),
                          7=>array(0=>"Castilla la Mancha",1=>555.8),
                          8=>array(0=>"Cataluña",1=>568.3),
                          9=>array(0=>"Comunidad Valenciana",1=>561.1),
                          10=>array(0=>"Extremadura",1=>584.3),
                          11=>array(0=>"Galicia",1=>600.1),
                          12=>array(0=>"Madrid",1=>613.3),
                          13=>array(0=>"Murcia",1=>564.7),
                          14=>array(0=>"Navarra",1=>638.1),
                          15=>array(0=>"País Vasco",1=>637.5),
                          16=>array(0=>"La Rioja",1=>562.4),
                          17=>array(0=>"Ceuta",1=>539.7),
                          18=>array(0=>"Melilla",1=>569.8));
    echo "<center>";
    echo "<hr><h1>Alumn@s escolarizad@s por cada 1000 habitantes</h1><hr>";
    echo "<table border=1 WIDTH=400>";
    echo "<tr>
      <th ALIGN=\"center\">Comunidad Autónoma</th>
      <th ALIGN=\"center\">Número de alum@s</th>
      <th ALIGN=\"center\">% escolarización</th>
      </tr>";
    $media = 0;
    for ($i=0;$i<19;$i++){
      echo "<tr>";
      echo "<td ALIGN=\"center\" width=\"40%\">".$matriz_alumnos[$i][0]."</td>";
      echo "<td ALIGN=\"right\" width=\"30%\">".$matriz_alumnos[$i][1]."</td>";
      $porcentaje = $matriz_alumnos[$i][1] / 10 ;
      echo "<td ALIGN=\"right\" width=\"30%\">".$porcentaje."</td>";
      $media = $media + $porcentaje;
      echo "</tr>";
    }
    echo "</table>";
    $media = $media / 19;
    printf("<br><br><b>La media total es %4.2f <b>",$media);
    echo "</center>";
    ?>
  </body>
</html>