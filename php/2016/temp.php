<?php
	$path_with_query="http://www.ex.com/getdat.php?dep=n/a&title=boss";
	$path=explode("?",$path_with_query);
	$filename=basename($path[0]);
	echo $filename;
	$query=$path[1];
?>