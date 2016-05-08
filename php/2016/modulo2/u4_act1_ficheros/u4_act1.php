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
	</style>
</head>
<body>
	<div class="centrado">
		<div class="panel-body alert-success">
			<div class="col-md-2">
		    <img src="cerdito.gif" alt="cerdito">
		  </div>
		  <div class="col-md-8">
		    <h1 class="text-center">Monedero</h1>
		  </div>
		  <div class="col-md-2">
		    <img src="cerdito.gif" alt="cerdito">
		  </div>
		</div>

		<div class="clearfix">
			<?php
			require('u4_act1_class.php');
			
			//error_reporting(E_ALL); 
			//ini_set("display_errors", 1);
			
			$monedero = new monedero();
			
			//echo "<table class=\"table table-condensed table-bordered table-fixed no-margin\">
			echo <<<EOT
			<table class="table table-condensed table-bordered table-fixed no-margin">
				<thead class="alert-success">
					<tr>
						<th class="text-center col-md-5">Concepto</th>
						<th class="text-center col-md-2">Fecha</th>
						<th class="text-center col-md-2">Importe (€)</th>
						<th class="text-center col-md-3">Operaciones</th>
					</tr>
				</thead>"
EOT;
			echo "<tbody>";
			$monedero->show();
			
			echo <<<EOT
				<div class="clearfix">
					<form name="form2" method="post" action="index.php" >
						<tr>
							<td><input name="add_concepto" type="text" value="" class="form-control"></td>
							<td><input name="add_fecha" type="text" value="" class="form-control"></td>
							<td><input name="add_importe" type="text" value="" class="form-control"></td>
							<td class="text-center"><a class="btn btn-danger" href="http://www.w3schools.com">Añadir</a></td>
						</tr>
					</form>
				</div>
EOT;
			
			echo "</tbody></table>";
			
			echo "Hay ",$monedero->getRows()," registros."
			?>	
		</div>
	</div>
</body>
</html>
