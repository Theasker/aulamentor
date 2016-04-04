<?php
  
  require("uni7_utilidades.php");
  
  /********** Funciones auxiliares de la página *******/
  function cabecera()
  {     
     header("Cache-Control:no-cache");
     header("Pragmal: no-cache");
     echo "<HTML><HEAD><TITLE>Ejemplo 3 - Unidad 7 - Curso Iniciación de PHP 5</TITLE></HEAD><BODY>";
     $acciones=array("Nuevo","Buscar","Mostrar_todos");
     echo "<CENTER><H1>Usuarios</H1>";
     for ($i=0;$i<count($acciones);$i++)
         echo "<A HREF=".$_SERVER["PHP_SELF"]."?op=$acciones[$i]>$acciones[$i]||</A>";
     echo "</CENTER><P>";
  }

  function pie()
  {
	echo "</BODY></HTML>";
  }

  function formulario_datos($registro, $dni,$nombre,$apellidos,
                       $domicilio,$localidad,$provincia,$telefono,$tipo)
  {     
     echo "
     <FORM ACTION=".$_SERVER["PHP_SELF"]."?op=$tipo METHOD=POST>
	 <CENTER>
	 <TABLE>
	   <TR>
	     <TD>DNI</TD>
	   	 <TD><INPUT NAME=dni VALUE=\"$dni\" size=9></TD>
	   </TR><TR>
	   	 <TD>Nombre</TD>
	   	 <TD><INPUT NAME=nombre VALUE=\"$nombre\" size=10></TD>
	   </TR><TR>
	   	 <TD>Apellidos</TD>
	   	 <TD><INPUT NAME=apellidos VALUE=\"$apellidos\"size=25></TD>
	   </TR><TR>
	     <TD>Dirección</TD>
	     <TD><INPUT NAME=domicilio VALUE=\"$domicilio\" size=35></TD>
	   </TR><TR>
	     <TD>Localidad</TD>
	     <TD><INPUT NAME=localidad VALUE=\"$localidad\" size=20></TD>
	   </TR><TR>
	     <TD>Provincia</TD>
	     <TD><INPUT NAME=provincia VALUE=\"$provincia\" size=20></TD>
	   </TR><TR>
	     <TD>Teléfono</TD>
	     <TD><INPUT NAME=telefono VALUE=\"$telefono\" size=20></TD>
	   </TR>
	 </TABLE>
	   <INPUT TYPE=HIDDEN NAME=registro VALUE=$registro>
	   <INPUT TYPE=SUBMIT VALUE=Aceptar></CENTER>
	 </FORM><P>";
  }

  function formulario_busqueda()
  {     
     $campos=array( array("dni","DNI"), 
                      array("nombre","Nombre"),
     				  array("apellidos","Apellidos"),
     				  array("domicilio","Dirección"),
     				  array("localidad","Localidad"),
     				  array("provincia","Provincia"),
     				  array("telefono","Teléfono"));
     
     for ($i=0;$i<count($campos);$i++)
		echo "<FORM ACTION=".$_SERVER["PHP_SELF"]."?op=Buscar METHOD=POST>
		     <INPUT TYPE=hidden NAME='campo_busqueda' VALUE=".$campos[$i][0].">
		     <TABLE align=center>
		     <TR>
		             <TD width=90>".$campos[$i][1]."</TD>
		             <TD><INPUT NAME=buscar_txt></TD>
		             <TD><INPUT TYPE=SUBMIT NAME=boton VALUE=\"Buscar por '".$campos[$i][0]."'\"></TD>
		     </TR></TABLE></FORM>";
  }
  
  function listado($resultado)
  {     
     $filas=$resultado->rowCount();
     echo "<TABLE BORDER=1 align=center>";
     echo "<TR><TD>Registro</TD><TD>DNI</TD>
                 <TD>Nombre</TD><TD>Apellidos</TD>
                 <TD>Dirección</TD><TD>Localidad</TD><TD>Provincia</TD>
                 <TD>Teléfono</TD><TD colspan=2>Operación</TD>
               </TR>";
     foreach ($resultado as $valor) {
         echo "<TR>
       			<TD>$valor[registro]</TD><TD>$valor[dni]</TD>
       			<TD>$valor[nombre]</TD><TD>$valor[apellidos]</TD>
       			<TD>$valor[domicilio]</TD><TD>$valor[localidad]</TD>
       			<TD>$valor[provincia]</TD><TD>$valor[telefono]</TD>
       			<TD><A HREF=".$_SERVER["PHP_SELF"]."?op=editar&registro=$valor[registro]>
       					Editar</A></TD>
       			<TD><A HREF=".$_SERVER["PHP_SELF"]."?op=borrar&registro=$valor[registro]>
       					Borrar</A></TD>
       	     </TR>";
     }
     echo "</TABLE><P>";
   }

  
  /******* END Funciones auxiliares de la página *******/


//Aquí empieza la funcionalidad de la página
cabecera();

/* Intentamos establecer una conexión con el servidor.*/
$db = conectaBD('biblioteca');

if (isset($_GET["op"])) {
  if ($_GET["op"]=="Nuevo")
  {
   	formulario_datos("","","","","","","","","inserta");
  }
  else
  if ($_GET["op"]=="inserta")
  {  $bien = ( (!empty($_POST["dni"])) && (!empty($_POST["nombre"])) && 
  		     (!empty($_POST["apellidos"])) && (!empty($_POST["domicilio"])) &&
  		     (!empty($_POST["localidad"])) && (!empty($_POST["provincia"])) &&
     	     (!empty($_POST["telefono"])) );
     if ($bien)
     {
        $consulta="insert into usuarios values
     	      ('".$_POST["nombre"]."','".$_POST["apellidos"]."','".$_POST["dni"]."','1962-09-10',
          	  '".$_POST["domicilio"]."','".$_POST["localidad"]."','".$_POST["provincia"]."',2000.000,
          	  '".$_POST["telefono"]."','','',NULL)";
        if ($db->query($consulta))
        {
        	print("<CENTER><H3>El registro ha sido dado de alta 
        			correctamente</H3></CENTER>");
        }
        else // Si no se ejecuta correctamente mostramos el error al usuario
        {
        	echo"<CENTER><H3>No se ha podido ejecutar la 
                	consulta.<P>Compruebe si la sintaxis de 
                	la misma es correcta.<P></H3>Errores: </H3><PRE>";
        	print_r($db->errorInfo());
        	echo "</PRE></CENTER>";
        }        
     }
     else
       formulario_datos(0,$_POST["dni"],$_POST["nombre"],$_POST["apellidos"],$_POST["domicilio"],
       				$_POST["localidad"],$_POST["provincia"],$_POST["telefono"],"inserta");
  }//end if inserta
  else
  if ($_GET["op"]=="Mostrar_todos")
  {
     $consulta="select registro,dni,nombre,apellidos,
	     			domicilio,localidad,provincia,telefono 
     				from usuarios order by registro";
     $resultado = $db->query($consulta);
     if ($resultado)
     {
     	listado($resultado);
     }
     else // Si no se ejecuta correctamente mostramos el error al usuario
     {
     	echo"<CENTER><H3>No se ha podido ejecutar la
                	consulta.<P>Compruebe si la sintaxis de
                	la misma es correcta.<P></H3>Errores: </H3><PRE>";
     	print_r($db->errorInfo());
     	echo "</PRE></CENTER>";
     }
  }//end Mostrar_todos
  else
  if ($_GET["op"]=="editar")
  {
     $consulta="select registro,dni,nombre,apellidos,
     				  domicilio,localidad,provincia,telefono 
     			  	from usuarios where registro=".$_GET["registro"];
     $resultado = $db->query($consulta);
     if ($resultado)
     {
     	$datos = $resultado->fetch();
     	formulario_datos($datos['registro'],$datos['dni'],$datos['nombre'],$datos['apellidos'],
     	   $datos['domicilio'], $datos['localidad'], $datos['provincia'], $datos['telefono'],"actualiza");
     }
     else // Si no se ejecuta correctamente mostramos el error al usuario
     {
     	echo"<CENTER><H3>No se ha podido ejecutar la
                	consulta.<P>Compruebe si la sintaxis de
                	la misma es correcta.<P></H3>Errores: </H3><PRE>";
     	print_r($db->errorInfo());
     	echo "</PRE></CENTER>";
     }
  }//end editar
  else
  if ($_GET["op"]=="actualiza")
  {
     $consulta ="update usuarios set dni='".$_POST["dni"]."',nombre='".$_POST["nombre"]."',
     				apellidos='".$_POST["apellidos"]."',domicilio='".$_POST["domicilio"]."',
     				localidad='".$_POST["localidad"]."',provincia='".$_POST["provincia"]."',
     				telefono='".$_POST["telefono"]."' where registro=".$_POST["registro"];
     if ($db->query($consulta))
     {
     	print("<CENTER><H3>El registro ha sido modificado 
     			correctamente</H3></CENTER>");
     }
     else // Si no se ejecuta correctamente mostramos el error al usuario
     {
     	echo"<CENTER><H3>No se ha podido ejecutar la
                	consulta.<P>Compruebe si la sintaxis de
                	la misma es correcta.<P></H3>Errores: </H3><PRE>";
     	print_r($db->errorInfo());
     	echo "</PRE></CENTER>";
     }
  } //end actualiza 
  else
  if ($_GET["op"]=="borrar")
  {
     $consulta="delete from usuarios where registro=".$_GET["registro"];
     if ($db->query($consulta))
     {
     	print("<CENTER><H3>El registro ha sido borrado 
     			correctamente</H3></CENTER>");
     }
     else // Si no se ejecuta correctamente mostramos el error al usuario
     {
     	echo"<CENTER><H3>No se ha podido ejecutar la
                	consulta.<P>Compruebe si la sintaxis de
                	la misma es correcta.<P></H3>Errores: </H3><PRE>";
     	print_r($db->errorInfo());
     	echo "</PRE></CENTER>";
     } 
  }//end borrar
  else
  if ($_GET["op"]=="Buscar")
  {
     if (!isset($_POST["campo_busqueda"])) formulario_busqueda();
     else
     {         
         $consulta="select registro,dni,nombre,apellidos,domicilio,
         			localidad,provincia,telefono from usuarios 
						where ".$_POST["campo_busqueda"]." like '%".$_POST["buscar_txt"]."%'";
     	$resultado = $db->query($consulta);
	    if ($resultado)
	    {
	     	listado($resultado);
	    }
	    else // Si no se ejecuta correctamente mostramos el error al usuario
	    {
	     	echo"<CENTER><H3>No se ha podido ejecutar la
	                	consulta.<P>Compruebe si la sintaxis de
	                	la misma es correcta.<P></H3>Errores: </H3><PRE>";
	     	print_r($db->errorInfo());
	     	echo "</PRE></CENTER>";
	    }
     }
  }//end if buscar

}//end if isset($_GET["op"])


pie();

?>

