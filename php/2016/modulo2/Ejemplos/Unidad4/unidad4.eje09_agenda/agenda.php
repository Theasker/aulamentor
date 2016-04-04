<?php
	
	// Método que crea los botones de cada opción de los registros utilizando una tabla HTML 
	function boton_ficticio($caption,$url)
	{
		return "<TABLE border=1 CELLSPACING=0 CELLPADDING=3 bgcolor=black>
			<TR><TD bgcolor=\"white\">
				<FONT size =\"-1\" face=\"arial, helvetica\">
					<a href = \"$url\">$caption</A>
				</FONT>
			</TD></TR></TABLE>";
	}
	
	// Muestra el listado de los contactos a partir de una matriz de registros.
	// El parámetro $id_edit indica el registro que el usuario desea editar.
	function listado_contactos($contactos_array, $id_edit)
	{
		echo "<TABLE BORDER=\"0\" cellspacing=\"1\" cellpadding=\"1\" 
				align=\"center\" width=\"600\">
			 	<TR>
					<th bgcolor=\"teal\"><FONT color=\"white\" face=\"arial, helvetica\">Nombre
						</FONT></th>
					<th bgcolor=\"teal\"><FONT color=\"white\" face=\"arial, helvetica\">Apellidos
						</FONT></th>
					<th bgcolor=\"teal\"><FONT color=\"white\" face=\"arial, helvetica\">Teléfono
						</FONT></th>
					<th bgcolor=\"teal\" colspan=\"2\"><FONT color=\"white\" face=\"arial, helvetica\">Operaciones
						</FONT></th>
				</TR>";	
		// Bucle que recorre todos los registros de la matriz
		for ($i=0;$i<sizeof($contactos_array);$i++)
		{
			// Si el id_edit no coincide con el id del registro $i de la matriz 
			// entonces imprimimos los datos
			if ($id_edit != $contactos_array[$i][0])
				echo "<TR><TD>".$contactos_array[$i][1]."</TD>
						<TD>".$contactos_array[$i][2]."</TD>
						<TD>".$contactos_array[$i][3]."</TD> 
						<TD>".boton_ficticio("Editar","index_agenda.php?operacion=editar&nume=".$contactos_array[$i][0])."</TD>
						<TD>".boton_ficticio("Borrar","index_agenda.php?operacion=borrar&nume=".$contactos_array[$i][0]).
					"</TD></TR>";			
			else // En caso contrario, estamos editando el registro $id y mostramos el correspondiente formulario 
			// con los valores del registro. Usamos la etiqueta de tipo hidden para pasar el nº de id a la página destino.
			echo "<TR><FORM name=\"form3\" method=\"post\" action=\"index_agenda.php?operacion=modificar\">
    					<TD><input type=\"text\" name=\"nombre\" size=\"10\" 
    					 value = \"".$contactos_array[$i][1]. "\" maxlength=\"30\"></TD>
					<TD><input type=\"text\" name=\"apellidos\" size=\"25\" 
					value = \"".$contactos_array[$i][2]. "\" maxlength=\"100\"></TD>
					<TD><input type=\"text\" name=\"telefono\" size=\"10\" 
					value = \"".$contactos_array[$i][3]. "\" maxlength=\"30\"></TD> 
					<TD colspan=\"2\">
					<INPUT type=\"hidden\" NAME=\"el_nume\" value = \"$id_edit\">
					<INPUT TYPE=\"SUBMIT\" NAME=\"pulsa\"  VALUE=\"Modificar contacto\"></TD>
				</FORM></TR>";
			
		}
		// Formulario de alta de registros
	    echo "<TR><FORM name=\"form2\" method=\"post\" action=\"index_agenda.php?operacion=alta\">
    					<TD><input type=\"text\" name=\"nombre\" size=\"10\" maxlength=\"30\"></TD>
							<TD><input type=\"text\" name=\"apellidos\" size=\"25\" maxlength=\"100\"></TD>
							<TD><input type=\"text\" name=\"telefono\" size=\"10\" maxlength=\"30\"></TD> 
							<TD colspan=\"2\"><INPUT TYPE=\"SUBMIT\" NAME=\"pulsa\"  VALUE=\"Añadir contacto\"></TD>
				</FORM></TR>
			</TABLE>";
	}
	
	
	// Clase agenda que gestiona los registros de los contactos
	class agenda {
		
		private $nombre_fichero = "agenda.txt";
		// Variable que guarda el nº de contactos del fichero
		public $numero_contactos = 0;
		
		function agenda () //Esto es el constructor
      	{
      		// Creamos el fichero si no existe
      		if (!file_exists($this->nombre_fichero)){
      			$id_fichero=@fopen($this->nombre_fichero,"w") 
      				or die("<B>El fichero '$this->nombre_fichero' no se ha podido 
      								crear.</B><P>");
      			fclose($id_fichero);
      		}
      	}
   
    	// Añadir un contacto a la lista
    	function alta_contacto ($nombre, $apellidos, $telefono) {
    		// Primero leemos los contactos para obtener así el nº de contactos
    		$this->leer_contactos();
    		// Abrimos el fichero de datos en modo añadir
    		$id_fichero = @fopen($this->nombre_fichero,"a")
    				or die("<B>El fichero '$this->nombre_fichero' no se ha podido 
      								abrir.</B><P>");
			
    		$nume=$this->numero_contactos;
    		// Creamos una matriz con los datos del nuevo contacto
    		$contacto = array("nume"=>$nume, "nombre"=>$nombre, "apellidos"=>$apellidos, "telefono"=>$telefono);
    		// Añadimos un intro y juntamos todos los datos de la matriz en una cadena separada por el carácter ~
			$contacto_str = "\n".implode("~", $contacto);
			// Añadimos la cadena anterior al fichero
			fputs($id_fichero, $contacto_str);
			// Cerramos el fichero de datos
	    	fclose($id_fichero);
    	}

    	// Función que lee los contactos del fichero de datos
    	function leer_contactos() {
    		// Abrimos el fichero en modo lectura	
    		$id_fichero = @fopen($this->nombre_fichero,"r")
    				or die("<B>El fichero '$this->nombre_fichero' no se ha podido abrir.</B><P>");
    		// Vamos al principio del fichero
    		rewind($id_fichero);
    		// El nº de contactos leídos es 0
    		$this->numero_contactos=0;
    		// Definimos la matriz donde vamos a ir guardando los registros leídos del fichero
    		$contactos = array();
    		// Mientras no estemos al final del fichero...
    		while (!feof($id_fichero))
    		{
    			// Obtenemos el contenido de la línea actual y nos movemos a la siguiente
        		$contacto_str = trim(fgets($id_fichero));
        		// Si la cadena leida <> vacío
        		if ($contacto_str!=""){
        			// Usamos explode para separar los datos de la cadena en una matriz y esta 
        			// matriz la añadimos con array_push a la matriz $contactos
    				array_push($contactos, explode("~", $contacto_str));
    				// Incrementamos el nº de contactos
    				$this->numero_contactos++;
				}
    		} // end while
    		// Cerramos el fichero
			fclose($id_fichero);
			// Devolvemos la matriz de datos
			return $contactos;
    	}
    		
    	// Función que modifica los datos del contacto en un fichero
    	function modificar_contacto($id_to_modi, $nombre, $apellidos, $telefono) {
      		// Leemos los contactos del fichero
      		$contactos=$this->leer_contactos();
      		// Como se trata de un fichero de tipo texto (poco eficaz para guardar muchos datos)
      		// podemos guardar todos los registros a la vez.
      		// Creamos en modo escritura el fichero basura.tmp.
      		$id_fichero_temp = @fopen("basura.tmp","w")
      		or die("<B>El fichero 'basura.tmp' no se ha podido abrir.</B><P>");
      		// Recorremos todos los contactos de la matriz con los registros
    		for ($i=0;$i<sizeof($contactos);$i++)
    		{
    			// Si el id del contacto corresponde al que queremos editar 
    			// modificamos los datos de la matriz
    			if ($contactos[$i][0] == $id_to_modi) {
    				$contactos[$i][1]=$nombre;
    				$contactos[$i][2]=$apellidos;
    				$contactos[$i][3]=$telefono;
    			}
    			// Si estamos escribiendo el registro >0 entonces hay que añadir 
    			// un salto de línea para que el fichero queden bien los registros
    			if ($i>0) fputs($id_fichero_temp, "\n"); 
    			// Escribimos de nuevo los datos en el fichero de registros 
    			$contacto_str = implode("~", $contactos[$i]);					
    			fputs($id_fichero_temp, $contacto_str);
    		} // end for
    		// Cerramos el fichero temporal
			fclose($id_fichero_temp);
			// Borramos fichero original de datos
			unlink($this->nombre_fichero);
			// Renombramos el fichero temporal al fichero de datos
			rename("basura.tmp", $this->nombre_fichero);
    	}
    		
    	// Función que borra un contecto
 	   	function borrar_contacto($id_to_del) {
 	   		// Leemos los contactos del fichero
 	   		$contactos=$this->leer_contactos();
    		// Volvemos de nuevo a usar un fichero temporal		
      		$id_fichero_temp = @fopen("basura.tmp","w")
    				or die("<B>El fichero 'basura.tmp' no se ha podido abrir.</B><P>");
      		// Nueva variable para renombrar el id de cada registro
      		$j=0;
      		// Recorremos todos los contactos de la matriz con los registros
    		for ($i=0;$i<sizeof($contactos);$i++)
    		{
    			// Si el id del contacto NO es el id que queremos borrar
    			// entonces lo añadimos a la matriz de resultados e incrementamos
    			// el contador j.
    			if ($contactos[$i][0] != $id_to_del) {
    				$contactos[$i][0]=$j;
    				$contacto_str = implode("~", $contactos[$i]);
    				// Si estamos escribiendo el registro >0 entonces hay que añadir 
    		        // un salto de línea para que el fichero quede bien
    		        if ($j>0) fputs($id_fichero_temp, "\n"); 					
    				fputs($id_fichero_temp, $contacto_str);
    				$j+=1;
				}
    		} // end for
    		// Cerramos fichero temporal y lo renombramos
			fclose($id_fichero_temp);
			unlink($this->nombre_fichero);
			rename("basura.tmp", $this->nombre_fichero);
    	}
    	
    	// Función que busca un contacto
    	function buscar($lo_q_busco) {
    		// Abrimos el fichero en modo lectura	
    		$id_fichero = @fopen($this->nombre_fichero,"r")
    				or die("<B>El fichero '$this->nombre_fichero' no se ha podido 
      							abrir.</B><P>");
    		rewind($id_fichero);
    		// Matriz con los resultados de la búsqueda
    		$contactos = array();
    		// Mientras el fichero no termine
    		while (!feof($id_fichero))
    		{
        		$contacto_str = trim(fgets($id_fichero));
        		if ($contacto_str!=""){
        			$contacto = explode("~", $contacto_str);
        			// Buscamos si hay alguna coincidencia con stristr en alguno de los 
        			// campos de búsqueda. Fíjate que esta función no distingue entre
        			// mayúsculas y minúsculas.
        			if ((stristr($contacto[1], $lo_q_busco)) || 
						(stristr($contacto[2], $lo_q_busco)))
        				array_push($contactos, explode("~", $contacto_str));
				}
    		} // end for
    		// Cerramos e fichero
			fclose($id_fichero);
			// Devolvemos la matriz de datos
			return $contactos;
    	}//END function
	} // end clase

	
?>

