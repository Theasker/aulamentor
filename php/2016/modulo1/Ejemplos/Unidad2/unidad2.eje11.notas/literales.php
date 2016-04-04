<?php
//Aquí van los literales
define ("asignatura1","Matemáticas");
define ("asignatura2","Lengua");
define ("asignatura3","Inglés");
define ("asignatura4","Historia");
define ("asignatura5","Arte");

function la_nota($calificacion)
{
	if ($calificacion=="") return "ERROR calificación";
	elseif (($calificacion>=0) && ($calificacion<=2)) return "Muy deficiente";
	elseif (($calificacion>2) && ($calificacion<5)) return "Insuficiente";
	elseif (($calificacion>=5) && ($calificacion<6)) return "Suficiente";
	elseif (($calificacion>=6) && ($calificacion<7)) return "Bien";
	elseif (($calificacion>=7) && ($calificacion<=8)) return "Notable";
	elseif (($calificacion>8) && ($calificacion<=10)) return "Sobresaliente";
	else return "ERROR calificación";
}
?>

