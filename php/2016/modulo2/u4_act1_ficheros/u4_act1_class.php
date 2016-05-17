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
	private $total;
	
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
	
	public function getTotal(){
		return $this->total;	
	}
	
	private function loadArray(){
		$this->fileArray = file($this->file);
		$this->rows = count($this->fileArray);
		foreach($this->fileArray as $row){
			$this->splits[] = explode("~", $row);
		}
	}
	
	public function show(){
		$this->total = 0;
		foreach($this->splits as $row){
			$this->total = $this->total + (int)$row[3];
			$id=(int)$this->splits[0];
			echo "<tr>";
			echo "<td>",$row[1],"</td>";
			echo '<td class="text-center">',date('m/d/Y', $row[2]),"</td>";
			echo '<td class="text-right">',$row[3] , " €", "</td>";
			echo <<<EOT
			<td class="text-center">
				<div class="btn-group text-center" role="group">
				  <a class="btn btn-xs btn-success" href="$this->scriptName?ope="editar";id=$id">Editar</a>
				  <a class="btn btn-xs btn-success" href="$this->scriptName?ope="editar";id=$id">Borrar</a>
				</div>
			</td>
EOT;
			echo "</tr>";
		}
	}
	
	public function unsorted(){
		$this->loadArray();
		$this->show();
	}
	
	public function sortConcepto(){
		
		$this->loadArray();

		// Función que compara para ordenar por el segundo elemento de array (1)
		function cmp($a,$b){
			if ($a[1] == $b[1]) return 0;
			return ($a[1] < $b[1]) ? -1 : 1;
		}
		// Ordenamos con la función 'cmp'
		usort($this->splits,'cmp');
		$this->show();
	}
	
	public function sortDate(){
		$this->loadArray();

		// Función que compara para ordenar por el tercer elemento de array (2)
		function cmp($a,$b){
			if ($a[2] == $b[2]) return 0;
			return ($a[2] < $b[2]) ? -1 : 1;
		}
		// Ordenamos con la función 'cmp'
		usort($this->splits,'cmp');
		$this->show();
	}
	
	
	public function sortAmount(){
		$this->loadArray();

		// Función que compara para ordenar por el tercer elemento de array (3)
		function cmp($a,$b){
			if ($a[3] == $b[3]) return 0;
			return ($a[3] < $b[3]) ? -1 : 1;
		}
		// Ordenamos con la función 'cmp'
		usort($this->splits,'cmp');
		$this->show();
	}
}
?>