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
		body{background-color: #cccccc;font-family: Times;}
		.centrado{width:800px; margin: 0 auto;}
		.titulo{margin-top: 15px; padding: 5px;}
		input{width: 200px }
		#new{width: 600px;margin: 0 auto; }
	</style>
</head>
<body>
	<div class="container centrado">
<?php
	}
	
	static function htmlFin(){
	?>
		</div>
	</body>
	</html>
	<?php
	}
	
	static function login($scriptName,$typeLogin,$mesage){
		echo <<<HTML
    <div class="row">
			
			<form class="form-horizontal" action='$scriptName' method="POST">
			  <fieldset>
			    <div id="legend">
			      <legend class="">Login</legend>
			    </div>
			    <div class="control-group">
			      <!-- Username -->
			      <label class="control-label"  for="username">Username</label>
			      <div class="controls">
			        <input type="text" id="username" name="username" placeholder="Usuario" class="input-xlarge">
			      </div>
			    </div>
			    <div class="control-group">
			      <!-- Password-->
			      <label class="control-label" for="password">Password</label>
			      <div class="controls">
			        <input type="password" id="password" name="password" placeholder="Contraseña" class="input-xlarge">
			      </div>
			    </div>
			    <div class="control-group">
			      <!-- Button -->
			      <span class="label label-danger">$mesage</span>
			      <div class="controls">
			        <button type="submit" class="btn btn-default" name="$typeLogin" value="$typeLogin">$typeLogin</button>
			      </div>
			      <a href="./$scriptName?action=registrar">Registrar</a>
			    </div>
			  </fieldset>
			</form>

		</div>
HTML;
	}
	
	static function headerLogged(){
		?>
		<div class="navbar navbar-default navbar-fixed-top">
	    <div class="container">
        <div class="navbar-header">
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Sitename</a>
        </div>
        <center>
          <div class="navbar-collapse collapse" id="navbar-main">
            <ul class="nav navbar-nav">
              <li class="active"><a href="#">Link</a>
              </li>
              <li><a href="#">Link</a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a>
                  </li>
                  <li><a href="#">Another action</a>
                  </li>
                  <li><a href="#">Something else here</a>
                  </li>
                  <li class="divider"></li>
                  <li><a href="#">Separated link</a>
                  </li>
                  <li class="divider"></li>
                  <li><a href="#">One more separated link</a>
                  </li>
                </ul>
              </li>
            </ul>
            <form class="navbar-form navbar-right" role="search">
              <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="password" placeholder="Password">
              </div>
              <button type="submit" class="btn btn-default">Sign In</button>
            </form>
          </div>
        </center>
	    </div>
	</div>
		<?php
	}
}
?>