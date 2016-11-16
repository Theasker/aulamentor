<?php
require('conection.php');
require('proyect_html.php');
require('proyect_controller.php');

$bd = conectaBD();
$discos = new discos($bd);

$scriptName = basename($_SERVER["SCRIPT_NAME"]);
session_start();
html::htmlInicio(); // doctype, head y style en el html

if (isset($_POST['Entrar'])){
	if(!empty($_POST['username']) && !empty($_POST['password'])){
		$login = $discos->login();
		switch ($login){
			case 'ok':
				$_SESSION['user'] = $_POST['username'];
				html::login($scriptName,"Entrar",'',true);
				html::showProducts($discos->productos(null),$_GET['orden'],null);
				break;
			case 'user':
				html::login($scriptName,"Entrar",'NO existe el usuario');
				break;
			case 'fail':
				html::login($scriptName,"Entrar",'Contraseña incorrecta');
				break;
		}
	}else{ // Usuario y/o contraseña vacío
		html::login($scriptName,"Entrar",'',false);
	}
}else if (isset($_POST['Registrar'])){ // Se ha pulsado el botón "Registrar"
	if(!$discos->checkUser()){ // Usuario que ya existe
		html::login($scriptName,"Registrar",'El usuario ya existe',false);
	}else if(!empty($_POST['username']) && !empty($_POST['password'])){ // Se han rellenado los campos
		$discos->register();
		$msg = 'Usuario "'.$_POST['username'].'" añadido a la base de datos.';
		html::login($scriptName,"Entrar",$msg,false);
	}else html::login($scriptName,"Registrar",'Usuario o contrasña vacío',false);
}else if(isset($_GET['action'])){
	if(isset($_SESSION['user'])){ // El usuario está logueado
		switch($_GET['action']){
			case 'cerrarSesion':
				$_SESSION = array();
				session_destroy();
				html::login($scriptName,"Entrar",'',false);
				break;
			case 'comprar':
				html::login($scriptName,"",'',true);
				$msg = array('tipo'=>'success','msg'=>'Producto añadido a la cesta.');
				$discos->comprar();
				html::showProducts($discos->productos('titulo'),$_GET['orden'],$msg);
				break;
			case 'carrito':
				html::login($scriptName,"",'',true);
				html::showCart($discos->cart());
				break;
			case 'finalizarCompra':
				break;
		} 
	}else{ // El usuario NO está logueado
		switch($_GET['action']){ 
			case 'registrar':
				html::login($scriptName,"Registrar",'',false);
				break;
			default:
				html::login($scriptName,"Entrar",'',false);
		}
	}
}else if(isset($_SESSION['user'])){ // Usuario logueado
	html::login($scriptName,"",'',true);
	if(isset($_GET['orden'])){ // Se ha pulsado ordenar por ...
		switch($_GET['orden']){
			case 'titulo':
				html::showProducts($discos->productos('titulo'),$_GET['orden'],null);
				break;
			case 'artista':
				html::showProducts($discos->productos('artista'),$_GET['orden'],null);
				break;
			case 'genero':
				html::showProducts($discos->productos('genero'),$_GET['orden'],null);
				break;
			case 'stock':
				html::showProducts($discos->productos('stock'),$_GET['orden'],null);
				break;
			case 'precio':
				html::showProducts($discos->productos('precio'),$_GET['orden'],null);
				break;
		}
	}else{
		html::showProducts($discos->productos(null),$_GET['orden'],null);
	}
}else{
	html::login($scriptName,"Entrar",'',false);
} 


//html::containerEnd();
echo '<div class="container">';
echo "SESSION<br>";
var_dump($_SESSION);
echo "GET<br>";
var_dump($_GET);
echo "POST<br>";
var_dump($_POST);
echo '</div>';


?>
