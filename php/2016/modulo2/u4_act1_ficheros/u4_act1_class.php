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
	private $html;
	
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
			$this->html = new html($this->scriptName);
		}catch(Exception $e){
			echo ("Ha habido un problema con el fichero.");
		}
	}
	
	public function __destruct(){
		fclose($this->fileid);
	}
	
	public function getPath(){ return $this->path;	}
	
	public function getRows(){ return $this->rows; }
	
	public function getScriptName(){ return $this->scriptName; }
	
	public function getTotal(){	return $this->total; }
	
	private function loadArray(){
		$this->fileArray = file($this->file);
		$this->rows = count($this->fileArray);
		foreach($this->fileArray as $row){
			$this->splits[] = explode("~", $row);
		}
	}
	
	public function show($orden){
		if ($orden=="") $orden="desordenado";
		$script = $this->scriptName;
		$this->total = 0;
		if(count($this->splits)!=0){
			foreach($this->splits as $id => $row ){
				$this->total = $this->total + (int)$row[3];
	
				echo "<tr>";
				echo "<td>",$row[1],"</td>";
				echo '<td class="text-center">',date('d-m-Y', $row[2]),"</td>";
				echo '<td class="text-right">',$row[3] ," €","</td>";
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
		
		$this->loadArray();
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
				case "fecha":
					// Función que compara para ordenar por el tercer elemento de array (2)
					function cmpdate($a,$b){
						if ($a[2] == $b[2]) return 0;
						return ($a[2] < $b[2]) ? -1 : 1;
					}
					// Ordenamos con la función 'cmp'
					usort($this->splits,'cmpdate');
					break;
				case "importe":
					// Función que compara para ordenar por el tercer elemento de array (3)
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
	
	public function find ($str){
		$cont = 0;
		$this->loadArray();
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
		$this->show('desordenado');
		return($cont);
	}
	
	// Función que quita los acentos de cualquier string
	function stripAccents($string){
		return strtr($string,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ',
	'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
	}
	
	public function add($orden){
		if($_POST['add_concepto'] && $_POST['add_fecha'] && $_POST['add_importe']){
			$this->loadArray();
			// Buscamos el id del último registro de nuestro fichero
			$ultimo = ($this->splits[count($this->splits)-1]);
			$ultimo = $ultimo[0];
			// Convierto el string de la fecha a timestamp
			$dtime = DateTime::createFromFormat("Y-m-d", $_POST['add_fecha']);
			$timestamp = $dtime->getTimestamp();
			// confeccionamos el array que añadiremos al final del fichero
			$registro = array($ultimo+1,$_POST['add_concepto'],$timestamp,$_POST['add_importe']);
			$implode = implode("~", $registro);
			$this->fileArray[] = $implode;
			// Agregamos la línea
			file_put_contents($this->file, $implode, FILE_APPEND | LOCK_EX);
			// Añado un salto de línea al fichero para el siguiente registro
			file_put_contents($this->file,"\n",FILE_APPEND); 
		}
		$this->splits = "";
		$this->ordenar($orden);
		$this->show($orden);
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
	
	public function editVer($orden){
		if ($orden=="") $orden="desordenado";
		$this->total = 0;
		foreach($this->splits as $id => $row ){
			$this->total = $this->total + (int)$row[3];
			if ($id == $_GET['id']){ // coincide con el registro a editar
				// El número está guardado con un salto de línea y con este comando lo descarto
				$num = explode("\n", $row[3]);
				$this->html->formEdit($row[0],$row[1],date('Y-m-d',$row[2]),(float)$num[0],$orden);
			}else{ // no coincide con el registro a editar
				echo "<tr>";
				echo "<td>",$row[1],"</td>";
				echo '<td class="text-center">',date('m-d-Y', $row[2]),"</td>";
				echo '<td class="text-right">',$row[3] ," €","</td>";
				echo <<<EOT
				<td class="text-center">
					<div class="btn-group text-center" role="group">
					  <a class="btn btn-xs btn-success" href="$this->scriptName?action=editVer&id=$id&orden=$orden">Editar</a>
					  <a class="btn btn-xs btn-danger" href="$this->scriptName?action=del&id=$id&orden=$orden">Borrar</a>
					</div>
				</td>
EOT;
			}
				echo "</tr>";
		}
	}
	/*
	'action' => string 'edit' (length=4)
  'orden' => string 'desordenado' (length=11)
  'id' => string '3' (length=1)
  'edit_concepto' => string 'Regalo cumpleaños Alicia' (length=25)
  'edit_fecha' => string '2013-03-07' (length=10)
  'edit_importe' => string '-199.66' (length=7)
	*/
	public function edit(){
		var_dump('function editar:',$_POST);
		
		// Convierto el string de la fecha a timestamp
		$dtime = DateTime::createFromFormat("Y-m-d", $_POST['edit_fecha']);
		$timestamp = $dtime->getTimestamp();
		$reg = [$_POST['id'],$_POST['edit_concepto'],$timestamp,$_POST['edit_importe']];
		
		$registro = implode("~", $reg);
		$registro = $registro."\n";
		$this->loadArray();
		// Sustituyo la posición editada del array de registros
		$this->fileArray[(int)$_POST['id']] = $registro;
		$registros = "";
		foreach($this->fileArray as $row){
			$registros = $registros.$row;
		}
		// grabamos el texto de los registros al fichero
		file_put_contents($this->file, $registros);
		// Añado un salto de línea al fichero para el siguiente registro
		//file_put_contents($this->file,"\n",FILE_APPEND | LOCK_EX); 
		$this->splits = "";
		$this->html->cabeceraOrden($_POST['orden']);
		$this->ordenar($orden);
		$this->show($orden);
	}
}
?>