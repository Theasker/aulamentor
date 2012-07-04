<?php
require 'uni7_monedero_htmls.php';
require ("uni7_monedero_class.php");
titulo();
$mi_monedero=new monedero();
$mi_monedero->mostrar();
if (isset($_REQUEST['añadir'])){
  $mi_monedero->agregar();
}
var_dump($_REQUEST);
?>
