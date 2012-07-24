<html>
  <head>
    <title>
      Actividad 2 obligatoria. Unidad 2.
      Tabla periódica de elementos
    </title>
  </head>
  <body BGCOLOR="003399" text="white">
    <center>
      <br><hr>
      <img alt="" src="http://olivo.mentor.mec.es/cursophp/iniciacion/ejercicios_tutor_mesa_2008/unidad2/tabla_periodica/imagen.jpg">
      <br><h1>Tabla Periódica de los Elementos</h1><hr>
      <form action="uni2_act2_tabla_resultado.php" method="POST">
        <p>Seleccione grupo que desea consultar:
        <SELECT NAME="grupos">
          <?
          //cargamos el combo con los datos del array
          //que ya tenemos para no tener que rellenarlo a mano.
          require "uni2_act2_tabla_matrices.php";
          foreach ($matriz_elementos as $elemento=>$indice){
            echo "<OPTION>$elemento</OPTION>";
          }
          ?>
        </SELECT></p>
        <INPUT TYPE=submit NAME=boton VALUE="Buscar">
      </form>
    </center>
  </body>
</html>