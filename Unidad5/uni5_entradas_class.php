<?php
class uni5_entradas_class {
  public $cine = array();
  public $directorio;
  
  function __construct() {
    $this->directorio = '.'; //Directorio de trabajo el actual
    $this->fichero = "uni5_entradas.txt";
    $this->ficheroamatriz();
  }
  function ficheroamatriz(){ 
    chdir($this->directorio);//cambiamos el directorio activo
    //Abrimos el fichero en modo solo lectura
    $idfich = @fopen($this->fichero, "r") or die("No existe el fichero $this->fichero");
    $temp = explode("|",fgets($idfich,1024));
    $this->cine["peli"] = array("sala"=>$temp[0],"titulo"=>$temp[1],"hora"=>$temp[2],"dia"=>$temp[3]);
    while($linea= fgets($idfich,1024)){//leemos liena a linea
      $this->cine[] = str_split($linea, 1);
    }
    fclose($idfich);
  }
  function mostrarmatriz(){
    echo "<table>";
    for ($filas = 0 ; $filas < 16; $filas++){
      for ($columnas = 0 ; $columnas < 21; $columnas++){
        if ($columnas == 0 && $filas < 15) echo "<td>".($filas+1)."</td>";
        else {
          if ($filas < 15) echo "<td><a href=uni5_entradas.php?accion=pulsar&estado=ocupado>__</a></td>";
            else{
              if ($columnas == 0) echo "<td></td>";
              else echo "<td>$columnas</td>";
            }
        }
      }
      echo "</tr>";
    }
    echo "</table>";
    var_dump($_REQUEST);
  }
}

?>
