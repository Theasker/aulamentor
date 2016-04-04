<?php

	function muestra_matriz($matriz){
		$resultado = "<TD><TABLE border=1><TR><TD><B>Indice</B></TD><TD width=150><B>Carta</B></TD></TR>";
		while (list($indice,$valor)=each($matriz))
		{    
			$resultado .= "<TR><TD><B>$indice</B></TD><TD><B>$valor</B></TD></TR>";
		}
		
		$resultado .= "</TABLE></TD>";
		echo $resultado;
	}
	
?>

