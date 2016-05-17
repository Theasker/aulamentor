<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Módulo 2 - Unidad 4 - Actividad 1 (Aula Mentor)</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<style>
		body{background-color:#C0C0C0;}
		.centrado{width:700px; margin: 0 auto;}
		.btn{margin-right:5px;}
		.verde{background:#669900;}
		th, .textWhite{color: white;}
		.resaltado{background:teal;}
		.red{color:red;}
	</style>
</head>
<body>
	<div class="centrado">
		<p>
			<div class="panel-body verde">
				<div class="col-xs-2"><img src="cerdito.gif" alt="cerdito"></div>
			  <div class="col-xs-8"><h1 class="text-center">Monedero</h1></div>
			  <div class="col-xs-2"><img src="cerdito.gif" alt="cerdito"></div>
			</div>
		</p>

		<div>
			<?php
			require('u4_act1_class.php');
			
			//error_reporting(E_ALL);
			//ini_set("display_errors", 1);
			
			$monedero = new monedero();
			
			$script = $monedero->getScriptName();
			
			//var_dump("get:",$_GET);
			//var_dump("post:",$_POST);
			
			if (isset($_GET["orden"])){
				switch ($_GET["orden"]){
					case "concepto":
						echo <<<EOT
							<table class="table table-condensed table-bordered table-fixed no-margin">
								<thead class="verde">
									<tr>
										<th class="text-center col-xs-7 resaltado"><a class="textWhite" href="$script?orden=concepto">Concepto</a></th>
										<th class="text-center col-xs-1"><a class="textWhite" href="$script?orden=fecha">Fecha</a></th>
										<th class="text-center col-xs-2"><a class="textWhite" href="$script?orden=importe">Importe (€)</a></th>
										<th class="text-center col-xs-2">Operaciones</th>
									</tr>
								</thead>
EOT;
						
						$monedero->sortConcepto();
						break;
					case "fecha":
						echo <<<EOT
							<table class="table table-condensed table-bordered table-fixed no-margin">
								<thead class="verde">
									<tr>
										<th class="text-center col-xs-7"><a class="textWhite" href="$script?orden=concepto">Concepto</a></th>
										<th class="text-center col-xs-1 resaltado"><a class="textWhite" href="$script?orden=fecha">Fecha</a></th>
										<th class="text-center col-xs-2"><a class="textWhite" href="$script?orden=importe">Importe (€)</a></th>
										<th class="text-center col-xs-2">Operaciones</th>
									</tr>
								</thead>
EOT;
						$monedero->sortDate();
						break;
					case "importe":
						echo <<<EOT
							<table class="table table-condensed table-bordered table-fixed no-margin">
								<thead class="verde">
									<tr>
										<th class="text-center col-xs-7"><a class="textWhite" href="$script?orden=concepto">Concepto</a></th>
										<th class="text-center col-xs-1"><a class="textWhite" href="$script?orden=fecha">Fecha</a></th>
										<th class="text-center col-xs-2 resaltado"><a class="textWhite" href="$script?orden=importe">Importe (€)</a></th>
										<th class="text-center col-xs-2">Operaciones</th>
									</tr>
								</thead>
EOT;
						$monedero->sortAmount();
						break;
				}
			}else{ // Si no se ha pulsado ninguna cabecera para ordenaer
				echo <<<EOT
							<table class="table table-condensed table-bordered table-fixed no-margin">
								<thead class="verde">
									<tr>
										<th class="text-center col-xs-7"><a class="textWhite" href="$script?orden=concepto">Concepto</a></th>
										<th class="text-center col-xs-1"><a class="textWhite" href="$script?orden=fecha">Fecha</a></th>
										<th class="text-center col-xs-2"><a class="textWhite" href="$script?orden=importe">Importe (€)</a></th>
										<th class="text-center col-xs-2">Operaciones</th>
									</tr>
								</thead>
EOT;
				$monedero->unsorted();
			};
			
			

			// Formulario para añdir un nuevo registro
			echo <<<EOT
					<form name="add" method="post" action="$script" >
						<tr>
							<div class="input-group input-group-sm">
								<input type="hidden" name="add" value="add">
								<td><input name="add_concepto" type="text" value="" class="form-control input-sm"></td>
								<td><input name="add_fecha" type="text" value="" class="form-control input-sm"></td>
								<td><input name="add_importe" type="text" value="" class="form-control input-sm"></td>
								<td class="text-center"><input class="btn btn-sm"  type="submit" value="Añadir registro"></td>
							</div>
						</tr>
					</form>
EOT;
			
			echo "</table>";
			
			echo '<div class="container"';
			echo '<hr>';
			
			echo '<hr>';
			echo 'El nº de registros del monedero es ',$monedero->getRows();
			echo '<p class="red">El balance del monedero es de <strong>',$monedero->getTotal(),' euros </strong></p>';
			echo '<p class="text-center">NOTA: es obligatorio rellenar el campo Concepto.</p>';
			echo '</div>';
			
			?>	
		</div>
	</div>
</body>
</html>