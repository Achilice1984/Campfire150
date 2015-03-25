
<div class="container">
	<?php if (IS_DEBUG) { ?>
		
	
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

	<?php } else { ?>
		

		<div class="panel panel-default" style="margin-top: 40px; margin-bottom: 40px;">
	  		<div class="panel-heading">Oops, It looks like something went wrong.</div>
	  		<div class="panel-body">
	    		Don't worry though, a report is already on its way to us!
	    		<br />
	    		<br />
	    		We will work hard to make sure this doesn't happen again.
	  		</div>
		</div>

	<?php } ?>
</div>