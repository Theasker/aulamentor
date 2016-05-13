<?php
class monedero{
	
	private $monedero = array();
	private $scriptName;
	private $path;
	private $file;
	private $fileid;
	private $fileArray = array();
	private $rows;
	private $splits = array();
	
	public function __construct(){
		try{
			//basename — Devuelve el último componente de nombre de una ruta
			// Guardamos el nombre del script en ejecución
			$this->scriptName = basename($_SERVER["SCRIPT_NAME"]);
			$this->path = getcwd(); //Directorio de trabajo
			$this->file = "monedero.txt"; // Fichero
			chdir($this->path);
			opendir($this->path);
			$this->fileid = fopen($this->file,"r");
		}catch(Exception $e){
			echo ("Ha habido un problema con el fichero.");
		}
	}
	
	public function __destruct(){
		fclose($this->fileid);
	}
	
	public function getPath(){
		return $this->path;
	}
	
	public function getRows(){
		return $this->rows;
	}
	
	public function getScriptName(){
		return $this->scriptName;
	}
	
	private function loadArray(){
		$this->fileArray = file($this->file);
		$this->rows = count($this->fileArray);
		foreach($this->fileArray as $row){
			$this->splits[] = explode("~", $row);
		}
		echo("<pre>");
		//var_dump($this->splits);
		echo("</pre>");
		
	}
	
	public function show(){
		try{
			$this->loadArray();
			foreach($this->splits as $row){
				echo "<tr>";
				echo "<td>",$row[1],"</td>";
				echo '<td class="text-center">',date('m/d/Y', $row[2]),"</td>";
				echo '<td class="text-right">',$row[3] , " €", "</td>";
				echo <<<EOT
				<td class="text-center">
					<div class="btn-group text-center" role="group">
					  <a class="btn btn-xs btn-success" href="$this->scriptName?ope=editar;id=$splits[0]">Editar</a>
					  <a class="btn btn-xs btn-success" href="$this->scriptName?ope=editar;id=$splits[0]">Borrar</a>
					</div>
				</td>
EOT;
				
				echo "</tr>";
			}
			
		}catch (Exception $e){
			echo ("Ha habido un problema con el fichero.");
		}
	}
	
	public function sortConcepto(){

		




		// Función que compara para orden
		function cmp($a,$b){
			if ($a[1] == $b[1]) return 0;
			return ($a[1] < $b[1]) ? -1 : 1;
		}
		// Ordenamos con la función 'cmp'
		usort($this->fileArray,'cmp');
		echo "<h3>ordenado por concepto:</h3>";
		echo "<pre>";
		var_dump($this->fileArray);
		echo "</pre>";
		$this->show();
	}
}
?>