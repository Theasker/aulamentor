<?php
class html{
	private $scriptName;
	
	public function __construct($script){
		$this->scriptName = $script;
	}
	
	public function cabeceraOrden($orden){
		switch ($orden){
			case "concepto":
				echo <<<EOT
					<thead class="amarillo">
						<tr>
							<th class="text-center col-xs-7 resaltado"><a class="textWhite" href="$script?orden=concepto">Nombre del medicamento</a></th>
							<th class="text-center col-xs-1"><a class="textWhite" href="$script?orden=cantidad">Cantidad</a></th>
							<th class="text-center col-xs-2"><a class="textWhite" href="$script?orden=importe">Importe (€)</a></th>
							<th class="text-center col-xs-2">Operaciones</th>
						</tr>
					</thead>
EOT;
				break;
			case "cantidad":
				echo <<<EOT
					<thead class="amarillo">
						<tr>
							<th class="text-center col-xs-7"><a class="textWhite" href="$script?orden=concepto">Nombre del medicamento</a></th>
							<th class="text-center col-xs-1 resaltado"><a class="textWhite" href="$script?orden=cantidad">Cantidad</a></th>
							<th class="text-center col-xs-2"><a class="textWhite" href="$script?orden=importe">Importe (€)</a></th>
							<th class="text-center col-xs-2">Operaciones</th>
						</tr>
					</thead>
EOT;
				break;
			case "importe":
				echo <<<EOT
					<thead class="amarillo">
						<tr>
							<th class="text-center col-xs-7"><a class="textWhite" href="$script?orden=concepto">Nombre del medicamento</a></th>
							<th class="text-center col-xs-1"><a class="textWhite" href="$script?orden=cantidad">Cantidad</a></th>
							<th class="text-center col-xs-2 resaltado"><a class="textWhite" href="$script?orden=importe">Importe (€)</a></th>
							<th class="text-center col-xs-2">Operaciones</th>
						</tr>
					</thead>
EOT;
				break;
			case "desordenado":
				echo <<<EOT
					<thead class="amarillo">
						<tr>
							<th class="text-center col-xs-7"><a class="textWhite" href="$script?orden=concepto">Nombre del medicamento</a></th>
							<th class="text-center col-xs-1"><a class="textWhite" href="$script?orden=cantidad">Cantidad</a></th>
							<th class="text-center col-xs-2"><a class="textWhite" href="$script?orden=importe">Importe (€)</a></th>
							<th class="text-center col-xs-2">Operaciones</th>
						</tr>
					</thead>
EOT;
				break;
				}
	}
	
	public function formAdd($orden){
		// Formulario para añdir un nuevo registro
		$script = $this->scriptName;
		echo <<<EOT
				<form name="add" method="post" action="$script" >
					<tr>
						<div class="input-group input-group-sm">
							<input type="hidden" name="action" value="add">
							<input type="hidden" name="orden" value="$orden">
							<td><input name="add_concepto" type="text" value="" class="form-control input-sm" placeholder="Introduce un medicamento" require></td>
							<td><input name="add_cantidad" type="number" value="" class="form-control input-sm" min="0" require></td>
							<td><input name="add_importe" type="number" step="any" value="" class="form-control input-sm" placeholder="0.00" require></td>
							<td class="text-center"><input class="btn btn-sm"  type="submit" value="Añadir registro"></td>
						</div>
					</tr>
				</form>
EOT;
			// END Formulario para añadir un nuevo registro
	}
	
	public function formFind($orden){
		$script = $this->scriptName;
		echo <<<EOT
			<hr>
			<form class="form-inline text-center" role="form" method="get" name="busca" action="$script">
				<div class="form-group">
						<label for="buscar" class="control-label">Buscar contenido </label>
						<input type="hidden" name="orden" value="$orden">
						<input name="buscar" type="text" class="form-control input-sm" placeholder="introduce texto a buscar">
						<button type="submit" class="btn btn-success btn-sm">Buscar</button>
				</div>
			</form>
			<hr>
EOT;
	}
	
	public function footer($rows,$total){
		echo '<div class="row">';
		echo '<p>';
		echo '<div class="col-xs-8 text-left">El nº de registros del monedero es <b>',$rows,'</b></div>';
		echo '<div class="col-xs-4 text-right"><a class="btn btn-xs btn-success text-right" href="'.$this->scriptName.'">Ver listado inicial</a></div>';
		echo '</p>';
		echo '<p class="red col-xs-12 text-danger">El medicamento más caro es "'.$total['nombre'].'" con <strong>'.number_format($total['cantidad'],2,",",".").' euros </strong></p>';
		echo '<p class="text-center col-xs-12">NOTA: no se puede repetir el nombre de un medicamento en esta farmacia.</p>';
		echo '</div>';
	}
}
?>