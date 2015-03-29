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
    global $config;

    $this->viewModel = $viewModel;
    $validationMessages = array();
    $validationDecorators = $viewModel->getValidationDecorators();

    if(isset($validationDecorators))
    {
      foreach ($validationDecorators as $property => $validationTypes) {
        foreach ($validationTypes as $validationType => $validationDetails) {

          try
          {
              if(method_exists($this, $validationType) && property_exists($viewModel, $property))
              {
                //Call a validation method
                if(!$this->$validationType($viewModel->$property, $validationDetails["Properties"]))
                {
                  $validationMessages[$property][$validationType] = $validationDetails["Message"];
                }
              }
              else
              {
                if($config["debugMode"] == true)
                {
                  $validationMessages[$property][$validationType] = "This will only show in debug mode: <br />Failed on: <br />" . $validationType . " " . $property;
                }
                else
                {
                  $validationMessages[$property][$validationType] = gettext("Some unknown error has occurred");
                }
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

  private function date($propertyValue)
  {
    $format = "Y-m-d";

    $d = DateTime::createFromFormat($format, $propertyValue);

    return $d && $d->format($format) == $propertyValue;
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
      try
      {
          // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
          // Check MIME Type by yourself.
         // $finfo = new finfo(FILEINFO_MIME_TYPE);

          if(isset($file['size']) && $file['size'] > 0)
          {
            // if (false === $ext = array_search($finfo->file($file['tmp_name']), 
            //   array('jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif'), true )) 
            // {
            //     return false;
            // }

            // $allowed =  array('gif','png' ,'jpg');
            // $filename = $file['name'];
            // $ext = pathinfo($filename, PATHINFO_EXTENSION);
            // if(!in_array($ext,$allowed) ) {
            //     echo 'error';
            // }
            return true;

          }
          else
          {
            return false;
          }
      }
      catch(Exception $ex)
      {
          return false;
      }
      
      return true;
  }
  function img_required($file)
  {
      return ($file['size'] > 0);
  }
  function validateYoutubeEmbedTag($embedHtml){
      /*
      <iframe width="560" height="315" src="https://www.youtube.com/embed/gauN0gzxTcU" frameborder="0" allowfullscreen></iframe>
      get everything between src="  and the final closing "
      if the string isn't a youTube embed tag to begin with it will return false
      */
      $start='src="';
      $end='"';

      if ( preg_match('/<script>/',$embedHtml) && preg_match('/src="/',$embedHtml) && preg_match('/</script>/',$embedHtml)   ) 
      {
        $htmlAddress=get_string_between($embedHtml);
        $start='<iframe width="560" height="315" src="';
        $end='" frameborder="0" allowfullscreen></iframe>';
        
        return $start.$htmlAddress.$end;
      }
      else
      {
        return gettext('Not a proper YouTube embed tag.');
      }        
  }
  function get_string_between($string, $start, $end){
    $string = " ".$string;
    $ini = strpos($string,$start);
    if ($ini == 0) return "";
    $ini += strlen($start);
    $len = strpos($string,$end,$ini) - $ini;
    return substr($string,$ini,$len);
   } 
}
?>