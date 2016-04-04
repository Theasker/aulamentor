<?php
	ini_set('default_charset', 'utf-8');
	require ("agenda.php");
	// Creamos la BD 
	$mi_agenda=new agenda();		
	header("Location: http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]."index_agenda.php"); 
	exit;
?>