<?
class monedero{
  protected $datos;
  protected $id_conexion;
  
  function __construct(){
    $DBHost="localhost";
    $DBUser="root";
    $DBPass="";
    $this->id_conexion = @mysql_connect($DBHost, $DBUser, $DBPass) or
            die ("No se ha podidor realizar la conexión a la BD");
    if (!mysql_select_db("ejercicios")) echo (mysql_errno().'.-'.mysql_error());
  }
  function __destruct(){
    if (isset($this->datos)) mysql_free_result($this->datos);
    if (isset($this->id_conexion)) mysql_close($this->id_conexion);    
  }
  function mostrar(){
    $query = "SELECT monedero.orden, monedero.fecha, monedero.importe, monedero.tipo_asiento, 
              codigos_asientos.descripcion as codigo, monedero.descripcion 
              FROM ejercicios.monedero
              INNER JOIN ejercicios.codigos_asientos ON
              monedero.cod_asiento =codigos_asientos.orden";
    $this->datos = @mysql_query($query, $this->id_conexion) or 
            die("No se ha podido realizar la consulta".mysql_error());
    encabezados();
    while($fila = mysql_fetch_array($this->datos)){
      echo "<tr>";
      $temp = explode("-", $fila['fecha']);
      echo "<td>$temp[2]/$temp[1]/$temp[0]</td>";      
      echo '<td class="dcha">'.number_format($fila['importe'], 2, ",",".")."</td>";
      echo '<td class="centrar">'.$fila['tipo_asiento']."</td>";
      echo "<td>".$fila['codigo']."</td>";
      echo "<td>".$fila['descripcion']."</td>";
      echo '<td><center>';
      echo '<table><tr>';
      echo '<td class="boton"><a href="uni7_monedero.php?opcion=editar&registro='.$fila['orden'].'">Editar</a></td>';
      echo '<td class="boton"><a href="uni7_monedero.php?opcion=borrar&registro='.$fila['orden'].'">Borrar</a></td>';
      echo "</tr></table></center>";
      echo "</td></tr>";
    }
    // Formulario para agregar registros
    ?>
    <tr>
    <form method="POST" action="uni7_monedero.php">
      <td><input type="text" name="fecha" size="10"></td>
      <td class="dcha"><input type="text" name="importe" size="8"></td>
      <td class="centrar">
        <select name="tipo">
          <option value="gasto">Gasto</option>
          <option value="ingreso">Ingreso</option>
        </select>
      </td>
      <td>
      <?php
      // Rellenamos el menú desplegable de Código de Asiento
      $query = "SELECT codigos_asientos.descripcion FROM ejercicios.codigos_asientos";
      $datos = mysql_query($query, $this->id_conexion);
      $datos = @mysql_query($query, $this->id_conexion) or 
            die("No se ha podido realizar la consulta".mysql_error());
      echo '<select name="codigo">';
      while($fila = mysql_fetch_array($datos)){
        echo '<option value="'.$fila['descripcion'].'">'.$fila['descripcion'].'</opcion>';
      }
      echo '</select>';
      ?>
      </td>
      <td><input type="text" name="descripcion" size="30%"></td>
      <td><center><input type="submit" name="añadir" value="Añadir asiento"></center></td>
    </form>
    </tr>
    <?php
    echo '<td></td><td></td><td></td><td></td><td></td>';
    echo '<td class="boton"><center><a href="uni7_monedero.php?opcion=informes">Acceso a Informes</a></center></td>';
    echo "</tr></table>";
  }
  function agregar(){
    $query = "SELECT monedero.orden, monedero.fecha, monedero.importe, monedero.tipo_asiento, 
              codigos_asientos.descripcion as codigo, monedero.descripcion 
              FROM ejercicios.monedero
              INNER JOIN ejercicios.codigos_asientos ON
              monedero.cod_asiento =codigos_asientos.orden";
    $this->datos = @mysql_query($query, $this->id_conexion) or 
            die("No se ha podido realizar la consulta".mysql_error());
  }
}
?> 