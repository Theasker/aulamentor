<HTML>
<HEAD><TITLE>Ejemplo 9 - Unidad 4 - Curso Iniciación de PHP 5</TITLE>
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

<BODY bgcolor="#C0C0C0" link="teal" vlink="teal" alink="teal">
<TABLE border="0" align="center" cellspacing="3" cellpadding="3" width="600">
<TR>
	<TH colspan="2" width="100%" bgcolor="teal">
		&nbsp;<FONT size="6" color="white" face="arial, helvetica">Agenda de 
		Contactos</FONT>&nbsp
	</TH>
	
</TR></TABLE><P>

<?php
	require ("agenda.php");	
	
	$mi_agenda=new agenda();
	
	
	if (isset($_REQUEST["operacion"])){
		if ($_REQUEST["operacion"]=="buscar") {
			if (($_POST["buscar_edit"]) == "") echo "<CENTER>No se ha introducido ningúna cadena</CENTER><P>";
			else {
				echo "<CENTER>Los contactos que contienen '".$_POST["buscar_edit"]."' son: </CENTER><P>";
				listado_contactos($mi_agenda->buscar($_POST["buscar_edit"]), -1);
			}
		} else
		if ($_REQUEST["operacion"]=="editar") {
			listado_contactos($mi_agenda->leer_contactos(), $_REQUEST["nume"]);
		} 
		else {
			if ($_REQUEST["operacion"]=="alta") {
				if ($_POST["nombre"]=="") echo "<CENTER>No se ha introducido ningún nombre</CENTER><P>";
				else
				{
					$mi_agenda->alta_contacto ($_POST["nombre"], $_POST["apellidos"], $_POST["telefono"]);
					echo "<CENTER>Se ha dado de alta correctamente el contacto: ".$_POST["nombre"]." ".$_POST["apellidos"]."</CENTER><P>";
				}
			} else
			if ($_REQUEST["operacion"]=="modificar") {
				if ($_POST["nombre"]=="") echo "<CENTER>No se ha introducido ningún nombre</CENTER><P>";
				else
				{
					$mi_agenda->modificar_contacto ($_POST["el_nume"], $_POST["nombre"], $_POST["apellidos"], $_POST["telefono"]);
					echo "<CENTER>Se ha dado modificado correctamente el contacto: 
						".$_POST["nombre"]." ".$_POST["apellidos"]."</CENTER><P>";
				}
			} else
			if ($_REQUEST["operacion"]=="borrar") {
				$mi_agenda->borrar_contacto($_REQUEST["nume"]);
				echo "<CENTER>Se ha borrado correctamente el contacto.</CENTER><P>";
			}
			listado_contactos($mi_agenda->leer_contactos(), -1);
		}
	} else {
		listado_contactos($mi_agenda->leer_contactos(), -1);
	}

	echo "<CENTER><P><TABLE border=0 width=600>";
	echo "<TR><TD colspan=\"2\"><HR></TD></TR>";	
	echo "<TR><TD valign=top align=right>
			<FORM METHOD=\"POST\" ACTION=\"index_agenda.php?operacion=buscar\">
			<FONT size =\"-1\" face=\"arial, helvetica\">
			Buscar contacto</FONT></TD><TD>";
	echo "<INPUT TYPE=\"TEXT\" NAME=\"buscar_edit\" size=\"20\"> ";
	echo "<INPUT TYPE=\"SUBMIT\" NAME=\"buscar\"  VALUE=\"¡Buscar!\">
				</FORM></TD></TR>";
				
	echo "<TR><TD colspan=\"2\"><HR></TD></TR>";
	echo "</TABLE></CENTER>";
	echo "<TABLE BORDER=\"0\" cellspacing=\"1\" cellpadding=\"1\" 
			align=\"center\" width=\"600\">
			<TR><TD><FONT size =\"-1\" face=\"arial, helvetica\">
			El nº total de contactos es: ".
			$mi_agenda->numero_contactos."</LEFT></FONT><P></TD><TD valign=top align=right>".
				boton_ficticio("Ver listado completo","index_agenda.php?operacion=listado")."
				</TD></TR></TABLE>";
	
?>

</BODY>
</HTML>

