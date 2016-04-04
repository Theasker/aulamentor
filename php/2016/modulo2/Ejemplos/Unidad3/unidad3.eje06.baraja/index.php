<HTML>
<HEAD><TITLE>Ejemplo 6 - Unidad 3 - Curso Iniciación de PHP 5</TITLE></HEAD>
<BODY bgcolor="green">
<HR>
<H2 align="center"><FONT color="lime">El juego de la baraja
	</FONT></H2>
<HR>
<TABLE cellspacing=50><TR><TD valign=top><TABLE border=2>
<H3><FONT color="white">Operaciones con la baraja</FONT></H3>
<FORM name="form1" method="post" action="index.php">
    <TR align=center><TD><input type="submit" name="ver_baraja_ind_nume" value="Ver baraja con índices numéricos"></TD></TR>
    <TR align=center><TD><input type="submit" name="ver_baraja_ind_cad" value="Ver baraja con índices de cadena"></TD></TR>
    <TR align=center><TD><input type="submit" name="barajar" value="Barajar"></TD></TR>
    <TR align=center><TD><input type="submit" name="invertir_orden" value="Invertir orden de la baraja"></TD></TR>
    <TR align=center><TD><input type="submit" name="ordenar_por_cartas" value="Ordenar las cartas de la baraja"></TD></TR>
    <TR align=center><TD><input type="submit" name="repartir" value="Repartir la baraja a 5 jugadores"></TD></TR>
    <TR align=center><TD><input type="submit" name="recoger" value="Guardar la baraja"></TD></TR>
</FORM>
</TABLE></TD>
<?php
	include ("funciones.php");
	$palos = array(0=>"oros", 1=>"copas", 2=>"espadas", 3=>"bastos");
	$cartas = array(1=>"as", 2=>"dos", 3=>"tres", 4=>"cuatro", 5=>"cinco", 
			        6=>"seis", 7=>"siete", 8=>"ocho", 9=>"nueve",
					10=>"sota", 11=>"caballo", 12=>"rey");
	
	//creamos la matriz de la baraja con indices numéricos
	$la_baraja_ind_nume = array();
	for ($i=0;$i<sizeof($palos);$i++) {
		for ($j=1;$j<=sizeof($cartas);$j++){
			array_push($la_baraja_ind_nume, "<IMG src='imagenes/".$palos[$i]."_".$j.".jpg'>");
		}
	}
	
	//creamos la matriz de la baraja con indices de texto
	$la_baraja_ind_cad = array();
	for ($i=0;$i<sizeof($palos);$i++) {
		for ($j=1;$j<=sizeof($cartas);$j++){
			$indice=$cartas[$j][0].$palos[$i][0];
			$matriz_basu=array("$indice"=>"\n<IMG src='imagenes/".$palos[$i]."_".$j.".jpg'>");
			$la_baraja_ind_cad=array_merge ($la_baraja_ind_cad, $matriz_basu);
		}
	}
	
	/********** Aquí se inician las operaciones de la baraja *************/
	// Buscamos si se ha pulsado un determinado botón
	if (isset($_POST["ver_baraja_ind_nume"])) {
		echo "<H3><FONT color=\"white\">La baraja con índices numéricos contiene: </FONT></H3><P>";
		muestra_matriz($la_baraja_ind_nume);
	}
	if (isset($_POST["ver_baraja_ind_cad"])) {
		echo "<H3><FONT color=\"white\">La baraja con indices de cadena contiene: </FONT></H3><P>";
		muestra_matriz($la_baraja_ind_cad);
	}
	else if (isset($_POST["barajar"])) {
		echo "<H3><FONT color=\"white\">Barajando obtenemos: </FONT></H3><P>";
		shuffle ($la_baraja_ind_nume);
		
		//buscamos el as de copas
		for ($i=0;$i<sizeof($la_baraja_ind_nume);$i++) {
			if ($la_baraja_ind_nume[$i]=="as de copas"){
				echo "<P><FONT color=\"lime\">La carta \"as de copas\" <BR>ocupa la posición $i</FONT><P>";
				break;
			}
		}
		muestra_matriz($la_baraja_ind_nume);
	}
	else if (isset($_POST["invertir_orden"])) {
		echo "<H3><FONT color=\"white\">Invirtiendo el orden de la baraja tenemos: </FONT></H3><P>";
		krsort ($la_baraja_ind_nume);
		muestra_matriz($la_baraja_ind_nume);
	}
	else if (isset($_POST["ordenar_por_cartas"])) {
		echo "<H3><FONT color=\"white\">Ordenando por las cartas de la baraja tenemos: </FONT></H3><P>";
		sort ($la_baraja_ind_nume);
		muestra_matriz($la_baraja_ind_nume);
	}
	else if (isset($_POST["repartir"])) {
		echo "<H3><FONT color=\"white\">La ronda queda repartida así: </FONT></H3>";
		shuffle ($la_baraja_ind_nume);//primero barajamos
		
		for ($i=0;$i<sizeof($la_baraja_ind_nume);) {
			$j = $i / 4 + 1;
			echo "<P>El jugador $j tiene: <P>";
			muestra_matriz(array_slice ($la_baraja_ind_nume, $i, 4));
			$i+=4;
		}
	}
	
?>


</TR></TABLE>
</BODY>
</HTML>