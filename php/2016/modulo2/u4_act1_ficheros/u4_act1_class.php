<?php
class monedero{
	private $monedero = array();
	private $path;
	private $file;
	private $fileid;
	private $fileArray = array();
	private $rows;
	
	public function __construct(){
		try{
			$this->path = getcwd(); //Directorio de trabajo
			$this->file = "monedero.txt"; // Fichero
			chdir($this->path);
			opendir($this->path);
			$this->fileid = fopen($this->file,"r");
		}catch(Exception $e){
			
		}
	}
	
	public function getPath(){
		return $this->path;
	}
	
	public function getRows(){
		return $this->rows;
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
				echo '<td class="text-right">',$splits[3]," €","</td>";
				echo <<<EOT
				<td class="text-center">
					<div class="btn-group text-center" role="group">
					  <a class="btn btn-xs btn-success" href="http://www.w3schools.com">Editar</a>
					  <a class="btn btn-xs btn-success" href="http://www.w3schools.com">Modificar</a>
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
}
?>