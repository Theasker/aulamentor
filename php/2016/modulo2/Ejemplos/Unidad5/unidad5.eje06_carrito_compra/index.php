﻿<?php
    // Iniciamos la sesión
	session_start();
	// Si el usuario indica un prodcuto distinto de vacío
	if ( (isset($_POST["producto"])) && (trim($_POST["producto"])!="") ){
		$encontrado=0;
		// Si la variable de sesión productosEnCesta no existe, la creamos
		if (!isset($_SESSION["productosEnCesta"])){
			// Definimos el elemento [procuto] dentro de la variable de sesión productosEnCesta
			// y como valor le asignamos la cantidad indicada por el comprador.
			$_SESSION["productosEnCesta"][$_POST["producto"]]=$_POST["cantidad"];
		} else {
			// Si ya existe la variable de sesión productosEnCesta, recorremos 
			// la matriz buscando el producto indicado para ver si existe ya.
			foreach($_SESSION["productosEnCesta"] as $k => $v){
				// Si el producto corresponde con $k entonces aumentamos la cantidad
				// e indicamos que hemos encontrado el producto en la lista para no crear
				// de nuevo el elemento "producto".
				if ($_POST["producto"]==$k){
					$_SESSION["productosEnCesta"][$k]+=$_POST["cantidad"];
					$encontrado=1;
				}
			} // end foreach
			// Si el producto no está ya en la lista, lo añadimos a la variable de sesión productosEnCesta
			if (!$encontrado) $_SESSION["productosEnCesta"][$_POST["producto"]]=$_POST["cantidad"];
		} // end else 
	} // end if (isset($_POST["producto"])
?>

<HTML><HEAD><TITLE>Ejemplo 6 - Unidad 5 - Curso Iniciación de PHP 5</TITLE></HEAD>
	<BODY bgcolor='#CCCCCC' link='blue' vlink='blue' alink='blue'>
	<TABLE border='0' align='center' cellspacing='3' cellpadding='3' width='600'>
		<TR>
		<TH colspan='2' width='100%' bgcolor='yellow'>&nbsp;
		<FONT size='6' color='black' face='arial, helvetica'>
			Carrito de la compra
		</FONT>&nbsp
		</TH>
		</TR>
	</TABLE><P>
	<CENTER>
	<H3>Introduce los productos que deseas comprar</H3><TT>

	<TABLE border='0' align='center' cellspacing='0' cellpadding='1' width='600'>
	<TR><TD colspan='2' width='100%' bgcolor='yellow'>
		<FORM action="<?=$_SERVER["PHP_SELF"]?>" method="post">
		<TABLE border='0' align='center' cellspacing='3' cellpadding='3' width='600'>
		<TR><TD width='100%' bgcolor='white'>		
			Dime el producto <input type="text" name="producto" size="20"></td>
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

// Si existe la variable de sesión productosEnCesta mostramos su contenido en una tabla
if (isset($_SESSION["productosEnCesta"])){
	echo'<P>El contenido de la cesta de la compra es:<br>';
	echo "<TABLE BORDER=\"0\" cellspacing=\"1\" cellpadding=\"1\" 
				align=\"center\" width=\"600\">
			 	<TR>
					<th bgcolor=\"yellow\"><FONT color=\"black\" face=\"arial, helvetica\">Artículo
						</FONT></th>
					<th bgcolor=\"yellow\"><FONT color=\"black\" face=\"arial, helvetica\">Cantidad
						</FONT></th>
				</TR>";	
	// Recorremos todos los elementos de la variable de sesión productosEnCesta (tipo matriz)
	foreach($_SESSION["productosEnCesta"] as $k => $v){
		echo "<TR><TD>".$k."</TD>
			<TD>".$v."</TD></TR>";		
	} // end bucle
	echo "</TABLE>";
}
?>

</TT>
</BODY>
</HTML>

