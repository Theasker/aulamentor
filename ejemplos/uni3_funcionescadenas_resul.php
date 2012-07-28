<HTML>
<HEAD>
<TITLE>Curso PHP 5 - Unidad 3 - Ejemplo 1b</TITLE>
<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
</HEAD>
<BODY>
<?
/****** Enlace Adaptar las cadenas al contexto *******/
if ($_GET["tipo"]==1)
{
// Función addSlashes()

$consulta="WHERE nom = 'Ana'";
echo "<H1><CENTER>Función addSlashes()</H1></CENTER><P>";
echo "La variable <B>\$consulta</B> contiene la cadena <B>
        \"$consulta\"</B><P>";
$consulta=addSlashes($consulta);
echo "La instrucción<B> \"addSlashes(\$consulta)\"</B>
    devuelve la cadena <FONT size='3'><B>\"$consulta\"
    <P></FONT></B>";

// Función stripSlashes()

echo "<H1><CENTER>Función stripSlashes()</H1></CENTER><P>";
echo "La variable <B>\$consulta </B> contiene la cadena <B>
        \"$consulta\"</B><P>";
$consulta=stripSlashes($consulta);
echo "La instrucción<B> \"stripSlashes(\$consulta)\"</B>
     devuelve la cadena <FONT> <B> \"$consulta\"
     <P></FONT></B>";

// Función urlencode()

echo "<H1><CENTER>Función urlencode()</H1></CENTER><P>";
$a="< HREF = resultado?tipo=Esto es una frase";
echo "La variable <B> \$a </B> contiene la cadena <B> \"$a\"
        </B> <P>";
$b=urlencode($a);
echo "La instrución <B> urlencode(\$a)</B> devuelve la cadena
     <FONT size='3'><B> \"$b\"<P></FONT></B>";

// Función urldecode()

echo "<H1><CENTER>Función urldecode()</H1></CENTER><P>";
$c="SELECT+ALL+FROM+tabla+WHERE+nombre%3D%22JUANA%22";
echo "La variable <B> \$c </B> contiene la cadena <B> \"$c\"
        </B><P>";
$d=urldecode($c);
echo "La instrución <B> urldecode(\$c) </B> devuelve la cadena
     <FONT size='3'> <B> \"$d\"<P></FONT></B>";

// Función nl2br()

echo "<H1><CENTER>Función nl2br()</H1></CENTER><P>";
$frase="Primero \n Segundo \n Tercero";
echo "La variable <B> \$frase </B> contiene la cadena
        <B> \"$frase\" </B><P>";
echo "Sin aplicar salto de línea de tipo HTML se muestra:
        <P><B> \"$frase\"</B><P>";
$frase=nl2br($frase);
echo "Aplicando salto de línea de tipo HTML se muestra:
        <P><B> \"$frase\"</B><P>";

}

/****** Enlace Limpiar cadenas de caracteres ******/

elseif ($_GET["tipo"]==2)
{

// Función chop()

echo "<H1><CENTER>Función chop()</H1></CENTER><P>";
$f="La ciencia es un conjunto de verdades    \n  ";
echo "La variable <B> \$f </B> contiene la cadena:
    <B> \"$f&nbsp;&nbsp;&nbsp;&nbsp;\\n&nbsp;&nbsp;\"
    </B><P>";
$g=chop($f);
echo "La variable <B> \$f </B> contiene <B>".strlen($f).
    " </B> caracteres de los que <B>".(strlen($f)-strlen($g)).
    " </B> son espacios en blanco o saltos de línea.<P>";
echo "En cambio, si usamos la función chop(), la variable
    <B> \$f </B> contiene sólo <B>".strlen($g).
    " </B> caracteres.<P>";

// Función ltrim()

echo "<H1><CENTER>Función ltrim()</H1></CENTER><P>";
$h="     La ciencia es un conjunto de verdades";
echo "La variable <B> \$h </B> contiene la cadena <B> \"
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$h\" </B><P>";
$i=ltrim($h);

echo "La variable <B> \$h </B> contiene <B>".strlen($h).
    "</B> caracteres de los que <B>".(strlen($h)-strlen($i)).
    "</B> son espacios en blanco. <P>";
echo "En cambio, si usamos la función ltrim(), la variable
    <B> \$h </B> contiene sólo <B>".strlen($i)."</B> caracteres.
     <P>Ha perdido los espacios en blanco iniciales.<P>";

// Función trim()

echo "<H1><CENTER>Función trim()</H1></CENTER><P>";
$limpia="    casa    ";
$limpia1=trim($limpia);
echo "La variable <B> \$limpia </B> contiene la cadena <B> \"
     &nbsp;&nbsp;&nbsp;&nbsp;$limpia&nbsp;&nbsp;&nbsp;&nbsp;
         \" </B><P>";
echo "La variable <B> \$limpia</B> contiene <B>".
        strlen($limpia)."</B> caracteres de los que <B>"
          .(strlen($limpia)-strlen($limpia1))."</B> son
          espacios en blanco.<P>";
echo "En cambio, si usamos la función trim(), la variable <B>
        \$limpia </B> contiene sólo <B>".strlen($limpia1).
        "</B> caracteres. <P>Ha perdido los espacios en blanco
        iniciales y finales.<P>";

// Función strip_tags()

echo "<H1><CENTER>Función strip_tags()</H1></CENTER><P>";
$quita_html="<H1> Texto grande </H1> <B> Negrita </B> <P>";
$quita_html1=strip_tags($quita_html);
echo "La variable <B> \$quita_html </B> muestra la página
        $quita_html <P>al aplicarse los controles HTML que
        contiene <P>";
echo "En cambio, si usamos la función strip_tags(), la misma
        variable <B> \$quita_html </B> muestra la página
         <B> $quita_html1 </B><P>al haber eliminado esta
         función los controles HTML.";
}

/********* Enlace Mayúsculas y minúsculas ****************/

elseif ($_GET["tipo"]==3)
{

// Función strtoupper()

setlocale(LC_ALL,"spanish");
   // Fijamos las categorías para el entorno español.
echo "<H1><CENTER>Función strtoupper()</H1></CENTER><P>";
$m="Pepe";
echo "La variable <B> \$m </B> contiene <B> \"$m\"</B>.<P>";
echo "En cambio, si usamos la función strtoupper(), la
        variable <B> \$m </B> contiene <B>\"".strtoupper($m).
        "\".</B><P>";

// Función strtolower()

echo "<H1><CENTER>Función strtolower()</H1></CENTER><P>";
$M="PePE";
echo "La variable <B> \$M </B> contiene <B> \"$M\"</B>. <P>";
echo "En cambio, si usamos la función strtolower(), la variable
     <B> \$M </B>contiene <B>\"".strtolower($M)."\".</B><P>";

// Función ucfirst()

echo "<H1><CENTER>Función ucfirst()</H1></CENTER><P>";
$M_pal="diosa de la antigüedad egipcia";
echo "La variable <B> \$M_pal </B> contiene <B> \"$M_pal\"
        </B>.<P>";
echo "En cambio, si usamos la función ucwords(), la variable
        <B> \$M_pal </B> contiene <B>\"".ucfirst($M_pal)."\".
        </B><P>";

// Función ucwords()

echo "<H1><CENTER>Función ucwords()</H1></CENTER><P>";
$M_pal="diosa de la antigüedad egipcia";
echo "La variable <B> \$M_pal </B> contiene <B> \"$M_pal\"
        </B>.<P>";
echo "En cambio, si usamos la función ucwords(), la variable
        <B> \$M_pal </B>contiene <B>\"".ucwords($M_pal)."\".
        </B><P>";

}

/********* Enlace Longitud de una cadena *************/

elseif ($_GET["tipo"]==4)
{

// Función strlen()

echo "<H1><CENTER>Función strlen()</H1></CENTER><P>";
$M_pal="diosa de la antigüedad egipcia   ";
echo "La variable <B> \$M_pal </B> contiene la frase <B>
        \"$M_pal&nbsp;&nbsp;&nbsp;\"</B><P>";
echo "Usando la función strlen() sabemos que esta frase
        tiene <B>".strlen($M_pal)." </B> caracteres.
        Los tres últimos son espacios.<P>";
echo "En cambio, usando las funciones strlen(trim(\$M_pal))
        podemos saber que esta frase tiene <B>".
        strlen(trim($M_pal))." </B> caracteres. Los tres
        últimos espacios no se cuentan.<P>";

}

/******** Enlace Repetir y Modificar una cadena ********/

elseif ($_GET["tipo"]==5)
{

// Función str_repeat()

echo "<H1><CENTER>Función str_repeat()</H1></CENTER><P>";
$repe="diosa ";
echo "La variable <B> \$repe </B> contiene <B> \"$repe\"
        </B>.<P>";
echo "Si usamos la función str_repeat(), la variable <B>
        \$repe </B> genera esta pantalla sin poner salto
        de línea <B><P>".str_repeat($repe,3)."<P></B>";
$repe="<P>diosa";
echo "En cambio, si ponemos salto de línea, genera esta
        otra pantalla <B>".str_repeat($repe,3)."<P></B>";

// Función strtr()

echo "<H1><CENTER>Función strtr()</H1></CENTER><P>";
$cambia="Los días perdidos en verano";
echo "La variable <B> \$cambia </B> contiene <B> \"$cambia\"
        </B>. <P>";
echo "Usando la función strtr() cambiamos las as por us y las
        os por es.<B><P>\"".strtr($cambia,"ao","ue")."\"<P></B>";

}

/****** Enlace Buscar en el interior de una cadena *****/

elseif ($_GET["tipo"]==6)
{

// Funciones strcspn(), strspn(), strpos(),
//           strrpos(), strrchr() y strstr()

echo "<H1><CENTER>Función strcspn()</H1></CENTER><P>";
echo "La instrución <B> strcspn(\"La casa del león es
        la selva\",\"buena\") </B> devuelve <FONT size='3'><B>".
         strcspn("La casa del león es la selva","buena").
         ".<P></FONT></B>";

echo "<H1><CENTER>Función strspn()</H1></CENTER><P>";
echo "La instrución <B> strcspn(\"La casa del león es la
        selva\",\"La casa le\")</B> devuelve <FONT size='3'>
       <B>".strspn("La casa del león es la selva","La casa le").
         ".<P></FONT></B>";

echo "<H1><CENTER>Función strpos()</H1></CENTER><P>";
echo "La instrución <B> strpos(\"amigos para siempre, enemigos
        nunca\",\"gos\")</B> devuelve <FONT size='3'>
           <B>".strpos("amigos para siempre, enemigos nunca","gos").
         ".<P></FONT></B>";

echo "La instrución <B> strpos(\"amigos para siempre, enemigos
        nunca\",\"gos\",10)</B> devuelve <FONT size='3'>
          <B>".strpos("amigos para siempre, enemigos nunca","gos",10).
         ".<P></FONT></B>";

echo "<H1><CENTER>Función strrpos()</H1></CENTER><P>";
echo "La instrución <B> strrpos(\"amigos para siempre, enemigos
        nunca\",\"gos\")</B> devuelve <FONT size='3'>
           <B>".strrpos("amigos para siempre, enemigos nunca","gos").
         ".<P></FONT></B>";
echo "La instrución <B> strrpos(\"amigos para siempre, enemigos
        nunca\",\"gos\", -10)</B> devuelve <FONT size='3'>
           <B>".strrpos("amigos para siempre, enemigos nunca","gos", -10).
         ".<P></FONT></B>";

echo "<H1><CENTER>Función strrchr()</H1></CENTER><P>";
echo "La instrución <B> strrchr(\"amigos para siempre, enemigos
        nunca\",\"g\")</B> devuelve <FONT size='3'>
           <B>\"".strrchr("amigos para siempre, enemigos nunca","g").
         "\".<P></FONT></B>";

echo "<H1><CENTER>Función strstr()</H1></CENTER><P>";
echo "La instrución <B> strstr(\"amigos para siempre, enemigos
        nunca\",\"pre\")</B> devuelve <FONT size='3'>
           <B>\"".strstr("amigos para siempre, enemigos nunca","pre").
         "\".<P></FONT></B>";

}

/********* Enlace Trabajar con subcadenas ******************/

elseif ($_GET["tipo"]==7)
{

// Función substr()

echo "<H1><CENTER>Función substr()</H1></CENTER><P>";

echo "La instrucción <B>\"substr(\"Memorias de África\",3,4)\"
        devuelve: <FONT size='3'>\"".
        substr("Memorias de África",3,4)."\"<P></FONT></B>";

echo "La instrucción <B>\"substr(\"Memorias de África\",3)\"
        devuelve: <FONT size='3'>\"".
         substr("Memorias de África",3)."\"<P></FONT></B>";

echo "La instrucción <B>\"substr(\"Memorias de África\",-3)\"
        devuelve: <FONT size='3'>\"".
         substr("Memorias de África",-3)."\"<P></FONT></B>";

echo "La instrucción <B>\"substr(\"Memorias de África\",-5,4)\"
        devuelve: <FONT size='3'>\"".
         substr("Memorias de África",-5,4)."\"<P></FONT></B>";

// Función substr_replace()

echo "<H1><CENTER>Función substr_replace()</H1></CENTER><P>";

echo "La instrucción <B>\"substr_replace(\"Memorias de
        África\",\"en\",9,2)\" devuelve: <FONT size='3'>\"".
         substr_replace("Memorias de África","en",9,2).
         "\"<P></FONT></B>";

echo "La instrucción <B>\"substr_replace(\"Memorias de
        África\",\"l en\",-11,4)\" devuelve: <FONT size='3'>\"".
         substr_replace("Memorias de África","l en",-11,4).
         "\"<P></FONT></B>";

echo "La instrucción <B>\"substr_replace(\"Memorias de
        África\",\"Historia\",0,-7)\" devuelve: <FONT size='3'>\"".
         substr_replace("Memorias de África","Historia",0,-7).
         "\"<P></FONT></B>";

echo "La instrucción <B>\"substr_replace(\"Memorias de
        África\",\"Asia\",12)\" devuelve: <FONT size='3'>\"".
         substr_replace("Memorias de África","Asia",12).
         "\"<P></FONT></B>";

}

/******* Enlace Invertir el texto de una cadena *********/

elseif ($_GET["tipo"]==8)
{

// Función strrev()

echo "<H1><CENTER>Función strrev()</H1></CENTER><P>";

echo "La instrucción <B>\"strrev(\"paseo\")\" devuelve:
         <FONT size='3'>\"".strrev("paseo").
         "\"<P></FONT></B>";

echo "La instrucción <B>\"strrev(\"Los días perdidos\")\" devuelve:
        <FONT size='3'>\"".strrev("Los días perdidos").
         "\"<P></FONT></B>";

echo "La instrucción <B>\"strrev(\"Del salón en el ángulo
        oscuro...\")\" devuelve: <FONT size='3'>\"".
         strrev("Del salón en el ángulo oscuro...").
         "\"<P></FONT></B>";

}

/********* Enlace Separar una cadena de texto **************/

elseif ($_GET["tipo"]==9)
{

// Función strtok()

echo "<H1><CENTER>Función strtok()</H1></CENTER><P>";
$dicho="Dime con quién andas y te diré quién eres.";
echo "<H3><CENTER>Separamos la frase \"$dicho\" en palabras
        </H3></CENTER><P>";

$pal=strtok($dicho," ");
$i=0;

while ($pal)
{
      $frase[$i]="$pal";
      $i++;
      $pal=strtok(" ");
}
echo "<H4>";

for ($i=0;$i<count($frase);$i++)
{
    for ($j=0;$j<25;$j++)
         {echo "&nbsp";}
    echo "Palabra $i: ".$frase[$i]."<BR>";
}
echo "</H4>";

}

/********* Enlace pasar datos desde una cadena ************/

elseif ($_GET["tipo"]==10)
{

// Función parse_str()

$variables="nom=Nacho&ape1=Roa&ape2=Bastos";
echo "La variable <B>\"\$variables\"</B> contiene: $variables<P>";
parse_str($variables);
echo "Si separamos su contenido utilizando la instrucción <B>
    \"parse_str(\$variables)\"</B>, entonces obtenemos:<P>";
echo "\$nom = $nom<P>";
echo "\$ape1 = $ape1<P>";
echo "\$ape2 = $ape2";

}

/********* Enlace Comparar cadenas ******************/

elseif ($_GET["tipo"]==11)
{

// Función strcasecmp()

echo "<H1><CENTER>Función strcasecmp()</H1></CENTER><P>";

echo "La instrucción <B>\"strcasecmp(\"ABC\",\"abc\")\" devuelve:
     <FONT size='3'>".strcasecmp("ABC","abc")."<P></font'></B>";

echo "La instrucción <B>\"strcasecmp(\"CAB\",\"abc\")\" devuelve:
     <FONT size='3'>".strcasecmp("CAB","abc")."<P></FONT></B>";

echo "La instrucción <B>\"strcasecmp(\"ABC\",\"cab\")\" devuelve:
     <FONT size='3'>".strcasecmp("ABC","cab")."<P></FONT></B>";

// Función strcmp()

echo "<H1><CENTER>Función strcmp()</H1></CENTER><P>";

echo "La instrucción <B>\"strcmp(\"A\",\"A\")\" devuelve:
     <FONT size='3'>".strcmp("A","A")."<P></FONT></B>";

echo "La instrucción <B>\"strcmp(\"B\",\"A\")\" devuelve:
     <FONT size='3'>".strcmp("B","A")."<P></FONT></B>";

echo "La instrucción <B>\"strcmp(\"A\",\"B\")\" devuelve:
     <FONT size='3'>".strcmp("A","B")."<P></FONT></B>";

echo "La instrucción <B>\"strcmp(\"a\",\"A\")\" devuelve:
     <FONT size='3'>".strcmp("a","A")."<P></FONT></B>";

echo "La instrucción <B>\"strcmp(\"B\",\"a\")\" devuelve:
     <FONT size='3'>".strcmp("B","a")."<P></FONT></B>";

echo "La instrucción <B>\"strcmp(\"A\",\"b\")\" devuelve:
     <FONT size='3'>".strcmp("A","b")."<P></FONT></B>";

}

/********* Enlace Carácter ASCII ******************/

elseif ($_GET["tipo"]==12)
{

// Función chr()

echo "<H1><CENTER>Función chr()</H1></CENTER><P>";
for ($i=33;$i<123;$i++)
{ echo "La instrucción <B>\"chr($i)\" devuelve:
     <FONT size='3'>\"".chr($i)."\"<P></FONT></B>";
}

}

/********* Enlace Código ASCII ******************/

elseif ($_GET["tipo"]==13)
{

// Función ord()

echo "<H1><CENTER>Función ord()</H1></CENTER><P>";
for ($i=33;$i<123;$i++)
{ echo "La instrucción <B>\"ord(\"".chr($i)."\")\" devuelve:
     <FONT size='3'>".ord(chr($i))."<P></FONT></B>";
}

}

/********* Enlace Dar formato a un número **************/

elseif ($_GET["tipo"]==14)
{

// Función number_format()

echo "<H1><CENTER>Función number_format()</H1>
</CENTER><P>";

$numero=1234.5678;
$numero_formateado=number_format($numero,3,",",".");

echo "Si \$numero contiene $numero, la instrucción
        <B>\"number_format(\$numero, 3, \",\", \".\")\" </B>devuelve: <B>
         <FONT size='3'>".$numero_formateado."<P>
         </font size='3'></B>";
}
/********* Enlace Nuevas funciones PHP 5 **************/

elseif ($_GET["tipo"]==15)
{

// Función str_split()

echo "<H1><CENTER>Función str_split()</H1>
</CENTER><P>";

$cadena="Lo que el viento se llevó";
$matriz = str_split($cadena, 5);

echo "Si \$cadena contiene '$cadena', la instrucción
        <B>\"str_split(\$cadena, 5)\" </B>devuelve:
         <PRE>".print_r($matriz, true)."</PRE>";

// Función strpbrk()

echo "<H1><CENTER>Función strpbrk()</H1>
</CENTER><P>";

echo "Si \$cadena contiene '$cadena', la instrucción
        <B>\"strpbrk(\$cadena, 'vl')\" </B>devuelve: <B>
         <FONT size='3'>".strpbrk($cadena, 'vl')."<P>
         </font size='3'></B>";
}
else echo "ERROR en llamada a función";

echo  "<BR><CENTER><INPUT type='button' value='<- Volver a la página anterior'onClick='history.back()'></CENTER>";

?>
</BODY>
</HTML>