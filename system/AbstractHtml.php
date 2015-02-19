<?php
/**
* 
*/
abstract class AbstractHtml
{
	abstract static public function input($object, $property, $label = null, $inputType = "text");

	abstract static protected function beginInput();
	abstract static protected function addLabel($for, $labelText);
	abstract static protected function addInput($varName, $varValue, $inputType, $placeholder, $htmlProperties);
	abstract static protected function endInput();

	protected static function getVariableName($object, $property)
	{
		if(isset($object) && isset($property))
		{
			$className = get_class($object);

			if(isset($className))
			{
				if(property_exists($className, $property))
				{
					return $property;
				}
			}			
		}

		return "";
	}

	protected static function getVariableValue($object, $property)
	{
		if(isset($object) && isset($property))
		{
			$className = get_class($object);

			if(isset($className))
			{
				if(property_exists($className, $property))
				{
					return $object->$property;
				}
			}			
		}

		return "";
	}
}
?>
