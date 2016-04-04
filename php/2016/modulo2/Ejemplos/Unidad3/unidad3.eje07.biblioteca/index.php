<HTML>
<HEAD><TITLE>Ejemplo 7 - Unidad 3 - Curso Iniciación de PHP 5</TITLE></HEAD>
<BODY>

<?php

// Definimos la clase que vamos a utilizar después como un objeto
class biblioteca {
		
	function biblioteca () //Esto es el constructor
    {
        $this->los_datos=array(); // Matriz con todos los registros
    }
   
	// Añadir un registro a la lista
	function add_registro($titulo, $autor, $editorial) {
		$dato = array("titulo"=>$titulo, "autor"=>$autor, "editorial"=>$editorial);
		array_push($this->los_datos, $dato);
	} // end add_registros

	// Método que muestra los registros
	function mostrar()
	{
		echo "<table border=1 ALIGN=center CELLPACING=7 width=400><td>Título</td><td>Autor</td><td>Editorial</td>";
		// ¡Ojo! Como la matriz empieza en el elemento 0, entonces hay que hacer bucle de 0 a nº elementos -1 
		//  (de ahí que usaemos el operador "<".
		// Fíjate que para acceder a la matriz de este objeto hay que usar la estructura $this->nombre_propiedad
		for ($i=0;$i<sizeof($this->los_datos);$i++) 
		{	
		echo "
			<tr>
				<td ALIGN=center>".$this->los_datos[$i]["titulo"]."</td>
				<td ALIGN=right>".$this->los_datos[$i]["autor"]."</td>
				<td ALIGN=right>".$this->los_datos[$i]["editorial"]."</td>
			</tr>";    
		} // end for
		echo "</table>";	
	} //end mostrar
	
	// Aquí irían el resto de métodos de la clase
	
} //end clase


// Ahora usamos el objeto.
// Ten en cuenta que el código anterior se puede escribir en otro fichero php separado y después usar "require" 
// para añadir esa parte del código en el script principal.

// Creamos el objeto a partir de la clase
$la_biblioteca=new biblioteca();
// Añadimos registros
$la_biblioteca->add_registro("El médico", "Noah Gordon", "Time Warner");
$la_biblioteca->add_registro("Marina", "Carlos Ruíz Zafón", "Edebé");
$la_biblioteca->add_registro("El Quijote", "Miguel de Cervantes y Saavedra", "Varios");
// Mostramos los registros
$la_biblioteca->mostrar();


?>

</BODY>
</HTML>