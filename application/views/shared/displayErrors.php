
<?php
	if(isset($validationResult))
	{
		if(count($validationResult->getValidationMessages()) > 0)
		{
?>
	<div role="alert" class="alert alert-danger alert-dismissible fade in">
	  	<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
	  	<h4>Oh snap! You got an error!</h4>
		<p>

<?php
			foreach ($validationResult->getValidationMessages() as $property) {
				foreach ($property as $validationType => $errorMessage) {
					echo $errorMessage . "<br />";
				}		
			}
?>
		</p>
	</div>
<?php
		}
	}
?>
	