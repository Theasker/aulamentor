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
	
	public function endBuy(){
		$user = $_SESSION['user'];
		$cart = $this->cart();
		// variable en la que almaceno los resultados de la resta de stocks si se ha podido o no restar.
		$done = array();
		foreach($cart as $line){
			$id = $line['id'];
			// Comprobamos si hay suficiente stock en el producto
			if($line['stock']>=$_SESSION[$user][$id]){ // Hay suficiente stock en el producto 
				$sql = $sql.'UPDATE productos SET stock = (stock - :cantidad) WHERE id = '.$id.";\n";
				$params = array(':cantidad'=>$_SESSION[$user][$id]);
				//$this->preparaSQL($sql,$params);
				$done[$id] = true;
			}else{ // No hay stock suficiente
				$done[$id] = false;
			}
		}
		return $this->order($cart,$done);
	}
	
	private function order($cart,$done){
		/*
		CREATE TABLE IF NOT EXISTS pedidos (
		  id int(4) NOT NULL auto_increment,
		  id_cliente int(4) NOT NULL,
		  fecha date NOT NULL DEFAULT '0000-00-00' ,
		  PRIMARY KEY (id),
		  KEY id_cliente (id_cliente),
		  FOREIGN KEY (id_cliente) REFERENCES clientes(id)
		) CHARACTER SET utf8 COLLATE utf8_general_ci;
		*/
		// Buscamos el id del cliente
		$sql = 'SELECT id FROM clientes WHERE user = "'.$_SESSION['user'].'"';
		$id_client = $this->preparaSQL($sql,null);
		$id_client = (int)$id_client[0]['id'];
		// Fecha de hoy
		$now = getdate();
		$date = $now['year'].'-'.$now['mon'].'-'.$now['mday'];
		// Buscamos el último registro de la tabla pedidos para saber el nuevo 'id'
		$sql = 'SELECT id FROM pedidos ORDER BY id DESC LIMIT 1';
		$resultado = $this->preparaSQL($sql,null);
		$id_pedido = (int)$resultado[0]['id'] + 1;

		// Agregamos la entrada en la tabla de pedidos
		$sql = 'INSERT INTO pedidos (id,id_cliente,fecha) VALUES(:id,:cliente,:fecha)';
		$params = array(':id'=>$id_pedido,':cliente'=>$id_client,':fecha'=>$date);
		$this->preparaSQL($sql,$params);

		/*
		CREATE TABLE IF NOT EXISTS lineas_pedidos (
		  id int(4) NOT NULL auto_increment,
		  id_pedido int(4) NOT NULL,
		  id_producto int(4) NOT NULL,
		  cantidad int(3) UNSIGNED NOT NULL DEFAULT '0' ,
		  precio double NOT NULL DEFAULT '0' ,
		  PRIMARY KEY (id),
		  KEY id_pedido (id_pedido),
		  KEY id_producto (id_producto),
		  FOREIGN KEY (id_pedido) REFERENCES pedidos(id),
		  FOREIGN KEY (id_producto) REFERENCES productos(id)
		) CHARACTER SET utf8 COLLATE utf8_general_ci;
		*/
		$user = $_SESSION['user'];
		foreach($cart as $reg){
			// Comprobamos si había stock en el array guardado
			$id = (int)$reg['id'];
			if ($done[$id]){ // Hay stock
				$sql = 'INSERT INTO lineas_pedidos (id_pedido,id_producto,cantidad,precio)
								VALUES (:id_pedido,:id_producto,:cantidad,:precio)';
				$params = array(
					':id_pedido'=>$id_pedido,
					':id_producto'=>$reg['id'],
					':cantidad'=>$_SESSION[$user][$id],
					':precio'=>$reg['precio']);
				$this->preparaSQL($sql,$params);
			}
		}
		return $done;
	}
	
	// Devuelve los registros de los productos de la cesta de la compra
	public function cart(){
		// Guardamos las claves del array que son las id de los productos
		$prod = array_keys($_SESSION[$_SESSION['user']]); 
		$prodIds = implode(',',$prod);
		$sql = 'SELECT * FROM productos WHERE id IN ('.$prodIds.')';
		return $this->preparaSQL($sql,null);
	}
	
	// Vacía la cesta de la compra
	public function cleanCart(){
		$user = $_SESSION['user'];
		unset($_SESSION[$user]);
	}
	
	// visualización de los pedidos
	public function pedidos(){
		$cliente = $_SESSION['user'];
		$sql = 'SELECT * FROM clientes WHERE user = "'.$cliente.'"';
		$resultado = $this->preparaSQL($sql,null);
		$id_cliente = (int)$resultado[0]['id'];
		
		$sql = 'SELECT pedidos.id_cliente,pedidos.id,pedidos.fecha,SUM(precio) AS sumPrecio 
						FROM pedidos 
						INNER JOIN lineas_pedidos ON pedidos.id = lineas_pedidos.id_pedido
						INNER JOIN clientes ON clientes.id = pedidos.id_cliente
						WHERE clientes.id = '.$id_cliente.
						' GROUP BY pedidos.id';
		$resultado = $this->preparaSQL($sql,null);
		return $resultado;
	}
	
	public function verPedido(){
		$sql = 'SELECT lineas_pedidos.*,productos.titulo,productos.artista FROM lineas_pedidos 
						INNER JOIN productos 
						ON lineas_pedidos.id_producto = productos.id
						WHERE lineas_pedidos.id_pedido = '.$_GET['id'];
		$resultado = $this->preparaSQL($sql,null);
		
		return $resultado;
	}
}
?>