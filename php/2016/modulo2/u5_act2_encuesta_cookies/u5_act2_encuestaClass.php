<?php
class encuesta{
	private $scriptName;
	private $path;
	private $file;
	private $html;
	private $fileArray = array();
	private $titulo;
	private $splits = array();
	private $fileid;
	
	public function getTitulo(){
		return $this->titulo;
	}
	
	public function getDatos(){
		return $this->splits;
	}

	public function __construct($scriptName){
		try{
			// Guardamos el nombre del script en ejecución
			$this->scriptName = $scriptName;
			$this->path = getcwd(); //Directorio de trabajo
			$this->file = "encuesta.txt"; // Fichero
			chdir($this->path);
			opendir($this->path);
			$this->fileid = fopen($this->file,"r");
			$this->html = new html($this->scriptName);

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
		// Guardamos la información de la encuesta
		$this->titulo = $this->fileArray[0];
		// Guardamos la informacion de los resultados de la encuesta
		for ($x = 1;$x < $this->rows;$x++){
			$this->splits[] = explode("¦", $this->fileArray[$x]);
		}
	}
	
	// Guardamos los datos al fichero de texto
	private function arrayToFile(){
		$registros[0] = $this->titulo;
		foreach ($this->splits as $row) {
			// Converito en número string a entero para eliminar el salto de línea si existe
			$row[1] = (int)$row[1]; 
			$registros[] = implode("¦", $row)."\n";
		}
		file_put_contents($this->file, $registros);
	}
	
	public function votar(){
		$id = (int)$_POST['encuesta'];
		$votos = (int)$this->splits[$id][1];
		
		// Sumamos uno a los votos
		$this->splits[$id][1] = $votos + 1;
		$this->arrayToFile();
	}
	
}
?>