<?php
class encuesta{
	private $scriptName;
	private $path;
	private $file;
	private $html;
	private $fileArray = array();
	private $splits = array();
	private $fileid;

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
			// Cargo 
			$this->fileToArray();
		}catch(Exception $e){
			echo ("Ha habido un problema con el fichero.");
		}
	}
	
	public function __destruct(){
		fclose($this->fileid);
	}

	

}
?>