<HTML>
	<HEAD><TITLE>Ejemplo11a - Unidad 2 - Curso Iniciación de PHP 5</TITLE></HEAD>
	<BODY bgcolor="#66CCFF"><CENTER>
	<HR>
  <H1><FONT color="blue">Boletín de notas</FONT></H1>
  <HR>

	<P><FONT face="Georgia, Times New Roman, Times, serif" size="3">Introduzca 
           las notas obtenidas por el alumno:</FONT></P>
        <FORM ACTION="resultado.php?" METHOD="POST">
	<TABLE BORDER=2>
      <TR> 
        <TD width=100 align="CENTER"><B><FONT color="blue"> Asignatura </FONT></B></TD>
        <TD width=100 align="CENTER"><B><FONT color="blue"> Trimestre 1 </FONT></B></TD>
        <TD width=100 align="CENTER"><B><FONT color="blue"> Trimestre 2 </FONT></B></TD>
        <TD width=100 align="CENTER"><B><FONT color="blue"> Trimestre 3 </FONT></B></TD>
      </TR>
      <BR>
      <P> 
      <TR> 
      
        <?php require("literales.php"); ?>
        
        <TD align=middle> <?php echo asignatura1; ?> </TD>
        <TD align=right> 
          <input type="text" name="asig1_1" size="10" maxlength="2">
        </TD>
        <TD align=right> 
          <input type="text" name="asig1_2" size="10" maxlength="2">
        </TD>
        <TD align=right>
          <input type="text" name="asig1_3" size="10" maxlength="2">
        </TD>
      </TR>
      <TR> 
        <TD align=middle> <?php echo asignatura2; ?> </TD>
        <TD align=right>
          <input type="text" name="asig2_1" size="10" maxlength="2">
        </TD>
        <TD align=right>
          <input type="text" name="asig2_2" size="10" maxlength="2">
        </TD>
        <TD align=right>
          <input type="text" name="asig2_3" size="10" maxlength="2">
        </TD>
      </TR>
      <TR> 
        <TD align=middle> <?php echo asignatura3; ?> </TD>
        <TD align=right>
          <input type="text" name="asig3_1" size="10" maxlength="2">
        </TD>
        <TD align=right>
          <input type="text" name="asig3_2" size="10" maxlength="2">
        </TD>
        <TD align=right>
          <input type="text" name="asig3_3" size="10" maxlength="2">
        </TD>
      </TR>
      <TR> 
        <TD align=middle> <?php echo asignatura4; ?> </TD>
        <TD align=right>
          <input type="text" name="asig4_1" size="10" maxlength="2">
        </TD>
        <TD align=right>
          <input type="text" name="asig4_2" size="10" maxlength="2">
        </TD>
        <TD align=right>
          <input type="text" name="asig4_3" size="10" maxlength="2">
        </TD>
      </TR>
      <TR> 
        <TD align=middle> <?php echo asignatura5; ?> </TD>
        <TD align=right>
          <input type="text" name="asig5_1" size="10" maxlength="2">
        </TD>
        <TD align=right>
          <input type="text" name="asig5_2" size="10" maxlength="2">
        </TD>
        <TD align=right>
          <input type="text" name="asig5_3" size="10" maxlength="2">
        </TD>
      </TR>
    </TABLE>
    Atención: los datos no numéricos serán calculados como 0.<BR>
    Las casillas en blanco se consideran un error.
    <P> 
      <INPUT TYPE="submit" VALUE="Calcular resultado">
      <INPUT TYPE="reset" VALUE="Borrar datos">
    </FORM>
</CENTER>
</BODY></HTML>
