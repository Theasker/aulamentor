<?php
class encuesta_class {
  public $encuesta = array();
  public $directorio;
  public $totalvotos;
  
  function __construct(){
    $this->directorio = '.'; //Directorio de trabajo el actual
    $this->fichero = "encuesta.txt";
    $this->ficheroamatriz();
    // Da las gracias si se ha votado
    if(isset($_REQUEST['Votar']) && isset($_REQUEST['encuesta'])){
      echo "<center><p>¡Gracias por votar!</p></center>";
    }
    $this->mostrarencuesta();
  }
  function ficheroamatriz(){ 
    chdir($this->directorio);//cambiamos el directorio activo
    //Abrimos el fichero en modo sÃ³lo lectura
    $idfich = @fopen($this->fichero, "r") or die("No existe el fichero $this->fichero");
    $this->encuesta["titulo"] = fgets($idfich,1024);
    while($linea= fgets($idfich,1024)){//leemos liena a linea
      $temp = explode("¦",$linea);
      $this->encuesta["$temp[0]"] = $temp[1];
    }
    fclose($idfich);
  }
  function matrizafichero(){
    $idfich = @fopen($this->fichero, "w") or die("No existe el fichero $this->fichero");
    $texto = "¿Cuantas veces entras en Internet?\n";
    fputs($idfich,$texto,(strlen($texto)));
    $this->totalvotos = 0;
    foreach ($this->encuesta as $indice => $elemento){
      if($indice != "titulo"){
        $this->totalvotos = $this->totalvotos + $elemento;
        $texto = $indice."¦".$elemento;
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
        <th><h2>Encuesta</h2></th>
      </tr>
      <form action="encuesta.php" method="POST">
      <tr>
      <td><center><p><b><?echo $this->encuesta["titulo"]?></b></p>
      <input type="submit" name="Votar" value="Votar"></center></td>      
      </tr>
      <tr><td>
      <?php
      foreach($this->encuesta as $indice=>$elemento){
        if ($indice != "titulo"){
          echo '<input type="radio" name="encuesta" value="'.$indice.'"> '.$indice.'</br>';
        }
      }
      ?>
      </td></tr>      
      </form>
    </table>
    </center>
  <?php
  }
  function votacion(){
    $this->encuesta[$_REQUEST['encuesta']] = $this->encuesta[$_REQUEST['encuesta']] + 1;
    $this->encuesta[$_REQUEST['encuesta']] = $this->encuesta[$_REQUEST['encuesta']]."\n";
  }
  function resultados(){
    $this->matrizafichero();
    echo "<center></br>Resultados</br></center>";
    echo '<center><table width="50%" border="1"><tr>';
    echo '<td><center><h3>'.$this->encuesta['titulo'].'</h3></center></td></tr>';
    echo '<tr><td></br>';
    foreach($this->encuesta as $indice => $elemento){
      if ($indice != "titulo"){
        $porc = $elemento * 100 / $this->totalvotos;
        echo "$indice = ".number_format($porc,2, ',', ' ')." % ($elemento)</br>";
      }
    }
    echo '</tr></td>';
    echo '</table></center>';
    echo "<center><h2>Nº total de votos: $this->totalvotos</h2></center>";
  }
}
?>
