<?php
function OrdenarArray ($ArrayDesordenado, $campo){  
  $claves = array();
  $ArrayOrdenado = array();
  //Guardamos en el array $claves los indices y el campo que queremos ordenar
  foreach ($ArrayDesordenado as $clave => $fila){
    $claves[$clave] = $fila[$campo];
  }
  //Ordenamos el array por el contenido, que es el campo que hemos elegido.
  asort($claves);
  //recorremos el array de claves ya ordenado y vamos rellenando un nuevo array
  //con los campos completos con el nuevo orden
  foreach ($claves as $clave => $fila){
    $ArrayOrdenado[] = $ArrayDesordenado[$clave];
  }  
  return $ArrayOrdenado;
}
$colores=array(
    array("nombre"=>"Gelocatil","cantidad"=>25,"precio"=>1.95),
    array("nombre"=>"Aspirina","cantidad"=>100,"precio"=>1.99),
    array("nombre"=>"Jarabe para la tos","cantidad"=>50,"precio"=>2.95),
    array("nombre"=>"Mercromina","cantidad"=>150,"precio"=>1.35));
    var_dump(OrdenarArray($colores, "cantidad"));
?>
