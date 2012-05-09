<?php
function titulo(){
?> 
<center><div class="cabecera">Farmacia</div></center>
<br>
<?
}
function encabezados(){
?>
<center>
<table>
  <tr>
    <th class="a"><A href=uni4_farmacia.php?accion=ordenarmedicamento>Nombre medicamento</A></th>
    <th class="b"><A href=uni4_farmacia.php?accion=ordenarcantidad>Cantidad</A></th>
    <th class="b"><A href=uni4_farmacia.php?accion=ordenarimporte>Importe €</A></th>
    <th class="c">Operaciones</th>      
  </tr>
</center>
<?
}
function formularioagregar(){
?>
<form action="uni4_farmacia.php" method="post">
  <tr>
    <td><input type="text" name="nombre"></td>
    <td><input type="text" name="cantidad"></td>
    <td><input type="text" name="importe"></td>
    <td><INPUT type="submit" name="btnagregar" value="Añadir registro"></td>
  </tr>  
</form>
</table>
<?
}
function formulariobuscar(){
  ?>

<center>
  <p>
  <form action="uni4_farmacia.php" method="post">
    <hr>
    Buscar nombre
    <input type="text" name="buscar">
    <input type="submit" name="btnbuscar" value="¡Buscar!">
    <hr>
  </form>
  </p>
</center>

<?
}
?>