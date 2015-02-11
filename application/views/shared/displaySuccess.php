
<?php if(isset($_SESSION["successMessages"]))	{
		if(count($_SESSION["successMessages"]) > 0) { ?>
			<div role="alert" class="alert alert-success alert-dismissible fade in">
			  	<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
			  	<h4><?php echo gettext("Success!"); ?></h4>
				<p id="errorMessageSection">

					<?php foreach ($_SESSION["successMessages"] as $property) {
						foreach ($property as $validationType => $successMessage) {
							echo $successMessage . "<br />";
						}		
					} ?>
				</p>
			</div>
<?php
		}
	}
?>
	