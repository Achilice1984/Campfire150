<?php
/**
* 
*/
class ViewModel
{
	private $isValid;
	private $validationDecorators;
	
	function __construct($validationDecorators)
	{
		$this->validationDecorators = $validationDecorators;
	}

	public function validate($persistCount = 0, $exceptions = array())
	{
		foreach ($exceptions as $exception) {
			if(array_key_exists($exception, $this->validationDecorators))
			{
				unset($this->validationDecorators[$exception]);
			}
		}

		$sessionManager = new SessionManager();
		$validator = new Validator();

		$validationMessages = $validator->validate($this);		

		if(count($validationMessages) > 0)
		{
			$sessionManager->setErrorMessages($validationMessages);

			$sessionManager->setPersistCount_Errors($persistCount);
			$this->isValid = false;
		}
		else
		{
			$this->isValid = true;
		}

		return $this->isValid;
	}
	
	public function isValid()
	{
		return $this->isValid;
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