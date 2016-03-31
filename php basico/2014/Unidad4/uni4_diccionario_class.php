<?php
class diccionario {
  public $diccionario = array();
  public $directorio;
  public $fichero;
  public $contador;
  
  function ficheroamatriz(){ //ordenado por traducción (por defecto)
    chdir($this->directorio);
    //Abrimos el fichero en modo sólo lectura
    $idfich = @fopen($this->fichero, "r") or die("No existe el fichero $this->fichero");
    $this->contador = 0;
    while($linea= fgets($idfich,1024)){
      $temp = explode("~",$linea);
      #$this->diccionario[$this->contador] = Array("Traduccion"=>$temp[1],"Palabra"=>$temp[2]);
      $this->diccionario[] = Array("Traduccion"=>$temp[1],"Palabra"=>$temp[2]);
      $this->contador++;
    }
    fclose($idfich);
  }
  function ficheroamatriz2(){ //para ordenar por palabra
    chdir($this->directorio);
    //Abrimos el fichero en modo sólo lectura
    $idfich = @fopen($this->fichero, "r") or die("No existe el fichero $this->fichero");
    $this->contador = 0;
    while($linea= fgets($idfich,1024)){
      $temp = explode("~",$linea);
      #$this->diccionario[$this->contador] = Array("Traduccion"=>$temp[1],"Palabra"=>$temp[2]);
      $this->diccionario[] = Array("Palabra"=>$temp[2],"Traduccion"=>$temp[1]);
      $this->contador++;
    }
    fclose($idfich);
  }
  function mostrararray(){
    $this->contador = 0;
    foreach ($this->diccionario as $indice=>$elemento){
      echo "<tr>";
      echo "<td>$elemento[Palabra]</td>";
      echo "<td>$elemento[Traduccion]</td>";
      echo '<td><table>';
      echo "<td class=\"boton\"><A href=uni4_diccionario.php?accion=editarregistro&elemento=".$indice.">Editar</A></td>";
      echo "<td class=\"boton\"><A href=uni4_diccionario.php?accion=borrarregistro&elemento=".$indice.">Borrar</A></td>";
      echo "</table></td>";
      echo "</tr>";
      $this->contador++;
    }
  }
  function matrizafichero(){
    chdir($this->directorio);
    $idfich = @fopen($this->fichero, "w") or die("No existe el fichero $this->fichero");
    $this->contador = 0;
    foreach ($this->diccionario as $elemento){
      $texto = $this->contador."~".implode("~",$elemento);
      fputs($idfich,$texto,(strlen($texto)));
      $this->contador++;
    }
    if(isset($_REQUEST['btnagregar'])){
      fputs($idfich,"\n",(strlen("\n")));//añadimos un salto de linea
    }
    fclose($idfich);
  }
  function agregar(){   
    $this->ficheroamatriz();
    $this->diccionario[] = Array("Traduccion"=>$_REQUEST["traduccion"],"Palabra"=>$_REQUEST["palabra"]);
    $this->matrizafichero();
    $this->mostrararray();
  }
  function mostrarparaeditar($indiceparaeditar){
    $this->contador = 0;
    foreach ($this->diccionario as $indice=>$elemento){
      if($indice == $indiceparaeditar){
        echo '<form action="uni4_diccionario.php" method="post">';
        echo '<tr><td><input type="text" name="palabra" value="'.$elemento['Palabra'].'"></td>';
        echo '<td><input type="text" name="traduccion" value="'.$elemento['Traduccion'].'"></td>';
        echo '<td><input type="submit" name="btnguardar" value="Guardar"></td></tr>';
        echo '<input type="hidden" name="codigo" value="'.$indice.'"></form>';
      }else{
        echo "<tr>";
        echo "<td>$elemento[Palabra]</td>";
        echo "<td>$elemento[Traduccion]</td>";
        echo '<td><table>';
        echo "<td class=\"boton\"><A href=uni4_diccionario.php?accion=editarregistro&elemento=".$indice.">Editar</A></td>";
        echo "<td class=\"boton\"><A href=uni4_diccionario.php?accion=borrarregistro&elemento=".$indice.">Borrar</A></td>";
        echo "</table></td>";
        echo "</tr>";
      }
      $this->contador++;
    }
  }
  function guardarregistro(){
    $this->ficheroamatriz();
    //modificamos el registro correspondiente de la matriz
    //y añadimos el salto de linea para que quede bien el fichero con "\n"
    $this->diccionario[$_REQUEST['codigo']]['Palabra'] = ($_REQUEST['palabra']."\n");
    $this->diccionario[$_REQUEST['codigo']]['Traduccion'] = $_REQUEST['traduccion'];
    
    /*chdir($this->directorio);
    //Abrimos el fichero en modo sólo lectura
    $idfich = @fopen($this->fichero, "r") or die("No existe el fichero $this->fichero");
    $this->contador = 0;
    while($linea= fgets($idfich,1024)){
      if ($this->contador == $_REQUEST['codigo']){
        
      }else{
        $temp = explode("~",$linea);
        $this->diccionario[] = Array("Palabra"=>$temp[2],"Traduccion"=>$temp[1]);        
      }
      $this->contador++;
    }
    fclose($idfich);*/
    $this->matrizafichero();
  }
  function borrarregistro($elementoaborrar){
    chdir($this->directorio);
    //Abrimos el fichero en modo sólo lectura
    $idfich = @fopen($this->fichero, "r") or die("No existe el fichero $this->fichero");
    $this->contador = 0;
    while($linea= fgets($idfich,1024)){
      if($this->contador <> $elementoaborrar){
        $temp = explode("~",$linea);
        #$this->diccionario[$this->contador] = Array("Traduccion"=>$temp[1],"Palabra"=>$temp[2]);
        $this->diccionario[] = Array("Traduccion"=>$temp[1],"Palabra"=>$temp[2]);
       }
       $this->contador++;      
    }
    fclose($idfich);
    $this->matrizafichero();
    $this->mostrararray();
  }
  function buscar(){
    $this->ficheroamatriz();
    $this->contador = 0;
    foreach ($this->diccionario as $indice=>$elemento){
      if ($_REQUEST['buscar']<>''){
        $temp1 = strstr(strtoupper($elemento['Palabra']),strtoupper($_REQUEST['buscar']));
        $temp2 = strstr(strtoupper($elemento['Traduccion']),strtoupper($_REQUEST['buscar']));
      }
      if (isset ($temp1)){
        echo "<tr>";
        echo "<td>$elemento[Palabra]</td>";
        echo "<td>$elemento[Traduccion]</td>";
        echo '<td><table>';
        echo "<td class=\"boton\"><A href=uni4_diccionario.php?accion=editarregistro&elemento=".$indice.">Editar</A></td>";
        echo "<td class=\"boton\"><A href=uni4_diccionario.php?accion=borrarregistro&elemento=".$indice.">Borrar</A></td>";
        echo "</table></td>";
        echo "</tr>";
      }
      $this->contador++;
    }
  }
}

?>
