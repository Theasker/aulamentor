<?php
class vardump{
	
	static function ver($out){
		echo '<pre>';
		print_r($out);
		echo '</pre>';
	}
	
	static function ver2($out){
		echo '<pre>';
		var_dump($out);
		echo '</pre>';
	}
	
}

?>