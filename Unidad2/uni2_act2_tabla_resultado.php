<html>
  <head>
    <title>
      Actividad 2 obligatoria. Unidad 2.
      Tabla Periódica de los Elementos
    </title>
  </head>
  <body BGCOLOR="003399" text="white">
    <center>
      <br><hr>
      <img alt="" src="http://olivo.mentor.mec.es/cursophp/iniciacion/ejercicios_tutor_mesa_2008/unidad2/tabla_periodica/imagen.jpg">
      <h1>Tabla Periódica de los Elementos</h1><hr><p>
        El grupo <b>'<? echo $_POST["grupos"]; ?>'</b>
        está formado por los siguientes elementos::</p>
        <table border=1 WIDTH=200>
        <th ALIGN="center">Nombre</th>
        <th ALIGN="center">Nº atómico</th>
          <?
          require "uni2_act2_tabla_matrices.php";
          $cont = 0;
          foreach ($matriz_elementos[$_POST["grupos"]] as $elemento=>$indice){
            echo "<tr>";
            echo "<td>$elemento</td>";
            echo "<td>$indice</td>";
            $cont = $cont + 1;
          }
            echo "</tr>";
          ?>
        </table>
        <? echo "<p>Número total: $cont</p>" ?>
         <p><INPUT type='button' value='<- Volver atrás'onClick='history.back()'</p>
    </center>
  </body>
</html>