<?php
function eratosthenes($n)
{
	$all=array();
	$prime=1;
	echo 1," ",2;
	$i=3;
	while($i<=$n){
		if(!in_array($i,$all)){
			echo " ",$i;
			$prime+=1;
			$j=$i;
			while($j<=($n/$i)){
				array_push($all,$i*$j);
				$j+=1;
			}
		}
		$i+=2;
	}
	echo "\n";
	return;
}

eratosthenes(10);
?>