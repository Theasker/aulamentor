<?
$resultadoStr="";

if (isset($_POST["validar"])) {
  header("Cache-Control: no-cahe, must-revalidate");
  header("Refresh: 1; URL=".$_SERVER["PHP_SELF"]);
  setcookie("usuario", $_POST["tu_nombre"], time()+300);
  setcookie("password", $_POST["tu_password"], time()+300);
  $resultadoStr .= "En breve la página se actualizará 
          y mostrará los datos guardados en la cookie.<P>
          <FONT color=blue>¡Espere un momento!</FONT><P>";        
} 
elseif(isset($_POST["borrarcookie"])){
  header("Cache-Control: no-cahe, must-revalidate");
  header("Refresh: 1; URL=".$_SERVER["PHP_SELF"]);
  setcookie("usuario");
  $resultadoStr .= "¡La cookie ha sido borrada! <P>En breve 
          la página se actualizará y podrá volver a validarse.<P>
          <FONT color=blue>¡Espere un momento!";
}elseif(isset($_COOKIE["usuario"]) && $_COOKIE["usuario"]!=""){
  $resultadoStr .= "Hola, ".$_COOKIE["usuario"].". Bienvenido a nuestra página web.
            <P>La cookie <B>usuario</B> tiene el valor <B>".
            $_COOKIE["usuario"]."</B><P>La cookie <B>password</B> tiene 
            el valor <B>".$_COOKIE["password"]."</B><P>
            <FORM ACTION='ejer1.php' METHOD=POST>
              <INPUT TYPE='submit' VALUE='Borrar cookie' name='borrarcookie'>
          </FORM>";
}
else{
  $resultadoStr = "Por favor, introduzca los datos para 
          acceder a la página siguiente
          <FORM ACTION='ejer1.php' METHOD=POST>
          <TABLE border=0 cellspacing=10><TR>
              <TD>
              <FONT color=green>Nombre de usuario:</FONT>
              </TD><TD>
              <INPUT TYPE='text' NAME='tu_nombre'>
              </TD></TR>
          <TR><TD>
              <FONT color=green>Password de usuario:</FONT>
          </TD><TD>
              <INPUT TYPE='text' NAME='tu_password'>
          </TD><TD></TABLE><P>
          <INPUT TYPE='submit' VALUE='Validar usuario' name='validar'>
      </FORM>"
  .$resultadoStr;
}
echo "<HTML><HEAD><TITLE>Curso PHP 5 - Unidad 5 - Ejercicio 1</TITLE></HEAD>
        <BODY bgcolor='#C0C0C0' link='blue' vlink='blue' alink='blue'>
        <TABLE border='0' align='center' cellspacing='3' cellpadding='3' width='600'>
        <TR>
            <TH colspan='2' width='100%' bgcolor='green'>
                &nbsp;<FONT size='6' color='white' face='arial, helvetica'>
                Validar usuario</FONT>&nbsp
            </TH>
    
        </TR></TABLE><P>            
        <CENTER><FONT color=green>$resultadoStr</FONT> 
        </BODY>
    </HTML>";
?> 