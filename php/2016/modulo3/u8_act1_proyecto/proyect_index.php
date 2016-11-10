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
				echo $_SESSION['user'],' se ha logueado correctamente';
				html::headerLogged();
				break;
			case 'user':
				html::login($scriptName,"Entrar",'NO existe el usuario');
				break;
			case 'fail':
				html::login($scriptName,"Entrar",'Contraseña incorrecta');
				break;
		}
	}
}else if (isset($_POST['Registrar'])){ // Se ha pulsado el botón "Registrar"
	if(!$discos->checkUser()){ // Usuario que ya existe
		html::login($scriptName,"Registrar",'El usuario ya existe');
	}else if(!empty($_POST['username']) && !empty($_POST['password'])){ // Se han rellenado los campos
		$discos->register();
		$msg = 'Usuario "'.$_POST['username'].'" añadido a la base de datos.';
		html::login($scriptName,"Entrar",$msg);
	}else html::login($scriptName,"Registrar",'Usuario o contrasña vacío');
}else if ($_GET['action'] == 'registrar'){
	html::login($scriptName,"Registrar",'');
}else html::login($scriptName,"Entrar",'');

echo '<div class="row">';
echo "GET<br>";
var_dump($_GET);
echo "POST<br>";
var_dump($_POST);
echo '</div>';

html::htmlFin();	
?>
