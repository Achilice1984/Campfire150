<?php
	function unsetErrors()
	{
		// Remove any lingering errors
		unset($_SESSION["errorMessages"]);
	}	
	function unsetSuccess()
	{
		// Remove any lingering errors
		unset($_SESSION["successMessages"]);
	}

	function addErrorMessage($key, $errorMessage)
	{
		$sessionManager = new SessionManager();
		$sessionManager->addErrorMessages($key, $errorMessage);
	}

	function addSuccessMessage($key, $errorMessage)
	{
		$sessionManager = new SessionManager();
		$sessionManager->addSuccessMessages($key, $errorMessage);
	}
?>