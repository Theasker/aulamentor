<html>
  <head>
    <title>
      Actividad obligatoria Unidad 1.
      Evolución población española
    </title>
  </head>
  <body BGCOLOR="#66CBFF">
    <?php
    $matriz_hab = array(0=>array(0=>1910,1=>19995191),
                          1=>array(0=>1920,1=>21389589),
                          2=>array(0=>1930,1=>23677497),
                          3=>array(0=>1940,1=>26014750),
                          4=>array(0=>1950,1=>28118057),
                          5=>array(0=>1960,1=>30583466),
                          6=>array(0=>1970,1=>34041022),
                          7=>array(0=>1975,1=>36012702),
                          8=>array(0=>1981,1=>37683410),
                          9=>array(0=>1986,1=>38472451),
                          10=>array(0=>1991,1=>38872268),
    );
    echo "<center>";
    echo "<hr><h1>Evolución población española</h1><hr>";
    echo "<table border=1 WIDTH=\"120%\">";
    echo "<tr>
      <th ALIGN=\"center\">Periodo (año)</th>
      <th ALIGN=\"center\">Población</th>
      <th ALIGN=\"center\">% aumento</th>
      </tr>";
    $aumento_total = 0;
    for ($i=1;$i<11;$i++){
      echo "<tr>";
      echo "<td ALIGN=\"center\">".$matriz_hab[$i-1][0]."-".$matriz_hab[$i][0]."</td>";
      echo "<td ALIGN=\"right\">".$matriz_hab[$i][1]."</td>";
      $aumento = 100 * (($matriz_hab[$i][1] / $matriz_hab[$i-1][1])-1);
      printf("<td ALIGN=\"right\">%03.2f </td>", $aumento);
      $aumento_total = $aumento_total + $aumento;
      echo "</tr>";
    }
    echo "</table>";
    printf("<br><br><b>El aumento total de la población es de %3.2f </b>",$aumento_total);
    echo "</center>";
    ?>
  </body>
</html>