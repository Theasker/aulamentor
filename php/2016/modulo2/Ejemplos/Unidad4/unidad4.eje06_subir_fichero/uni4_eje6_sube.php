<?php

include "uni4_eje6_configura.php";
$fragmento_fichero=explode("/", $_FILES['fichero']['type']);
echo "<CENTER><H2>Proceso de subir un fichero al servidor</H2>
		</CENTER><P>";
echo "Fichero temporal en el servidor: <B>".$_FILES['fichero']['tmp_name']."</B><P>";
echo "Tipo del fichero <B>".$_FILES['fichero']['type']."</B><P>";
echo "Nombre del fichero <B>".$_FILES['fichero']['name']."</B><P>";
echo "Tamaño del fichero <B>".$_FILES['fichero']['size']."</B><P>";

chdir($directorio);
echo "Directorio donde se copiará el fichero <B>$directorio</B><P>";
echo "<B>Este directorio contiene los ficheros siguientes:</B><P>";
$puntero=opendir('.');
$i=0;
while ($fiche = readdir($puntero))
{
   if ($fiche != "." && $fiche != ".." && !is_dir($fiche))
   {
       $ficheros_directorio[]=$fiche;
       echo $ficheros_directorio[$i]."<P>";
       $i++;
   }
}

// Si el fichero está repetido, no se sobrescribe, sino que se
// muestra un mensaje.
if ($ficheros_directorio && in_array($_FILES['fichero']['name'], $ficheros_directorio)
		 && $machacar=="NO")
{
    echo "$fr_repetido";
}
else
{
     echo "<B>El fichero seleccionado no está en el servidor y se subirá 
     			si es posible</B>.<P>";

     if ($_FILES['fichero']['size']>51200 or $_FILES['fichero']['size']<1)
       // Si el tamaño del fichero es mayor de 50 Kb o está vacío,
       // se muestra un mensaje y se abandona el script.
     {
        die ("<B>El fichero ocupa más de 51.200 bytes o no ha indicado
             su nombre en el formulario. No puede copiarse.</B>");
     }
     
     /* A partir de aquí se controla si el fichero no está vacío (empty()),
        si no ha sido ya pasado del fichero temporal al directorio indicado
        (is_uploaded_file) y si es uno de los tipos de ficheros que se
        pueden subir al servidor. Si no es ninguno de los indicados en
        los primeros if, entra simpre por $subir_cualquiera="SI".   */

     if (is_uploaded_file($_FILES['fichero']['tmp_name']) 
         && !empty($_FILES['fichero']['tmp_name']))
        // La función is_uploaded_file() devuelve True si es el fichero
        // es un fichero temporal pendiente de pasar.
     {
     	  $fichero_destino="$directorio".$_FILES['fichero']['name'];
          if ($subir_cualquiera=="FILTRAR" 
              && $fichero_type=="$tipo_fichero")
          {               
               move_uploaded_file($_FILES['fichero']['tmp_name'], $fichero_destino);
               echo "<B>$fr_aceptacion</B><P>";
          }
          else if ($subir_cualquiera=="AUDIO" 
                          && $fragmento_fichero[0]=="audio")
          {              
               move_uploaded_file($_FILES['fichero']['tmp_name'], $fichero_destino);
               echo "<B>$fr_aceptacion</B><P>";
          }
          else if ($subir_cualquiera=="IMAGEN" && $fragmento_fichero[0]=="image")
          {               
               move_uploaded_file($_FILES['fichero']['tmp_name'], $fichero_destino);
               echo "<B>$fr_aceptacion</B><P>";
          }
          else if ($subir_cualquiera=="SI")
          {
               move_uploaded_file($_FILES['fichero']['tmp_name'], $fichero_destino);
               echo "<B>$fr_aceptacion</B><P>";
          }
          else
          {
                echo "<B>$fr_noaceptacion</B><P>";
          }
     }
     else
     {
         echo "<B>$fr_noaceptacion</B><P>";
     }
}
if (file_exists($_FILES['fichero']['tmp_name'])) unlink($_FILES['fichero']['tmp_name']);
echo "<CENTER><H3>Finalmente, borramos el fichero temporal.
		</H3></CENTER><P>";

?>
