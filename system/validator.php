<?php
/**
* Usage Example
* if( validator->email($anEmailToBeValidated) ){
*  this email is valid else invalid.
* }
***
* validator sub functions like phoneThreeDigit or name etc, all take a variable and return true/false
*/
class Validator
{
  private $viewModel;

  public function validate($viewModel)
  { 
    $this->viewModel = $viewModel;
    $validationMessages = array();
    $validationDecorators = $viewModel->getValidationDecorators();

    if(isset($validationDecorators))
    {
      foreach ($validationDecorators as $property => $validationTypes) {
        foreach ($validationTypes as $validationType => $validationDetails) {

          try
          {
              //Call a validation method
              if(!$this->$validationType($viewModel->$property, $validationDetails["Properties"]))
              {
                $validationMessages[$property][$validationType] = $validationDetails["Message"];
              }
            }
            catch(Exception $ex)
            {
              $validationMessages[$property][$validationType] = gettext("Some unknown error has occurred");
            }
          }
      }
    }

    //$validationResult = new ValidationResult($validationMessages);

    return $validationMessages;
  }

  private function email($propertyValue)
  {
    return filter_var($propertyValue, FILTER_VALIDATE_EMAIL);
  }

  private function fieldMatch($propertyValue, $properties)
  {
    return true;
  }

  private function required($propertyValue)
  {
    return !empty($propertyValue);
  }

	private function name($match)
  {
    return preg_match('/^[a-zA-Z -]{2,30}$/', $match);
	}

  private function phoneThreeDigit($match)
  {
    return preg_match('/^[0-9]{3}/', $match);
  }

  private function phoneAreaCode($match)
  {
    return preg_match('/^[0-9]{3}/', $match);
  }

  private function phoneFourDigit($match)
  {
    return preg_match('/^[0-9]{4}/', $match);
  }

 private function unitNo($match)
 {
    return preg_match('/^[0-9A-Za-z]{1,6}/', $match);
 }
 private function aptNo($match){
    return preg_match('/^[0-9A-Za-z]{1,6}/', $match);
 }
 private function streetNo($match)
 {
    return preg_match('/^[0-9A-Za-z]{1,6}/', $match);
 }
 private function street($match)
 {
    return preg_match('/^[A-Za-z\- ]{1,30}/', $match);
 }
 private function city($match)
 {
    return preg_match('/^[A-Za-z\- ]{1,30}/', $match);
 }
 private function postalCode($match)
 {
    return preg_match('/^[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1} *\d{1}[A-Z]{1}\d{1}$/', $match);
 }
 function badWord($string){
    $string =strtolower($string);
    $badWords = array("fuck","shit","asshole","bitch","whore","cunt");
    $matches = array();
    $matchFound = preg_match_all("/\b(" . implode($badWords,"|") . ")\b/i",$string,$matches);

    return $matchFound;
  }

  function validFileType($file)
  {
    // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
    // Check MIME Type by yourself.
    $finfo = new finfo(FILEINFO_MIME_TYPE);

    if (false === $ext = array_search($finfo->file($file['tmp_name']), 
      array('jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif'), true )) 
    {
        return false;
    }
    
    return true;
  }
}
?>