<? 
// directorio de origen
$path = 'H:\programacion\xampp\htdocs\varios\curso\Ejercicios\Unidad4';

// Abrimos directorio
$iddir = @opendir($path) or die("Unable to open $path");

// Recorremos los fichero y directorios del path


echo $temp;
while ($file = readdir($iddir)){
  if (is_dir($file))
    echo "<a href=".$file.">(dir) ".$file.'</a><br/>';
  else echo "<a href=\"$file\">$file</a><br />";
}
// Close
closedir($iddir);
?> 