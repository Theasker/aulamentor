<?php
$path = 'E:\Documents and Settings\u3440003.ALBIA.000\Escritorio\temp';

chdir($path);

$exif = exif_read_data('IMG_20120716_192455.jpg');
$fecha = $exif['DateTime'];


$fecha = getdate($exif['FileDateTime']);
var_dump($fecha);
echo $fecha['year'].'-'.$fecha['mon'].'-'.$fecha['mday'].' '
        .$fecha['hours'].':'.$fecha['minutes'].':'.$fecha['seconds'];
?>