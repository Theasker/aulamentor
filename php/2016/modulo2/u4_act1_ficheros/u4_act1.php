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
		.verde{background:#669900;};
		.textoNegro{color:black;}
	</style>
</head>
<body>
	<div class="centrado">
		<p>
			<div class="panel-body verde">
				<div class="col-md-2"><img src="cerdito.gif" alt="cerdito"></div>
			  <div class="col-md-8"><h1 class="text-center">Monedero</h1></div>
			  <div class="col-md-2"><img src="cerdito.gif" alt="cerdito"></div>
			</div>
		</p>

		<div class="clearfix">
			<?php
			require('u4_act1_class.php');
			
			//error_reporting(E_ALL); 
			//ini_set("display_errors", 1);
			
			$monedero = new monedero();
			
			$script = $monedero->getScriptName();
			
			var_dump($_GET);
			
			if (isset($_GET["orden"])){
				switch ($_GET["orden"]){
					case "concepto":
						
						break:
					case "concepto":
						break:
					case "concepto":
						break:
					case "concepto":
						break:
				}
			}else
				
			}
			
			echo <<<EOT
			<table class="table table-condensed table-bordered table-fixed no-margin">
				<thead class="verde">
					<tr>
						<th class="text-center col-md-7"><a href="$script?orden=concepto">Concepto</a></th>
						<th class="text-center col-md-1"><a href="$script?orden=fecha">Fecha</a></th>
						<th class="text-center col-md-2"><a href="$script?orden=importe">Importe (€)</a></th>
						<th class="text-center col-md-2">Operaciones</th>
					</tr>
				</thead>
EOT;
			echo "<tbody>";
			$monedero->show();
			
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
			
			echo "</tbody></table>";
			
			echo "El nº de registros del monedero es ",$monedero->getRows();
			?>	
		</div>
	</div>
</body>
</html>
