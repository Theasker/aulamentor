<HTML>
<HEAD><TITLE>Actividad 1 - Unidad 4 - Curso Iniciación de PHP 5 - Monedero</TITLE>
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

<BODY bgcolor="#C0C0C0" link="white" vlink="white" alink="white"><center>
<TABLE border="0" align="center" cellspacing="3" cellpadding="3" width="600" bgcolor="#669900">
<TR>	
	<td width=30><img src=cerdito.gif></td>
	<TD align=center><FONT size="6" color="white" face="arial, helvetica">Monedero</FONT></TD>
	<td width=30><img src=cerdito.gif></td>
</TR></TABLE><P>


<?php
require("monedero_declara.php");
    
    $mi_monedero= new monedero();
    
    $conceptos=$mi_monedero->leer_conceptos();
    $ord="";
    
    if (isset($_REQUEST["operacion"])){
        switch($_REQUEST["operacion"]){
            
            case "buscar":
                if (($_POST["buscar_edit"]) == "") echo "<CENTER>No se ha introducido ningúna cadena</CENTER><P>";
                else {
                    echo "<CENTER>Los conceptos que contienen '".$_POST["buscar_edit"]."' son: </CENTER><P>";
                    listado_monedero($mi_monedero->buscar($_POST["buscar_edit"]), -1,$ord,$_POST["buscar_edit"]);
                    
                }
                break;
                
            case "editar":
                $ord=$_REQUEST["ordenar_por_campo"];
                if($_REQUEST["buscar_texto"]!="")$conceptos=$mi_monedero->buscar($_REQUEST["buscar_texto"]);
                    else $conceptos=$mi_monedero->leer_conceptos();
                if($ord==""){
                        listado_monedero($conceptos, $_REQUEST["nume"],$ord,$_REQUEST["buscar_texto"]);
                    }
                    else if($ord=="concepto"){
                        $conceptos=ordenar_registros ("concepto", $conceptos);
                        listado_monedero($conceptos, $_REQUEST["nume"],$ord,$_REQUEST["buscar_texto"]);
                        }else if($ord=="fecha"){
                            $conceptos=ordenar_registros ("fecha", $conceptos);
                            listado_monedero($conceptos, $_REQUEST["nume"],$ord,$_REQUEST["buscar_texto"]);
                            }else if($ord=="importe"){
                                $conceptos=ordenar_registros ("importe", $conceptos);
                                listado_monedero($conceptos, $_REQUEST["nume"],$ord,$_REQUEST["buscar_texto"]);
                            }
                break;
                
            case "alta":
                if ($_POST["concepto"]=="") 
                    echo "<CENTER>No se puede dar de alta. Es obligatorio introducir el concepto.</CENTER><P>";
                    else if($_POST["fecha"]=="")
                        echo "<CENTER>No se puede dar de alta. Es obligatorio introducir la fecha.</CENTER><P>";
                        else if($mi_monedero->alta_monedero ($_POST["concepto"], $_POST["fecha"], $_POST["importe"])==0){
                            echo "<CENTER>Se ha dado de alta correctamente el concepto: ".$_POST["concepto"]."</CENTER><P>";
                            $mi_monedero->numero_conceptos++;
                            listado_monedero($mi_monedero->leer_conceptos(),-1,$ord,"");
                        }
                break;
                
            case "modificar":
                if ($_POST["concepto"]=="") 
                    echo "<CENTER>No se ha introducido ningún concepto</CENTER><P>";
                    else if($mi_monedero->modificar_concepto ($_POST["el_nume"], $_POST["concepto"], $_POST["fecha"], $_POST["importe"])==0){
                        echo "<CENTER>Se ha dado modificado correctamente el concepto: ".$_POST["concepto"]. "</CENTER><P>";
                        if($_REQUEST["buscar_texto"]!="")$conceptos=$mi_monedero->buscar($_REQUEST["buscar_texto"]);
                            else $conceptos=$mi_monedero->leer_conceptos();
                        listado_monedero($conceptos,-1,$_REQUEST["ordenar_por_campo"],$_REQUEST["buscar_texto"]);
                    }
                break;
                
            case "borrar":
                $mi_monedero->borrar_concepto($_REQUEST["nume"]);
                echo "<CENTER>Se ha borrado correctamente el concepto.</CENTER><P>";
                $mi_monedero->numero_conceptos--;
                $ord=$_REQUEST["ordenar_por_campo"];
                if($_REQUEST["buscar_texto"]!="")$conceptos=$mi_monedero->buscar($_REQUEST["buscar_texto"]);
                    else $conceptos=$mi_monedero->leer_conceptos();
                if($ord==""){
                    listado_monedero($conceptos, -1,$ord,$_REQUEST["buscar_texto"]);
                }
                    else if($ord=="concepto"){
                        $conceptos=ordenar_registros ("concepto", $conceptos);
                        listado_monedero($conceptos,-1,$ord,$_REQUEST["buscar_texto"]);
                        }else if($ord=="fecha"){
                            $conceptos=ordenar_registros ("fecha", $conceptos);
                            listado_monedero($conceptos, -1,$ord,$_REQUEST["buscar_texto"]);
                            }else if($ord=="importe"){
                                $conceptos=ordenar_registros ("importe", $conceptos);
                                listado_monedero($conceptos, -1,$ord,$_REQUEST["buscar_texto"]);
                            }
                break;
                
            default:
                listado_monedero($mi_monedero->leer_conceptos(), -1,$_REQUEST["ordenar_por_campo"],"");
        }
    }
    else
        if (isset($_REQUEST["ordenar_por_campo"])){
                if($_REQUEST["buscar_texto"]!="")$conceptos=$mi_monedero->buscar($_REQUEST["buscar_texto"]);
                    else $conceptos=$mi_monedero->leer_conceptos();
                switch ($_REQUEST["ordenar_por_campo"]){
                    case "concepto":
                        $conceptos=ordenar_registros ("concepto", $conceptos);
                        listado_monedero($conceptos, -1,$_REQUEST["ordenar_por_campo"],$_REQUEST["buscar_texto"]);
                        break;
                    case "fecha":
                        $conceptos=ordenar_registros ("fecha", $conceptos);
                        listado_monedero($conceptos, -1,$_REQUEST["ordenar_por_campo"],$_REQUEST["buscar_texto"]);
                        break;
                    case "importe":
                        $conceptos=ordenar_registros ("importe", $conceptos);
                        listado_monedero($conceptos, -1,$_REQUEST["ordenar_por_campo"],$_REQUEST["buscar_texto"]);
                        break;
                    default:
                        listado_monedero($mi_monedero->leer_conceptos(), -1,$_REQUEST["ordenar_por_campo"],$_REQUEST["buscar_texto"]);
                        
                }
                }else listado_monedero($mi_monedero->leer_conceptos(), -1,"","");
            
            echo "<CENTER><P><TABLE border=0 width=600>";
            echo "<TR><TD colspan=\"2\"><HR></TD></TR>";
            echo "<TR><TD valign=top align=right>
            <FORM METHOD=\"POST\" ACTION=\"monedero.php?operacion=buscar\">
            <FONT size =\"-1\" face=\"arial, helvetica\">
            Buscar concepto:</FONT></TD><TD>";
            echo "<INPUT TYPE=\"TEXT\" NAME=\"buscar_edit\" size=\"20\"> ";
            echo "<INPUT TYPE=\"SUBMIT\" NAME=\"buscar\"  VALUE=\"¡Buscar!\">
	        </FORM></TD></TR>";
            
            echo "<TR><TD colspan=\"2\"><HR></TD></TR>";
            echo "</TABLE></CENTER>";
            echo "<TABLE BORDER=\"0\" cellspacing=\"1\" cellpadding=\"1\"
            align=\"center\" width=\"600\">
            <TR><TD><FONT size =\"-1\" face=\"arial, helvetica\">
            El nº total de registros del monedero es: ".
            			$mi_monedero->numero_conceptos."</LEFT></FONT><P></TD><TD valign=top align=right>".
            			boton_ficticio("Ver listado completo","monedero.php")."
	        </TD></TR>
            <TR><TD>";
			$conceptos=$mi_monedero->leer_conceptos();
            echo "<font color=red>El balance del monedero es: ". array_sum(array_column($conceptos, 3))." €</font></TD></TR>
            </TABLE><BR>NOTA: es obligatorio rellenar el campo Concepto.";
?>
</center></BODY>
</HTML>