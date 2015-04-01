
<?php if (IS_DEBUG) { ?>
	
	<div class="container">
		<?php if (error_reporting()) { ?>
			
			<?php if (isset($_SESSION["errno"])): ?>			
			
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
			<?php endif ?>

			<h1 class="text-danger">Exception</h1>
			<?php if (isset($_SESSION["exception"])): ?>

				<?php debugit($_SESSION["exception"]); ?>

			<?php endif ?>

		<?php } else { ?>

			<div class="panel panel-default">
		  		<div class="panel-heading">Oops!</div>
		  		<div class="panel-body">
		    		It looks like some error occured...
		  		</div>
			</div>

		<?php } ?>
	</div>

<?php } else { ?>
	
	<div class="container" style="min-height: 400px;">
		<img class="img-responsive" style="display: table; margin: 0 auto; max-height: 300px;" src="<?php echo BASE_URL . "static/c150/campfire-logo-large.png"; ?>">
		<div style="display: table; margin: 0 auto;">
			<h1 class="text-danger" style="font-size: 3em;"><?php echo gettext("Oops, something went wrong"); ?></h1>
		</div>		
	</div>

	<div class="jumbotron" style="">
		<div class="container" style="padding-top: 40px; padding-bottom: 40px;">
			<p style="display: table; margin: 0 auto; padding-bottom: 10px; font-size: 3em;"><?php echo gettext("Don't worry though, a report is already on its way to us!"); ?></p>
	    	<p style="display: table; margin: 0 auto; font-size: 2em;"><?php echo gettext("We are working hard to make sure this doesn't happen again."); ?></p>
    	</div>
	</div>

<?php } ?>
