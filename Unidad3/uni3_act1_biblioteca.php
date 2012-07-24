<html>
<head>
   <meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
   <title>
      Actividad 1. Unidad 3.
      Biblioteca
    </title>
</head>
<body bgcolor="#336667" text="White">

  <div style="clear: both;">
    <hr>
  </div>
  <div id="div1" style="float: left; width: 40%;">
    <img alt="Biblioteca.gif" src="images/Biblioteca.gif">
  </div>
  <div id="div2" style="float: right; width: 60%;">
    <h3>BIBLIOTECA</h3>
    <u><b>Operaciones con los ejemplares</b></u><br><br>
    <form method="post" action="uni3_act1_biblioteca.php">
      <P ALIGN=right>
        <b>Buscar ejemplar</b>
        <input type="text" name="txtbuscar" id="buscar" />
        <input type="submit" name="btnbuscar" value="buscar"/>
      </P>
      <p align="center">
        <input type="submit" name="btnlistado1" value="Ver listado completo de la biblioteca" style="width: 300px"/><br><br>
        <input type="submit" name="btnlistado2" value="Ver listado completo ordenado por título" style="width: 350px"/>
      </p>
    </form>
  </div>
  <div style="clear: both;">
    <hr>
  </div>
  <?
  //claee con inicialización de la matriz
  require "uni3_act1_biblioteca_class.php";
  $obj_biblio = new biblioteca();
  //var_dump($obj_biblio);
  //Visualizamos la cabecera de la tabla se pulse lo que se pulse
  echo "<center><br><table border=1 WIDTH=500>
      <th width=50%>Título</th><th width=25%>Autor</th><th width=25%>Editorial</th>";
  $cont = 0;
  //Según el botón que pulsamos nos manda a una u otra opción
  if (isset($_REQUEST['btnbuscar'])){
    //$_REQUEST[txtbuscar]
    if ($_REQUEST[txtbuscar] == ""){
      echo "No se ha introducido ningún texto";
    }
    else{
      foreach ($obj_biblio->biblio as $elemento=>$indice){
        //comprobamos que la cadena a buscar está en alguna de los campos
        //pasando a mayúsculas la frase y la cadena a comparar strtoupper()5
        $cont1 = substr_count(strtoupper($elemento),strtoupper($_REQUEST[txtbuscar]));
        $cont2 = substr_count(strtoupper($indice[Autor]),strtoupper($_REQUEST[txtbuscar]));
        $cont3 = substr_count(strtoupper($indice[Editorial]),strtoupper($_REQUEST[txtbuscar]));
        if ($cont1 or $cont2 or $cont3) {
          echo "<tr><td>$elemento</td>";
          echo "<td>$indice[Autor]</td>";
          echo "<td>$indice[Editorial]</td>";
          echo "</td></tr>";
          $cont ++;
        }
        unset($cont1);
        unset($cont2);
        unset($cont3);
      }
      echo "</table>El nº de ejemplares encontrados es: $cont</center>";
    }
  }
  elseif (isset($_REQUEST['btnlistado1'])){
    foreach ($obj_biblio->biblio as $elemento=>$indice){
      echo "<tr><td>$elemento</td>";
      echo "<td>$indice[Autor]</td>";
      echo "<td>$indice[Editorial]</td>";
      echo "</td></tr>";
      $cont ++;
    }
    echo "</table>El nº de ejemplares encontrados es: $cont</center>";
  }
  elseif (isset($_REQUEST['btnlistado2'])){
    ksort($obj_biblio->biblio);
    foreach ($obj_biblio->biblio as $elemento=>$indice){
      echo "<tr><td>$elemento</td>";
      echo "<td>$indice[Autor]</td>";
      echo "<td>$indice[Editorial]</td>";
      echo "</td></tr>";
      $cont ++;
    }
    echo "</table>El nº de ejemplares encontrados es: $cont</center>";
  }
  ?>
</body>
</html>