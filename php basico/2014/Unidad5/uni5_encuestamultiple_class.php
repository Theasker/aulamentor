<?php
class encuestamultiple_class {
  public $encuesta = array();
  public $directorio;
  public $fichero;
  public $votos;
  
  function __construct(){
    $this->directorio = '.'; //Directorio de trabajo el actual
    $this->fichero = "uni5_encuestamultiple.txt";
    $this->ficheroamatriz();
  }
  function ficheroamatriz(){
    chdir($this->directorio);
    $idfich = @fopen($this->fichero,"r") or die("No existe el fichero");
    $temp = fgets($idfich,1024);
    $this->encuesta["titulo"] = $temp;
    $this->votos = 0;
    while($linea= fgets($idfich,1024)){
      $temp = explode("¦",$linea);
      $this->encuesta[$temp[0]] = (int) $temp[1];
      $this->votos = $this->votos + $temp[1];
    }
    fclose($idfich);
  }
  function matrizafichero(){
    $idfich = @fopen($this->fichero,"w") or die ("No existe el fichero $this->fichero");
    $texto = $this->encuesta["titulo"];
    fputs($idfich,$texto,(strlen($texto)));
    $this->votos = 0;
    foreach($this->encuesta as $indice=>$elemento){
      if($indice != "titulo"){
        $texto = $indice."¦".$elemento."\n";
        fputs($idfich,$texto,(strlen($texto)));
        $this->votos = $this->votos + $elemento;
      }
    }
    fclose($idfich);
  }
  function mostrarencuesta(){
    echo '<table border="1"><tr><th>Encuesta múltiple</th></tr>';
    echo '<tr><td><p><b>'.$this->encuesta["titulo"].'</b></p>';
    echo '<form action="uni5_encuestamultiple.php" method="GET">';
    foreach($this->encuesta as $indice=>$elemento){
      if($indice != "titulo")
        echo "<INPUT TYPE=\"checkbox\" NAME=\"$indice\"> $indice</br>";
    }
    echo '<input type="submit" name="votar" value="votar">';
    echo "</form></td></tr><table>";
    echo "<p>Nota: uedes votar una sola vez a varias opciones</p>";
  }
  function mostrarresultados(){
    echo "Resultados";
    echo "<table border=\"1\"><tr><td>";
    echo '<p><b>'.$this->encuesta["titulo"].'</b></p>';
    foreach($this->encuesta as $indice=>$elemento){
      if($indice != "titulo"){
        $porc = ($elemento * 100 / $this->votos);
        echo "$indice = ".(number_format($porc,2, ',', ' '))." % ($elemento)</br>";
      }
        
    }
    echo "</table>";
  }
  function votar(){
    foreach ($_REQUEST as $indice=>$elemento){
      if($indice != "votar"){
        //al pasar el parametro por POST o GET las palabras compuestas como "Coche particular"
        //se pasa como "Coche_particular" por lo que luego no encuentra el índice en el array
        //por lo que cambio "_" por " " para que coincida y poder sumar los votos la indice correspondiente.
        $indice = str_ireplace("_", " ", $indice);
        $this->encuesta[$indice]++;
      }
    }
    $this->matrizafichero();
  }
}
?>
