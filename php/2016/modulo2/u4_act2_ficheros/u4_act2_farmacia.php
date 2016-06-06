<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Unicad 4 - Activadad 2</title>
	<meta name="viewport" content="width=device-width,initial-scale=1">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

	<script   src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<style>
		body{background: #C0C0C0;}
		.centrado{width:700px; margin: 0 auto;}
		.amarillo{background: #FFA500;}
		.titulo{padding: 5px; color: white;}
	</style>
</head>
<body>
	<div class="container centrado">
		<br>
		<div class="row amarillo titulo">
			 <div class="col-md-2 col-md-offset-1"><img src="medicina.gif" alt="medicina" width="80px"></div>
			 <div class="col-md-6 text-center"><h1>Farmacia</h1></div>
			 <div class="col-md-2"><img src="medicina.gif" alt="medicina" width="80px"></div>
			 <div class="col-md-1"></div>
		</div>
		<br>
		<div class="row">
<?php
	require('u4_act2_farmaciaClass.php');
	require('u4_act2_farmaciaHtml.php');
	
	$scriptName = basename($_SERVER["SCRIPT_NAME"]);
	
	$farmacia = new farmacia();
	
?>
		</div>
	</div>
</body>
</html>