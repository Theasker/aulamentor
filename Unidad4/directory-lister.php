<? 
// directorio de origen
$path = 'E:\utilidades\programacion\EasyPHP-5.3.8.0\www';

// Abrimos directorio
$iddir = @opendir($path) or die("Unable to open $path");

// Recorremos los fichero y directorios del path

while ($file = readdir($iddir)){
  if (is_dir($file))
    //echo "<a href=".$file.">(dir) ".$file.'</a><br/>';
	echo "$file</br>";
	//echo "<a href=".$file.">".'</a><br/>';
  else echo "<a href=\"$file\">$file</a><br />";
}
// Close
closedir($iddir);
?> 