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
    for ($fila = 0 ; $fila < 15; $fila++){
      for ($columna = 0 ; $columna < 20; $columna++){
        //numeracion lateral
        if ($columna == 0 && $fila < 16) echo "<td class=\"limpio\">".($fila+1)."</td>";
        switch ($this->cine[$fila][$columna]){
        case 0:
          echo "<td class=\"verde\"><a href=uni5_entradas.php?estado=".$this->cine[$fila][$columna]."&fila=$fila&columna=$columna>__</a></td>";
          break;
        case 1:
          if (isset($_SESSION[$fila][$columna])){
            echo "<td class=\"naranja\"><a href=uni5_entradas.php?estado=".$this->cine[$fila][$columna]."&fila=$fila&columna=$columna>__</a></td>";
          }
          else{
            echo "<td class=\"rojo\"><a href=uni5_entradas.php?estado=".$this->cine[$fila][$columna]."&fila=$fila&columna=$columna>__</a></td>";
          }          
          break;
        default:
          echo $this->cine[$fila][$columna];
          } 
      }
      echo "</tr>";
    }
    // numeracion en la última fila
    for ($columna = 0 ; $columna < 21; $columna++){
      if ($columna == 0) echo "<td class=\"limpio\"></td>";
      else echo "<td class=\"limpio\">$columna</td>";
    }
    echo "</table>";
  }
  function matrizafichero(){
    $idfich = @fopen($this->fichero, "w") or die("No existe el fichero $this->fichero");
    $texto = implode("|",$this->cine["peli"]);
    fputs($idfich,$texto,(strlen($texto)));
    for ($fila = 0; $fila < 15;$fila++){
      $texto = implode("",$this->cine[$fila]);
      fputs($idfich,$texto,(strlen($texto)));
    }
    fclose($idfich);
  }
  function cambiarestado(){
    $fila = $_REQUEST['fila'];
    $columna = $_REQUEST['columna'];
    switch ($this->cine[$fila][$columna]){
      case 0:
        $this->cine[$fila][$columna] = 1;
        break;
      case 1:
        $this->cine[$fila][$columna] = 0;
        break;
    }
    $this->matrizafichero();
  }
}
?>
