<?php
class html{
	public function titulo($aviso){
		?>
			<div class="row verdeoscuro titulo">
				<div class="col-md-12 text-center"><h1>Comprar entradas de teatro</h1></div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					<h3>¡Bienvenid@ a la página de reserva de localidades</h3>
					<div class="danger text-center"><?php echo $aviso ?></div>
				</div>
				<hr>
			</div>
		<?php
	}
	public function mostrarObra($obra){
		?>
		<div class="row">
			<div class="col-md-2 verdeoscuro">Nombre teatro</div>
			<div class="col-md-2"><b><?php echo $obra[0] ?></b></div>
			<div class="col-md-3 verdeoscuro">Nombre de la obra teatral</div>
			<div class="col-md-3"><b><?php echo $obra[1] ?></b></div>
			<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-2 verdeoscuro">Sesión</div>
			<div class="col-md-2"><b><?php echo $obra[2] ?></b></div>
			<div class="col-md-7 text-right">Día: <?php echo $obra[3] ?></div>
			<div class="col-md-1"></div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-12 text-center">Escenario</div>
		</div>
		<div class="row">
			<div class="col-md-4 col-md-offset-4"><hr></div>
		</div>
		<?php
	}
}
?>