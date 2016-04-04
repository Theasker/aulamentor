<?php
class coleccion{
	private $films = array();
	
	public function __construct(){
		$this->films = array(
				array('El gran dictador','Charles Chaplin','Comedia',1940),
				array('En busca del arca perdida','Steven Spielberg','Aventuras',1981),
				array('Los pájaros','Alfred Hitchcock',	'Thriller',	1963),
				array('Pulp Fiction','Quentin Tarantino','Alternativo',1994),
				array('The Matrix','Andy y Larry Wachowski','Ciencia ficción',1999),
				array('2001:una odisea en el espacio','Stanley Kubrick','Ciencia ficción',1968),
				array('Lawrence de Arabia','David Lean','Histórica',1962)
			);
	}
	
	public function show_films(){
		$cont = count($this->films);
		echo "<table><tr>";
		echo "<th>Título</th><th>Director</th><th>Género</th><th>Año</th></tr>";
		for ($x = 0 ; $x < $cont ; $x++){
			echo "<tr>";
			echo "<td>",$this->films[$x][0],"</td>";
			echo "<td>",$this->films[$x][1],"</td>";
			echo "<td>",$this->films[$x][2],"</td>";
			echo "<td>",$this->films[$x][3],"</td>";
			echo "</tr>";
		}
		echo "</table>";
		echo '<p><span class="rojo">El nº de registros encontrados es: ',$cont,"</span></p>";
	}
	
	public function sortTitle(){
		// Función que compara el título de cada película para ordenarlo
		function cmp($a,$b){
			if ($a[0] == $b[0]) return 0;
			return ($a[0] < $b[0]) ? -1 : 1;
		}
		// Ordenamos con la función 'cmp'
		usort($this->films,'cmp');
		$this->show_films();
	}
	
	public function find($str){
		$cont = 0;
		echo "<table><tr>";
		echo "<th>Título</th><th>Director</th><th>Género</th><th>Año</th></tr>";
		foreach ($this->films as $key => $value){
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