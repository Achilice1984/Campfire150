<?php

/**
* validator function
*/
class Validator extends Controller{
	public function validate($viewModel)
	{	
		$validationMessages = array();
		$validationDecorators = $viewModel->getValidationDecorators();

		if(isset($validationDecorators))
		{
			foreach ($validationDecorators as $property => $validationTypes) {
				foreach ($validationTypes as $validationType => $errorMessage) {

					try
					{
						//Call a validation method
						if($this->$validationType($viewModel->$property))
				    	{
				    		$validationMessages[$property][$validationType] = $errorMessage;
				    	}
			    	}
			    	catch(Exception $ex)
			    	{
			    		$validationResult->validationMessages[$property] = "Some unknown error has occurred";
			    	}
		    	}
			}
		}

		$validationResult = new ValidationResult($validationMessages);

		return $validationResult;
	}

	private function email($propertyValue)
	{
		return !filter_var($propertyValue, FILTER_VALIDATE_EMAIL);
	}

	private function required($propertyValue)
	{
		return empty($propertyValue);
	}
	private function name(){}
	private function addressUnitNo{}
	private function addressStreetNo{}
	private function addressStreetName{}
	private function addressPostalCode{}
	private function phoneAreaCode{}
	private function phoneThreeDigit{}
	private function phoneFourDigit{}
}

?>