<?php
function encabezado1(){
  ?>
  <table width="100%">
    <tr>
      <td bgcolor="#00FF01">
          <center><font face="Arial" color="#00807E" size=+3><b>Biblioteca</b></font></center>
      </td>
    </tr>
  </table>
<?php
}
function resumen1($primer_resumen){
  ?>
  <table width="100%">
    <tr>
      <td>
        <center>
          <?echo $primer_resumen."<br>";?>
        </center>
      </td>
    </tr>
  </table>
<?php
}
function encabezadosmatriz(){
  ?>
  <table width="100%">
    <tr>
      <td bgcolor="#00FF01" align="center">
        <font face="Arial" color="#00807E">
          <u><b>Autor</b></u>
        </font>
      </td>
      <td bgcolor="#00FF01" align="center">
        <font face="Arial" color="#00807E">
          <u><b>Título</b></u>
        </font>
      </td>
      <td bgcolor="#00FF01" align="center">
        <font face="Arial" color="#00807E">
          <u><b>Editorial</b></u>
        </font>
      </td>
      <td bgcolor="#00FF01" align="center">
        <font face="Arial" color="#00807E">
          <u><b>Operaciones</b></u>
        </font>
      </td>
    </tr>
  
  <?php
}
function formularioagregar(){
  ?>
    <form method="post" action="uni4_biblioteca.php">
      <tr>
        <td>
          <input type="text" name="Autor">
        </td>
        <td>
          <input type="text" name="Titulo">
        </td>
        <td>
          <input type="text" name="Editorial">
        </td>
        <td>
          <input type="submit" name="btnagregar" value="Añadir libro">
        </td>
      </tr>
    </form>
  </table><hr><p>
  <center>
    <form method="post" action="uni4_biblioteca.php">
      Buscar libro
      <input type="text" name="buscar">
      <input type="submit" name="btnbuscar" value="¡Buscar!">
      <input type="hidden" name="mostrado" value="si">
    </form>
  </center>
  <br><hr>
  <?php
}
function pie(){
  ?>
  <table border=1 bgcolor="white" width="145px">
    <tr>
      <td><A href=uni4_biblioteca.php?accion=mostrar>Ver listado completo</A></td>
    </tr>
  </table>
  <?php
 
}
?>