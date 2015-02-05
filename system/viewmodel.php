<?php
/**
* 
*/
class ViewModel
{
	private $validationResult;
	private $validationDecorators;
	
	function __construct($validationDecorators)
	{
		$this->validationDecorators = $validationDecorators;
	}

	public function validate()
	{
		$validator = new Validator();
		$this->validationResult = $validator->validate($this);
	}

	public function getValidationResult()
	{
		if(isset($this->validationResult))
		{
			return $this->validationResult;
		}
		else
		{
			return null;
		}
	}

	public function addErrorMessage($key, $errorMessage)
	{
		if(!isset($this->validationResult))
		{
			$this->validationResult = new ValidationResult();
		}

		$this->validationResult->setValidationMessage($key, $errorMessage);
	}


	public function isValid()
	{
		if(isset($this->validationResult))
		{
			return $this->validationResult->isValid();
		}
		else
		{
			return false;
		}
	}

	public function getValidationDecorators()
	{
		return $this->validationDecorators;
	}

	public function getValidationAttribute($propertyName)
	{
		$dataAttributes = " ";

		if(isset($this->validationDecorators[$propertyName]))
		{
			foreach ($this->validationDecorators[$propertyName] as $validationType => $errorMessage) {
				$dataAttributes .= "data-validate-" . $validationType . "=\"" . $errorMessage . "\" ";
			}
		}

		return $dataAttributes;
	}
}
?>