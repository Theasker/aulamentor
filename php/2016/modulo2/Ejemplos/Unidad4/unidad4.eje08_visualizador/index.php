<HTML>
<HEAD><TITLE>Ejemplo 8 - Unidad 4 - Curso Iniciación de PHP 5</TITLE>
	<STYLE  TYPE="text/css">
		<!--
		input
			{
			font-family : Arial, Helvetica;
			font-size : 14;
			color : #000033;
			font-weight : normal;
   			border-color : #999999;
   			border-width : 1;
   			background-color : #FFFFFF;
			}
		-->
	</style>

</HEAD>

<BODY bgcolor="#C0C0C0" link="blue" vlink="blue" alink="blue">
<TABLE border="0" align="center" cellspacing="3" cellpadding="3" width="600">
<TR>
	<TH colspan="2" width="100%" bgcolor="blue">
		&nbsp;<FONT size="6" color="white" face="arial, helvetica">Visualizador 
		de ficheros</FONT>&nbsp
	</TH>
	
</TR></TABLE><P>


<?php

$machacar="NO";  // Si el fichero existe, no se sobreescribe el que hay.
$directorio_inicial = "c:/";


//Función que calcula el literal del tamaño de un fichero
function display_size($file){
	$file_size = filesize($file);
	if($file_size >= 1073741824)
		$file_size = round($file_size / 1073741824 * 100) / 100 . "GB";
	else if($file_size >= 1048576)
		$file_size = round($file_size / 1048576 * 100) / 100 . "MB";
	else if($file_size >= 1024)
		$file_size = round($file_size / 1024 * 100) / 100 . "KB";
	else $file_size = $file_size . "b";
	return $file_size;
}

//Función que trocea el nombre del fichero para que quepa en la rejilla
function split_str($file, $longitud){
	if (strlen($file)<$longitud) return $file;
	else {
		$resultado = substr($file, 0, $longitud);
		$i=$longitud;
		while ($i<strlen($file)){
			$resultado .= "<BR>" . substr($file, $i, $i+$longitud);
			$i+=$longitud;
		}
		return $resultado;
	}
}


/********** función para listar directorio *****/
function displaydir($directorio)
	{
		
		echo "<TABLE BORDER=\"0\" cellspacing=\"1\" cellpadding=\"1\" 
				align=\"center\" width=\"600\">
			 <TR>
				<th bgcolor=\"blue\" align=left><FONT color=\"white\" face=\"arial, helvetica\">&nbsp;&nbsp;Carpeta actual
						</FONT></th>
			</TR><TR>
				<TD nobreak><FONT size =\"-1\" color=blue face=\"arial, helvetica\"><B>"
					.split_str(htmlspecialchars($directorio), 135) . "</B></FONT></TD>\n
			</TR></TABLE><P>";
		
		echo "<TABLE BORDER=\"0\" cellspacing=\"1\" cellpadding=\"1\" 
				align=\"center\" width=\"600\">
			 <TR>
				<th bgcolor=\"blue\"><FONT color=\"white\" face=\"arial, helvetica\">Tipo
						</FONT></th>
				<th bgcolor=\"blue\"><FONT color=\"white\" face=\"arial, helvetica\">Nombre
						</FONT></th>
				<th bgcolor=\"blue\"><FONT color=\"white\" face=\"arial, helvetica\">Tamaño
						</FONT></th>
				<th bgcolor=\"blue\"><FONT color=\"white\" face=\"arial, helvetica\">Modificado
						</FONT></th>
			</TR>";
	
		//Primero leemos los directorios
		chdir($directorio);
		$handle=opendir(".");
		while ($file = readdir($handle))
			{
			if(is_dir($directorio."/".$file)) $dirlist[] = $file;
			}
		closedir($handle);

		//Como los directorios van primero ordenamos la lista
		asort($dirlist);
		while (list ($key, $file) = each ($dirlist))
		{
			if (!($file == "."))
			{
				$filename=$directorio.$file;
				$fileurl=rawurlencode($directorio.$file."/");
				$lastchanged = filectime($filename);
				$changeddate = date("d-m-Y H:i:s", $lastchanged);
				echo "<TR>";

				if($file == "..")
				{
					$downdir = dirname($directorio)."/";
					echo "<TD align=\"center\" nobreak>
							<A HREF=\"index.php?action=chdr&file=$downdir\">
							<img src=\"images/parent.gif\" alt=\"Arriba\" border=\"0\" width=\"20\" 
							height=\"16\"></A></TD>\n";
					echo "<TD></TD>\n";
					echo "<TD align=\"right\" nobreak><FONT size =\"-1\" face=\"arial, helvetica\">" . 
							display_size($filename)."</FONT></TD>";
					echo "<TD align=\"right\" nobreak><FONT size =\"-1\" face=\"arial, helvetica\">" . 
							$changeddate . "</FONT></TD>";
				}
				else
				{
					$lastchanged = filectime($filename);
					echo "<TD align=\"center\" nobreak>
							<A HREF=\"index.php?action=chdr&file=$fileurl\">
							<img src=\"images/folder.gif\" alt=\"Cambiar al directorio $file\" 
							border=\"0\" width=\"15\" height=\"13\"></A></TD>\n";
					echo "<TD nobreak><FONT size =\"-1\" face=\"arial, helvetica\">
							<A HREF=\"index.php?action=chdr&file=$fileurl\">" 
							. split_str(htmlspecialchars($file), 35) . "</A></FONT></TD>\n";
					echo "<TD align=\"right\" nobreak><FONT size =\"-1\" face=\"arial, helvetica\">" . 
							display_size($filename) . "</FONT></TD>";
					echo "<TD align=\"right\" nobreak><FONT size =\"-1\" face=\"arial, helvetica\">" . 
							$changeddate . "</FONT></TD>";
				}
			}//end file!="."
		}//end while
		
		//Ahora mostramos todos los ficheros
		$handle=opendir(".");
		while ($file = readdir($handle))
		{
			if(is_file($directorio."/".$file)) $filelist[] = $file;
		}
		closedir($handle);

		if (isset($filelist))
		{
			asort($filelist);
			while (list ($key, $file) = each ($filelist))
			{
				//buscamos la extensión
				$ext = strrchr ( $file , "." );

				if((!strcasecmp ($ext, ".gif")) || (!strcasecmp ($ext, ".jpg")) || 
				   (!strcasecmp ($ext, ".png")) || (!strcasecmp ($ext, ".bmp")) || 
				   (!strcasecmp ($ext, ".jpeg")))
				{
					$icon = "images/image.gif"; //Imagen 
					$hint_fichero ="Fichero imagen";
				}
				else if(!strcasecmp ($ext, ".txt")) 
				{
					$icon = "images/text.gif"; //Fichero de texto
					$hint_fichero ="Fichero de texto";
				}
				else if((!strcasecmp ($ext, ".wav")) || (!strcasecmp ($ext, ".mp2")) || 
				        (!strcasecmp ($ext, ".mp3")) || (!strcasecmp ($ext, ".mp4")) || 
				        (!strcasecmp ($ext, ".vqf")) || (!strcasecmp ($ext, ".midi")) || 
				        (!strcasecmp ($ext, ".mid")))
				{
					$icon = "images/audio.gif"; //Fichero de audio
					$hint_fichero ="Fichero audio";
				}
				else if((!strcasecmp ($ext, ".phps")) || (!strcasecmp ($ext, ".php")) || 
					  (!strcasecmp ($ext, ".php2")) || (!strcasecmp ($ext, ".php3")) || 
					  (!strcasecmp ($ext, ".php4")) || (!strcasecmp ($ext, ".phtml")) || 
					  (!strcasecmp ($ext, ".asp")) || (!strcasecmp ($ext, ".asa")) || 
					  (!strcasecmp ($ext, ".cgi")) || (!strcasecmp ($ext, ".shtml")) || 
					  (!strcasecmp ($ext, ".pl")))
				{
					$icon = "images/webscript.gif"; //Webscript
					$hint_fichero ="Fichero webscript";
				}
				else if ((!strcasecmp ($ext, ".html")) || (!strcasecmp ($ext, ".htm")))
				{
					$icon = "images/webpage.gif"; //Página web
					$hint_fichero ="Fichero HTML";
				}
				else if (!strcasecmp ($ext, ".doc"))
				{
					$icon = "images/word.gif"; //Word
					$hint_fichero ="Fichero Word";
				}
				else if (!strcasecmp ($ext, ".exe"))
				{
					$icon = "images/ejecutable.gif"; //Word
					$hint_fichero ="Fichero Ejecutable";
				}
				else if((!strcasecmp ($ext, ".zip")) || (!strcasecmp ($ext, ".tar")) || 
					   (!strcasecmp ($ext, ".rar")) || (!strcasecmp ($ext, ".gz")))
				{
					$icon = "images/text.gif"; //archivo comprimido
					$hint_fichero ="Fichero comprimido";
				}
				else //Desconocido
				{
					$icon = "images/text.gif";
					$hint_fichero ="";
				}
			
				$filename=$directorio.$file;
				$fileurl=rawurlencode($directorio.$file);
				$lastchanged = filectime($filename);
				if ($lastchanged>0)
					$changeddate = date("d-m-Y H:m:s", $lastchanged);
				echo "<TR>";
				echo "<TD align=\"center\" nobreak>
					<IMG SRC=\"$icon\" alt=\"$hint_fichero\" border=\"0\" width=\"15\" height=\"15\">
					</TD>\n";
				
				echo "<TD nobreak><FONT size =\"-1\" face=\"arial, helvetica\">" . 
						split_str(htmlspecialchars($file), 35) . "</FONT></TD>\n";
				echo "<TD align=\"right\" nobreak><FONT size =\"-1\" face=\"arial, helvetica\">" . 
						display_size($filename) . "</FONT></TD>";
				echo "<TD align=\"right\" nobreak><FONT size =\"-1\" face=\"arial, helvetica\">" . 
						$changeddate . "</FONT></TD><TD align=\"right\">";
			}//while
		}//if $filelist
	
		
		echo "</TD></TR>\n";
		echo "</TABLE>";
		
		
		//Botones de otras funciones
		echo "<CENTER><TABLE border=\"0\" width=\"75%\">";
		echo "<TR><TD colspan=\"2\"><HR></TD></TR>";

		//Subir fichero
		echo "<TR><TD valign=top align=right>
				<FONT size =\"-1\" face=\"arial, helvetica\">Subir fichero</FONT></TD>";
		echo "<TD><FORM ENCTYPE=\"multipart/form-data\" 
				METHOD=\"POST\" ACTION=\"index.php\">";
		echo "<INPUT TYPE=\"HIDDEN\" NAME=\"directorio\" VALUE=\"$directorio\">";
		echo "<INPUT NAME=\"userfile\" TYPE=\"file\" size=\"40\">&nbsp;";
		echo "<INPUT TYPE=\"SUBMIT\" NAME=\"upload\" VALUE=\"¡Subir!\">
				</FORM></TD></TR>";
		
		//Crear Directorio
		echo "<FORM METHOD=\"POST\" ACTION=\"index.php\">";	
		echo "<TR><TD valign=top align=right><FONT size =\"-1\" face=\"arial, helvetica\">
				Crear directorio</FONT></TD><TD>";
		echo "<INPUT TYPE=\"TEXT\" NAME=\"mkdirfile\" size=\"40\">";
		echo "<INPUT TYPE=\"HIDDEN\" NAME=\"action\" VALUE=\"mkdir\">";
		echo "<INPUT TYPE=\"HIDDEN\" NAME=\"directorio\" VALUE=\"$directorio\">";
		echo "<INPUT TYPE=\"SUBMIT\" NAME=\"mkdir\"  VALUE=\"¡Crear!\">
				</FORM></TD></TR>";
		echo "<TR><TD colspan=\"2\"><HR></TD></TR>";
		echo "</TABLE></CENTER>";
		
	}

if (isset($_POST["upload"]))
	{
	//Solo subimos el fichero si existe
	if ($_FILES['userfile']['size']>0) {
		//comprobamos que no existe ya el fichero en  el directorio
		chdir($_POST["directorio"]);
		$handle=opendir(".");
		while ($file = readdir($handle))
		{
			if(is_file($file)) $ficheros_directorio[] = $file;
		}
		closedir($handle);
		if (isset($ficheros_directorio) && in_array($_FILES['userfile']['name'], $ficheros_directorio) 
					&& $machacar=="NO")
    			echo "<CENTER><FONT color=red>ERROR: ¡El fichero ya existe en servidor 
    					y no se puede sobreescribir!</CENTER></FONT><P>";
		else
		{
			copy($_FILES['userfile']['tmp_name'],$_POST["directorio"].$_FILES['userfile']['name']); 
			echo "<CENTER><FONT color=blue>MENSAJE: El fichero '".$_FILES['userfile']['name']."' se subió 
					correctamente a la carpeta '".$_POST["directorio"]."' </CENTER></FONT><P>";
		}
	}
	else 
		echo "<CENTER><FONT color=red>ERROR: ¡El fichero NO existe!
				</CENTER></FONT><P>";
	
	displaydir($_POST["directorio"]);
} 
else
if (isset($_REQUEST["action"]))
switch ($_REQUEST["action"])
{
	case "": 
		displaydir($directorio_inicial);
		break;
	case "chdr":
		if(file_exists($_GET["file"]))
			displaydir($_GET["file"]);
		else {
			echo "<CENTER><FONT color=red>ERROR: ¡El directorio '".$_GET["file"]."' NO 
					existe!</CENTER></FONT><P>";
			displaydir($directorio_inicial);
		}
		break;
	case "mkdir":
		//sólo creamos el direcotio si no existe 		
		if(!file_exists($_POST["directorio"].$_POST["mkdirfile"]))
			mkdir($_POST["directorio"].$_POST["mkdirfile"], 0);
		else echo "<CENTER><FONT color=red>¡¡¡Error. 
				Ya existe una carpeta o un fichero con el 
				nombre '".$_POST["mkdirfile"]."' en la carpeta actual!!!
				</CENTER></FONT><P>";
		displaydir($_POST["directorio"]);
		break;
		
}//END switch
else displaydir($directorio_inicial);

?>

</BODY>
</HTML>