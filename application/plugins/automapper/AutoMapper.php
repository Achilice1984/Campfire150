<?php 

/**
* 
*/
class AutoMapper
{
	public static function mapPost($viewModel)
	{
		foreach($_POST as $name => $value) 
		{
			if(property_exists(get_class($viewModel), $name))
			{
				$viewModel->$name = $value;
			}
		}

		return $viewModel;
	}
}
?>