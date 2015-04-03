<?php
	function unsetErrors()
	{
		//Check if persist is still in effect
		if(isset($_SESSION["errorMessages_persistCount"]) && $_SESSION["errorMessages_persistCount"] > 0)
		{
			$_SESSION["errorMessages_persistCount"] = $_SESSION["errorMessages_persistCount"] - 1;
		}
		else
		{
			// Remove any lingering errors
			unset($_SESSION["errorMessages"]);
		}
	}	
	function unsetSuccess()
	{
		//Check if persist is still in effect
		if(isset($_SESSION["successMessages_persistCount"]) && $_SESSION["successMessages_persistCount"] > 0)
		{
			$_SESSION["successMessages_persistCount"] = $_SESSION["successMessages_persistCount"] - 1;
		}
		else
		{
			// Remove any lingering errors
			unset($_SESSION["successMessages"]);
		}
	}
	function unsetInfo()
	{
		//Check if persist is still in effect
		if(isset($_SESSION["infoMessages_persistCount"]) && $_SESSION["infoMessages_persistCount"] > 0)
		{
			$_SESSION["infoMessages_persistCount"] = $_SESSION["infoMessages_persistCount"] - 1;
		}
		else
		{
			// Remove any lingering errors
			unset($_SESSION["infoMessages"]);
		}
	}

	function addErrorMessage($key, $errorMessage, $persistCount = 0)
	{
		$sessionManager = new SessionManager();
		$sessionManager->addErrorMessages($key, $errorMessage, $persistCount);
	}

	function addSuccessMessage($key, $errorMessage, $persistCount = 0)
	{
		$sessionManager = new SessionManager();
		$sessionManager->addSuccessMessages($key, $errorMessage, $persistCount);
	}

	function addInfoMessage($key, $errorMessage, $persistCount = 0)
	{
		$sessionManager = new SessionManager();
		$sessionManager->addInfoMessages($key, $errorMessage, $persistCount);
	}


	function getSuccessMessage()
	{
		return '<div class="alert alert-success alert-dismissible" id="UserSearchInfoBar" role="alert">
		  		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  		<strong>' . gettext("Success") . '</strong> ' . gettext("Your data was saved successfully.") . '
			</div>';
	}
	function getErrorMessage()
	{
		return '<div class="alert alert-danger alert-dismissible" id="UserSearchInfoBar" role="alert">
		  		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  		<strong>' . gettext("Error") . '</strong> ' . gettext("Your data could not be saved at this time.") . '
			</div>';
	}
?>