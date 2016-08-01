<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
</head>
<body>
	<form action="temp.php" method="post">
		<input name="borrar" type="submit">
	</form>
	<?php
		var_dump($_REQUEST);
	?>
</body>
</html>