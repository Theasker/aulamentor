<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
	<title>Aula Mentor - Unidad 7 - Gstión de cines</title>
  <link rel="stylesheet" type="text/css" href="uni7_cines.css" media="screen">
</head>
<body>
<?php
require 'uni7_cines_class.php';
$micine = new cine();
$micine->encabezado();
var_dump($_REQUEST);
if(isset($_REQUEST['opcion'])){
  switch($_REQUEST['opcion']){
    case 'frm_inicial':
      if (isset($_REQUEST['buscar'])){
      	$sql = 'SELECT cine.* FROM ejercicios.cine
								WHERE cine.nombre_peli LIKE "%'.$_REQUEST['txt_buscar'].'%"';
      	$micine->mostrar($sql);
      }
      else if (isset($_REQUEST['nuevo'])){
      	// Parámetros:Nombre del cine, Nombre de la película, Descripción, Sesión1 (hora),
      	// Sesión2 (hora), Sesión3 (hora), nº de filas del cine y nº de asientos del cine
				$micine->formulario_altamodificacion("alta","","","","","","","","","");				
      }
      else{
				$sql = "SELECT * FROM ejercicios.cine ORDER BY cine.nombre_cine";
      	$micine->mostrar($sql);
      } 
      break;
    case 'consultar':
    	$micine->consultar();
    	break;
    case 'alta':
    	if ($micine->comprobarcampos()){
    		$micine->alta($_REQUEST['nomcine'],$_REQUEST['nompeli'],
    					$_REQUEST['descripcion'],$_REQUEST['sesion1'],$_REQUEST['sesion2'],$_REQUEST['sesion3'],
    							$_REQUEST['numfilas'],$_REQUEST['numasientos']);
    	}
    	break;
    case 'editar':
    	$sql = 'SELECT cine.* FROM ejercicios.cine
								WHERE cine.Id ='.$_REQUEST['registro'];
    	$datos = @mysql_query($sql,$micine->id_conexion) or	die("$sql</br>".mysql_error());
    	$registro = mysql_fetch_array($datos);
    	$micine->formulario_altamodificacion("modificacion",$_REQUEST['registro'],$registro['nombre_cine'],
    						$registro['nombre_peli'],$registro['descripcion'],
								$registro['sesion1'],$registro['sesion2'],$registro['sesion3'],
    						$registro['nume_filas'],$registro['nume_asientos']);
    	break;
    case 'modificacion':
    	$micine->modificacion($_REQUEST['registro'],$_REQUEST['nomcine'],$_REQUEST['nompeli'],
    			$_REQUEST['descripcion'],$_REQUEST['sesion1'],$_REQUEST['sesion2'],$_REQUEST['sesion3'],
    			$_REQUEST['numfilas'],$_REQUEST['numasientos']);
    	break;
    case 'borrar':
    	$micine->borrar();
    	break;
    case 'comprar':
    	if (isset($_REQUEST['sesion']) and isset($_REQUEST['fecha'])){
    		// pasamos el último caracter del nombre de la sesión para convertir
    		// sesion1 en 1, sesion2 en 2 ó sesion3 en 3 con substr echo substr("Memorias de África",-1,1);
    		$micine->formulariocomprar($_REQUEST['registro'],substr($_REQUEST['sesion'],-1,1),$_REQUEST['fecha']);
    	}else{
				$micine->formulariocomprar($_REQUEST['registro'],1,"");
			}
    	break;
    case 'cambiarestado':
    	$micine->cambiarestado();
    	break;
 }
}else{
	$sql = "SELECT * FROM ejercicios.cine ORDER BY cine.nombre_cine";
	$micine->mostrar($sql);
}
?>
</body>
</html>