<?php
class monedero{
	
	private $monedero = array();
	private $scriptName;
	private $path;
	private $file;
	private $fileid;
	private $fileArray = array();
	private $rows;
	
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
	
	
	
	public function getPath(){
		return $this->path;
	}
	
	public function getRows(){
		return $this->rows;
	}
	
	public function getScriptName(){
		return $this->scriptName;
	}

	public function show(){
		try{
			$this->fileArray = file($this->file);
			$this->rows = count($this->fileArray);
			foreach($this->fileArray as $row){
				$splits = explode("~", $row);
				echo "<tr>";
				echo "<td>",$splits[1],"</td>";
				echo '<td class="text-center">',date('m/d/Y', $splits[2]),"</td>";
				echo '<td class="text-right">',$splits[3] , " €", "</td>";
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
			fclose($this->fileid);
		}catch (Exception $e){
			echo ("Ha habido un problema con el fichero.");
		}
		
	}
	
	public function sortConcepto(){
		// Función que compara el título de cada película para ordenarlo
		function cmp($a,$b){
			if ($a[0] == $b[0]) return 0;
			return ($a[0] < $b[0]) ? -1 : 1;
		}
		// Ordenamos con la función 'cmp'
		usort($this->medicine,'cmp');
		$this->show();
	}
}
?>