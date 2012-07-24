<?php
$path = $_SERVER['DOCUMENT_ROOT'];

chdir($path);
$id_dir = @opendir($path) or die("no se ha podido abrir $path");

while (false !== ($archivo = readdir($id_dir))) {
      if(is_dir($archivo)) echo "$archivo</br>";
}

closedir($id_dir);
?>