<?php
class monedero{
  protected $datos;
  protected $id_conexion;
  protected $resultadoinforme;
  
  function __construct(){
    $DBHost="localhost";
    $DBUser="root";
    $DBPass="";
    $this->id_conexion = @mysql_connect($DBHost, $DBUser, $DBPass) or
            die ("No se ha podidor realizar la conexión a la BD");
    if (!mysql_select_db("ejercicios")) echo (mysql_errno().'.-'.mysql_error());
  }
  function __destruct(){
    if (isset($this->datos)) @mysql_free_result($this->datos)
      or die("Se ha realizado una consulta INSERT o UPDATE");
    if (isset($this->id_conexion)) mysql_close($this->id_conexion);
    if (isset($query)) unset($query);
  }
  function mostrar(){
    $query = "SELECT monedero.orden, monedero.fecha, monedero.importe, monedero.tipo_asiento, 
              codigos_asientos.descripcion as codigo, monedero.descripcion 
              FROM ejercicios.monedero
              INNER JOIN ejercicios.codigos_asientos ON
              monedero.cod_asiento =codigos_asientos.orden";
    $this->datos = @mysql_query($query, $this->id_conexion) or 
            die("No se ha podido realizar la consulta".mysql_error());
    echo '<table width="100%">
        <tr class="encabezados">
          <td>Fecha</td><td>Importe (€)</td><td>Tipo</td>
          <td>Cod.Asiento</td><td>Descripicón</td><td>Operaciones</td>
        </tr>';
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
    $this->form_agregar("agregar","dd/mm/aaaa","","","","");
    echo '<td></td><td></td><td></td><td></td><td></td>';
    echo '<td class="boton"><center><a href="uni7_monedero.php?opcion=informes">Acceso a Informes</a></center></td>';
    echo "</tr></table>";
  }
  function form_agregar($accion,$fecha,$importe,$tipo,$codigo,$descripcion){ // Formulario para agregar registros
    echo '<tr>
          <form method="POST" action="uni7_monedero.php">';
    echo '<td><input type="text" name="fecha" value="'.$fecha.'" size="10" value=""></td>';
    echo '<td class="dcha"><input type="text" name="importe" value="'.$importe.'" size="8"></td>';
    echo '<td class="centrar">
        <select name="tipo">
          <option value="gasto">Gasto</option>
          <option value="ingreso">Ingreso</option>
        </select>
      </td><td>';
    // Rellenamos el menú desplegable de Código de Asiento
    $query = "SELECT codigos_asientos.descripcion FROM ejercicios.codigos_asientos";
    $datos = mysql_query($query, $this->id_conexion);
    $datos = @mysql_query($query, $this->id_conexion) or 
          die("No se ha podido realizar la consulta".mysql_error());
    echo '<select name="codigo">';
    while($fila2 = mysql_fetch_array($datos)){
      echo '<option value="'.$fila2['descripcion'].'">'.$fila2['descripcion'].'</opcion>';
    }
    echo '</select>';
    echo '</td>
          <td><input type="text" name="descripcion" value="'.$descripcion.'" size="30%"></td>';
    if($accion == 'agregar'){
      echo '<td><center><input type="submit" name="añadir" value="Añadir asiento"></center></td>
                        <input type="HIDDEN" name="opcion" value="agregar">';
    }elseif($accion == 'editar'){
      echo '<td><center><input type="submit" name="editar" value="Guardar"></center></td>
                        <input type="HIDDEN" name="opcion" value="guardar">
                        <input type="HIDDEN" name="registro" value="'.$_REQUEST['registro'].'">';
    }
    echo '</form></tr>';
  }
  function agregar(){
    // Comprobamos que la fecha introducida es correcta
    $temp = explode("/", $_REQUEST['fecha']);
    if (checkdate($temp[1], $temp[0], $temp[1])){
      $fecha = (int) $temp[2]."-".(int) $temp[1]."-".(int) $temp[0];
    }else die("la fecha es errónea");
    // buscamos en la tabla "codigos_asientos" el codigo introducido
    $query = 'SELECT codigos_asientos.orden FROM ejercicios.codigos_asientos
              WHERE codigos_asientos.descripcion = "'.$_REQUEST['codigo'].'"';
    $this->datos = mysql_query($query, $this->id_conexion);
    $fila = mysql_fetch_array($this->datos);
    $codigo = $fila['orden'];
    // Comprobamos que se han introducido un importe y una descripción
    if ($_REQUEST['importe'] == '') die("Hay que introducir un importe");
    if ($_REQUEST['descripcion'] == '') die("Hay que introducir una descripción");
    $query = 'INSERT INTO monedero VALUES
              (0,"'.$_REQUEST['descripcion'].'","'.$fecha.'",'.$_REQUEST['importe'].
              ',"'.$_REQUEST['tipo'].'",'.$codigo.')';
    $this->datos = @mysql_query($query, $this->id_conexion)
          or die("No se ha podido realizar la consulta $query") ;
  }
  function borrar(){
    $query = "DELETE FROM monedero WHERE monedero.orden=".$_REQUEST['registro'];
    $this->datos = @mysql_query($query, $this->id_conexion)
          or die("No se ha podido realizar la consulta $query") ;
  }
  function mostrar_para_editar(){
    $query = "SELECT monedero.orden, monedero.fecha, monedero.importe, monedero.tipo_asiento, 
              codigos_asientos.descripcion as codigo, monedero.descripcion 
              FROM ejercicios.monedero
              INNER JOIN ejercicios.codigos_asientos ON
              monedero.cod_asiento =codigos_asientos.orden";
    $this->datos = @mysql_query($query, $this->id_conexion) or 
            die("No se ha podido realizar la consulta".mysql_error());
    echo '<table width="100%">
        <tr class="encabezados">
          <td>Fecha</td><td>Importe (€)</td><td>Tipo</td>
          <td>Cod.Asiento</td><td>Descripicón</td><td>Operaciones</td>
        </tr>';
    while($fila = mysql_fetch_array($this->datos)){
      if($fila['orden'] == $_REQUEST['registro']){
        $temp = explode("-", $fila['fecha']);
        $fecha = "$temp[2]/$temp[1]/$temp[0]";
        $this->form_agregar("editar",$fecha,$fila['importe'],
                $fila['tipo_asiento'],$fila['codigo'],$fila['descripcion']);
      }else{
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
    }
    $this->form_agregar("agregar","dd/mm/aaaa","","","","");
    echo '<td></td><td></td><td></td><td></td><td></td>';
    echo '<td class="boton"><center><a href="uni7_monedero.php?opcion=informes">Acceso a Informes</a></center></td>';
    echo "</tr></table>";
  }
  function guardar(){
    //Comprobamos que la fecha es correcta
    $temp = explode("/", $_REQUEST['fecha']);
    if (checkdate($temp[1], $temp[0], $temp[1])){
      $fecha = (int) $temp[2]."-".(int) $temp[1]."-".(int) $temp[0];
    }else die("la fecha es errónea");
    // buscamos en la tabla "codigos_asientos" el codigo introducido
    $query = 'SELECT codigos_asientos.orden FROM ejercicios.codigos_asientos
              WHERE codigos_asientos.descripcion = "'.$_REQUEST['codigo'].'"';
    $this->datos = mysql_query($query, $this->id_conexion);
    $fila = mysql_fetch_array($this->datos);
    $codigo = $fila['orden'];
    // Comprobamos que se han introducido un importe y una descripción
    if ($_REQUEST['importe'] == '') die("Hay que introducir un importe");
    if ($_REQUEST['descripcion'] == '') die("Hay que introducir una descripción");
    $query = 'UPDATE monedero SET
              descripcion = "'.$_REQUEST['descripcion'].
              '", fecha = "'.$fecha.
              '", importe = '.$_REQUEST['importe'].
              ', tipo_asiento = "'.$_REQUEST['tipo'].
              '", cod_asiento = '.$codigo. 
              ' WHERE orden = '.$_REQUEST['registro'];
    $this->datos = @mysql_query($query, $this->id_conexion)
          or die("No se ha podido realizar la consulta $query") ;
  }
  function informes(){
    echo '<table width="500px">
        <tr class="encabezados">
          <td>Tipo de Informe</td>
          <td width="90px">Opciones</td>
        </tr>';
    echo '<tr><td>1. Saldo Global</td>';
    // 1. Saldo Global
    echo '<td class="centrar">
          <form method="POST" action="uni7_monedero.php">
          <input type="submit" name="calcularglobal" value="Calcular">
          <input type="hidden" name="opcion" value="calcularglobal"></form>
          </td></tr>';
    echo '<tr><td><hr></td><td><hr></td></tr>';
    // 2. Gasto entre 2 fechas
    echo '<tr><td><form method="POST" action="uni7_monedero.php">
          2. Gasto entre dos fechas.</br>
          Desde el día <input type="text" name="desde" value="dd/mm/aaaa" size="10"> hasta
          el día <input type="text" name="hasta" value="dd/mm/aaaa" size="10"></td>';
    echo '<td class="centrar"><input type="submit" name="calcularfechas" value="Calcular">
          <input type="hidden" name="opcion" value="calcularfechas"></form><td></tr>';
    echo '<tr><td><hr></td><td><hr></td></tr>';
    // 3. Ingresos por el código de asiento
    echo '<form method="post" action="uni7_monedero.php">';
    echo '<tr><td>3. Ingresos por el código de asiento ';
    $query = "SELECT codigos_asientos.descripcion FROM ejercicios.codigos_asientos";
    $datos = mysql_query($query, $this->id_conexion);
    $datos = @mysql_query($query, $this->id_conexion) or 
          die("No se ha podido realizar la consulta".mysql_error());
    echo '<select name="codigo">';
    while($fila2 = mysql_fetch_array($datos)){
      echo '<option value="'.$fila2['descripcion'].'">'.$fila2['descripcion'].'</opcion>';
    }
    echo '</select></td>';
    echo '<td class="centrar"><input type="submit" name="calcularingresoscodigo" value="Calcular">
          <input type="hidden" name="opcion" value="calcularingresoscodigo"></form><td></tr>';
    echo '<tr><td><hr></td><td><hr></td></tr>';
    // 3. Gastos por el código de asiento
    echo '<form method="post" action="uni7_monedero.php">';
    echo '<tr><td>4. Gastos por el código de asiento ';
    $query = "SELECT codigos_asientos.descripcion FROM ejercicios.codigos_asientos";
    $datos = mysql_query($query, $this->id_conexion);
    $datos = @mysql_query($query, $this->id_conexion) or 
          die("No se ha podido realizar la consulta".mysql_error());
    echo '<select name="codigo">';
    while($fila2 = mysql_fetch_array($datos)){
      echo '<option value="'.$fila2['descripcion'].'">'.$fila2['descripcion'].'</opcion>';
    }
    echo '</select></td>';
    echo '<td class="centrar"><input type="submit" name="calculargastoscodigo" value="Calcular">
          <input type="hidden" name="opcion" value="calculargastoscodigo"></form><td></tr>';
    echo '<tr><td><hr></td><td><hr></td></tr>';
    echo '<tr><td><b>'.$this->resultadoinforme.'</b></td>';
    echo '<td class="boton"><a href="uni7_monedero.php>Ir al listado</a></td></tr>';
  }
  function inf_calcularglobal(){
    $query = 'SELECT monedero.tipo_asiento, sum(monedero.importe) as saldo 
              FROM ejercicios.monedero
              group by monedero.tipo_asiento;';
    $datos = @mysql_query($query, $this->id_conexion) or 
            die("No se ha podido realizar la consulta".mysql_error());
    $saldo = 0;
    while($campo = mysql_fetch_array($datos)){
      switch ($campo['tipo_asiento']){
        case 'Ingreso':
          $saldo = $saldo + $campo['saldo'];
          break;
        case 'Gasto':
          $saldo = $saldo - $campo['saldo'];
          break;
      }
    }
    $this->resultadoinforme = "El saldo Global del monedero es: ".number_format($saldo, 2, ",", ".");
    $this->informes();
  }
  function inf_calcularfechas(){
    // Comprobamos que las 2 fechas son correctas
    $fecha1 = explode("/", $_REQUEST['desde']);
    $fecha2 = explode("/", $_REQUEST['hasta']);    
    if (checkdate($fecha1[1], $fecha1[0], $fecha1[1]) || checkdate($fecha2[1], $fecha2[0], $fecha2[1])){
      $desde = (int) $fecha1[2]."-".(int) $fecha1[1]."-".(int) $fecha1[0];
      $hasta = (int) $fecha2[2]."-".(int) $fecha2[1]."-".(int) $fecha2[0];
    }else die("la fecha es errónea");
    // Comprobamos que la fecha desde es <= que la fecha hasta.
    if (!($_REQUEST['desde'] <= $_REQUEST['hasta'])){
      $this->resultadoinforme = 'La fecha "desde" debe de ser menor o igual que la fecha "hasta"';
      $this->informes();
      exit(0);
    }
    $query = 'SELECT sum(monedero.importe) as saldogasto FROM ejercicios.monedero
              WHERE monedero.tipo_asiento = "Gasto" AND
              monedero.fecha >= "'.$desde.'" AND 
              monedero.fecha <= "'.$hasta.'";';
    $datos = @mysql_query($query, $this->id_conexion) or 
            die("No se ha podido realizar la consulta".mysql_error());
    $campo = mysql_fetch_array($datos);
    $this->resultadoinforme = 'El Gasto entre "'.$_REQUEST['desde'].'" y "'.
                              $_REQUEST['hasta'].'": '.number_format($campo['saldogasto'], 2, ",", ".");
    $this->informes();
  }
  function inf_calcularingresoscodigo(){
    $query = 'SELECT sum(monedero.importe) as ingresos FROM ejercicios.monedero
              INNER JOIN ejercicios.codigos_asientos ON
              codigos_asientos.orden = monedero.cod_asiento
              WHERE codigos_asientos.descripcion = "'.$_REQUEST['codigo'].'"
              AND monedero.tipo_asiento = "Ingreso";';
    $datos = @mysql_query($query, $this->id_conexion) or 
            die("No se ha podido realizar la consulta".mysql_error());
    $campo = mysql_fetch_array($datos);
    $this->resultadoinforme = 'Los Ingresos con el código "'.$_REQUEST['codigo'].
                              '" son: '.number_format($campo['ingresos'],2,",",".");
    $this->informes();    
  }
  function inf_calculargastoscodigo(){
    $query = 'SELECT sum(monedero.importe) as gastos FROM ejercicios.monedero
              INNER JOIN ejercicios.codigos_asientos ON
              codigos_asientos.orden = monedero.cod_asiento
              WHERE codigos_asientos.descripcion = "'.$_REQUEST['codigo'].'"
              AND monedero.tipo_asiento = "Gasto";';
    $datos = @mysql_query($query, $this->id_conexion) or 
            die("No se ha podido realizar la consulta".mysql_error());
    $campo = mysql_fetch_array($datos);
    $this->resultadoinforme = 'Los Gastos con el código "'.$_REQUEST['codigo'].
                              '" son: '.number_format($campo['gastos'],2,",",".");
    $this->informes();  
  }
}
?>