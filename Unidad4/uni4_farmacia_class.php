<?php
class farmacia {
  public $farmacia = array();
  public $directorio;
  public $fichero;
  public $contador;
  public $max;
  
  function ficheroamatriz(){ //ordenado por traducción (por defecto)
    chdir($this->directorio);//cambiamos el directorio activo
    //Abrimos el fichero en modo sólo lectura
    $idfich = @fopen($this->fichero, "r") or die("No existe el fichero $this->fichero");
    $this->contador = 0;
    while($linea= fgets($idfich,1024)){//leemos liena a linea
      $temp = explode("~",$linea);
      $this->farmacia[] = Array("nombre"=>$temp[1],"cantidad"=>$temp[2],"importe"=>$temp[3]);
      $this->contador++;
    }
    fclose($idfich);
  }
  function mostrarmatriz(){
    //inicializamos la variable que guarda el índice del elemento con precio máximo
    $this->max = 0;
    foreach ($this->farmacia as $indice=>$elemento){
      echo "<tr>";
      echo "<td>".$elemento['nombre']."</td>";
      echo "<td>".$elemento['cantidad']."</td>";
      echo "<td>".$elemento['importe']."</td>";
      if ($elemento['importe'] > $this->farmacia[$this->max]['importe']){
        $this->max = $indice;
      }
      echo '<td><table>';
      echo "<td class=\"boton\"><A href=uni4_farmacia.php?accion=editarregistro&elemento=".$indice.">Editar</A></td>";
      echo "<td class=\"boton\"><A href=uni4_farmacia.php?accion=borrarregistro&elemento=".$indice.">Borrar</A></td>";
      echo "</table></td>";
      echo "</tr>";
      $this->contador++;      
    }
  }
  //Funcion para ordenar arrays multidimensionales por cualquier campo
  function OrdenarArray ($ArrayDesordenado, $campo){
    $claves = array();
    //$ArrayOrdenado = array();
    //Guardamos en el array $claves los indices y el campo que queremos ordenar
    foreach ($ArrayDesordenado as $clave => $fila){
      $claves[$clave] = $fila[$campo];
    }
    //Ordenamos el array por el contenido, que es el campo que hemos elegido.
    asort($claves);
    //recorremos el array de claves ya ordenado y vamos rellenando un nuevo array
    //con los campos completos con el nuevo orden
    $this->farmacia = null;
    //Recorremos el array de claves ordenadas y rellenamos de nuevo nuestro array
    foreach ($claves as $clave => $fila){
      $this->farmacia[] = $ArrayDesordenado[$clave];
    }
  }
  function mostrarmatrizeditar(){
    //inicializamos la variable que guarda el índice del elemento con precio máximo
    $this->max = 0;
    foreach ($this->farmacia as $indice=>$elemento){
      echo "<tr>";
      if ($indice == $_REQUEST['elemento']){
        echo '<form action="uni4_farmacia.php" method="post">';
        echo '<td><input type="text" name="nombre" value='.$elemento['nombre'].'></td>';
        echo '<td><input type="text" name="cantidad" value='.$elemento['cantidad'].'></td>';
        echo '<td><input type="text" name="importe" value='.$elemento['importe'].'></td>';
        echo '<td><input type="submit" name="btnguardar" value="Guardar"></td>';
        echo '<input type="hidden" name="codigo" value="'.$indice.'"></form>';
      }
      else{
        
        echo "<td>".$elemento['nombre']."</td>";
        echo "<td>".$elemento['cantidad']."</td>";
        echo "<td>".$elemento['importe']."</td>";
        echo '<td><table>';
        echo "<td class=\"boton\"><A href=uni4_farmacia.php?accion=editarregistro&elemento=".$indice.">Editar</A></td>";
        echo "<td class=\"boton\"><A href=uni4_farmacia.php?accion=borrarregistro&elemento=".$indice.">Borrar</A></td>";
        echo "</table></td>";
      }
      echo "</tr>";
      if ($elemento['importe'] > $this->farmacia[$this->max]['importe']){
        $this->max = $indice;
      }
      $this->contador++;      
    }
  }
  function guardarregistro(){
    $this->ficheroamatriz();
    //modificamos el registro correspondiente de la matriz
    //y añadimos el salto de linea para que quede bien el fichero con "\n"
    $this->diccionario[$_REQUEST['codigo']]['nombre'] = ($_REQUEST['nombre']."\n");
    $this->diccionario[$_REQUEST['codigo']]['cantidad'] = ($_REQUEST['nombre']."\n");
    $this->diccionario[$_REQUEST['codigo']]['importe'] = ($_REQUEST['nombre']."\n");
    $this->matrizafichero();
  }
  function matrizafichero(){
    $idfich = @fopen($this->fichero, "w") or die("No existe el fichero $this->fichero");
    $this->contador = 0;
    foreach ($this->farmacia as $elemento){
      $texto = $this->contador."~".implode("~",$elemento);
      fputs($idfich,$texto,(strlen($texto)));
      $this->contador++;
    }
    if(isset($_REQUEST['btnagregar']) or isset($_REQUEST['btnguardar'])){
      fputs($idfich,"\n",(strlen("\n")));//añadimos un salto de linea
    }
    fclose($idfich);
  }
}
?>
