<?php
require(ROOT_DIR .'system/AbstractHtml.php');
/**
* 
*/
class BootstrapHtml extends AbstractHtml
{
	public static function input($object, $property, $label = null, $inputType = "text", $placeholder = "", $htmlProperties = array())
	{
		$varName = self::getVariableName($object, $property);
		$varValue = self::getVariableValue($object, $property);

		self::beginInput();

		if (isset($label)) 
		{
			self::addLabel($varName, $label);
		}

		self::addInput($varName, $varValue, $inputType, $placeholder, $htmlProperties);

		self::endInput();
	}

	protected static function beginInput()
	{
		echo '<div class="form-group">';
	}
	protected static function addLabel($for, $labelText)
	{
		echo '<label for="' . $for . '">' . $labelText . '</label>';
	}
	protected static function addInput($varName, $varValue, $inputType, $placeholder, $htmlProperties)
	{
		switch ($inputType) {
			case 'text':
				$inputType = "text";
				break;
			case 'password':
				$inputType = "password";
				break;
			case 'date':
				$inputType = "date";
				break;
			case 'email':
				$inputType = "email";
				break;
			case 'phone':
				$inputType = "phone";
				break;
			case 'select':
				$inputType = "select";
				break;
			case 'radio':
				$inputType = "radio";
				break;
			default:
				$inputType = "text";
				break;
		}

		echo '<input type="' . $inputType . '" placeholder="' . $placeholder . '"';

		if(!isset($htmlProperties["id"]))
		{
			$htmlProperties["id"] = $varName;
		}
		if(!isset($htmlProperties["class"]))
		{
			$htmlProperties["class"] = "";
		}

		foreach ($htmlProperties as $key => $value) {
		 
		 	if($key == "class")
			{
				$value .= " form-control";
			}
			
			echo ' ' . $key . '="' . $value . '" ';
		}
		echo '> <p class="help-block"></p>';
	}
	protected static function endInput()
	{
		echo '</div>';
	}
}
?>


            
            
        