<?php
$a = "ABCDEFG";
$b = "HIJ";
echo operacion($a,$b); 
function operacion($x,$y) {
	echo strlen($x);
	echo strlen($y);
	$n = strlen($x)-strlen($y); 
	return $n;
}
?>