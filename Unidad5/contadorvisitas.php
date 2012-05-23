<?
setlocale(LC_ALL,"spanish");
$fecha_nueva=strftime("%A, %d de %B de %Y %H:%M:%S");

if (isset($_COOKIE["contador"]))   
{
    $_COOKIE["contador"]++;   //aumentamos la cuenta en 1
    $fecha_ultima = "La última vez que nos visitó fue el ". $_COOKIE["fecha"];
    SetCookie("fecha",$fecha_nueva, time()+3600000);
    SetCookie("contador",$_COOKIE["contador"], time()+3600000); 
    $contador=$_COOKIE["contador"];
}
else  //si el cookie no existe lo creamos
{        
    $fecha_ultima = "Ésta es la primera vez que nos visita";
    SetCookie("fecha",$fecha_nueva, time()+3600000);
    SetCookie("contador",1, time()+3600000); 
    $contador=1;
}


?>
<HTML><HEAD><TITLE>Curso PHP 5 - Unidad 5 - Ejercicio 2</TITLE></HEAD>
<BODY bgcolor="#C0C0C0" link="blue" vlink="blue" alink="blue">
<?
echo "<P><TABLE border='0' align='center' cellspacing='3' 
            cellpadding='3' width='600'>
    <TR>
        <TH colspan='2' width='100%' bgcolor='blue'>&nbsp;
          <FONT size='2' color='white' face='arial, helvetica'>
                Usted ha visitado esta página ". $contador .
                " veces.<P>".$fecha_ultima .
          "</FONT>&nbsp
        </TH>
    </TR></TABLE>";
?>
</BODY>
</HTML>