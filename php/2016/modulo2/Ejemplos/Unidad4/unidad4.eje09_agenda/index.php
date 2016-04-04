<?php
	if (file_exists("agenda.txt")) unlink("agenda.txt");
	copy ("agenda_original.txt", "agenda.txt");
	header("Location: http://".$_SERVER["HTTP_HOST"].str_replace("index.php", "index_agenda.php", $_SERVER['PHP_SELF']));       
	exit;
?>