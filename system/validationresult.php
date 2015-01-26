<?php
/**
* Validation Result
*/
class ValidationResult
{
	private $isValid;
	private $validationMessages = array();
	
	function __construct($validationMessages)
	{
		if(!empty($validationMessages))
		{
			$this->validationMessages = $validationMessages;

			$this->isValid = false;
		}		
		else
		{
			$this->isValid = true;
		}
	}

	public function isValid()
	{
		return $this->isValid;
	}

	public function getValidationMessages()
	{
		return $this->validationMessages;
	}
}
?>