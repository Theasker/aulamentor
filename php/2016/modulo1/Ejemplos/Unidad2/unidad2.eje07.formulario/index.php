<HTML>
<HEAD><TITLE>Ejemplo 7a - Unidad 2 - Curso Iniciación de PHP 5</TITLE></HEAD>
<BODY>
<CENTER>
<H1>Introduzca sus datos</H1>

<?php	
  echo "<FORM ACTION=$_SERVER[PHP_SELF] METHOD=POST>
		<input type='hidden' name='oculto' value='Dato oculto' />		
		<TABLE border=0 cellpadding=10><TR><TD>
		<input type='image' name='imagen' alt='imagen' src='colegio.png' /></TD><TD>
  		<TABLE border=0>";

  echo "<TR><TD align=right>Nombre: </TD>
  			<TD><INPUT NAME=nom VALUE=''></TD>
  		</TR>";
  echo "<TR><TD align=right>Apellidos: </TD>
  			<TD><INPUT NAME=apel VALUE=''></TD>
  		</TR>";
  echo "<TR><TD align=right>Repetidor: </TD>
  			<TD><input type='checkbox' name='repe'/></TD>
  		</TR>";
  echo "<TR><TD align=right>Sexo: </TD>
  			<TD>
			Hombre <input type='radio' name='Hombre' value='H'/>			
			Mujer <input type='radio' name='Mujer' value='M'/></TD>
  		</TR>";
	
  echo "<TR><TD align=right>Curso: </TD>
  			<TD>		
			<select name='curso'>
				<option>1D</option>
				<option selected='selected'>2A</option>
				<option>3B</option>
			</select></TD>
  		</TR>";
		
  echo "<TR><TD align=right>Notas: </TD>
  			<TD><TEXTAREA NAME=notas COLS=20 ROWS=5></TEXTAREA>
  			</TD>
  		</TR>
  	</TABLE></TD></TR></TABLE>";
  echo "<P><INPUT TYPE=submit name='boton' VALUE='Aceptar'><P><P>"; 
  
  if (isset($_REQUEST['boton'])) {
    echo "<BR>Contenido de la variable \$_REQUEST: <PRE>";
	print_r($_REQUEST);
	echo  "</PRE><BR><BR><INPUT type='button' value='Volver a la página anterior'onClick='history.back()'>";
  }  
  

?>
     
</FORM>
</CENTER>
</BODY>
</HTML>