
<div class="container">
	<?php if (error_reporting()) { ?>

		<h1 class="text-danger">Error</h1>
		<hr class="text-danger" />

		<div class="panel panel-default">
	  		<div class="panel-heading">Error Type</div>
	  		<div class="panel-body">
	    		<?php if(isset($_SESSION["errstr"])) { echo $_SESSION["errstr"]; } ?>
	  		</div>
		</div>

		<div class="panel panel-default">
	  		<div class="panel-heading">Error Number</div>
	  		<div class="panel-body">
	    		<?php if(isset($_SESSION["errno"])) { echo $_SESSION["errno"]; } ?>
	  		</div>
		</div>

		<div class="panel panel-default">
	  		<div class="panel-heading">Location</div>
	  		<div class="panel-body">
	    		<?php if(isset($_SESSION["errfile"])) { echo $_SESSION["errfile"]; } ?>
	  		</div>
		</div>

		<div class="panel panel-default">
	  		<div class="panel-heading">Line Number</div>
	  		<div class="panel-body">
	    		<?php if(isset($_SESSION["errline"])) { echo $_SESSION["errline"]; } ?>
	  		</div>
		</div>
	<?php } else { ?>

		<div class="panel panel-default">
	  		<div class="panel-heading">Oops!</div>
	  		<div class="panel-body">
	    		It looks like some error occured...
	  		</div>
		</div>

	<?php } ?>
</div>