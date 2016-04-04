<?php
$resultados2 = array(
	array('El gran dictador','Charles Chaplin','Comedia',1940),
	array('En busca del arca perdida','Steven Spielberg','Aventuras',1981),
	array('Los pájaros','Alfred Hitchcock',	'Thriller',	1963),
	array('Pulp Fiction','Quentin Tarantino','Alternativo',1994),
	array('The Matrix','Andy y Larry Wachowski','Ciencia ficción',1999),
	array('2001:una odisea en el espacio','Stanley Kubrick','Ciencia ficción',1968),
	array('Lawrence de Arabia','David Lean','Histórica',1962)
);

function cmp($a, $b){
  if ($a[0] == $b[0]) {
      return 0;
  }
  return ($a[0] < $b[0]) ? -1 : 1;
}

$a = array(
	array('f','f'),
	array('b','b'),
	array('c','c'));
	
usort($a, "cmp");
usort($resultados2, "cmp");

foreach ($resultados2 as $clave => $valor) {
  echo $valor[0],": ",$valor[1],"<br>";
}
?>