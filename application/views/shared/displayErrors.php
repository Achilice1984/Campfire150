<?php

if(isset($validationResult))
{
	foreach ($validationResult->getValidationMessages() as $errorMessage) {
		echo $errorMessage;
	}
}

?>