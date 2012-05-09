<html>
<head>
   <meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
</head>
<body>
<?
$directorio = 'H:\programacion\xampp\htdocs\varios\curso\Ejercicios\Unidad4';
chdir($directorio);
echo "<FORM ENCTYPE=multipart/form-data METHOD=post ACTION=uni4_subirfichero.php>
      Fichero:
      <INPUT TYPE=File NAME=fichero SIZE=25>
      <INPUT TYPE=submit NAME=submit VALUE=Subir></FORM>";

var_dump($_FILES);
$fichero_destino="$directorio"."\\".$_FILES['fichero']['name'];
move_uploaded_file($_FILES['fichero']['tmp_name'], $fichero_destino);
//Eliminamos el archivo temporal
if (file_exists($_FILES['fichero']['tmp_name']))
unlink($_FILES['fichero']['tmp_name']);
?>
</body>
</html>