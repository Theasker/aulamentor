<?php
function titulo(){
?> 
<center><div class="cabecera">Diccionario</div></center>
<br>
<?
}
function encabezados(){
?>
<center>
<table>
  <tr>
    <th class="a"><A href=uni4_diccionario.php?accion=ordenarpalabra>Palabra</A></th>
    <th class="a"><A href=uni4_diccionario.php?accion=ordenartraduccion>Traducción</A></th>
    <th class="b">Operaciones</th>      
  </tr>
</center>
<?
}
function formularioagregar(){
?>
<form action="uni4_diccionario.php" method="post">
  <tr>
    <td><input type="text" name="palabra"></td>
    <td><input type="text" name="traduccion"></td>
    <td><INPUT type="submit" name="btnagregar" value="Añadir registro"></td>
  </tr>  
</form>
</table>
<?
}
function formulariobuscar(){
  ?>
<div class="c">
<center>
  <form action="uni4_diccionario.php" method="post">
    <hr>
    Buscar palabra o traducción
    <input type="text" name="buscar">
    <input type="submit" name="btnbuscar" value="¡Buscar!">
    <hr>
  </form>
</center>
</div>
<?
}
?>