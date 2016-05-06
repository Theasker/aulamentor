<?php
class monedero{
	private $monedero = array();
	private $path;
	private $file;
	private $fileid;
	private $fileArray = array();
	
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

	public function readFile(){
		try{
			$this->fileArray = file($this->file);
			foreach($this->fileArray as $row){
				$splits = explode("~", $row);
				echo "<tr>";
				echo "<td>",$splits[1],"</td>";
				echo "<td class=\"text-center\">",date('m/d/Y', $splits[2]),"</td>";
				echo "<td class=\"text-right\">",$splits[3]," €","</td>";
				$bar = <<<EOT
				<td class="text-center">
				<div class="btn-group" role="group" aria-label="...">
				  <button type="button" class="btn btn-default btn-success">
				  
				  </button>
				  <button type="button" class="btn btn-default btn-success">
				  
				  </button>
				</div>
				</td>
EOT;
				echo $bar;
				echo "</tr>";
			}
			fclose($this->fileid);
		}catch (Exception $e){
			echo ("Ha habido un problema con el fichero.");
		}
		
	}
}
?>