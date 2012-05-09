<html>
  <head>
    <title>
      Actividad complementaria Unidad 1.
      Boletín de notas
    </title>
  </head>
  <body BGCOLOR="#66CBFF">
    <?
    $matriz_notas = array(0=>array(0=>"Matemáticas",1=>3,2=>10,3=>7),
                           1=>array(0=>"Lengua",1=>8,2=>5,3=>3),
                           2=>array(0=>"Física",1=>7,2=>2,3=>1),
                           3=>array(0=>"Latín",1=>4,2=>7,3=>8),
                           4=>array(0=>"Inglés",1=>6,2=>2,3=>3));
    echo "<center>";
    echo "<hr><h1>Boletín de notas</h1><hr>";
    echo "<table border=1 WIDTH=\"120%\">";
    echo "<tr>
      <th ALIGN=\"center\">Asignatura</th>
      <th ALIGN=\"center\">Trimestre 1</th>
      <th ALIGN=\"center\">Trimestre 2</th>
      <th ALIGN=\"center\">Trimestre 3</th>
      <th ALIGN=\"center\">Media</th>
      </tr>";
    $media = 0;
    for ($i=0;$i<5;$i++){
      echo "<tr>";
      echo "<td ALIGN=\"center\">".$matriz_notas[$i][0]."</td>";
      echo "<td ALIGN=\"right\">".$matriz_notas[$i][1]."</td>";
      echo "<td ALIGN=\"right\">".$matriz_notas[$i][2]."</td>";
      echo "<td ALIGN=\"right\">".$matriz_notas[$i][3]."</td>";
      $media = ($matriz_notas[$i][1]+$matriz_notas[$i][2]+$matriz_notas[$i][3])/3;
      printf("<td ALIGN=\"right\">%03.1f </td>", $media);
      $media_total = $media_total + $media;
      echo "</tr>";
    }
    echo "</table>";
    $media_total = $media_total / $i;
    printf("<br><br><b>La media total es %3.1f <b>",$media_total);
    echo "</center>";
    ?>
  </body>
</html>