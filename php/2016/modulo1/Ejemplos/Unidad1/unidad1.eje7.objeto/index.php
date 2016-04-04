<HTML>
<HEAD><TITLE>Ejemplo 7 - Unidad 1 - Curso Iniciación de PHP 5</TITLE></HEAD>

<BODY>

<?php
  //Indicamos inicio de definición de objeto con class	
  class Contactos
  {
        //Definimos las variables que almacena la clase
        public $nombre;
        public $apellido;
        public $profesion;
        public $edad;
        public $importe;
        //Función para introducir datos
        function completa($nom,$ape,$pro,$eda,$impor)
        {
          $this->nombre=$nom;
          $this->apellido=$ape;
          $this->profesion=$pro;
          $this->edad=$eda;
          $this->importe=$impor;
        }
  }

  
  //Creamos una instancia nueva de la clase "Contactos"
  $contacto = new Contactos;
  
  //Introducimos los datos de un contacto
  $contacto->completa("María","Pérez Mas","médico",35,"350.000");

  //Imprimimos los datos por pantalla
  echo "<H3><CENTER>Hemos creado el objeto \$contacto y a sus
       propiedades les hemos asignado estos datos:</H3></CENTER><P>";
  echo "Nombre: <B>$contacto->nombre</B><P>";
  echo "Apellidos: <B>$contacto->apellido</B><P>";
  echo "Profesión: <B>$contacto->profesion</B><P>";
  echo "Edad: <B>$contacto->edad</B><P>";
  echo "Importe: <B>$contacto->importe</B><P>";
  
?>


</BODY>
</HTML>

