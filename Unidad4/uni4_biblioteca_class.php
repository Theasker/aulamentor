<?php
class biblioteca{
  public $biblio = array();
  public $directorio;
  public $fichero;
  public $contador;

  public function ficheroamatriz(){
    @chdir($this->directorio) or die("No existe el directorio $this->directorio");
    $idfich = @fopen($this->fichero,"r") or die("No existe el fichero $this->fichero");
    $this->contador = 0;
    while(!feof($idfich)){
      $linea=fgets($idfich, 256);
      if ($linea=="") return;
      //------------------------------------------------------------------------
      //gurdamos en un array las posiciones de los carácteres de separación
      $posicion = 0;
      //si existe el array lo inicializamos a null
      if (isset($posiciones)) $posiciones = null;
      $contar = strpos($linea,"~",$posicion);
      while($contar){ //hacemos el bucle mientras haya algún elemento separador
        $posiciones[] = $contar;
        $posicion = $contar + 1;
        $contar = strpos($linea,"~",$posicion);
      }
      //------------------------------------------------------------------------
      //llenado con las posiciones del caracter separador (strlen = longitud) 
      $autor = substr($linea,($posiciones[0]+1),($posiciones[1] - $posiciones[0] - 1));
      $titulo = substr($linea,($posiciones[1]+1),($posiciones[2] - $posiciones[1] - 1));
      $editorial = substr($linea,($posiciones[2]+1),(strlen($linea) - $posiciones[2] - 1));
      $this->biblio[$this->contador] = array("Autor"=>$autor,"Titulo"=>$titulo,"Editorial"=>$editorial);
      //------------------------------------------------------------------------
      $this->contador++;
    }
    fclose($idfich);
  }
  public function mostrarlibros(){
    $this->ficheroamatriz();
    foreach ($this->biblio as $indice=>$elemento){
      echo "<tr>";
      echo "<td>$elemento[Autor]</td>";
      echo "<td>$elemento[Titulo]</td>";
      echo "<td>$elemento[Editorial]</td>";
      echo '<td align="center"><table border=1 bgcolor="white"><tr>';
      echo "<td><A href=\"uni4_biblioteca.php?codigo=$indice&accion=editar\">Editar</A></td>";
      echo "<td><A href=\"uni4_biblioteca.php?codigo=$indice&accion=borrar\">Borrar</A></td>";
      echo "</tr></table></td>";
      echo "</td></tr>";
    }
    unset($this->biblio);
  }
  public function mostrarlibroseditar($codigo){
    $this->ficheroamatriz();
    foreach ($this->biblio as $indice=>$elemento){
      if ($indice <> $codigo){
        echo "<tr>";
        echo "<td>$elemento[Autor]</td>";
        echo "<td>$elemento[Titulo]</td>";
        echo "<td>$elemento[Editorial]</td>";
        echo '<td align="center"><table border=1 bgcolor="white"><tr>';
        echo "<td><A href=\"uni4_biblioteca.php?codigo=$indice&accion=editar\">Editar</A></td>";
        echo "<td><A href=\"uni4_biblioteca.php?codigo=$indice&accion=borrar\">Borrar</A></td>";
        echo "</tr></table></td>";
        echo "</td></tr>";
      }else {
        ?>
        <form method="post" action="uni4_biblioteca.php">
          <tr>
            <td>
              <input type="text" name="Autor" value="<? echo $elemento['Autor'] ?>">
            </td>
            <td>
              <input type="text" name="Titulo" value="<? echo $elemento['Titulo'] ?>">
            </td>
            <td>
              <input type="text" name="Editorial" value="<? echo $elemento['Editorial'] ?>">
            </td>
            <td align="center">
              <input type="submit" name="btnguardar" value="Guardar">
              <input type="hidden" name="codigo" value="<?echo $indice;?>">
            </td>
          </tr>
        </form>
        <?

        echo '<td><table border=1 bgcolor="white"><tr>';
        echo "</tr></table></td>";
        echo "</td></tr>";
      }
    }
    unset($this->biblio);
  }
  public function guardar(){
    $this->ficheroamatriz();
    //modificamos el registro correspondiente de la matriz
    $this->biblio[$_REQUEST['codigo']]['Autor'] = $_REQUEST['Autor'];
    $this->biblio[$_REQUEST['codigo']]['Titulo'] = $_REQUEST['Titulo'];
    $this->biblio[$_REQUEST['codigo']]['Editorial'] = $_REQUEST['Editorial'];
    //modificamos el fichero
    @chdir($this->directorio) or die("No existe el directorio $this->directorio");
    $idfich = @fopen($this->fichero,"w") or die("No existe el fichero $this->fichero");
    $this->contador = 0;
    if (isset ($texto)) unset($texto);
    foreach ($this->biblio as $elemento){
      $texto = $this->contador."~$elemento[Autor]~$elemento[Titulo]~$elemento[Editorial]";
      fputs($idfich,$texto,(strlen($texto)));
      $this->contador++;
    }
    fclose($idfich);
    unset($this->biblio);
    $this->mostrarlibros();
  }
  public function matrizafichero(){
    $this->ficheroamatriz();
    @chdir($this->directorio) or die("No existe el directorio $this->directorio");
    $idfich = @fopen($this->fichero,"w") or die("No existe el fichero $this->fichero");
    $this->contador = 0;
    if (isset ($texto)) unset($texto);
    foreach ($this->biblio as $elemento){
      $texto = $this->contador."~$elemento[Autor]~$elemento[Titulo]~$elemento[Editorial]";
      fputs($idfich,$texto,(strlen($texto)));
      $this->contador++;
    }
    fclose($idfich);
  }
  public function agregar($autor,$titulo,$editorial){
    chdir($this->directorio);
    $idfich = @fopen($this->fichero,"a") or die("No existe el fichero $this->fichero");
    $this->ficheroamatriz();
    $texto = "\n".$this->contador."~".$autor."~".$titulo."~".$editorial;
    fputs($idfich,$texto,(strlen($texto)));
    fclose($idfich);
    unset($this->biblio);
  }
  public function borrar($codigo){
    $this->ficheroamatriz();
    @chdir($this->directorio) or die("No existe el directorio $this->directorio");
    $idfich = @fopen($this->fichero,"w") or die("No existe el fichero $this->fichero");
    $this->contador = 0;
    if (isset ($texto)) unset($texto);
    foreach ($this->biblio as $indice=>$elemento){
      if ($indice <> $codigo){
        $texto = $this->contador."~$elemento[Autor]~$elemento[Titulo]~$elemento[Editorial]";
        fputs($idfich,$texto,(strlen($texto)));
        $this->contador++;
      }
    }
    fclose($idfich);
    unset($this->biblio);
  }
  public function buscar(){
    $this->ficheroamatriz();
    $this->contador = 0;
    foreach ($this->biblio as $indice=>$elemento){
      if ($_REQUEST['buscar']<>''){
        //buscamos el texto en todos los campos poniendolos antes en mayúsculas
        //para evitar la diferencia de mayúsculas y minúsculas en la búsqueda.
        $temp1 = strstr(strtoupper($elemento['Autor']),strtoupper($_REQUEST['buscar']));
        $temp2 = strstr(strtoupper($elemento['Titulo']),strtoupper($_REQUEST['buscar']));
        $temp3 = strstr(strtoupper($elemento['Editorial']),strtoupper($_REQUEST['buscar']));
      }
      if ($temp1 || $temp2 || $temp3){
        echo "<tr>";
        echo "<td>$elemento[Autor]</td>";
        echo "<td>$elemento[Titulo]</td>";
        echo "<td>$elemento[Editorial]</td>";
        echo '<td align="center"><table border=1 bgcolor="white"><tr>';
        echo "<td><A href=\"uni4_biblioteca.php?codigo=$indice&accion=editar\">Editar</A></td>";
        echo "<td><A href=\"uni4_biblioteca.php?codigo=$indice&accion=borrar\">Borrar</A></td>";
        echo "</tr></table></td>";
        echo "</td></tr>";
        $this->contador++;
      }
    }
    unset($this->biblio);
  }
 }
?>
