<?php
class farmacia{

	private $scriptName;
	private $path;
	private $file;
	private $fileid;
	private $fileArray = array();
	private $rows;
	private $splits = array();
	private $total;
	private $html;
	
	public function __construct($scriptName){
		try{
			// Guardamos el nombre del script en ejecución
			$this->scriptName = $scriptName;
			$this->path = getcwd(); //Directorio de trabajo
			$this->file = "farmacia.txt"; // Fichero
			chdir($this->path);
			opendir($this->path);
			$this->fileid = fopen($this->file,"r");
			$this->html = new html($this->scriptName);
		}catch(Exception $e){
			echo ("Ha habido un problema con el fichero.");
		}
	}
	
	private function ficheroToArray(){
		
	}
	
	private function ArrayToFile(){
		
	}
}
?>