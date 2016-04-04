<?php
class coleccion{
	private $medicine = array();
	
	public function __construct(){
		$this->medicine = array(
				array('Alcohol 70%','Antiséptico',	2.33,'Se usa para desinfectar termómetros clínicos, inzas, tijeras u otro instrumental. También se usa para la limpieza de la piel, antes de la inyección. No es aconsejable utilizarlo en una herida por que irrita los tejidos.'),
				array('Gasas',	'Materiales',14.99,'Controla hemorragias, limpia y cubre heridas o quemaduras.'),
				array('Avril','Medicamento',2.50,	'Tratamiento de quemaduras')
			);
	}
	
	public function show(){
		$cont = count($this->medicine);
		echo "<table><tr>";
		echo "<th>Nombre</th><th>Tipo</th><th>Precio</th><th>Prescripción</th></tr>";
		for ($x = 0 ; $x < $cont ; $x++){
			echo "<tr>";
			echo "<td>",$this->medicine[$x][0],"</td>";
			echo "<td>",$this->medicine[$x][1],"</td>";
			echo "<td>",$this->medicine[$x][2],"</td>";
			echo "<td>",$this->medicine[$x][3],"</td>";
			echo "</tr>";
		}
		echo "</table>";
		echo '<p><span class="rojo">El nº de registros encontrados es: ',$cont,"</span></p>";
	}
	
	public function sortName(){
		// Función que compara el título de cada película para ordenarlo
		function cmp($a,$b){
			if ($a[0] == $b[0]) return 0;
			return ($a[0] < $b[0]) ? -1 : 1;
		}
		// Ordenamos con la función 'cmp'
		usort($this->medicine,'cmp');
		$this->show();
	}
	
	public function find($str){
		$cont = 0;
		echo "<table><tr>";
		echo "<th>Título</th><th>Director</th><th>Género</th><th>Año</th></tr>";
		foreach ($this->medicine as $key => $value){
			$finded = 0; //Para controlar si hay coincidencia en el "registro"
			foreach ($value as $val){
				$val = $this->stripAccents($val); //quitamos los posibles acentos
				/*comprobamos que la cadena a buscar está en alguna de los campos
        pasando a mayúsculas la frase y la cadena a comparar
        Si encuentra alguna coincidencia en algún elemento del "registro" lo visualiza y sale
         */ 
        //echo $str,": ",$val,"-> ", substr_count(strtoupper($val),strtoupper($str)),"<br>";
        if  (substr_count(strtoupper($val),strtoupper($str))) {
        	$finded = 1;
        	$cont++;
        	break;
        }
			}
			if ($finded){
				echo "<tr>";
				echo "<td>",$value[0],"</td>";
				echo "<td>",$value[1],"</td>";
				echo "<td>",$value[2],"</td>";
				echo "<td>",$value[3],"</td>";
				echo "</tr>";
			}
		}
		echo "</table>";
		echo '<p><span class="rojo">El nº de registros encontrados es: ',$cont,"</span></p>";
	}
	
	// Función que quita los acentos de cualquier string
	function stripAccents($string){
		return strtr($string,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ',
	'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
	}
}
?>