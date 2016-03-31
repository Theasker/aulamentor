<html>
  <head>
    <title>
      Actividad obligatoria. Unidad 2.
      Equipos ganadores de la NBA
    </title>
  </head>
  <body BGCOLOR="#66CBFF">
    <center>
      <br><hr><h1>Equipos ganadores de la NBA</h1><hr><br>
      <form action="uni2_act2_resultado.php" method="POST">
        Seleccione el equipo que desea consultar:
        <SELECT NAME="equipos">
          <?php
          //cargamos el combo con los datos del array
          //que ya tenemos para no tener que rellenarlo a mano.
          require "uni2_act2_arrayequipos.php";
          foreach ($matriz_equipos as $elemento=>$indice){
            echo "<OPTION>$elemento</OPTION>";
          }
          ?>
        </SELECT>
        <INPUT TYPE=submit NAME=boton VALUE="Buscar">
      </form>
    </center>
    <DIV align="right">
      <br><br><br><br>
      NBA es una marca registrada de NBA Media Ventures, LLC 
    </DIV>
  </body>
</html>