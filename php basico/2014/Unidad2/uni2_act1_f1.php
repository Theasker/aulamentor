<html>
  <head>
    <title>
      Actividad obligatoria. Unidad 2.
      Equipos ganadores de la NBA
    </title>
  </head>
  <body BGCOLOR="003399" text="white">
    <center>
      <br><hr>
      <img alt="logoF1.gif" src="logoF1.gif">
      <h1>FÓRMULA 1</h1><hr><br>
      <form action="uni2_act1_f1_resultado.php" method="POST">
        Seleccione el piloto que desea consultar:
        <SELECT NAME="piloto">
          <?php
          //cargamos el combo con los datos del array
          //que ya tenemos para no tener que rellenarlo a mano.
          require "uni2_act1_f1_matrices.php";
          foreach ($matriz_pilotos as $elemento=>$indice){
            echo "<OPTION>$elemento</OPTION>";
          }
          ?>
        </SELECT>
        <INPUT TYPE=submit NAME=boton VALUE="Buscar">
      </form>
    </center>
  </body>
</html>