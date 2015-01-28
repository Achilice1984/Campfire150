<?php
if(isset($validationResult))
{
	foreach ($validationResult->getValidationMessages() as $property) {
		foreach ($property as $validationType => $errorMessage) {
			echo $errorMessage . "<br />";
		}		
	}
}

?>