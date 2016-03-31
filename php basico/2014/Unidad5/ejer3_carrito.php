<?php
var_dump($_REQUEST);
session_start();
if ( (isset($_POST["item"])) && ($_POST["item"]!="") ){
  $encontrado=0;
  if (!isset($_SESSION["itemsEnCesta"])){
    $_SESSION["itemsEnCesta"][$_POST["item"]]=$_POST["cantidad"];
  }else{
    foreach($_SESSION["itemsEnCesta"] as $indice => $v){
      if ($_POST["item"]==$indice){
        $_SESSION["itemsEnCesta"][$indice]+=$_POST["cantidad"];
        $encontrado=1;
      }
    }
    if (!$encontrado){
      $_SESSION["itemsEnCesta"][$_POST["item"]]=$_POST["cantidad"];
    }
  }
}
?>

<HTML><HEAD><TITLE>Curso PHP 5 - Unidad 5 - Ejercicio 3</TITLE></HEAD>
<BODY bgcolor='#CCCCCC' link='blue' vlink='blue' alink='blue'>
<TABLE border='0' align='center' cellspacing='3' cellpadding='3' width='600'>
  <TR>
  <TH colspan='2' width='100%' bgcolor='yellow'>&nbsp;
  <FONT color='black' face='arial, helvetica'>
        Carrito de la compra
  </FONT>&nbsp
  </TH>
  </TR>
</TABLE><P>
<CENTER>
<H4>Introduce los productos que deseas comprar</H4><TT>

<TABLE border='0' align='center' cellspacing='0' cellpadding='1' width='600'>
<TR><TD colspan='2' width='100%' bgcolor='yellow'>
  <FORM action="<?php=$_SERVER["PHP_SELF"]."?".SID?>" method="post">
  <TABLE border='0' align='center' cellspacing='3' cellpadding='3' width='600'>
  <TR><TD width='100%' bgcolor='white'>		
        Dime el producto <input type="text" name="item" size="20"></td>
      <TD rowspan='2' valign=middle>
        <input type="submit" value="Añadir a la cesta">
      </TD>
  </TR>
  <TR><TD bgcolor='white'>Cuántas unidades 
    <select name="cantidad" size="1">
      <option value="1" selected>1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
    </select></TD>
  </TR></TABLE></FORM>
</TD></TR></TABLE>
<?php
if (isset($_SESSION["itemsEnCesta"])){
  echo'<P>El contenido de la cesta de la compra es:<br>';
  echo "<TABLE BORDER=\"0\" cellspacing=\"1\" cellpadding=\"1\" align=\"center\" width=\"600\">
    <TR>
      <th>Artículo</th>
      <th>Cantidad</th>
    </TR>";	

  foreach($_SESSION["itemsEnCesta"] as $indice => $elemento){
    echo "<TR><TD>".$indice."</TD>
          <TD>".$elemento."</TD></TR>";		
  }
  echo "</TABLE>";
}
?>
</TT>
</BODY>
</HTML>