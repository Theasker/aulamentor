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
  
   echo "Selecciona tu edad: <select name='edad'>";
  /* Definimos una matriz con las opciones del menú  */
  $matriz_opciones = array(1=>"Menor de 4 años",
							2=>"Entre 4 y 10 años",
							3=>"Entre 10 y 14 años",
							4=>"Entre 14 y 21 años",
							5=>"Entre 21 y 55 años",
							6=>"Entre 55 y 70 años",
							7=>"Mayor de 70 años");
							
	for ($i=1; $i<=sizeof($matriz_opciones); $i++) {						
	 echo "<option value=$i";
	 // Así guardamos el último elemento seleccionado por el usuario.
	 // Comprobamos que la variable $edad es la opción seleccionada.
	 if ($edad==$i) echo " SELECTED";
	 echo ">$matriz_opciones[$i]</option>";
	}
	echo "</select>";
  
  /*
  La sentencias anteriores equivalen a escribir esto:
  
  echo "Selecciona tu edad: <select name='edad'>
		<option value=1>Menor de 4 años</option>
		<option value=2>Entre 4 y 10 años</option>
		<option value=3>Entre 10 y 14 años</option>
    	<option value=4>Entre 14 y 21 años</option>
    	<option value=5>Entre 21 y 55 años</option>
    	<option value=6>Entre 55 y 70 años</option>
    	<option value=7>Mayor de 70 años</option>
	</select>"; 
 */
    
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
          
    switch ($edad) {
    	case 1:
    		echo "<P>Infancia";
    		break;
    	case 2:
    		echo "<P>Niñez";
    		break;
    	case 3:
    		echo "<P>Pubertad";
    		break;
    	case 4:
    		echo "<P>Adolescencia";
    		break;
    	case 5:
    		echo "<P>Adultez";
    		break;
    	case 6:
    		echo "<P>Vejez";
    		break;
    	case 7:
    		echo "<P>Ancianidad";
    		break;   
    	default: 
    		echo "Error al introducir la edad.";
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
