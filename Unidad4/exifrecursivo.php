<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <style type="text/css">
        body{font-family: Arial,Helvetica,sans-serif; font-size: 10px;}
    </style>
  </head>
  <body>
<?php
$path = 'E:/Documents and Settings/u3440003.ALBIA.000/Escritorio/tmp';

chdir($path);
listar_directorios_ruta($path."/");

function listar_directorios_ruta($ruta){ 
  // abrir un directorio y listarlo recursivo 
  if (is_dir($ruta)) { 
    if ($dh = opendir($ruta)) { 
      while (($file = readdir($dh)) !== false) { 
        //esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio 
        //mostraría tanto archivos como directorios 
        //echo "<br>Nombre de archivo: $file : Es un: " . filetype($ruta . $file); 
        if (is_dir($ruta."\\".$file) && $file!="." && $file!=".."){ 
          //solo si el archivo es un directorio, distinto que "." y ".." 
          echo "<br>$ruta$file <b>(".filetype($ruta.$file).")</b>";
          listar_directorios_ruta($ruta . $file ."/"); 
        }elseif($file!="." && $file!=".."){
          //entra cuando es un fichero
          renombrar($ruta,$file);
        }
      } 
    closedir($dh); 
    } 
  }else 
    echo "<br>No es ruta valida"; 
}
function renombrar($rutafichero,$fichero){
  $infofile = pathinfo($rutafichero.$fichero);
  switch ($infofile['extension']) {
    case 'jpg':
      // cargamos en el array $exif los datos de la foto
      $exif = exif_read_data($rutafichero.$fichero);
      // guardamos en el array $fecha los datos de la fecha de la foto
      $fecha = getdate($exif['FileDateTime']);
      // confeccionamos el nombre del archivo que queremos para esa foto
      // para converitor los enteros en 2 digitos sprintf("%02d",$number)
      $nombre = $fecha['year']
              .'-'.sprintf("%02d",$fecha['mon'])
              .'-'.sprintf("%02d",$fecha['mday'])
              .' '.sprintf("%02d",$fecha['hours'])
              .'.'.sprintf("%02d",$fecha['minutes'])
              .'.'.sprintf("%02d",$fecha['seconds'])
              .".".$infofile['extension'];
      rename($rutafichero.$fichero,$rutafichero.$nombre);
      echo "<br>$rutafichero$fichero -> $nombre";
      break;
    case 'mp4':
      // guardamos en el array $fecha los datos de la fecha de la foto
      // que obtenemos con filemtime($fichero)
      $fecha = getdate(filemtime($rutafichero.$fichero));
      // confeccionamos el nombre del archivo que queremos para esa foto
      // para converitor los enteros en 2 digitos sprintf("%02d",$number)
      $nombre = $fecha['year']
              .'-'.sprintf("%02d",$fecha['mon'])
              .'-'.sprintf("%02d",$fecha['mday'])
              .' '.sprintf("%02d",$fecha['hours'])
              .'.'.sprintf("%02d",$fecha['minutes'])
              .'.'.sprintf("%02d",$fecha['seconds'])
              .".".$infofile['extension'];
      rename($rutafichero.$fichero,$rutafichero.$nombre);
      echo "<br>$rutafichero$fichero -> $nombre";
      break;
  }
}
?>
  </body>
</html>