<?php
class encuesta_class {
  public $encuesta = array();
  public $directorio;
  public $totalvotos;
  
  function __construct(){
    $this->directorio = '.'; //Directorio de trabajo el actual
    $this->fichero = "encuesta2.txt";
    $this->ficheroamatriz();
    // Da las gracias si se ha votado
    if(isset($_REQUEST['Votar']) && isset($_REQUEST['encuesta'])){
      echo "<center><p>¡Gracias por votar!</p></center>";
    }
  }
  function ficheroamatriz(){ 
    chdir($this->directorio);//cambiamos el directorio activo
    //Abrimos el fichero en modo solo lectura
    $idfich = @fopen($this->fichero, "r") or die("No existe el fichero $this->fichero");
    $this->encuesta["titulo"] = fgets($idfich,1024);
    $this->totalvotos = 0;
    while($linea= fgets($idfich,1024)){//leemos liena a linea
      $temp = explode("¦",$linea);
      $this->encuesta[$temp[0]] = array("director"=>$temp[1],"anio"=>$temp[2],"votos"=>$temp[3]);
      $this->totalvotos = $this->totalvotos + $temp[3];
    }
    fclose($idfich);
  }
  function matrizafichero(){
    $idfich = @fopen($this->fichero, "w") or die("No existe el fichero $this->fichero");
    $texto = $this->encuesta["titulo"];
    fputs($idfich,$texto,(strlen($texto)));
    $this->totalvotos = 0;
    foreach ($this->encuesta as $indice => $elemento){
      if($indice != "titulo"){
        $this->totalvotos = $this->totalvotos + $elemento["votos"];
        $texto = $indice."¦".$elemento["director"]."¦".$elemento["anio"]."¦".$elemento["votos"];
        fputs($idfich,$texto,(strlen($texto)));
      }
     }
    fclose($idfich);
  }
  function mostrarencuesta(){
    ?>
    <center>
    <table width='55%' border='1'>
      <tr>
        <th><h3>Encuesta 2</h3></th>
      </tr>
      <form action="encuesta2.php" method="POST">
      <tr>
      <td><p><h2><?echo $this->encuesta["titulo"]?></h2>
      (Puedes votar hasta 3 películas diferentes, una cada vez)</br></p>
      <?
      $this->totalvotos = 0;
      foreach($this->encuesta as $indice=>$elemento){
        if ($indice != "titulo"){
          echo '<input type="radio" name="encuesta" value="'.$indice.'"><b>'.$indice.'</b> - '
               .$elemento["director"].' ( '.$elemento["anio"].' )'.'</br>';
          $this->totalvotos = $this->totalvotos + $elemento["votos"];
        }
      }
      ?>
      </td></tr>
      <tr><td>
      <center><p><input type="submit" name="Votar" value="Votar">
      <A href=encuesta2.php?accion=mostrar>(Ver resultados)</A>
      </p></center>
      </td></tr>      
      </form>
    </table>
    </center>
  <?
  }
  function votacion(){
    // comprobamos las veces que se ha votado esa película
    if (!isset($_SESSION["encuesta"][$_REQUEST["encuesta"]])){ //no se ha votado
      $_SESSION["encuesta"][$_REQUEST["encuesta"]] = 1;
      $this->encuesta[$_REQUEST["encuesta"]]["votos"] = $this->encuesta[$_REQUEST["encuesta"]]["votos"] + 1;
      $this->encuesta[$_REQUEST["encuesta"]]["votos"] = $this->encuesta[$_REQUEST["encuesta"]]["votos"]."\n";
      $_SESSION["encuesta"]["votado"]++;
    }
    else echo "<center>¡Sólo se permite votar una vez a la misma película!</center>";
    $this->matrizafichero();
    
  }
  function resultados(){
    echo "<center></br>Resultados</br></center>";
    echo '<center><table width="45%" border="1">';
    echo '<tr><td><center><h3>'.$this->encuesta['titulo'].'</h3></center></td></tr>';
    echo '<tr><td><table border="0"><tr>';
    foreach($this->encuesta as $indice => $elemento){
      if ($indice != "titulo"){
        $porc = $elemento["votos"] * 100 / $this->totalvotos;
        echo "<tr><td>";
        echo $indice;
        echo "</td><td>";
        echo number_format($porc,2, ',', ' ');
        echo ' % ('. $elemento["votos"] .')</br></td></tr>';
      }
    }
    echo '</tr></td>';
    
    echo "</table>";
    echo "<center><h2>Nº total de votos: $this->totalvotos</h2>";
    echo '<form method="POST" acction="encuesta2.php">';
    echo '<input type="submit" name="volver" value="volver"></form>';
    echo "</center></tr></td></table></center>";
  }
}
?>
