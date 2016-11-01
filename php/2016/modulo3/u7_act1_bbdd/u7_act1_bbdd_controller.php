<?php
class rutas{
	private $BD;
	private $dificultad = array("Baja","Media","Alta");
	
	public function __construct($BD){
		$this->BD = $BD;
		
		$this->crearBD();
		$this->crearTablas();
		
		//$this->insertarValoresRutas();
		//$this->insertarValoresComentarios();
		
		// Cargar directamente todo el fichero sql
		//$sql = file_get_contents('crea_bases.sql');
	
	}
	
	private function crearBD(){
		//echo '<script>alertify.log("Creando la base de datos...", type, wait);</script>';
		//echo '<script>alertify.log("Creando la base de datos...");</script>';
		//echo '<script>alertify.success("Success notification");</script>';
		//echo '<script>alertify.error("Error notification");</script>';
		$sql = "SET NAMES UTF8";
		if(!$this->BD->query($sql)){
			//echo '<script>alertify.log("','", type, wait);'
			$msg = "Error: ".$this->BD->errorInfo()[1]." -> ".$this->BD->errorInfo()[2];
			echo '<script>alertify.error("',$msg,'");</script>'; 
		}
		
		$sql= "CREATE DATABASE IF NOT EXISTS ejercicios";
		if(!$this->BD->query($sql)){
			$msg = "Error: ".$this->BD->errorInfo()[1]." -> ".$this->BD->errorInfo()[2];
			echo '<script>alertify.error("',$msg,'");</script>';
		}
	}
	private function crearTablas(){
		//echo '<script>alertify.log("Creando tablas...");</script>';
		$sql= "USE ejercicios";
		if(!$this->BD->query($sql)){
			$msg = "Error: ".$this->BD->errorInfo()[1]." -> ".$this->BD->errorInfo()[2];
			echo '<script>alertify.error("',$msg,'");</script>';
		}
		
		$sql= "CREATE TABLE IF NOT EXISTS rutas (
					  id int(11) NOT NULL auto_increment,
					  titulo varchar(55) NOT NULL DEFAULT '' ,
					  descripcion varchar(250) ,
					  desnivel int(6) UNSIGNED NOT NULL DEFAULT '0' ,
					  distancia double NOT NULL DEFAULT '0' ,
					  notas blob,
					  dificultad tinyint(1) unsigned NOT NULL DEFAULT '0' ,
					  PRIMARY KEY (id),
					  KEY titulo (titulo)
					) CHARACTER SET utf8 COLLATE utf8_general_ci;";
		if(!$this->BD->query($sql)){
			$msg = "Error: ".$this->BD->errorInfo()[1]." -> ".$this->BD->errorInfo()[2];
			echo '<script>alertify.error("',$msg,'");</script>';
		}
		
		$sql = "CREATE TABLE IF NOT EXISTS rutas_comentarios (
						  id tinyint(4) NOT NULL auto_increment,
						  id_ruta int(11) NOT NULL DEFAULT '0' ,
						  nombre varchar(50) NOT NULL DEFAULT '' ,
						  texto varchar(254) NOT NULL DEFAULT '' ,
						  fecha date NOT NULL DEFAULT '0000-00-00' ,
						  PRIMARY KEY (id),
						  KEY id_ruta (id_ruta)
						) CHARACTER SET utf8 COLLATE utf8_general_ci;";
		if(!$this->BD->query($sql)){
			$msg = "Error: ".$this->BD->errorInfo()[1]." -> ".$this->BD->errorInfo()[2];
			echo '<script>alertify.error("',$msg,'");</script>';
		}
	}
	private function insertarValoresRutas(){
		$sql = "INSERT INTO rutas VALUES('1','Cuerda Larga: puerto Navacerrada a Puerto la Morcuera','Cuerda Larga Desde el Puerto de Navacerrada al Puerto de la Morcuera, con sus 9 cumbres superiores a 2000 m.','1000','20.64','Las Montañas o Cumbres que conforman la Cuerda Larga ordenados de Oeste a Este son: 
- Bola del Mundo 2.258 m
- Alto de Valdemartin, 2.283 m
- Cabeza de Hierro Menor, 2.376 m 
- Cabeza de Hierro Mayor, 2.382 m
- Loma del Pandasco, 2.244 m
- Navahondilla, 2.234 m
- Asomate de Hoyos, 2.242 m
- Bailanderos, 2.133 m
- La Najarra, 2.120 m','2');";
		if(!$this->BD->query($sql)){
			$msg = "Error: ".$this->BD->errorInfo()[1]." -> ".$this->BD->errorInfo()[2];
			echo '<script>alertify.error("',$msg,'");</script>';
		}
		
		$sql = 'INSERT INTO rutas VALUES("2","De Barcelona a Valldoreix por Collserola","Ruta en bicicleta de montaña que cruza Collserola, sale de Barcelona por la carretera de Cerdanyola y nos deja en la estación de los FGC de Valldoreix","277","20.85","Estupenda ruta para empezar.","1")';
		if(!$this->BD->query($sql)){
			$msg = "Error: ".$this->BD->errorInfo()[1]." -> ".$this->BD->errorInfo()[2];
			echo '<script>alertify.error("',$msg,'");</script>';
		}
		
		$sql = 'INSERT INTO rutas VALUES("3","Los 4 puentes. ","Manzaneros. Ávila","538","43.29","Dehesa del Pinar (Dehesa \"de los perrillos\"), camino paralelo a la vía del tren, Castro de las Cogotas, Arco de Conejeros, Cardeñosa (1º puente), encinar (2º, 3º y 4º puente), La Alamedilla, Las porteras, Martiherrero, Dehesa de San Mateo, Ávila.","2");';
		if(!$this->BD->query($sql)){
			$msg = "Error: ".$this->BD->errorInfo()[1]." -> ".$this->BD->errorInfo()[2];
			echo '<script>alertify.error("',$msg,'");</script>';
		}
		
	}
	private function insertarValoresComentarios(){
		$sql = 'INSERT INTO rutas_comentarios VALUES("1","1","Pedro","¡Me ha encantado la ruta!","2014-06-23")';
		if(!$this->BD->query($sql)){
			$msg = "Error: ".$this->BD->errorInfo()[1]." -> ".$this->BD->errorInfo()[2];
			echo '<script>alertify.error("',$msg,'");</script>';
		}
		
		$sql = 'INSERT INTO rutas_comentarios VALUES("2","2","Irene","Gracias por la información.","2014-06-23")';
		if(!$this->BD->query($sql)){
			$msg = "Error: ".$this->BD->errorInfo()[1]." -> ".$this->BD->errorInfo()[2];
			echo '<script>alertify.error("',$msg,'");</script>';
		}
	}
	
	// Función que ejecuta una SQL
  private function ejecuta_SQL($sql) {
		$resultado=$this->BD->query($sql);
		if (!$resultado){
			echo"<H3>No se ha podido ejecutar la consulta: <PRE>$sql</PRE><P><U> Errores</U>: </H3><PRE>";
			print_r($this->BD->errorInfo());					
			die ("</PRE>");
		}
		return $resultado;
	} // end ejecuta_SQL
	
	public function datos(){
		$sql = "select * from rutas";
		return $this->ejecuta_SQl($sql);
	}
	
	public function newReg(){
		$tit = $_POST['titulo'];
	  $desc = $_POST['descripcion'];
	  $desnivel = (int)$_POST['desnivel'];
	  $distancia = (float)$_POST['distancia'];
	  $dif = (int)$_POST['dificultad'];
	  $notas = $_POST['notas'];
	  
		$sql = 'INSERT INTO rutas (titulo,descripcion,desnivel,distancia,dificultad,notas) 
						VALUES("'.$tit.'","'.$desc.'",'.$desnivel.','.$distancia.','.$dif.',"'.$notas.'")';
		$this->ejecuta_SQl($sql);
	}
	
	public function saveData(){
		$id = $_POST['id'];
		$tit = $_POST['titulo'];
	  $desc = $_POST['descripcion'];
	  $desnivel = (int)$_POST['desnivel'];
	  $distancia = (float)$_POST['distancia'];
	  $dif = (int)$_POST['dificultad'];
	  $notas = $_POST['notas'];
	  
		$sql = 'UPDATE rutas
						SET titulo="'.$tit.'",descripcion="'.$desc.'",desnivel='.$desnivel.',
								distancia='.$distancia.',dificultad='.$dif.',notas="'.$notas.'"
						WHERE id='.$id;
		$this->ejecuta_SQl($sql);
	}
	
	public function deleteReg(){
		$sql = 'DELETE FROM rutas WHERE id = '.$_GET['id'];
		$this->ejecuta_SQl($sql);
	}
	
	public function verReg(){
		$sql = 'SELECT * FROM rutas WHERE id = '.$_GET['id'];
		return $this->ejecuta_SQl($sql);
	}
	
	public function search(){
		$sql = 'SELECT * FROM rutas WHERE '.$_POST['tipoBusqueda'].' LIKE "%'.$_POST['buscartexto'].'%"';
		return $this->ejecuta_SQl($sql);
	}
	
	public function comments(){
		$sql = 'SELECT * FROM rutas_comentarios WHERE id_ruta = '.$_GET['id'];
		return $this->ejecuta_SQl($sql);
	}
	
	public function saveComment(){
		$id_ruta = $_POST['id'];
		$nombre = $_POST['nombre'];
	  $comentario = $_POST['comentario'];
	  $fecha = $_POST['fecha'];
	  
		$sql = 'INSERT INTO rutas_comentarios (id_ruta,nombre,texto,fecha)
						VALUES('.$id_ruta.',"'.$nombre.'","'.$comentario.'","'.$fecha.'")';
		$this->ejecuta_SQl($sql);
	}
}
?>
