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
    var_dump($datos);
    while ($reg = mysql_fetch_array($datos)){
      echo '<tr><td class="centrar">'.$reg['nombre'].'</td>';
      echo '<td class="centrar">'.$this->trimestre[$reg['trimestre']].'</td>';
      echo '<td class="centrar">'.$reg['asignatura'].'</td>';
      echo '<td class="centrar">'.$reg['horario'].'</td>';
      echo '<td class="derecha">'.$reg['nota'].'</td>';
      
      echo '</tr>';
    }
  }
}

?>
