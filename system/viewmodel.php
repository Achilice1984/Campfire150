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
		return $this->validationResult;
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