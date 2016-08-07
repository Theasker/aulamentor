<?php
class entradas{
	private $scriptName;
	private $path;
	private $file;
	private $fileid;
	private $html;
	private $fileArray = array();
	private $obra = array();
	private $asientos = array();
	private $splits = array();
	private $rows;

	public function __construct($scriptName){
		try{
			// Guardamos el nombre del script en ejecución
			$this->scriptName = $scriptName;
			$this->path = getcwd(); //Directorio de trabajo
			$this->file = "entradas.txt"; // Fichero
			chdir($this->path);
			opendir($this->path);
			$this->fileid = fopen($this->file,"r");
			$this->html = new html($this->scriptName);
			// Cargo 
			$this->fileToArray();
		}catch(Exception $e){
			echo ("Ha habido un problema con el fichero.");
		}
	}
	
	public function __destruct(){
		fclose($this->fileid);
	}
	
	private function fileToArray(){
		$this->fileArray = file($this->file);
		$this->rows = count($this->fileArray);
		// Guardamos la información de la obra de teatro
		$this->obra = explode('|',$this->fileArray[0]);
		// Guardamos la informacion de los asientos
		for ($x = 1;$x < count($this->fileArray);$x++){
			$this->asientos[] = str_split($this->fileArray[$x]);
		}
	}
	
	// Información sobre la obra de teatro
	public function obra(){
		$this->html->mostrarObra($this->obra);
	}
	
	// Muestra el patio de butacas
	public function butacas(){
		echo '<div class="row">';
		echo '<div class="centrado col-md-12">';
		echo '<table>';
		for ($fila = 0 ; $fila < 15; $fila++){
			echo '<tr>';
      for ($columna = 0 ; $columna < 20; $columna++){
      	// Numeración de la primera columna
      	if ($columna == 0 && $fila < 16) echo "<td>".($fila+1)."</td>";
      	// Controlamos si la butaca está ocupada
      	switch ($this->asientos[$fila][$columna]){
      		case 0:
      			echo '<td class="verde text-center">';
      			echo "<a href=\"$this->scriptName?estado=".$this->asientos[$fila][$columna]."&fila=$fila&columna=$columna\">&nbsp;&nbsp;</a></td>";
      			break;
      		case 1:
      			$find = false;
      			if (isset($_COOKIE["butaca"][$fila][$columna])){
      				echo '<td class="naranja text-center">';
      			}else{
      				echo '<td class="rojo text-center">';
      			}
      			echo "<a href=\"$this->scriptName?estado=".$this->asientos[$fila][$columna]."&fila=$fila&columna=$columna\">&nbsp;&nbsp;</a></td>";
      			break;
      	}
      	
      	echo "<a href=\"$this->scriptName?estado=".$this->asientos[$fila][$columna]."&fila=$fila&columna=$columna\">&nbsp;&nbsp;</a>";
      }
      echo '</tr>';
		}
		 // numeracion en la última fila
    for ($columna = 0 ; $columna < 21; $columna++){
      if ($columna == 0) echo "<td class=\"limpio\"></td>";
      else echo "<td class=\"limpio\">$columna</td>";
    }
		echo '</table></div></div>';
	}
	
	public function cambioEstado($estado){
		switch ($estado) {
			case 'reservar':
				//vardump::ver($estado);
				//vardump::ver($this->obra);
				$this->asientos[$_GET["fila"]][$_GET["columna"]] = 1;
				break;
			case 'cancelar':
				$this->asientos[$_GET["fila"]][$_GET["columna"]] = 0;
				break;
		}
		$this->arrayToFile();
	}

	private function arrayToFile(){
		$registros = array(implode("|", $this->obra));
		foreach ($this->asientos as $row) {
			$registros[] = implode("", $row);
		}
		file_put_contents($this->file, $registros);
	}
}
?>