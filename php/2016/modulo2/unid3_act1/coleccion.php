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
	
	function show_films(){
		$cont = count($this->films);
		echo $cont;
		
		echo '<pre>';
		var_dump($this->films);
		echo '</pre>';
	}
}
?>


		





