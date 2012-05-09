<html>
  <head>
    <title>
      Actividad 2. Unidad 1.
      Cambio de monedas europeas
    </title>
  </head>
  <body BGCOLOR="#339967">
    <?
    $matriz_monedas = array(0=>array(0=>"Alemania",1=>"Marco alemán",2=>1.9558),
                            1=>array(0=>"España",1=>"Peseta",2=>166.386),
                            2=>array(0=>"Francia",1=>"Franco francés",2=>6.5596),
                            3=>array(0=>"bélgica",1=>"Franco belga",2=>40.3399),
                            4=>array(0=>"Italia",1=>"Lira italiana",2=>1936.27),
                            5=>array(0=>"Portugal",1=>"Escudo portugués",2=>200.482));
    echo "<center><br>";
    echo "<hr><br><h1>Cambio de monedas europeas</h1><hr>";
    echo "<table border=1 WIDTH=400>";
    echo "<tr>
      <th ALIGN=\"center\">País</th>
      <th ALIGN=\"center\">Moneda</th>
      <th ALIGN=\"center\">Cambio</th>
      </tr>";
    $comp = 0; //inicialización de la variable para comparar monedas
    for ($i=0;$i<6;$i++){
      echo "<tr>";
      echo "<td ALIGN=\"center\" width=\"25%\">".$matriz_monedas[$i][0]."</td>";
      echo "<td ALIGN=\"right\" width=\"50%\">".$matriz_monedas[$i][1]."</td>";
      echo "<td ALIGN=\"right\" width=\"50%\">";
      printf("%2.4f</td>",$matriz_monedas[$i][2]);
      //comparamos para ver si el cambio es más alto
      if ($matriz_monedas[$i][2] > $comp){
        $compnom = $matriz_monedas[$i][0]; //guardamos en nombre del pais
        $comp = $matriz_monedas[$i][2]; //guardamos el cambio
      }
      echo "</tr>";
    }
    echo "</table>";
    printf("<br><b>El timpo de cambio más alto es el de %s con %4.2f</b>",$compnom,$comp);
    echo "</center>";
    ?>
  </body>
</html>
