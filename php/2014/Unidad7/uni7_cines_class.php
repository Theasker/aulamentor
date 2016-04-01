<?php
class cine{
	public $id_conexion;
	protected $cont;
	protected $cine = array();
	
	function __construct(){
		$DBHost="localhost";
		$DBUser="root";
		$DBPass="";
		$this->id_conexion = @mysql_connect($DBHost, $DBUser, $DBPass) or
					die ("No se ha podidor realizar la conexi�n a la BD");
		if (!mysql_select_db("ejercicios")) echo (mysql_errno().'.-'.mysql_error());
	}
	function __destruct(){
		if (isset($this->id_conexion)) mysql_close($this->id_conexion);
	}	
	function encabezado(){
		?>
		<table width="100%">
      <tr><th class="titulo" ><h2>Cines</h2></th></tr>
      <tr><td class="centrar"><form method="POST" action="uni7_cines.php">
       Buscar pelicula 
      	<input type="text" name="txt_buscar" size="20">
       	<input type="submit" name="buscar" value="�Buscar!">
       	<p><input type="submit" name="nuevo" value="Nuevo cine">
       	<input type="submit" name="listado" value="Listado completo">
       	<input type="hidden" name="opcion" value="frm_inicial"></p>
    	</form>
    	</td></tr>
    </table>
		<?php
	}
	function mostrar($sql){ //usamos esta funcion para buscar y mostrar todos los registros
		?>
		<table width="100%">
		<tr>
		<th class="titulo" width="15%">Nombre cine</th>
		<th class="titulo" width="20%">Pel�cula</th>
		<th class="titulo" width="35%">Descripci�n</th>
		<th class="titulo" width="30%">Operaciones</th></tr>
		<?php 
		$datos = @mysql_query($sql,$this->id_conexion) or
						die("Error en consulta: $sql".mysql_error());
		$this->cont = 0;
		while($registro = mysql_fetch_array($datos)){
			echo '<tr>';
			echo '<td>'.$registro['nombre_cine'].'</td>';
			echo '<td>'.$registro['nombre_peli'].'</td>';
			echo '<td>'.$registro['descripcion'].'</td>';
			echo '<td><table><tr>';
			echo '<td class="boton"><a href="uni7_cines.php?opcion=consultar&registro='.$registro['Id'].'">Consulta</a></td>';
			echo '<td class="boton"><a href="uni7_cines.php?opcion=editar&registro='.$registro['Id'].'">Editar</a></td>';
			echo '<td class="boton"><a href="uni7_cines.php?opcion=comprar&registro='.$registro['Id'].'">Comprar</a></td>';
			echo '<td class="boton"><a href="uni7_cines.php?opcion=borrar&registro='.$registro['Id'].'">Borrar</a></td>';
			echo '</tr></table>';
			echo '</td></tr>';
			$this->cont++;
		}
		?>
		</table>
		<?php
		echo '<div class="resul"><p>El n� de pel�culas es: '.$this->cont.'</p></div>';
		unset($datos);
	}
	function consultar(){
		$sql = 'SELECT * FROM ejercicios.cine WHERE cine.Id='.$_REQUEST['registro'];
		$datos = @mysql_query($sql,$this->id_conexion) or
		die("Error en consulta: $sql".mysql_error());
		echo '<div class="resul"><h4>Datos del cine</h4></div>';
		echo '<table>';
		while($registro = mysql_fetch_array($datos)){
				echo '<tr><td class="titulo">Nombre del cine</td>';
				echo '<td>'.$registro['nombre_cine'].'</td></tr>';
				echo '<tr><td class="titulo">Nombre de la pel�cula</td>';
				echo '<td>'.$registro['nombre_peli'].'</td></tr>';
				echo '<tr><td class="titulo">Descripci�n</td>';
				echo '<td>'.$registro['descripcion'].'</td></tr>';
				echo '<tr><td class="titulo">Sesi�n 1 (hora)</td>';
				echo '<td>'.$registro['sesion1'].'</td></tr>';
				echo '<tr><td class="titulo">Sesi�n 2 (hora)</td>';
				echo '<td>'.$registro['sesion2'].'</td></tr>';
				echo '<tr><td class="titulo">Sesi�n 3 (hora)</td>';
				echo '<td>'.$registro['sesion3'].'</td></tr>';
				echo '<tr><td class="titulo">N� de filas del cine</td>';
				echo '<td>'.$registro['nume_filas'].'</td></tr>';
				echo '<tr><td class="titulo">N� de asientos del cine</td>';
				echo '<td>'.$registro['nume_asientos'].'</td></tr>';
		}
	}
	function formulario_altamodificacion($opcion,$registro,
			$nomcine,$nompeli,$descripcion,$sesion1,$sesion2,$sesion3,$numfilas,$numasientos){
		echo '
		<div class="resul"><h4>Alta de nuevo cine</h4></div>
		<form method="post" action="uni7_cines.php">
			<table>
				<tr><td class="titulo">Nombre del cine</td>
				<td><input type="text" name="nomcine" value="'.$nomcine.'" size="30"></td></tr>
				<tr><td class="titulo">Nombre de la pel�cula</td>
				<td><input type="text" name="nompeli" value="'.$nompeli.'" size="60"></td></tr>
				<tr><td class="titulo">Descripci�n</td>
				<td><input type="text" name="descripcion" value="'.$descripcion.'" size="200"></td></tr>
				<tr><td class="titulo">Sesi�n 1 (hora)</td>
				<td><input type="text" name="sesion1" value="'.$sesion1.'" size="10"></td></tr>
				<tr><td class="titulo">Sesi�n 2 (h ora)</td>
				<td><input type="text" name="sesion2" value="'.$sesion2.'" size="10"></td></tr>
				<tr><td class="titulo">Sesi�n 3 (hora)</td>
				<td><input type="text" name="sesion3" value="'.$sesion3.'" size="10"></td></tr>
				<tr><td class="titulo">N� de filas del cine</td>
				<td><input type="text" name="numfilas" value="'.$numfilas.'" size="5"></td></tr>
				<tr><td class="titulo">N� de asientos del cine</td>
				<td><input type="text" name="numasientos" value="'.$numasientos.'" size="5"></td></tr>';
				if ($opcion == "modificacion"){
					echo '<tr><td></td><td><input type="submit" name="modificar" value="Modificar cine"></td></tr>';
				}
				else if ($opcion == "alta"){
					echo '<tr><td></td><td><input type="submit" name="Alta" value="Alta cine"></td></tr>';
				}
				echo '<input type="hidden" name="opcion" value="'.$opcion.'">
						  <input type="hidden" name="registro" value="'.$registro.'">
				</table>
		</form>';
	}
	function alta($nomcine,$nompeli,$descripcion,$sesion1,$sesion2,$sesion3,$numfilas,$numasientos){
		$sql = 'INSERT INTO ejercicios.cine VALUES(0,"'.$nomcine.'","'.$nompeli.'",
						"'.$descripcion.'","'.$sesion1.'","'.$sesion2.'","'.$sesion3.'",
						"'.$numfilas.'","'.$numasientos.'")';
		$datos = @mysql_query($sql,$this->id_conexion) or	die("$sql</br>".mysql_error());
		// Despu�s de a�adir el registro mostramos todos los registros de nuevo
		$sql = "SELECT * FROM ejercicios.cine ORDER BY cine.nombre_cine";
		$this->mostrar($sql);
	}
	function modificacion($registro,$nomcine,$nompeli,$descripcion,$sesion1,$sesion2,$sesion3,$numfilas,$numasientos){
		// UPDATE productos SET stock = 120 WHERE stock=100;
		$sql = 'UPDATE cine SET 
						nombre_cine="'.$nomcine.'",
						nombre_peli="'.$nompeli.'",
						descripcion="'.$descripcion.'",
						sesion1="'.$sesion1.'",
						sesion2="'.$sesion2.'",
						sesion3="'.$sesion3.'",
						nume_filas="'.$numfilas.'",
						nume_asientos="'.$numasientos.'" 
						WHERE Id='.$registro;
		
		$datos = @mysql_query($sql,$this->id_conexion) or	die("$sql</br>".mysql_error());
		// Despu�s de a�adir el registro mostramos todos los registros de nuevo
		$sql = "SELECT * FROM ejercicios.cine ORDER BY cine.nombre_cine";
		$this->mostrar($sql);
	}
	function borrar(){
		$sql = 'DELETE FROM cine WHERE Id='.$_REQUEST['registro'];
		$datos = @mysql_query($sql,$this->id_conexion) or	die("$sql</br>".mysql_error());
		// Despu�s de a�adir el registro mostramos todos los registros de nuevo
		$sql = "SELECT * FROM ejercicios.cine ORDER BY cine.nombre_cine";
		$this->mostrar($sql);
	}
	function comprobarcampos(){
		if($_REQUEST['nomcine']=='' or $_REQUEST['nompeli']==''){
			echo 'No se puede realizar la operaci�n: el campo 
						"Nombre del cine" y el campo "Nombre de pelicula" es obligatorio.';
			return (false);
		}else return (true);
	}
	function formulariocomprar($registro,$sesion,$fecha){
		$sql = 'SELECT cine.*	FROM ejercicios.cine WHERE cine.Id='.$_REQUEST['registro'];
		$datos = @mysql_query($sql,$this->id_conexion) or	die("$sql".mysql_error());
		$registro = mysql_fetch_array($datos); //leemos el registro del cine en cuesti�n
		echo '<hr><div class="centrar">';
		echo '<table><tr><td class="titulo">Nombre cine</td><th>'.$registro['nombre_cine'].'</th>';
		echo '<td class="titulo">Nombre pelicula</td><th>'.$registro['nombre_peli'].'</th></table>';
		// Seleccionamos el registro �ltimo de un cine, de una sesi�n de un d�a espec�fico.
		$sql = 'SELECT * FROM ejercicios.cine_entradas
						WHERE Id_cine='.$_REQUEST['registro'].' AND sesion='.$sesion.' 
						ORDER BY sesion, dia DESC';
		$datos = @mysql_query($sql,$this->id_conexion) or	die("$sql".mysql_error());
		$regsesion = mysql_fetch_array($datos);
		echo '<form method="post" action="uni7_cines.php">
					<table><tr><td class="titulo">Sesi�n</td><td>Hora</td>
					<td><select name="sesion">';
		switch ($sesion){
			case '1': 
				echo '<option value="1" selected>'.date_format(date_create($registro['sesion1']), 'H:i').'</option>';
				echo '<option value="2">'.date_format(date_create($registro['sesion2']), 'H:i').'</option>';
				echo '<option value="3">'.date_format(date_create($registro['sesion3']), 'H:i').'</option>';
				break;
			case '2':
				echo '<option value="1">'.date_format(date_create($registro['sesion1']), 'H:i').'</option>';
				echo '<option value="2" selected>'.date_format(date_create($registro['sesion2']), 'H:i').'</option>';
				echo '<option value="3">'.date_format(date_create($registro['sesion3']), 'H:i').'</option>';
				break;
			case '3':
				echo '<option value="1">'.date_format(date_create($registro['sesion1']), 'H:i').'</option>';
				echo '<option value="2">'.date_format(date_create($registro['sesion2']), 'H:i').'</option>';
				echo '<option value="3"selected>'.date_format(date_create($registro['sesion3']), 'H:i').'</option>';
				break;
		}
		echo '</select></td>
					<td><input type="text" name="fecha" value="'.date_format(date_create($regsesion['dia']),'d/m/Y').'" size="8"></td>
					<td><input type="submit" name="cambiarsesion" value="Cambiar sesi�n"></td>
							<input type="hidden" name="opcion" value="comprar">
							<input type="hidden" name="registro" value="'.$_REQUEST['registro'].'">
					</form></table></div>';
		// Rellenamos toda la matriz de asientos con 0
		$this->rellenarmatriz($registro['nume_filas'],$registro['nume_asientos']);
		// Seleccionamos los asientos del d�a y sesion espec�fica.
		$dia = date_format(date_create($regsesion['dia']),'Y-m-d');
		$sql = 'SELECT * FROM ejercicios.cine_entradas
						WHERE Id_cine='.$_REQUEST['registro'].'
						AND sesion='.$sesion.' AND dia="'.$dia.'"';
		$datos = @mysql_query($sql,$this->id_conexion) or	die("$sql".mysql_error());
		// marcamos en la matriz los asientos ocupados
		while($regsesiondia = mysql_fetch_array($datos)){
			$fila=$regsesiondia['fila'];
			$columna=$regsesiondia['asiento'];
			$this->cine[$fila][$columna]=1;
		}
		$this->mostrarmatriz($registro['nume_filas'],$registro['nume_asientos'],$registro['Id'],$sesion,$dia);
	}
	function rellenarmatriz($filas,$columnas){
		unset($this->cine);
		for($fila=1;$fila<=$filas;$fila++){
			for($columna=1;$columna<=$columnas;$columna++){
				$this->cine[$fila][$columna] = 0;
			}
		}	
	}
	function mostrarmatriz($filas,$columnas,$idcine,$sesion,$dia){
		echo "$filas,$columnas,$idcine,$sesion,$dia";
		echo '<div class="centrar">';
		echo '<h3>Pantalla</h3><hr class="titulo">';
		echo "<table>";
		for ($fila=1;$fila<=$filas;$fila++){
			echo "<tr>";
			for ($columna=1;$columna<=$columnas;$columna++){
				if($this->cine[$fila][$columna]==0)
					echo '<td class="verde"><a href="uni7_cines.php?opcion=cambiarestado
						&estado='.$this->cine[$fila][$columna].'
						&fila='.$fila.'
						&columna='.$columna.'
						&idcine='.$idcine.'
						&sesion='.$sesion.'
						&dia='.$dia.'
						">__</a></td>';
				else
					echo '<td class="rojo"><a href="uni7_cines.php?opcion=cambiarestado
						&estado='.$this->cine[$fila][$columna].'
						&fila='.$fila.'
						&columna='.$columna.'
						&idcine='.$idcine.'
						&sesion='.$sesion.'
						&dia='.$dia.'
						">__</a></td>';
			}
			echo "</tr>";
		}
		echo "</table></div>";
	}
	function cambiarestado(){
		if($_REQUEST['estado']==0){
			$sql = 'INSERT INTO cine_entradas VALUES(0,'.$_REQUEST['idcine'];
			
		}
	}
}
?>