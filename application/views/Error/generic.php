
<div class="container">
	<?php if (!(error_reporting() & $_SESSION["errno"])) { ?>

		<h1 class="text-danger">Error</h1>
		<hr class="text-danger" />

		<div class="panel panel-default">
	  		<div class="panel-heading">Error Type</div>
	  		<div class="panel-body">
	    		<?php echo $_SESSION["errstr"]; ?>
	  		</div>
		</div>

		<div class="panel panel-default">
	  		<div class="panel-heading">Error Number</div>
	  		<div class="panel-body">
	    		<?php echo $_SESSION["errno"]; ?>
	  		</div>
		</div>

		<div class="panel panel-default">
	  		<div class="panel-heading">Location</div>
	  		<div class="panel-body">
	    		<?php echo $_SESSION["errfile"]; ?>
	  		</div>
		</div>

		<div class="panel panel-default">
	  		<div class="panel-heading">Line Number</div>
	  		<div class="panel-body">
	    		<?php echo $_SESSION["errline"]; ?>
	  		</div>
		</div>
	<?php } ?>
</div>