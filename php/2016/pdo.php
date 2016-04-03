<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<?php
	echo '<h1>Ejemplo MySQL</h1>';
	
	try {
    $mbd = new PDO('mysql:host=localhost;dbname=dbtest', 'root', 'Theasker');
    foreach($mbd->query('SELECT * from articulos') as $fila) {
        print_r($fila);
    }
    $mbd = null;
	} catch (PDOException $e) {
	    print "¡Error!: " . $e->getMessage() . "<br/>";
	    die();
	}
	
	
	
	/*
	
	// Conectamos con la base de datos
	// $mbd = new PDO('mysql:host=localhost;dbname=prueba', $usuario, $contraseña);
	$db = new PDO('mysql:host=localhost;dbname=dbtest;charset=utf8','root','Theasker');
	//$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	
	try{
		$stmt = $db->prepare("SELECT * FROM articulos WHERE pais=:mycountry");
		$stmt->execute( array(':mycountry' => 'Brazil') );
		$rows = $stmt>fetchAll(PDO::FETCH_ASSOC);
	}catch (PDOException $ex){
		echo "Ocurrió un error <br>";
		echo $ex->getMessage();
		exit;
	}
	
	var_dump($rows);
	
	echo '<ul>';
	foreach ($rows as $row){
		echo '<li>', $row['id'],' : (',$row['pais'],') ',$row['titulo'],'</li>';
	}
	echo '</ul>';
	*/
?>
</body>
</html>