<HTML>
<HEAD><TITLE>Ejemplo 8 - Unidad 2 - Curso Iniciación de PHP 5</TITLE></HEAD>
<BODY bgcolor="#6666CC">
<CENTER>
	<B>
    <FONT face="Times New Roman" size="6" color="#CCCCCC">
    	Etapas de la vida humana
    <P><FONT size="5" color="#FFFFFF">
    	Comprueba en qué etapa de la vida te encuentras</FONT></P>    
    </B>

<FORM ACTION=<?php echo $_SERVER['PHP_SELF'];?> METHOD=POST>

<?php	
  // inicializamos las variable $edad 
  // o leemos lo que ha escrito el usuario
  if (!isset($_POST["edad"])) $edad=""; 
  else $edad=$_POST["edad"];  
  
  echo "Escribe aquí tu edad: 
    <INPUT NAME=edad VALUE='$edad' size='2' maxlength='2'>";
    
  echo "<P><INPUT TYPE=submit VALUE=\"Ver mi etapa\">";

    /* En las dos instrucciones anteriores se presenta un formulario 
    	en el que se pregunta la edad de la persona que quiere matricularse 
    	en el centro.*/

  if (!empty($edad) )   // Si la variable $edad no está vacía...
  {
    echo "<P><H2><CENTER><FONT color=white>
    			Tu etapa de la vidad es
    		</FONT></CENTER></H2><P>
    		<TABLE border=1 align=center width=600 cellspacing=0 
    						cellpadding=10>
    		<TR><TD align=center><FONT color=white size=+4>";
          // Se muestra una celda con las caracteríticas especificadas.
    if ($edad<0) {
    	echo "Error al introducir la edad.";
    } 
    elseif ($edad<4)  // Si la edad se encuentra entre 0-5, se
    			   // muestra la información siguiente.
    {
	   echo "<P>Infancia";	   
    }
    elseif ($edad<10) // Si la edad es 6, 7, 8, 9 ó 10.
    {
	   echo "<P>Niñez";
    }
    elseif ($edad<14) // Si la edad es 11, 12... ó 14.
    {
	   echo "<P>Pubertad";
    }
    elseif ($edad<21) // Si la edad es 14, 15... ó 21.
    {
	   echo "<P>Adolescencia";
    }
    elseif ($edad<55) // Si la edad es 21, 22,... ó 55.
    {
	   echo "<P>Adultez";
    }
    elseif ($edad<70) // Si la edad es 55, 56... ó 70.
    {
	   echo "<P>Vejez";
    }
	elseif (($edad>70)) // Si la edad es > 70.
    {
	   echo "<P>Ancianidad";
    }    
    echo "</FONT></TR></TD></TABLE>";
  }

 /* Observa que en este script se entremezclan código HTML y código 
 	PHP usando los separadores necesarios en cada caso. En las trece
 	primeras líneas se usa código HTML. Desde la línea 14 hasta la 73
 	aparece el código PHP donde se muestra la información correspondiente 
	a cada edad usando una estructura condidional compleja. Recuerda que, si lo
 	precisas, puedes repasar en el Apéndice 2 las órdenes de código HTML
 	que no entiendas.*/
 
?>
     
</FORM>
</CENTER>
</BODY>
</HTML>
