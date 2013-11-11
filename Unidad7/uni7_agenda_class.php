<?php
  function boton_ficticio($caption,$url){
      return "<TABLE border=1 CELLSPACING=0 CELLPADDING=3 bgcolor=black>
              <TR><TD bgcolor=\"white\">
                  <FONT size =\"-1\">
                      <a href = \"$url\">$caption</A>
                 </FONT>
               </TD></TR></TABLE>";
  }
    
  class agenda{
    protected $datos;
    protected $id_conexion;
      
    function __construct(){ //Esto es el constructor
        $DBHost="localhost";
        $DBUser="root";
        $DBPass="";
        /* Intentamos establecer una conexión persistente con el servidor.*/
        $this->id_conexion =
            @mysql_connect($DBHost, $DBUser, $DBPass) or
                die("<CENTER><H3>No se ha podido establecer la conexión.
                    <P>Compruebe si está activado el servidor de bases de 
                    datos MySQL.</H3></CENTER>");
                    
        /* Intentamos seleccionar la base de datos "ejercicios". Si no
            se consigue, se informa de ello y se indica cuál es el
            motivo del fallo con el número y el mensaje de error.*/
        if (!mysql_select_db("ejercicios"))
            printf("<CENTER><H3>No se ha podido seleccionar la base de datos
                \"ejercicios\": <P>%s",'Error nº '.mysql_errno().'.-'.
                mysql_error());
    }//end function constructor
    
    function __destruct() //Esto es el destructor
    {
      if (isset($this->datos)) @mysql_free_result($this->datos);
      /* Liberamos la conexión persistente con el servidor.*/
      if (isset($this->id_conexion)) mysql_close($this->id_conexion);
    }//end destructor agenda
    
    // Añadir un contacto a la lista
    function add_contacto ($registro, $Nombre, $Apellidos, $Telefono_oficina, 
                            $Telefono_movil,$email, $direccion, $localidad, $provincia, 
                            $codigo_postal, $telefono, $notas) 
    {
      if ($registro>0) 
        $sql_script = "UPDATE agenda SET 
                            Nombre='$Nombre', Apellidos='$Apellidos', 
                            Telefono_oficina='$Telefono_oficina',
                            Telefono_movil='$Telefono_movil',email='$email', 
                            direccion='$direccion', localidad='$localidad', 
                            provincia='$provincia', codigo_postal='$codigo_postal',
                            telefono='$telefono', notas='$notas'
                        WHERE registro=$registro";
        else
          $sql_script = "INSERT INTO agenda (Nombre, Apellidos, Telefono_oficina,
                              Telefono_movil, email, direccion, localidad, provincia, 
                              codigo_postal, telefono, notas)
                          VALUES('$Nombre', '$Apellidos', '$Telefono_oficina', 
                              '$Telefono_movil','$email', '$direccion', '$localidad',
                              '$provincia', '$codigo_postal','$telefono', '$notas')";
                              
        $this->datos = mysql_query($sql_script,$this->id_conexion);
    }//end add_contacto
    
    // Nº total de contactos
    function nume_contacto () {
            $sql_script = "SELECT * FROM agenda";
            $this->datos = mysql_query($sql_script,$this->id_conexion);
            return mysql_num_rows($this->datos);
    }
        
    // Borrar contactos
    function del_contacto($id_to_del) {
            $sql_script = "delete FROM agenda where registro=$id_to_del";
            $this->datos = mysql_query($sql_script,$this->id_conexion);                
    }
    
    // Vaciar tabla contactos
    function del_all_contacto() {
            $sql_script = "delete FROM agenda";
            $this->datos = mysql_query($sql_script,$this->id_conexion);                
    }
    
    // Añadir o modificar contactos
    function introduce($id_to_edit, $ver) {
            
    $campos=array(    
           0=>array(0=>"Nombre",1=>"Nombre",2=>15, 3=>30, 4=>""),
           1=>array(0=>"Apellidos",1=>"Apellidos",2=>30, 3=>100, 4=>""),
           2=>array(0=>"Telefono_oficina",
                       1=>"Teléfono oficina",2=>15, 3=>30, 4=>""),
           3=>array(0=>"Telefono_movil",
                       1=>"Teléfono móvil",2=>15, 3=>30, 4=>""),
           4=>array(0=>"email",1=>"e-Mail",2=>40, 3=>200, 4=>""),
           5=>array(0=>"direccion",1=>"Dirección",2=>30, 3=>150, 4=>""),
           6=>array(0=>"localidad",1=>"Localidad",2=>30, 3=>100, 4=>""),
           7=>array(0=>"provincia",1=>"Provincia",2=>30, 3=>60, 4=>""),
           8=>array(0=>"codigo_postal",1=>"Cód. Postal",2=>5, 3=>5, 4=>""),
           9=>array(0=>"telefono",
                       1=>"Teléfono personal",2=>30, 3=>100, 4=>""),
           10=>array(0=>"notas",1=>"Notas",2=>65, 3=>254, 4=>""));
           
         if ($id_to_edit>0) {
             $sql_script = "SELECT Nombre, Apellidos, Telefono_oficina, 
                     Telefono_movil, email, direccion, localidad, 
                     provincia, codigo_postal, telefono, notas 
                     FROM agenda where registro='$id_to_edit'";
                     
             $this->datos = @mysql_query($sql_script,$this->id_conexion)
                or die ("<CENTER><H2>Error al consultar la base 
                        de datos.</H2></CENTER>");
                        
            $filas = mysql_num_rows($this->datos);
            if ($filas==0) { //resultado query vacío
              echo "<CENTER>
                  <TABLE BORDER=1 WIDTH=600 bordercolorlight='#FFFFFF' 
                          bordercolor='#FFFFFF' bgcolor='#C0C0C0'>
                  <TR><TD ALIGN=CENTER VALIGN=CENTER>
                      <H2>No se encuentra ningún registro</H2>
                  </TD></TR></TABLE></CENTER>";
            }
            else //la búsqueda no es vacía
            {
                $myrow = mysql_fetch_row($this->datos);
                for ($i=0; $i < count($campos); $i++)
                    $campos[$i][4]=$myrow[$i];
            }
        }//end if $id_to_edit>0
        
        if ($ver==0) 
            echo "<FORM name='form9' method='post' 
                    action=\"uni7_agenda.php?operacion=exec_alta\">";
        echo "<TABLE BORDER='0' cellspacing='10' cellpadding='0' 
                    align='center' width='600'>";
                    
        for ($i=0; $i < count($campos); $i++){
            echo "<TR><TD bgcolor='teal' align=center width=140>
                <FONT size=-1 color='white'>".$campos[$i][1]."</FONT>
                </TD><TD>";
            if ($ver==1) 
                echo "<FONT size=-1><B>". $campos[$i][4]."</B></FONT>"; 
            else echo "<input type='text' name='".$campos[$i][0]."' 
                        size='".$campos[$i][2]."' value = \"".$campos[$i][4].
                        "\" maxlength='".$campos[$i][3]."'>";
            echo "</TD>
            </TR>";
        }//for
        echo "</TABLE><CENTER>";
        
        if ($ver==0) {
            echo "<INPUT type='hidden' NAME='registro' value = '$id_to_edit'>";
            if ($id_to_edit>0) //estamos modificando
                echo "<INPUT TYPE='SUBMIT' NAME='pulsa' 
                        VALUE=\"Modificar contacto\">";
            else echo "<INPUT TYPE='SUBMIT' NAME='pulsa' 
                        VALUE=\"Alta contacto\">";
        }
        echo "</CENTER>";
        if ($ver==0) echo "</FORM>";    
        
   }//end Añadir o modificar contactos
   
   // Buscar contactos
   function buscar($lo_q_busco) {
       if ($lo_q_busco!="") 
           $sql_script="SELECT * FROM agenda 
                               WHERE apellidos like '%".$lo_q_busco."%' 
                               ORDER BY apellidos";
       else $sql_script = "SELECT * FROM agenda order by apellidos";
       
       $this->datos = @mysql_query($sql_script,$this->id_conexion)
           or die ("<CENTER><H2>Error al consultar la base de 
                       datos.</H2></CENTER>");
           
       $filas = mysql_num_rows($this->datos);
       if ($filas==0) { //resultado query vacío
           echo "<CENTER>
               <TABLE BORDER=1 WIDTH=650 bordercolorlight='#FFFFFF' 
                   bordercolor='#FFFFFF' bgcolor='#C0C0C0'>
               <TR><TD ALIGN=CENTER VALIGN=CENTER>
                   <H2>No se encuentra ningún registro</H2>
               </TD></TR></TABLE></CENTER>";
       }else //la búsqueda no es vacía
       
           echo "<TABLE BORDER='0' cellspacing='1' cellpadding='1' 
                        align='center' width='650'>
                    <TR>
                        <TH bgcolor='teal'>
                            <FONT color='white'>Nombre</FONT>
                        </TH>
                        <TH bgcolor='teal'>
                            <FONT color='white'>Apellidos</FONT>
                        </TH>
                        <TH bgcolor='teal'>
                            <FONT color='white'>Teléfono</FONT>
                        </TH>
                        <TH bgcolor='teal' colspan='3'>
                            <FONT color='white'>Operaciones</FONT>
                        </TH>
                    </TR>";
        while ( $myrow = mysql_fetch_row($this->datos))
        {
            echo "<TR>
                    <TD><FONT size='-1'><B>".$myrow[2]."</B></FONT></TD>
                    <TD><FONT size='-1'><B>".$myrow[1]."</B></FONT></TD>
                    <TD><FONT size='-1'><B>".$myrow[3]."</B></FONT></TD> 
                    <TD>".
                         boton_ficticio("Consulta","uni7_agenda.php?operacion=
                            introduce&ver=1&nume=".$myrow[0]."#ancla")."</TD>
                    <TD>".
                         boton_ficticio("Editar","uni7_agenda.php?operacion=
                            introduce&ver=0&nume=".$myrow[0]."#ancla")."</TD>
                    <TD>".
                         boton_ficticio("Borrar","uni7_agenda.php?operacion=
                            borrar&nume=".$myrow[0])."</TD>
                </TR>";
        }
        echo "</TABLE>";
    }//END function Buscar contactos
    
  }//END clase agenda
    
?> 