<?php
class notas {
  protected $id_conexion;
  protected $trimestre = array(1=>"Primero",2=>"Segundo",3=>"Tercero");
  
  function __construct(){
    $DBHost="localhost";
    $DBUser="root";
    $DBPass="";
    $this->id_conexion = @mysql_connect($DBHost, $DBUser, $DBPass) or
            die ("No se ha podidor realizar la conexión a la BD");
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
  }
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
        echo '<input type="submit" name="guardar" value="Guardar">';
        echo '<input type="hidden" name="opcion" value="guardar">';
        echo '<input type="hidden" name="registro" value="'.$_REQUEST['registro'].'">';        
        break;
      case 'agregar':
        echo '<input type="submit" name="añadir" value="Añadir asiento">';
        echo '<input type="HIDDEN" name="opcion" value="agregar">';
        break;
    }
      echo '</td></tr>';
      
  }
  function agregar(){
    // buscamos el número de trimestre introducido en textro
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
}

?>