<?php
class html{
	
	static function htmlInicio(){
?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Unicad 5 - Activadad 1 - Entradas de Cine</title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="bootstrap-theme.min.css">
	<script src="jquery-1.12.4.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="bootstrap.min.js"></script>
	<style>
		body{background-color: #fff;;font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;font-size: 14px;color: #333;line-height: 1.42857143;padding-top: 20px;padding-bottom: 20px;}
		.centrado{width:800px; margin: 0 auto;}
		.titulo{margin-top: 15px; padding: 5px;}
		input{width: 200px }
		#new{width: 600px;margin: 0 auto; }
		.navbar {margin-bottom: 20px;}
	</style>
</head>
<body>
<?php
	}
	static function htmlFin(){
		?>
		</body>
		</html>
		<?php
	}
	
	static function login($scriptName,$typeLogin,$mesage,$logged){
		?>
		<!-- Static navbar -->
		<div class="navbar navbar-inverse navbar-fixed-top">
		    <div class="container">
	        <div class="navbar-header">
	          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <a class="navbar-brand" href="#">Discos Theasker</a>
	        </div>
	        <center>
	          <div class="navbar-collapse collapse" id="navbar-main">
	            <ul class="nav navbar-nav">
	              <li class="active"><a href="<?=$scriptName?>">Discos</a></li>
	              <li><a href="<?=$scriptName?>?action=misPedidos">Mis pedidos</a></li>
	            </ul>
	            <?php
	            if(!$logged){ // Si aun no se ha logueado
	            	?>
	            	<form class="navbar-form navbar-right" role="search" action='<?=$scriptName?>' method="POST">
		            	<span class="label label-danger"><?=$mesage?></span>
		              <div class="form-group">
		                <input type="text" id="username" class="form-control" name="username" placeholder="Usuario">
		              </div>
		              <div class="form-group">
		                <input type="password" id="password" class="form-control" name="password" placeholder="Contraseña">
		              </div>
		              <button type="submit" class="btn btn-default" name="<?=$typeLogin?>" value="<?=$typeLogin?>"><?=$typeLogin?></button>
		              <?php
		              	if($typeLogin == "Entrar"){
		              		echo '<a class="btn btn-default" href="./'.$scriptName.'?action=registrar">Registrar</a>';
		              	}
		              ?>
		            </form>
	            	<?php
	            }else{
	            	?>
	            	<ul class="nav navbar-nav pull-right">
	            		<li>
	            			<?php
	            			// Número de productos comprados en el navbar
	            			$user = $_SESSION['user'];
	            			if (isset($_SESSION[$user])){
	            				$cont = 0;
	            				foreach($_SESSION[$user] as $prod){
	            					$cont = $cont + $prod;
	            				}
	            				echo '<a href="',$scriptName,'?action=carrito">Hay <b>',$cont,'</b> productos en el carrito</a>';
	            			}
	            			?>
									<li><a href="<?=$scriptName?>?action=cerrarSesion">Cerrar sesión de <?=$_SESSION['user']?></a></li>
								</ul>
	            	<?php
	            }
	            ?>
	          </div>
	        </center>
		    </div>
		</div>
		<br>
		<br>
		<br>
		<br>
	
	<?php
	}
	
	static function showProducts($products,$orden,$msg){
		?>
		<div class="container">
			<?php
			if($msg){
				echo '<div class="alert alert-',$msg['tipo'],'"><strong>Aviso: </strong>',$msg['msg'],'</div>';
			}
			?>
			<table class="table table-condensed border table-hover table-bordered table-fixed no-margin">
				<tr>
					<th class="col-md-3 default text-center">
						<a href="<?=$scriptName?>?orden=titulo">Título</a></th>
					<th class="col-md-3 default text-center">
						<a href="<?=$scriptName?>?orden=artista">Artista</a></th>
					<th class="col-md-2 default text-center">
						<a href="<?=$scriptName?>?orden=genero">Género</a></th>
					<th class="col-md-1 default text-center">
						<a href="<?=$scriptName?>?orden=stock">Stock</a></th>
					<th class="col-md-1 default text-center">
						<a href="<?=$scriptName?>?orden=precio">Precio</a></th>
					<th class="col-md-1 default text-center"></th>
				</tr>
				<?php
				foreach($products as $prod){
					echo '<tr>';
					echo '<td><b>(',$prod['id'],')</b> ',$prod['titulo'],'</td>';
					echo '<td>',$prod['artista'],'</td>';
					echo '<td>',$prod['genero'],'</td>';
					echo '<td class="text-right">',$prod['stock'],'</td>';
					echo '<td class="text-right">',$prod['precio'],'</td>';
					echo '<td><a class="btn btn-xs btn-success" href="',$scriptName,'?action=comprar&id=',$prod['id'],'&orden=',$orden,'">Comprar</a></td>';
					echo '<tr>';
				}
				?>
			</table>
		</div>
		<?php
	}
	
	static function showCart($scriptName,$products){
		?>
		<div class="container">
			<div class="col-md-6 col-md-offset-3">
				<h2 class="alert alert-success text-center">Cesta de la compra</h2>
			</div>
			<table class="table table-condensed border table-hover table-bordered table-fixed no-margin">
				<tr>
					<th class="col-md-3 default text-center">Id - Título</th>
					<th class="col-md-3 default text-center">Artista</th>
					<th class="col-md-1 default text-center">Precio</th>
					<th class="col-md-1 default text-center">Cantidad</a></th>
					<th class="col-md-1 default text-center">Total</a></th>
				</tr>
				<?php
				$user = $_SESSION['user'];
				$acum = 0;
				foreach($products as $prod){
					$id = (int)$prod['id'];
					// Coloreamos la fila si no hay suficiente stock en el producto
					if($prod['stock'] < $_SESSION[$user][$id]){
						echo '<tr class="danger">';
					}else{
						echo '<tr>';
					}
					echo '<td><b>',$id,'</b> - ',$prod['titulo'],'</td>';
					echo '<td>',$prod['artista'],'</td>';
					echo '<td class="text-right">',$prod['precio'],'</td>';
					echo '<td class="text-right">', $_SESSION[$user][$id] ,'</td>';
					$acum = $acum + ( ($_SESSION[$user][$id] * (float)$prod['precio']) );
					echo '<td class="text-right">', ($_SESSION[$user][$id] * (float)$prod['precio']) ,'</td>';
					echo '</tr>';
				}
				echo '<tr>';
				echo '<td colspan="4" class="text-right"><strong>Total: </strong></td>';
				echo '<td class="text-right">', $acum ,'</td>';
				echo '</tr>';
				?>
			</table>
			<div class="row">
				<?php
				?>
				<div class="col-md-2">
					<a class="btn btn-lg btn-default" href="<?=$scriptName?>">Volver</a>
				</div>
				<div class="col-md-6">
					Las líneas en rojo no tienen suficiente stock
				</div>
				<div class=" col-md-2">
					<a class="btn btn-lg btn-warning" href="<?=$scriptName?>?action=cleanCart">Vaciar Cesta</a>
				</div>
				<div class="col-md-2">
					<a class="btn btn-lg btn-success" href="<?=$scriptName?>?action=endBuy">Confirmar compra</a>
				</div>
			</div>
		</div>
		<?php
	}
	
	static function endBuy($scriptName,$products,$done){
		?>
		<div class="container">
			<div class="col-md-6 col-md-offset-3">
				<h2 class="alert alert-info text-center">Resumen de la compra</h2>
			</div>
			<table class="table-striped table table-condensed border table-hover table-bordered table-fixed no-margin">
				<tr>
					<th colspan="4" class="text-center bg-success">Productos comprados satisfactoriamente</th>
				</tr>
				<tr>
					<th class="col-md-3 default text-center">Artículo (Artista - Título)</th>
					<th class="col-md-1 default text-center">Precio</th>
					<th class="col-md-1 default text-center">Cantidad</a></th>
					<th class="col-md-1 default text-center">Total</a></th>
				</tr>
				<?php
				$user = $_SESSION['user'];
				$acum = 0;
				$noStock = false;
				foreach($products as $prod){
					$id = $prod['id'];
					if ($done[$id]){ // Si el producto tenía suficiente stock
						echo '<tr>';
						echo '<td>',$prod['artista'],' - ',$prod['titulo'],'</td>';
						echo '<td class="text-right">',$prod['precio'],'</td>';
						$amount = $_SESSION[$user][$id];
						echo '<td class="text-right">',$amount,'</td>';
						$acum = $acum + ( ($_SESSION[$user][$id] * (float)$prod['precio']) );
						$total = $amount * (float)$prod['precio'];
						echo '<td class="text-right">',$total,'</td>';
						echo '</tr>';
					}else{
						$noStock = true;
					}
				}
				echo '<tr>';
				echo '<td colspan="3" class="text-right"><h4>Total: </h4></td>';
				echo '<td class="text-right bg-success"><h4>', $acum ,'€</h4></td>';
				echo '</tr>';
				?>
			</table>
			<br>
			<?php
			if($noStock){
				?>
				<div class="col-md-8 col-md-offset-2">
					<table class="table-striped table table-condensed border table-hover table-bordered table-fixed no-margin">
						<tr>
							<th colspan="3" class="text-center bg-danger">Productos no comprados (sin stock suficiente)</th>
						</tr>
						<tr>
							<th class="col-md-3 default text-center">Artículo (Artista - Título)</th>
							<th class="col-md-1 default text-center">Cantidad</a></th>
							<th class="col-md-1 default text-center">Stock</a></th>
						</tr>
						<?php
						foreach($products as $prod){
							$id = $prod['id'];
							if (!$done[$id]){ // Si el producto NO tenía suficiente stock
								echo '<tr>';
								echo '<td>',$prod['artista'],' - ',$prod['titulo'],'</td>';
								$amount = $_SESSION[$user][$id];
								echo '<td class="text-right">',$amount,'</td>';
								echo '<td class="text-right">',(int)$prod['stock'],'</td>';
								echo '</tr>';
							}
						}
						?>
					</table>
				</div>
				<?php
			}
			?>
			<div class="col-md-12 row">
				
				<div class="col-md-2 text-left">
					<a class="btn btn-lg btn-default" href="<?=$scriptName?>">Volver</a>
				</div>
				<div class=" col-md-2 col-md-offset-8 text-right">
					<a class="btn btn-lg btn-default" href="<?=$scriptName?>?action=misPedidos">Mis pedidos</a>
				</div>
			</div>
		</div>
		<?php
	}
	
	static function pedidos($scriptName,$pedidos){
		?>
		<div class="container">
			<div class="col-md-6 col-md-offset-3">
				<h2 class="alert alert-info text-center">Mis pedidos</h2>
			</div>
			<div class="col-md-6 col-md-offset-3">
				<table class="table-striped table table-condensed border table-hover table-bordered table-fixed no-margin">
					<tr>
						<th class="col-md-1 default text-center">Pedido</th>
						<th class="col-md-2 default text-center">Fecha</th>
						<th class="col-md-1 default text-center">Precio</th>
						<th class="col-md-2 default text-center"></a></th>
					</tr>
					<?php
					foreach($pedidos as $ped){
						echo '<tr>';
						echo '<td class="text-center">',$ped['id'],'</td>';
						echo '<td class="text-center">',$ped['fecha'],'</td>';
						echo '<td class="text-right">',number_format($ped['sumPrecio'], 2, ',', ' '),'</td>';
						echo '<td class="text-center"><a class="btn btn-xs btn-success" href="',$scriptName,'?action=verPedido&id=',$ped['id'],'">Ver</a></td>';
						echo '</tr>';
					}
					?>
				</table>
				<div class=" col-md-2 col-md-offset-5 text-center">
					<a class="btn btn-lg btn-default" href="<?=$scriptName?>">Volver</a>
				</div>
			</div>
		</div>
		<?php
	}
	
	static function verPedido($scriptName,$pedido){
		?>
		<div class="container">
			<div class="col-md-6 col-md-offset-3">
				<h2 class="alert alert-info text-center">Pedido con código <?=$pedido[0]['id_pedido']?></h2>
			</div>
			<div class="col-md-8 col-md-offset-2">
				<table class="table-striped table table-condensed border table-hover table-bordered table-fixed no-margin">
					<tr>
						<th class="col-md-4 default text-center">Artista - Titulo</th>
						<th class="col-md-1 default text-center">Cantidad</th>
						<th class="col-md-1 default text-center">Precio</th>
					</tr>
					<?php
					$acum = 0;
					foreach($pedido as $ped){
						echo '<tr>';
						echo '<td class="text-center">',$ped['artista'],' - ',$ped['titulo'],'</td>';
						echo '<td class="text-center">',$ped['cantidad'],'</td>';
						$precio = (float)$ped['precio'];
						$acum = $acum + $precio;
						echo '<td class="text-right">',number_format($precio, 2, ',', ' '),'</td>';
						echo '</tr>';
					}
					echo '<tr>';
					echo '<td colspan="2" class="text-right"><strong>Total: </strong></td>';
					echo '<td class="text-right bg-success"><h4>', $acum ,'</h4></td>';
					echo '</tr>';
					?>
				</table>
				<div class="col-md-12 text-center">
					<a class="btn btn-lg btn-default" href="<?=$scriptName?>?action=misPedidos">Volver</a>
				</div>
			</div>
		</div>
		<?php
	}
}
?>