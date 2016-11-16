<?php
class discos{
	private $BD;
	private $salt = '$contraseña$';

	public function __construct($BD){
		$this->BD = $BD;

		// Cargar directamente todo el fichero sql
		$sql = file_get_contents('crea_bases.sql');
		$this->ejecuta_SQL($sql);
	}
	
	// Función que ejecuta una SQL
  private function ejecuta_SQL($sql) {
		$resultado = $this->BD->query($sql);
		if (!$resultado){
			echo"<H3>No se ha podido ejecutar la consulta: <PRE>$sql</PRE><P><U> Errores</U>: </H3><PRE>";
			print_r($this->BD->errorInfo());					
			die ("</PRE>");
		}
		return $resultado;
	} // end ejecuta_SQL
	
	private function preparaSQL($sql,$params){
	  $stmt = $this->BD->prepare($sql);
	  //echo '<br><br><br><br>';
	  //var_dump($stmt);
	  if($params){
	  	$resultado = $stmt->execute($params);
	  }else{
	  	$resultado = $stmt->execute();
	  }
	  if (!$resultado){
			echo"<H3>No se ha podido ejecutar la consulta: <PRE>$sql</PRE><P><U> Errores</U>: </H3><PRE>";
			print_r($stmt->errorInfo());					
			echo "</PRE>";
			return false;
		}else {
	  	return $stmt->fetchAll();
	  }
	}
	
	public function login(){
		// http://pabletoreto.blogspot.com.es/2015/04/login-php-con-hash-de-password.html
		$sql = 'SELECT * FROM clientes WHERE user = :username';

		$params = array(':username' => $_POST['username']);
		$resultado = $this->preparaSQL($sql,$params);
		
		/*
		echo '<div style="margin-top:50px;">';
		var_dump($params);
		var_dump($resultado);
		echo '</div>';
		*/
		
		if(count($resultado)){
			$res = $resultado[0];
			
			if(hash_equals($res['password'],crypt($_POST['password'],$this->salt))){
				return "ok";
			}else return "fail";
		}else return "user";
	}
	
	public function checkUser(){
		// Comprobamos si existe el usuario
		$sql = 'SELECT * FROM clientes WHERE user = :username';

		echo "comprobando usuario";
		$params = array(':username' => $_POST['username']);
		$resultado = $this->preparaSQL($sql,$params);

		if(count($resultado)){ // Ya existe el usuario
			return false;
		}else return true;
	}
	
	public function register(){
		$pass = crypt($_POST['password'],$this->salt);
		$sql = 'INSERT INTO clientes (user,password) VALUES (:user,:password)';
		
		$params = array(':user' => $_POST['username'],':password' => $pass);
		$resultado = $this->preparaSQL($sql,$params);
	}
	
	public function productos($orden){
		if(!$orden){
			$orden = 'id';
		}
		$sql = 'SELECT * FROM productos ORDER BY '.$orden;
		return $this->preparaSQL($sql,null);
	}
	
	public function comprar(){
		$id = $_GET['id'];
		$usuario = $_SESSION['user'];
		
		if (isset($_SESSION[$usuario][$id])){
			$_SESSION[$usuario][$id] = $_SESSION[$usuario][$id] + 1;
		}else{
			$_SESSION[$usuario][$id] = 1;
		}
	}
	
	public function finalizarCompra(){
		if($this->checkStock($id)){ // Stock > 0
			
		}else{ // Stock < 0
			return false;
		}
	}
	
	private function checkStock($id){
		$sql = 'SELECT stock FROM productos WHERE id = '.$id;
		$cont = $this->preparaSQL($sql,null);
		//echo '<br><br><br><br>';
		//var_dump($cont[0]['stock']);
		if($cont[0]['stock']>0){ // Hay stock y restamos uno
			// UPDATE equipos SET anio_fundacion = anio_fundacion + 2, anotaciones = "No hay anotaciones";
			$sql = 'UPDATE productos SET stock = :stock WHERE id = '.$id;
			$params = array(':stock'=>$cont[0]['stock']-1);
			$this->preparaSQL($sql,$params);
			return true; //mal
		}else{
			return false;
		}
	}
	
	public function cart(){
		$prod = $_SESSION[$_SESSION['user']];
		$prodIds = implode(',',$prod);
		$sql = 'SELECT * FROM productos WHERE id IN ('.$prodIds.')';
		return $this->preparaSQL($sql,null);
	}
}
?>