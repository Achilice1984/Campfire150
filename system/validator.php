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
              $validationMessages[$property][$validationType] = "Some unknown error has occurred";
            }
          }
      }
    }

    //$validationResult = new ValidationResult($validationMessages);

    return $validationMessages;
  }

  private function email($propertyValue)
  {
    return !filter_var($propertyValue, FILTER_VALIDATE_EMAIL);
  }

  private function required($propertyValue)
  {
    return empty($propertyValue);
  }

	private function name($match){
    if (preg_match('/^[a-zA-Z -]{2,30}$/', $match)){
      return true;
    }
    else{
      return false;
    }
	}
  private function firstName($match){
    if (preg_match('/^[a-zA-Z -]{2,30}$/', $match)){
      return true;
    }
    else{
      return false;
    }
  }
  private function lastName($match){
    if (preg_match('/^[a-zA-Z -]{2,30}$/', $match)){
      return true;
    }else{
      return false;
    }
  }
  private function phoneThreeDigit($match){
    if (preg_match('/^[0-9]{3}/', $match)){
      return true;
    }
    else{
      return false;
    } 
  }
  private function phoneAreaCode($match){
    if (preg_match('/^[0-9]{3}/', $match)){
      return true;
    }
    else{
      return false;
    } 
  }
  private function phoneFourDigit($match){
    if (preg_match('/^[0-9]{4}/', $match)){
      return true;
    }else{
      return false;
    } 
  }
 private function unitNo($match){
  if (preg_match('/^[0-9A-Za-z]{1,6}/', $match)){
   return true;
  }else{
   return false;
  }
 }
 private function aptNo($match){
  if (preg_match('/^[0-9A-Za-z]{1,6}/', $match)){
   return true;
  }else{
   return false;
  }
 }
 private function streetNo($match){
  if (preg_match('/^[0-9A-Za-z]{1,6}/', $match)){
   return true;
  }else{
   return false;
  }
 }
 private function street($match){
  if (preg_match('/^[A-Za-z\- ]{1,30}/', $match)){
   return true;
  }else{
   return false;
  }
 }
 private function city($match){
  if (preg_match('/^[A-Za-z\- ]{1,30}/', $match)){
   return true;
  }else{
   return false;
  }
 }
 private function postalCode($match){
  if (preg_match('/^[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1} *\d{1}[A-Z]{1}\d{1}$/', $match)){
   return true;
  }else{
   return false;
  }
 }
 function badWord($string){
  $string =strtolower($string);
  $badWords = array("fuck","shit","asshole","bitch","whore","cunt");
  $matches = array();
  $matchFound = preg_match_all("/\b(" . implode($badWords,"|") . ")\b/i",$string,$matches);
  if ($matchFound) {
   return true;
  }else{
   return false;
 }}
  function validFileType($fileType){
  $fileType =strtolower($fileType);
  $validTypes = array("png","jpg","jpeg","bmp","mp4","ogg","mp3");
  $matches = array();
  $matchFound = preg_match_all("/\b(" . implode($validTypes,"|") . ")\b/i",$fileType,$matches);
  if ($matchFound) {
   return true;
  }else{
   return false;
 }}
}
?>