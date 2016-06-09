<?php
    function boton_ficticio($caption,$url)
    {
        return "<TABLE border=1 CELLSPACING=0 CELLPADDING=3 bgcolor=black>
        <TR><TD bgcolor=\"#669900\">
        <FONT size =\"-1\" face=\"arial, helvetica\">
        <a href = \"$url\">$caption</A>
        </FONT>
        </TD></TR></TABLE>";
    }
    
    function ordenar_registros ($tipo, $array_ordenar) {
    
        if ($tipo == "concepto"){
            
            usort($array_ordenar, function ($a,$b){
                return strtolower($a[1]) > strtolower($b[1]);
            });
    
        } elseif ($tipo=="fecha"){
            usort($array_ordenar, function ($a,$b){
                return $a[2] > $b[2];
            });
    
        } elseif ($tipo=="importe"){
            usort($array_ordenar, function ($a,$b){
                return $a[3] < $b[3];
            });
        }
    
        return $array_ordenar;
    }
    
    function listado_monedero($conceptos_array, $id_edit,$ord,$busqueda){
        echo "<TABLE BORDER=\"0\" cellspacing=\"1\" cellpadding=\"1\"
				align=\"center\" width=\"700\">
			 	<TR>
					<th bgcolor=";
                    if ($ord=="concepto"){
                        echo 'teal'; 
                        $conceptos_array=ordenar_registros ("concepto", $conceptos_array);
                        }else echo '#669900';
					echo "><FONT color=\"white\" face=\"arial, helvetica\"><a href =monedero.php?buscar_texto=".$busqueda."&ordenar_por_campo=concepto>Concepto</a>
						</FONT></th>
					<th bgcolor=";
					if ($ord=="fecha"){
					    echo 'teal'; 
					    $conceptos_array=ordenar_registros ("fecha", $conceptos_array);
					    }else echo '#669900';
					echo "><FONT color=\"white\" face=\"arial, helvetica\"><a href =monedero.php?buscar_texto=".$busqueda."&ordenar_por_campo=fecha>Fecha</a>
						</FONT></th>
					<th bgcolor=";
					if ($ord=="importe"){
					    echo 'teal'; 
					    $conceptos_array=ordenar_registros ("importe", $conceptos_array);
					    }else echo '#669900';
					echo "><FONT color=\"white\" face=\"arial, helvetica\"><a href =monedero.php?buscar_texto=".$busqueda."&ordenar_por_campo=importe>Importe</a>
						</FONT></th>
					<th bgcolor=\"#669900\" colspan=\"2\"><FONT color=\"white\" face=\"arial, helvetica\">Operaciones
						</FONT></th>
				</TR>";
		
        // Bucle que recorre todos los registros de la matriz
        for ($i=0;$i<sizeof($conceptos_array);$i++)
        {
            // Si el id_edit no coincide con el id del registro $i de la matriz
            // entonces imprimimos los datos
            if ($id_edit != $conceptos_array[$i][0])
                echo "<TR><TD>".$conceptos_array[$i][1]."</TD>
						<TD>".date('d/m/Y',$conceptos_array[$i][2])."</TD>
						<TD>".number_format($conceptos_array[$i][3],2)."</TD>
						<TD>".boton_ficticio("Editar","monedero.php?operacion=editar&buscar_texto=".$busqueda."&ordenar_por_campo=".$ord."&nume=".$conceptos_array[$i][0])."</TD>
						<TD>".boton_ficticio("Borrar","monedero.php?operacion=borrar&buscar_texto=".$busqueda."&ordenar_por_campo=".$ord."&nume=".$conceptos_array[$i][0]).
    						"</TD></TR>";
                else // En caso contrario, estamos editando el registro $id y mostramos el correspondiente formulario
                    // con los valores del registro. Usamos la etiqueta de tipo hidden para pasar el nº de id a la página destino.
                    echo "<TR><FORM name=\"form3\" method=\"post\" action=\"monedero.php?operacion=modificar&buscar_texto=".$busqueda."&ordenar_por_campo=".$ord."\">
    					<TD><input type=\"text\" name=\"concepto\" size=\"10\"
    					 value = \"".$conceptos_array[$i][1]. "\" maxlength=\"30\"></TD>
					<TD><input type=\"text\" name=\"fecha\" size=\"25\"
					value = \"".date('d/m/Y',$conceptos_array[$i][2]). "\" maxlength=\"100\"></TD>
					<TD><input type=\"text\" name=\"importe\" size=\"10\"
					value = \"".$conceptos_array[$i][3]. "\" maxlength=\"30\"></TD>
    					<TD colspan=\"2\">
    					<INPUT type=\"hidden\" NAME=\"el_nume\" value = \"$id_edit\">
    					<INPUT TYPE=\"SUBMIT\" NAME=\"pulsa\"  VALUE=\"Modificar\"></TD>
    					</FORM></TR>";
                    	
        }
        // Formulario de alta de registros
        echo "<TR><FORM name=\"form2\" method=\"post\" action=\"monedero.php?operacion=alta\">
    					<TD><input type=\"text\" name=\"concepto\" size=\"10\" maxlength=\"30\"></TD>
							<TD><input type=\"text\" name=\"fecha\" size=\"25\" maxlength=\"100\"></TD>
							<TD><input type=\"text\" name=\"importe\" size=\"10\" maxlength=\"30\"></TD>
							<TD colspan=\"2\"><INPUT TYPE=\"SUBMIT\" NAME=\"pulsa\"  VALUE=\"Añadir registro\"></TD>
				</FORM></TR>
			</TABLE>";
        
    }
    
    class monedero {
    
        private $nombre_fichero = "monedero.txt";
        // Variable que guarda el nº de farmacos del fichero
        public $numero_conceptos = 0;
    
        function monedero () //Esto es el constructor
        {
          		// Creamos el fichero si no existe
          		if (!file_exists($this->nombre_fichero)){
          		    $id_fichero=@fopen($this->nombre_fichero,"w")
          		    or die("<B>El fichero '$this->nombre_fichero' no se ha podido
          		        crear.</B><P>");
          		    fclose($id_fichero);
          		}
        }
        // Añadir un farmaco a la lista
        function alta_monedero ($concepto, $fecha, $importe) {
            
            $id_fichero = @fopen($this->nombre_fichero,"a")
            or die("<B>El fichero '$this->nombre_fichero' no se ha podido
                abrir.</B><P>");
            	
            $nume=$this->numero_conceptos;
            $fecha=trim($fecha);
            $fecha_desglosada= explode("/", $fecha);
            $dia=$fecha_desglosada[0];
            $mes=$fecha_desglosada[1];
            $año=$fecha_desglosada[2];
            if($año>1970 && $año<2030){ //Para evitar fallo en función date()
                if(checkdate($mes, $dia, $año)==true){
                    $fecha_timestamp=strtotime($mes.'/'.$dia.'/'.$año);
                    // Creamos una matriz con los datos del nuevo farmaco
                    $concepto_nuevo = array("nume"=>$nume, "concepto"=>$concepto, "fecha"=>$fecha_timestamp, "importe"=>$importe);
                    // Añadimos un intro y juntamos todos los datos de la matriz en una cadena separada por el carácter ~
                    $concepto_str = "\n".implode("~", $concepto_nuevo);
                    // Añadimos la cadena anterior al fichero
                    fputs($id_fichero, $concepto_str);
                    // Cerramos el fichero de datos
                    fclose($id_fichero);
                }else {
                    echo "No se puede dar de alta el registro: es obligatorio indicar una fecha correcta (el formato correcto de la fecha es 'd/m/aaaa')<p>";
                    return -1;
                }   
            }else {
                echo "No se puede dar de alta el registro: es obligatorio indicar una fecha correcta (el formato correcto de la fecha es 'd/m/aaaa')<p>";
                return -1;
            }
        }
        
        // Función que lee los farmacos del fichero de datos
        function leer_conceptos() {
            // Abrimos el fichero en modo lectura
            $id_fichero = @fopen($this->nombre_fichero,"r")
            or die("<B>El fichero '$this->nombre_fichero' no se ha podido abrir.</B><P>");
            // Vamos al principio del fichero
            rewind($id_fichero);
            // El nº de farmacos leídos es 0
            $this->numero_conceptos=0;
            // Definimos la matriz donde vamos a ir guardando los registros leídos del fichero
            $conceptos = array();
            // Mientras no estemos al final del fichero...
            while (!feof($id_fichero))
            {
                // Obtenemos el contenido de la línea actual y nos movemos a la siguiente
                $concepto_str = trim(fgets($id_fichero));
                // Si la cadena leida <> vacío
                if ($concepto_str!=""){
                    // Usamos explode para separar los datos de la cadena en una matriz y esta
                    // matriz la añadimos con array_push a la matriz $conceptos
                    array_push($conceptos, explode("~", $concepto_str));
                    // Incrementamos el nº de farmacos
                    $this->numero_conceptos++;
                }
            } // end while
            // Cerramos el fichero
            fclose($id_fichero);
            // Devolvemos la matriz de datos
            return $conceptos;
        }
        
        // Función que modifica los datos del farmaco en un fichero
        function modificar_concepto($id_to_modi, $concepto, $fecha, $importe) {
            // Leemos los farmacos del fichero
            $conceptos=$this->leer_conceptos();
            
            // Creamos en modo escritura el fichero basura.tmp.
            $id_fichero_temp = @fopen("basura.tmp","w")
            or die("<B>El fichero 'basura.tmp' no se ha podido abrir.</B><P>");
            
            $fecha=trim($fecha);
            $fecha_desglosada= explode("/", $fecha);
            $dia=$fecha_desglosada[0];
            $mes=$fecha_desglosada[1];
            $año=$fecha_desglosada[2];
            if($año>1970 && $año<2030){ //Para evitar fallo en función date()
                if(checkdate($mes, $dia, $año)!=true){
                    echo "No se puede dar de alta el registro: es obligatorio indicar una fecha correcta (el formato correcto de la fecha es 'd/m/aaaa')<p>";
                    
                }else{
                
                    // Recorremos todos los farmacos de la matriz con los registros
                    for ($i=0;$i<sizeof($conceptos);$i++)
                    {
                        // Si el id del farmaco corresponde al que queremos editar
                        // modificamos los datos de la matriz
                        if ($conceptos[$i][0] == $id_to_modi) {
                            $fecha=trim($fecha);
                            $fecha_desglosada= explode("/", $fecha);
                            $dia=$fecha_desglosada[0];
                            $mes=$fecha_desglosada[1];
                            $año=$fecha_desglosada[2];
                            $fecha_timestamp=strtotime($mes.'/'.$dia.'/'.$año);
                            $conceptos[$i][1]=$concepto;
                            $conceptos[$i][2]=$fecha_timestamp;
                            $conceptos[$i][3]=$importe;
                        }
                        // Si estamos escribiendo el registro >0 entonces hay que añadir
                        // un salto de línea para que el fichero queden bien los registros
                        if ($i>0) fputs($id_fichero_temp, "\n");
                        // Escribimos de nuevo los datos en el fichero de registros
                        $concepto_str = implode("~", $conceptos[$i]);
                        fputs($id_fichero_temp, $concepto_str);
                    } // end for
                    
                    // Cerramos el fichero temporal
                    fclose($id_fichero_temp);
                    // Borramos fichero original de datos
                    unlink($this->nombre_fichero);
                    // Renombramos el fichero temporal al fichero de datos
                    rename("basura.tmp", $this->nombre_fichero);
                }
            }
        }
        
        // Función que borra un farmaco
        function borrar_concepto($id_to_del) {
            // Leemos los farmacos del fichero
            $conceptos=$this->leer_conceptos();
            // Volvemos de nuevo a usar un fichero temporal
            $id_fichero_temp = @fopen("basura.tmp","w")
            or die("<B>El fichero 'basura.tmp' no se ha podido abrir.</B><P>");
            // Nueva variable para renombrar el id de cada registro
            $j=0;
            // Recorremos todos los farmacos de la matriz con los registros
            for ($i=0;$i<sizeof($conceptos);$i++)
            {
                // Si el id del farmaco NO es el id que queremos borrar
                // entonces lo añadimos a la matriz de resultados e incrementamos
                // el contador j.
                if ($conceptos[$i][0] != $id_to_del) {
                    $conceptos[$i][0]=$j;
                    $concepto_str = implode("~", $conceptos[$i]);
                    // Si estamos escribiendo el registro >0 entonces hay que añadir
                    // un salto de línea para que el fichero quede bien
                    if ($j>0) fputs($id_fichero_temp, "\n");
                    fputs($id_fichero_temp, $concepto_str);
                    $j+=1;
                }
            } // end for
            // Cerramos fichero temporal y lo renombramos
            fclose($id_fichero_temp);
            unlink($this->nombre_fichero);
            rename("basura.tmp", $this->nombre_fichero);
        }
        
        // Función que busca un farmaco
        function buscar($lo_q_busco) {
            // Abrimos el fichero en modo lectura
            $id_fichero = @fopen($this->nombre_fichero,"r")
            or die("<B>El fichero '$this->nombre_fichero' no se ha podido
                abrir.</B><P>");
            rewind($id_fichero);
            // Matriz con los resultados de la búsqueda
            $conceptos = array();
            // Mientras el fichero no termine
            while (!feof($id_fichero))
            {
                $concepto_str = trim(fgets($id_fichero));
                if ($concepto_str!=""){
                    $concepto = explode("~", $concepto_str);
                    // Buscamos si hay alguna coincidencia con stristr en alguno de los
                    // campos de búsqueda.
                    if (stristr($concepto[1], $lo_q_busco))
                        array_push($conceptos, explode("~", $concepto_str));
                }
            } 
            // Cerramos el fichero
            fclose($id_fichero);
            // Devolvemos la matriz de datos
            return $conceptos;
        }       
        
         
    }

?>