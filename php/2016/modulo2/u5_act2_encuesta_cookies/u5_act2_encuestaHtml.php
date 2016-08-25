<?php
class html{
	private $scriptName;

	public function __construct($scriptName){
		$this->scriptName = $scriptName;
	}

	public function encuesta($titulo,$datos,$aviso){
		?>
<div class="row">
	<p class="bg-danger lead text-center"><?=$aviso ?></p>
	<div class="panel panel-default">
	  <div class="panel-heading">
	    <h3 class="panel-title"><b>Encuesta</b></h3>
	  </div>
	  <div class="panel-body">
			<form action="<?php $this->scriptName ?>" method="POST" role="form">
				<legend><div class="text-center"><?=$titulo?></div></legend>
				<?php
				for ($x = 0;$x < count($datos);$x++){
					?>
					<div class="input-group">
					  <span class="input-group-addon">
					    <input type="radio" name="encuesta" value="<?=$x?>">
					  </span>
					  <label class="form-control"><?=$datos[$x][0]?></label>
					</div><!-- /input-group -->
					<?php
				}
				?>
				<div class="input-group">
		      <span class="input-group-addon">
		        <input type="submit" class="btn btn-primary" name="enviar" value="Votar">
		      </span>
		    </div><!-- /input-group -->
			</form>
	  </div>
	</div>
</div><!-- /.row -->
<?php
	}
	
	public function resultados($titulo,$datos){
		?>
<div class="row">
	<div class="panel panel-default">
	  <div class="panel-heading">
	    <h3 class="panel-title"><b>Resultados</b></h3>
	  </div>
	  <div class="panel-body">
			<h3 class="text-center"><?=$titulo?></h3>
			<?php
			$acum=0;
			for ($x = 0;$x < count($datos);$x++){
				$acum = $acum + (int)$datos[$x][1];
			}
				for ($x = 0;$x < count($datos);$x++){
				echo "<div class=\"row\">";
				echo "<div class=\"col-xs-5 resultados\">",$datos[$x][0],"</div>";
				echo "<div class=\"col-xs-4 resultados\">";
				$number = ((int)($datos[$x][1])*100)/$acum;
				//<img height="14" alt="32 %" src="images/mainbar.gif" width="70">
				echo "<img height=\"14\" src=\"images/leftbar.gif\" width=\"7\">";
				echo '<img height="14" src="images/mainbar.gif" width="',$number,'">';
				echo "<img height=\"14\" src=\"images/rightbar.gif\" width=\"7\">";
				echo "</div>";
				echo "<div class=\"col-xs-3 resultados text-right\">",number_format($number, 2), " % (",(int)$datos[$x][1],") </div>";
				echo "</div>";
			}
			?>
	  </div>
	  <div class="panel-footer text-center"><strong>Nº total de votos: <?=$acum ?></strong></div>
	</div>
</div><!-- /.row -->
		<?php
	}
}
?>