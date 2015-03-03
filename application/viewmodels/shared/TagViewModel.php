<?php
/**
* 
*/
class TagViewModel extends ViewModel
{
	public $id;
	public $text;

	function __construct()
	{
		//Pass validation to the View Model
		parent::__construct(array());
	}
}

?>