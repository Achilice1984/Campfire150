<?php

/**
* 
*/
class Validator
{
	public function validate($viewModel)
	{	
		$validationMessages = array();
		$validationDecorators = $viewModel->getValidationDecorators();

		if(isset($validationDecorators))
		{
			foreach ($validationDecorators as $property => $validationTypes) {

				foreach (explode(',', $validationTypes) as $validationType) {
					$validationType = trim($validationType);

					try
					{
						//Call a validation method
						$validationMessage = $this->$validationType($viewModel->$property);

						if($validationMessage != null)
				    	{
				    		$validationMessages[$property] = $validationMessage;

				    		break;
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
		$message;

		if (!filter_var($propertyValue, FILTER_VALIDATE_EMAIL)) 
		{
			$message = "You have entered an invalid email address.";
		}

		return $message;
	}
}

?>