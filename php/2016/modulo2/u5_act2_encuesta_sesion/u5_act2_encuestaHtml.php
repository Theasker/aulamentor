<?php
class html{
	private $scriptName;

	public function __construct($scriptName){
		$this->scriptName = $scriptName;
	}

	public function encuesta(){
		?>
<div class="row">
	<div class="panel panel-default">
	  <div class="panel-heading">
	    <h3 class="panel-title">Encuesta</h3>
	  </div>
	  <div class="panel-body">
			<form action="<?php $this->scriptName ?>" method="POST" role="form">
				<legend>¿Cuantas veces accedes a Internet?</legend>

				<div class="input-group">
		      <span class="input-group-addon">
		        <input type="radio" name="encuesta" value="1">
		      </span>
		      <label class="form-control">Más de una vez al día</label>
		    </div><!-- /input-group -->
		    <div class="input-group">
		      <span class="input-group-addon">
		        <input type="radio" name="encuesta" value="2">
		      </span>
		      <label class="form-control">Una vez al día</label>
		    </div><!-- /input-group -->
		    <div class="input-group">
		      <span class="input-group-addon">

		        <input type="radio" name="encuesta" value="3">
		      </span>
		      <label class="form-control">Una vez a la semana</label>
		    </div><!-- /input-group -->
		    <div class="input-group">
		      <span class="input-group-addon">
		        <input type="radio" name="encuesta" value="4">
		      </span>
		      <label class="form-control">Una vez al mes</label>
		    </div><!-- /input-group -->
		    <div class="input-group">
		      <span class="input-group-addon">
		        <input type="radio" name="encuesta" value="5">
		      </span>
		      <label class="form-control">No accedo</label>
		    </div><!-- /input-group -->
				<div class="input-group">
		      <span class="input-group-addon">
		        <input type="submit" class="btn btn-primary" name="submit" value="Votar">
		      </span>
		    </div><!-- /input-group -->
			</form>
	  </div>
	</div>
		
</div><!-- /.row -->
<?php
	}
}
?>