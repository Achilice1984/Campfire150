<?php if(isset($_SESSION["successMessages"]))	{
		if(count($_SESSION["successMessages"]) > 0) { ?>
			<div role="alert" class="alert alert-success alert-dismissible fade in">
			  	<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
			  	<h4><?php echo gettext("Success!"); ?></h4>
				<p id="successMessageSection">

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

<?php if(isset($_SESSION["infoMessages"]))	{
		if(count($_SESSION["infoMessages"]) > 0) { ?>
			<div role="alert" class="alert alert-info alert-dismissible fade in">
			  	<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
			  	<h4><?php echo gettext("Info!"); ?></h4>
				<p id="infoMessageSection">

					<?php foreach ($_SESSION["infoMessages"] as $property) {
						foreach ($property as $validationType => $infoMessage) {
							echo $infoMessage . "<br />";
						}		
					} ?>
				</p>
			</div>
<?php
		}
	}
?>
	

<?php if(isset($_SESSION["errorMessages"]))	{
		if(count($_SESSION["errorMessages"]) > 0) { ?>
			<div role="alert" class="alert alert-danger alert-dismissible fade in">
			  	<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
			  	<h4><?php echo gettext("You got an error!"); ?></h4>
				<p id="errorMessageSection">

					<?php foreach ($_SESSION["errorMessages"] as $property) {
						foreach ($property as $validationType => $errorMessage) {
							echo $errorMessage . "<br />";
						}		
					} ?>
				</p>
			</div>
<?php
		}
	}
?>
	