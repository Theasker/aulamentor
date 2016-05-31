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
								<thead class="verde">
									<tr>
										<th class="text-center col-xs-7 resaltado"><a class="textWhite" href="$script?orden=concepto">Concepto</a></th>
										<th class="text-center col-xs-1"><a class="textWhite" href="$script?orden=fecha">Fecha</a></th>
										<th class="text-center col-xs-2"><a class="textWhite" href="$script?orden=importe">Importe (€)</a></th>
										<th class="text-center col-xs-2">Operaciones</th>
									</tr>
								</thead>
EOT;
						break;
					case "fecha":
						echo <<<EOT
								<thead class="verde">
									<tr>
										<th class="text-center col-xs-7"><a class="textWhite" href="$script?orden=concepto">Concepto</a></th>
										<th class="text-center col-xs-1 resaltado"><a class="textWhite" href="$script?orden=fecha">Fecha</a></th>
										<th class="text-center col-xs-2"><a class="textWhite" href="$script?orden=importe">Importe (€)</a></th>
										<th class="text-center col-xs-2">Operaciones</th>
									</tr>
								</thead>
EOT;
						break;
					case "importe":
						echo <<<EOT
								<thead class="verde">
									<tr>
										<th class="text-center col-xs-7"><a class="textWhite" href="$script?orden=concepto">Concepto</a></th>
										<th class="text-center col-xs-1"><a class="textWhite" href="$script?orden=fecha">Fecha</a></th>
										<th class="text-center col-xs-2 resaltado"><a class="textWhite" href="$script?orden=importe">Importe (€)</a></th>
										<th class="text-center col-xs-2">Operaciones</th>
									</tr>
								</thead>
EOT;
						break;
					case "desordenado":
						echo <<<EOT
								<thead class="verde">
									<tr>
										<th class="text-center col-xs-7"><a class="textWhite" href="$script?orden=concepto">Concepto</a></th>
										<th class="text-center col-xs-1"><a class="textWhite" href="$script?orden=fecha">Fecha</a></th>
										<th class="text-center col-xs-2"><a class="textWhite" href="$script?orden=importe">Importe (€)</a></th>
										<th class="text-center col-xs-2">Operaciones</th>
									</tr>
								</thead>
EOT;
						break;
				}
	}
	
	public function formAdd(){
		// Formulario para añdir un nuevo registro
			echo <<<EOT
					<form name="add" method="post" action="$script" >
						<tr>
							<div class="input-group input-group-sm">
								<input type="hidden" name="action" value="add">
								<td><input name="add_concepto" type="text" value="" class="form-control input-sm"></td>
								<td><input name="add_fecha" type="text" value="" class="form-control input-sm"></td>
								<td><input name="add_importe" type="text" value="" class="form-control input-sm"></td>
								<td class="text-center"><input class="btn btn-sm"  type="submit" value="Añadir registro"></td>
							</div>
						</tr>
					</form>
EOT;
			// END Formulario para añadir un nuevo registro
	}
	
	public function formFind(){
		echo <<<EOT
			<hr>
			<form class="form-inline text-center" role="form" method="get" name="busca">
				<div class="form-group">
						<label for="buscar" class="control-label">Buscar contenido </label>
						<input type="hidden" name="orden" value="$orden">
						<input name="buscar" type="text" class="form-control input-sm" placeholder="introduce texto a buscar">
						<button type="submit" class="btn btn-success btn-sm">Buscar</button>
				</div>
			</form>
EOT;
	}
}
?>