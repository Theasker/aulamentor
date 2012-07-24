<HTML>
<HEAD><TITLE>Curso PHP 5 - Unidad 7 - Ejemplo 5b</TITLE></HEAD>
<BODY>
<CENTER>
 
<?
   require("conexion.php");
   /* Recuperamos las variables globales de la conexión.*/
 
   $id_conexion =@mysql_connect($DBHost, $DBUser, $DBPass) or
               die("<H3>No se ha podido establecer la conexión.<P>
                       Compruebe si está activado el servidor de bases 
                       de datos MySQL.</H3>");
   /* Intentamos establecer una conexión con el servidor.*/
 
   if (! (mysql_select_db("biblioteca")))
      printf("<H3>No se ha podido seleccionar la base de datos
                  \"biblioteca\": <P>%s",'Error nº '.
                  mysql_errno().'.-'.mysql_error());
 
   $nombres_campos=array ( "Autor: ","Título: ","Editorial: ",
                                           "Año de edición: ","Páginas: ",
                                           "Precio en euros: ","Prestado: ",
                                           "Materia: ","ISBN: ","Resumen: ",
                                           "Notas: ","Registro: ");
 
   if ($_GET["tipo"]==1)  // Opción "Insertar un libro"
   {
      $consulta= "insert into libros values('Branchet, Bob',
                      'Microsoft SQL Server &.5','Prentice Hall',
                      '1997',648,70.75,'N','INF','84-98660-99-9',
                      'Buen manual','Algo antiguo',0)";
      $datos= @mysql_query($consulta,$id_conexion) or
           die("<H3>No se ha podido ejecutar la consulta.<P>
                    Compruebe si la sintaxis de la misma es 
                    correcta.</H3>");
      $id_insertar=mysql_insert_id($id_conexion);
      /* Así sabemos el número de identificador del registro 
          insertado, que es el valor que tenga este registro 
          en el campo "registro". */
 
      $filas=mysql_affected_rows($id_conexion);
      /* Así sabemos el número de filas afectadas, que es 1. */
 
      echo "<H3>Se ha insertado un libro cuyo registro
            lleva el número $id_insertar.<P>Al realizarse esta
            operación se han visto afactados $filas registros.<P>
            Éstos son sus datos:</H3>";
 
      $consulta= "select * from libros where registro=$id_insertar";
      /* Creamos nueva consulta con los datos del nuevo registro. */
 
      $datos= @mysql_query($consulta,$id_conexion) or
               die("<H3>No se ha podido ejecutar la consulta.<P>
                       Compruebe si la sintaxis de la misma es 
                       correcta.</H3>");
 
      $fila = mysql_fetch_array($datos);
      /* Mostramos los datos del registro insertado. */
      for ($i=0;$i<count($nombres_campos);$i++)
          print($nombres_campos[$i]."<B>".$fila[$i]."</B><P>");
 
   }
   elseif ($_GET["tipo"]==2)  /* Opción "Modificar la información del último
                         libro insertado" */
   {
      echo "<H3>Ahora modificamos las información del último
           registro insertado en la tabla \"libros\"</H3><P>";
      $consulta="select * from libros";
      $datos= @mysql_query($consulta,$id_conexion) or
              die("<H3>No se ha podido ejecutar la consulta.<P>
                    Compruebe si la sintaxis de la misma es 
                    correcta.</H3>");
      $filas=mysql_num_rows($datos);
      $regis=mysql_result($datos,$filas-1,"registro");
      /* Localizamos el valor del campo "registro" de la última fila
         de la consulta, que contendrá los datos del último registro. */
 
      $consulta="select * from libros where registro=$regis";
      $datos= @mysql_query($consulta,$id_conexion) or
              die("<H3>No se ha podido ejecutar la consulta.<P>
                   Compruebe si la sintaxis de la misma es correcta.
                   </H3>");
      $fila=mysql_fetch_array($datos);
      /* Seleccionamos los datos del último registro. */
 
      echo "<H4>El registro último sin haber sido modificado
           tiene estos datos:</H4><P>";
      /* Mostramos los datos del último registro antes 
            de modificarlo.*/
      for ($i=0;$i<count($nombres_campos);$i++)
          print($nombres_campos[$i]."<B>".$fila[$i]."</B><P>");
 
      echo "<H3>Una vez modificados algunos datos,
            la información del último registro queda así:
            </H3><P>";
 
      /* Modificamos algunos datos sobre los que tenía el registro
         original. */
      $consulta= "update libros set materia='OTR',
                        precio_euros=69.75,
                        resumen='Sólo para SQL Server',
                        notas='Manual completo' where registro=$regis";
      $datos= @mysql_query($consulta,$id_conexion) or
              die("<H3>No se ha podido ejecutar la consulta.<P>
                      Compruebe si la sintaxis de la misma es 
                      correcta.</H3>");
 
      /* Mostramos los datos del último registro una vez modificado. */   
      $consulta="select * from libros where registro=$regis";
      $datos= @mysql_query($consulta,$id_conexion) or
              die("<H3>No se ha podido ejecutar la consulta.<P>
                      Compruebe si la sintaxis de la misma es 
                      correcta.</H3>");
      $fila=mysql_fetch_array($datos);
      for ($i=0;$i<count($nombres_campos);$i++)
          print($nombres_campos[$i]."<B>".$fila[$i]."</B><P>");
 
   }
   elseif ($_GET["tipo"]==3)  // Opción "Eliminar el último libro insertado"
   {
      echo "<H3>Ahora eliminamos el último registro insertado
            en la tabla \"libros\"</H3><P>";
      $consulta="select * from libros";
      $datos= @mysql_query($consulta,$id_conexion) or
              die("<H3>No se ha podido ejecutar la consulta.<P>
                          Compruebe si la sintaxis de la misma es 
                          correcta.</H3>");
 
      $filas=mysql_num_rows($datos);
      $regis=mysql_result($datos,$filas-1,"registro");
      /* Localizamos el valor del campo "registro" de la última fila
         de la consulta, que contendrá los datos del último registro. */
 
      $consulta="select * from libros where registro=$regis";
      $datos= @mysql_query($consulta,$id_conexion) or
              die("<H3>No se ha podido ejecutar la consulta.<P>
                   Compruebe si la sintaxis de la misma es correcta.
                   </H3>");
 
      $consulta="delete from libros where registro=$regis";
      $datos= @mysql_query($consulta,$id_conexion) or
              die("<H3>No se ha podido ejecutar la consulta.<P>
                          Compruebe si la sintaxis de la misma es 
                          correcta.</H3>");
      /* Con la query anterior eliminamos el último registro. */
 
      echo "<H4>Se ha eliminado el registro número $regis de la 
                  tabla \"libros\".</H4><P>";
   }
   else   /* Opción Restablecer la base de datos biblioteca original" */
   {
      echo "<H2>Operaciones realizadas en la base de datos
                \"biblioteca\"</H2><P>";
      $consulta="select * from libros";
      $datos= @mysql_query($consulta,$id_conexion) or
              die("<H3>No se ha podido ejecutar la consulta.<P>
                    Compruebe si la sintaxis de la misma es 
                    correcta.</H3>");
     $filas_ante=mysql_num_rows($datos);
     $consulta="delete from libros";
     $datos= @mysql_query($consulta,$id_conexion) or
               die("<H3>No se ha podido ejecutar la consulta.<P>
                    Compruebe si la sintaxis de la misma es 
                    correcta.</H3>");
     $consulta="insert into libros select * from bis_libros";
     $datos= @mysql_query($consulta,$id_conexion) or
               die("<H3>No se ha podido ejecutar la consulta.<P>
                    Compruebe si la sintaxis de la misma es 
                    correcta.</H3>");
     $filas_poste=mysql_affected_rows($id_conexion);
     echo "<H3>Se han borrado $filas_ante registros de la 
             tabla \"libros\" <P>y se han insertado $filas_poste desde 
             la tabla \"bis_libros\", que contiene los datos originales.
             </H3><P>";
 
     $consulta="select * from usuarios";
      $datos= @mysql_query($consulta,$id_conexion) or
              die("<H3>No se ha podido ejecutar la consulta.<P>
                    Compruebe si la sintaxis de la misma es 
                    correcta.</H3>");
     $filas_ante=mysql_num_rows($datos);
     $consulta="delete from usuarios";
     $datos= @mysql_query($consulta,$id_conexion) or
               die("<H3>No se ha podido ejecutar la consulta.<P>
                    Compruebe si la sintaxis de la misma es 
                    correcta.</H3>");
     $consulta="insert into usuarios select * from bis_usuarios";
     $datos= @mysql_query($consulta,$id_conexion) or
               die("<H3>No se ha podido ejecutar la consulta.<P>
                    Compruebe si la sintaxis de la misma es 
                    correcta.</H3>");
     $filas_poste=mysql_affected_rows($id_conexion);
     echo "<H3>Se han borrado $filas_ante registros de la
          tabla \"usuarios\" <P>y se han insertado $filas_poste desde
          la tabla \"bis_usuarios\", que contiene los datos originales.
          </H3><P>";
 
      $consulta="select * from prestados";
      $datos= @mysql_query($consulta,$id_conexion) or
              die("<H3>No se ha podido ejecutar la consulta.<P>
                    Compruebe si la sintaxis de la misma es 
                    correcta.</H3>");
     $filas_ante=mysql_num_rows($datos);
     $consulta="delete from prestados";
     $datos= @mysql_query($consulta,$id_conexion) or
               die("<H3>No se ha podido ejecutar la consulta.<P>
                    Compruebe si la sintaxis de la misma es 
                    correcta.</H3>");
     $consulta="insert into prestados select * from bis_prestados";
     $datos= @mysql_query($consulta,$id_conexion) or
               die("<H3>No se ha podido ejecutar la consulta.<P>
                       Compruebe si la sintaxis de la misma es 
                       correcta.</H3>");
     $filas_poste=mysql_affected_rows($id_conexion);
     echo "<H3>Se han borrado $filas_ante registros de la 
            tabla \"prestados\" <P>y se han insertado $filas_poste 
            desde la tabla \"bis_prestados\", que contiene los datos 
            originales.</H3><P>";
      /* Contamos los registros de la tabla actual, borramos todos
         los registros que haya e insertamos los que hay en las 
         tablas bis_xxx, que son las originales del curso. */
   }
 
?>
<BR><INPUT type='button' value='<- Volver a la página anterior'onClick='history.back()'>
</CENTER>
</BODY>
</HTML> 