<?php
class notas {
  protected $id_conexion;
  protected $trimestre = array(1=>"Primero",2=>"Segundo",3=>"Tercero");
  public $resultadoinf; 
  
  function __construct(){
    $DBHost="localhost";
    $DBUser="root";
    $DBPass="";
    $this->id_conexion = @mysql_connect($DBHost, $DBUser, $DBPass) or
            die ("No se ha podidor realizar la conexiÃ³n a la BD");
    if (!mysql_select_db("ejercicios")) echo (mysql_errno().'.-'.mysql_error());
  }
  function __destruct(){
    if (isset($this->id_conexion)) mysql_close($this->id_conexion);
  }
  function mostrar(){
    echo '<table width="100%">
        <tr class="titulo">
          <td>Nombre</td><td>Trimestre</td><td>Asignaturas</td>
          <td>Horario</td><td>Nota (1-10)</td><td>Operaciones</td>
        </tr>';
    $query = "SELECT notas.id, notas.nombre, notas.trimestre, 
              notas_asignaturas.descripcion AS asignatura, notas.horario, notas.nota
              FROM notas INNER JOIN notas_asignaturas 
              ON notas.cod_asignatura = notas_asignaturas.id";
    $datos = @mysql_query($query, $this->id_conexion) or 
            die("No se ha podido realizar la consulta".mysql_error());
    while ($reg = mysql_fetch_array($datos)){
      // si hemos pulsado el boton editar entramos en el bucle
      if(isset($_REQUEST['opcion']) && ($_REQUEST['opcion'] == 'editar') 
              && ($_REQUEST['registro'] == $reg['id'])){
        $this->formulario_agregar_editar("editar",$reg['nombre'],$this->trimestre[$reg['trimestre']],
                $reg['asignatura'],$reg['horario'],$reg['nota']);
      }
      else{
        echo '<tr><td class="centrar">'.$reg['nombre'].'</td>';
        echo '<td class="centrar">'.$this->trimestre[$reg['trimestre']].'</td>';
        echo '<td class="centrar">'.$reg['asignatura'].'</td>';
        echo '<td class="centrar">'.$reg['horario'].'</td>';
        echo '<td class="derecha">'.$reg['nota'].'</td>';
        echo '<td class="centrar">
          <table><tr>
          <td class="boton"><a href="uni7_notas.php?opcion=editar&registro='.$reg['id'].'">Editar</a></td>
          <td class="boton"><a href="uni7_notas.php?opcion=borrar&registro='.$reg['id'].'">Borrar</a></td>
          </tr></table>
        </td></tr>';
      }
    }
    $this->formulario_agregar_editar("agregar","","","","","");
    echo '</table><br><hr>';
    echo '<div class="derecha">';
    echo '<table><tr>
          <td class="boton"><a href="uni7_notas.php?opcion=informes">Ir a informes</a></td>
          </tr></table>';
    echo '</div>';
  }
  // pasamos los parïámetros para poder reutilizar la funciï¿½n para agregar y para editar
  function formulario_agregar_editar($accion,$nom,$trim,$asig,$horario,$nota){
    echo '
      <tr>
      <form method="post" action="uni7_notas.php">
        <td class="centrar"><input type="text" name="nombre" value="'.$nom.'" size="27"></td>
        <td class="centrar"><select name="trimestre">';
    // rellenamos el campo de trimestres
    foreach($this->trimestre as $indice=>$elemento){
      if($elemento == $trim)
        echo '<option value="'.$elemento.'" selected>'.$elemento.'</option>';
      else echo '<option value="'.$elemento.'">'.$elemento.'</option>';
    }
    echo '</select></td>';    
    echo '<td class="centrar"><select name="asignatura">';
    // rellenamos el campo de asignaturas
    $query = 'select descripcion from notas_asignaturas';
    $datos = @mysql_query($query,$this->id_conexion) 
            or die("No se ha podido realizar la consulta".mysql_error());
    while ($reg = mysql_fetch_array($datos)){
      if($reg['descripcion'] == $asig){
        echo '<option value="'.$reg['descripcion'].'" selected>'.$reg['descripcion'].'</opcion>';
      }else
        echo '<option value="'.$reg['descripcion'].'">'.$reg['descripcion'].'</opcion>';
    }
    echo '</select></td>
      <td class="centrar"><input type="text" name="horario" value="'.$horario.'" size="7"></td>
      <td class="derecha"><input type="text" name="nota" value="'.$nota.'" size="1"></td>';
    echo '<td>';
    switch($accion){
      case 'editar':
      	echo '<center>';
        echo '<input type="submit" name="guardar" value="Guardar">';
        echo '<input type="hidden" name="opcion" value="guardar">';
        echo '<input type="hidden" name="registro" value="'.$_REQUEST['registro'].'">';
        echo '</form>';
        echo '</center>';
        break;
      case 'agregar':
      	echo '<center>';
        echo '<input type="submit" name="aï¿½adir" value="Aï¿½adir asiento">';
        echo '<input type="HIDDEN" name="opcion" value="agregar">';
        echo '</form>';
        echo '</center>';
        break;
    }
      echo '</td></tr>';
      
  }
  function agregar(){
    // buscamos el nÃºmero de trimestre introducido en textro
    foreach($this->trimestre as $indice=>$elemento){
      if($elemento==$_REQUEST['trimestre']) $trimestre = $indice;
    }
    $query = 'INSERT INTO notas VALUES (
            0,"'.
            $_REQUEST['nombre'].'","'.
            $_REQUEST['horario'].'",'.
            $trimestre.','.
            $this->codigo($_REQUEST['asignatura']).',"'.
            $_REQUEST['nota'].'")';
    $datos = @mysql_query($query, $this->id_conexion) or
            die("error en la consulta: $query por el error: ".mysql_error());
  }
  function codigo($asignatura){ // funcion que devuelve el codigo de asignatura
    $query = 'select notas_asignaturas.id from notas_asignaturas
              where notas_asignaturas.descripcion="'.$asignatura.'"';
    $datos = @mysql_query($query, $this->id_conexion) or
            die("error en la consulta: $query por el error: ".mysql_error());
    $reg = mysql_fetch_array($datos);
    return($reg['id']);
  }
  function borrar(){
    $query = 'delete from notas where notas.id = '.$_REQUEST['registro'];
    $datos = @mysql_query($query, $this->id_conexion) or
            die("error en la consulta: $query por el error: ".mysql_error());
  }
	function guardar(){
		// buscamos el número de trimestre introducido en textro
		foreach($this->trimestre as $indice=>$elemento){
			if($elemento==$_REQUEST['trimestre']) $trimestre = $indice;
		}
		$query = 'UPDATE notas SET notas.nombre = "'.$_REQUEST['nombre'].'",
							notas.horario = "'.$_REQUEST['horario'].'",
							notas.trimestre = '.$trimestre.',
							notas.cod_asignatura = '.$this->codigo($_REQUEST['asignatura']).',
							notas.nota = '.$_REQUEST['nota'].' WHERE notas.id = '.$_REQUEST['registro'];
		$datos = @mysql_query($query, $this->id_conexion) or
            die("error en guardado: $query por el error: ".mysql_error());
	}
	function informes(){
		echo '<table width="100%"><tr>
				<td class="informetipo" width="70%">Tipo de Informe</td>
				<td class="titulo" width="30%">Opciones</td></tr>';
		// 1. Listado de notas por asignatura y trimestre
		echo '<tr><td><strong>1. Listado de notas</strong></br>';
		echo '<form method="POST" action="uni7_notas.php">Asignatura ';
		$this->asignaturas();
		echo '</br>Trimestre ';
		$this->trimestres(); 
		echo '</td>';
		echo '<input type="hidden" name="opcion" value="inf_asig_trim">';
		echo '<td class="centrar"><input type="submit" name="ver" value="Ver"></form></td></tr>';
		echo '<tr><td><hr></td><td><hr></td></tr>';
		// 2. Listado de notas de un alumno
		echo '<tr><td><strong>2. Listado completo de notas de un alumno</strong></br>';
		echo '<form method="POST" action="uni7_notas.php">';
		echo 'Alumnos ';
		$this->alumnos();
		echo '</td>';
		echo '<input type="hidden" name="opcion" value="inf_alumno">';
		echo '<td class="centrar"><input type="submit" name="ver" value="Ver"></form></td></tr>';
		echo '<tr><td><hr></td><td><hr></td></tr>';
		// 3. Listado de la nota media de una asignatura.
		echo '<tr><td><strong>3. Listado de medias por asignatura</strong></br>';
		echo '<form method="POST" action="uni7_notas.php">Asignatura ';
		$this->asignaturas();
		echo '</td>';
		echo '<input type="hidden" name="opcion" value="inf_media_asig">';
		echo '<td class="centrar"><input type="submit" name="ver" value="Ver"></form></td></tr>';
		echo '<tr><td><hr></td><td><hr></td></tr>';
		// 4. Listado de nota media por alumno
		echo '<tr><td><strong>4. Listado de medias por alumno</strong></br>';
		echo '<form method="POST" action="uni7_notas.php">Alumnos ';
		$this->alumnos();
		echo '</td>';
		echo '<input type="hidden" name="opcion" value="inf_media_alum">';
		echo '<td class="centrar"><input type="submit" name="ver" value="Ver"></form></td></tr>';
		echo '</table><hr>';
		echo '<div>';
		echo "$this->resultadoinf</div>";
		echo '<div class="derecha">';
		echo '<table><tr>
          <td class="boton"><a href="uni7_notas.php">Ir a listado</a></td>
          </tr></table>';
		echo '</div>';
	}
	function inf_asig_trim(){
	// buscamos el nÃºmero de trimestre introducido en textro
    foreach($this->trimestre as $indice=>$elemento){
      if($elemento==$_REQUEST['trimestre']) $trimestre = $indice;
    }
    // Buscamos los registros de notas que corresponden 
    // a la asignatura y trimestre seleccionado
    $query = 'SELECT notas.nombre, notas.horario, notas.nota
    				FROM ejercicios.notas 
    				INNER JOIN ejercicios.notas_asignaturas 
    				ON notas_asignaturas.id = notas.cod_asignatura
    				WHERE notas_asignaturas.descripcion = "'.$_REQUEST['asignatura']. 
    				'" AND notas.trimestre = '.$trimestre;
    $datos = @mysql_query($query, $this->id_conexion) or
    					die("No se ha podido realizar la consulta $query:".mysql_error());
    $this->resultadoinf = '<table><tr><th>Nombre</th><th>Horario</th><th>Nota</th></tr>';
		while ($registro = mysql_fetch_array($datos)){
			$this->resultadoinf .= '<tr>';
			$this->resultadoinf .= '<td>'.$registro['nombre'].'</td>';
			$this->resultadoinf .= '<td>'.$registro['horario'].'</td>';
			$this->resultadoinf .= '<td>'.$registro['nota'].'</td>';
			$this->resultadoinf .= '</tr>';
		}
		$this->resultadoinf .= '</table>';
		$this->informes();
	}
	function inf_alumno(){
		$query = 'SELECT notas_asignaturas.descripcion, notas.trimestre, notas.nota
							FROM ejercicios.notas
							INNER JOIN ejercicios.notas_asignaturas
							ON notas.cod_asignatura = notas_asignaturas.id
							WHERE notas.nombre = "'.$_REQUEST['alumnos'].'"';
		$datos = @mysql_query($query, $this->id_conexion) or
							die("No se ha podido realizar la consulta $query:".mysql_error());
		$this->resultadoinf = '<table><tr><th>Asignatura</th><th>Trimestre</th><th>Nota</th></tr>';
		while ($registro = mysql_fetch_array($datos)){
			$this->resultadoinf .= '<tr>';
			$this->resultadoinf .= '<td>'.$registro['descripcion'].'</td>';
			$this->resultadoinf .= '<td>'.$this->trimestre[$registro['trimestre']].'</td>';
			$this->resultadoinf .= '<td>'.$registro['nota'].'</td>';
			$this->resultadoinf .= '</tr>';
		}
		$this->resultadoinf .= '</table>';
		$this->informes();
	}
	function inf_media_asig(){
		$query = 'SELECT notas.nombre, avg(notas.nota) AS media
							FROM ejercicios.notas
							INNER JOIN ejercicios.notas_asignaturas
							ON notas_asignaturas.id = notas.cod_asignatura
							WHERE notas_asignaturas.descripcion = "'.$_REQUEST['asignatura'].'"
							GROUP BY notas.nombre';
		$datos = @mysql_query($query, $this->id_conexion) or
		die("No se ha podido realizar la consulta $query:".mysql_error());
		$this->resultadoinf = '<table><tr><th>Nombre</th><th>Media</th></tr>';
		while ($registro = mysql_fetch_array($datos)){
			$this->resultadoinf .= '<tr>';
			$this->resultadoinf .= '<td>'.$registro['nombre'].'</td>';
			$this->resultadoinf .= '<td>'.$registro['media'].'</td>';
			$this->resultadoinf .= '</tr>';
		}
		$this->resultadoinf .= '</table>';
		$this->informes();
	}
	function inf_media_alum(){
		$query = 'SELECT notas_asignaturas.descripcion, avg(notas.nota) AS media
							FROM ejercicios.notas
							INNER JOIN ejercicios.notas_asignaturas
							ON notas_asignaturas.id = notas.cod_asignatura
							WHERE notas.nombre = "'.$_REQUEST['alumnos'].'"
							GROUP BY notas.cod_asignatura';
		$datos = @mysql_query($query, $this->id_conexion) or
		die("No se ha podido realizar la consulta $query:".mysql_error());
		$this->resultadoinf = '<table><tr><th>Asignatura</th><th>Media</th></tr>';
		while ($registro = mysql_fetch_array($datos)){
			$this->resultadoinf .= '<tr>';
			$this->resultadoinf .= '<td>'.$registro['descripcion'].'</td>';
			$this->resultadoinf .= '<td>'.$registro['media'].'</td>';
			$this->resultadoinf .= '</tr>';
		}
		$this->resultadoinf .= '</table>';
		$this->informes();
	}
	function asignaturas(){ // función para rellenar el campo de asignaturas
		$query = 'SELECT descripcion FROM ejercicios.notas_asignaturas';
		$datos = @mysql_query($query, $this->id_conexion) or
		die("No se ha podido realizar la consulta $query:".mysql_error());
		echo '<select name="asignatura">';
		while ($reg = mysql_fetch_array($datos)){
			echo '<option value="'.$reg['descripcion'].'">'.$reg['descripcion'].'</opcion>';
		}
		echo '</select>';
	}
	function trimestres(){// función para rellenar el campo de trimestres
		echo '<select name="trimestre">';
		foreach($this->trimestre as $indice=>$elemento){
			echo '<option value="'.$elemento.'">'.$elemento.'</option>';
		}
		echo '</select>';
	}
	function alumnos(){ // función para rellenar el combo de alumnos
		$query = 'SELECT notas.nombre FROM notas group by nombre;';
		$datos = @mysql_query($query, $this->id_conexion) or
			die("No se ha podido realizar la consulta $query:".mysql_error());
		echo '<select name="alumnos">';
		while ($reg = mysql_fetch_array($datos)){
			echo '<option value="'.$reg['nombre'].'">'.$reg['nombre'].'</opcion>';
		}
		echo '</select>';
	}
}

?>