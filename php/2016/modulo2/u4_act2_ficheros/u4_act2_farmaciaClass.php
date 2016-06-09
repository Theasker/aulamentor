<?php
class farmacia{

	private $scriptName;
	private $path;
	private $file;
	private $fileid;
	private $fileArray = array();
	private $rows;
	private $splits = array();
	private $max = array();
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
			// Cargo 
			$this->fileToArray();
		}catch(Exception $e){
			echo ("Ha habido un problema con el fichero.");
		}
	}
	
	public function __destruct(){
		fclose($this->fileid);
	}
	
	public function getRows(){ return $this->rows; }
	
	public function getMax(){	return $this->max; }
	
	private function fileToArray(){
		$this->fileArray = file($this->file);
		$this->rows = count($this->fileArray);
		foreach($this->fileArray as $row){
			$this->splits[] = explode("~", $row);
		}
	}
	
	private function arrayToFile(){
		
	}
	
	public function show($orden){
		$script = $this->scriptName;
		$this->ordenar($orden);
		$this->max = ["nombre"=>"","cantidad"=>0]; // Inicializo el array con el medicamento más caro
		if(count($this->splits)!=0){
			foreach($this->splits as $id => $row ){
				$this->total = $this->total + (float)$row[3];
				if ($row[3] > $this->max['cantidad']){
					$this->max['nombre'] = $row[1];
					$this->max['cantidad'] = $row[3];
				}
				echo "<tr>";
				echo "<td>",$row[1],"</td>";
				echo '<td class="text-center">',number_format($row[2],0,",","."),"</td>";
				echo '<td class="text-right">',number_format($row[3],2,",",".")," €","</td>";
				echo <<<EOT
				<td class="text-center">
					<div class="btn-group text-center" role="group">
					  <a class="btn btn-xs btn-success" href="$this->scriptName?action=editVer&id=$id&orden=$orden">Editar</a>
					  <a class="btn btn-xs btn-danger" href="$this->scriptName?action=del&id=$id&orden=$orden">Borrar</a>
					</form>
				</td>
EOT;
				echo "</tr>";
			}
		}
	}
	
	public function ordenar($orden){
		if(count($this->splits)!=0){
			switch ($orden){
				case "concepto":
					// Función que compara para ordenar por el segundo elemento de array (1)
					function cmpconcepto($a,$b){
						if ($a[1] == $b[1]) return 0;
						return ($a[1] < $b[1]) ? -1 : 1;
					}
					// Ordenamos con la función 'cmp'
					usort($this->splits,'cmpconcepto');
					break;
				case "cantidad":
					// Función que compara para ordenar por el tercer elemento de array (2)
					function cmpcant($a,$b){
						if ($a[2] == $b[2]) return 0;
						return ($a[2] < $b[2]) ? -1 : 1;
					}
					// Ordenamos con la función 'cmp'
					usort($this->splits,'cmpcant');
					break;
				case "importe":
					// Función que compara para ordenar por el cuarto elemento de array (3)
					function cmpamount($a,$b){
						if ($a[3] == $b[3]) return 0;
						return ($a[3] < $b[3]) ? -1 : 1;
					}
					// Ordenamos con la función 'cmp'
					usort($this->splits,'cmpamount');
					break;
			}
		}
	}
	
	// Buscamos en todos los campos guardados
	public function find ($str,$orden){
		$cont = 0;
		$arrayTemp = array();
		foreach ($this->splits as $key => $value){
			$finded = 0; //Para controlar si hay coincidencia en el "registro"
			foreach ($value as $val){
				$val = $this->stripAccents($val); //quitamos los posibles acentos
				// comprobamos que la cadena a buscar está en alguna de los campos
        // pasando a mayúsculas la frase y la cadena a comparar
        // Si encuentra alguna coincidencia en algún elemento del "registro" lo visualiza y sale
        if  (substr_count(strtoupper($val),strtoupper($str))) {
        	$finded = 1;
        	$cont++;
        	break;
        };
			};
			if ($finded){ $arrayTemp[] = $value; };
		};
		$this->splits = $arrayTemp;
		$this->show($orden);
		//return($cont);
	}
	
	// Función que quita los acentos de cualquier string
	private function stripAccents($string){
		return strtr($string,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ',
	'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
	}
	
	public function add($orden){
		if($_POST['add_concepto'] && $_POST['add_cantidad'] && $_POST['add_importe']){
			if (!$this->comprobarMedicamento($_POST['add_concepto'])){ // Comprobamos que el medicamento no existe
				// Buscamos el id del último registro de nuestro fichero
				echo "registros: ", ($this->splits[count($this->splits)-1]);
				echo "<br>registros: ", ($this->splits[count($this->splits)-1]);
				$ultimo = ($this->splits[count($this->splits)-1]);
				$ultimo = $ultimo[0];
				// confeccionamos el array que añadiremos al final del fichero
				$registro = array($ultimo+1,$_POST['add_concepto'],$_POST['add_cantidad'],$_POST['add_importe']);
				$implode = implode("~", $registro);
				$this->fileArray[] = $implode;
				// Agregamos la línea
				file_put_contents($this->file, $implode, FILE_APPEND | LOCK_EX);
				// Añado un salto de línea al fichero para el siguiente registro
				file_put_contents($this->file,"\n",FILE_APPEND); 
				$this->splits[] = $registro;
			}
		}
		$this->ordenar($orden);
		$this->show($orden);
		
	}
	
	private function comprobarMedicamento($nombre){
		$encontrado = false;
		for ($x = 0;$x < count($this->splits);$x++){
			if ($this->splits[$x][1] == $nombre) $encontrado = true;
		}
		return $encontrado;
	}
	
	public function del($orden){
		$this->loadArray();
		// Borramos el registro pulsado de fileArray
		unset($this->fileArray[$_GET['id']]);
		$registros = "";
		foreach($this->fileArray as $row){
			$registros = $registros.$row;
		}
		// grabamos el texto de los registros al fichero
		file_put_contents($this->file, $registros);
		// Añado un salto de línea al fichero para el siguiente registro
		//file_put_contents($this->file,"\n",FILE_APPEND | LOCK_EX); 
		$this->splits = "";
		$this->html->cabeceraOrden($orden);
		$this->ordenar($orden);
		$this->show($orden);
	}
	
}
?>