<html>
  <head>
    <meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
    <title>
      Actividad 2. Unidad 3.
      Colección de discos
    </title>
  </head>
  <body bgcolor="#FE9900" text="red">
    <hr>
    <table>
      <tr>
        <td align="center">
          <h3>COLECCION DE DISCOS</h3>
          <img src="images/guitarra.gif" alt="guitarra.gif">
        </td>
        <td align="center">
          <b><u>Operaciones con la colección</u></b><br><br>
          <form action="uni3_act2_discos.php" method="post">
            <b>Buscar disco</b>
            <input type="text" name="txtbuscar" id="txtbuscar" style="width: 75px">
            <input type="submit" name="btnbuscar" value="Buscar"><p>
            <input type="submit" name="btnlistado1" value="Ver listado completo de discos" style="width: 250px"/><p>
            <input type="submit" name="btnlistado2" value="Ver listado ordenado por titulo" style="width: 240px"/>
          </form>
        </td>
      </tr>
    </table>
    <hr>
    <?
    require 'uni3_act2_discos_class.php';
    $discos = new catalogo();
    //comprobación del botón que se ha pulsado
    echo "<center><br><table border=1 WIDTH=600>
      <th width=40%>Título</th><th width=25%>Intérprete</th><th width=25%>Discográfica</th><th width=10%>Año</th>";
    $cont = 0;
    if (isset($_REQUEST[btnbuscar])){
      if ($_REQUEST[txtbuscar]==""){
        echo "No has introducido ningún texto";
      }else {
        foreach ($discos->discos as $indice){
          //pasamos a mayúsculas las cadenas de texto con la función strtoupper
          //para poderlas comparar con la función substr_count
          $cont1 = substr_count(strtoupper($indice[Titulo]), strtoupper($_REQUEST[txtbuscar]));
          $cont2 = substr_count(strtoupper($indice[Interprete]), strtoupper($_REQUEST[txtbuscar]));
          $cont3 = substr_count(strtoupper($indice[Discografica]), strtoupper($_REQUEST[txtbuscar]));
          $cont4 = substr_count(strtoupper($indice[Año]), strtoupper($_REQUEST[txtbuscar]));
          if ($cont1 <> 0 or $cont2 <> 0 or $cont3 <> 0 or $cont4 <> 0){
            echo "<tr><td>$indice[Titulo]</td><td>$indice[Interprete]</td><td>$indice[Discografica]</td><td>$indice[Año]</td></tr>";
            $cont++;
          }
          unset($cont1);
          unset($cont2);
          unset($cont3);
          unset($cont4);
        }
      }
    }elseif (isset($_REQUEST[btnlistado1])){
      foreach ($discos->discos as $indice){
        echo "<tr><td>$indice[Titulo]</td><td>$indice[Interprete]</td><td>$indice[Discografica]</td><td>$indice[Año]</td></tr>";
        $cont++;
      }
    }elseif (isset($_REQUEST[btnlistado2])){
      asort($discos->discos);
      foreach ($discos->discos as $indice){
        echo "<tr><td>$indice[Titulo]</td><td>$indice[Interprete]</td><td>$indice[Discografica]</td><td>$indice[Año]</td></tr>";
        $cont++;
      }
    }
    echo "</table>El nº de discos encontrados es: $cont</center>";
    
    ?>
  </body>
</html>