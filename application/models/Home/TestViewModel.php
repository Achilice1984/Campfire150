<?php
/**
* 
*/
class TestViewModel extends Model
{
	public $name;// = "Josh";
	public $email;// = "josh.dvrs@gmail.com";

	function __construct()
	{
		parent::__construct(array('email' => 'email'));
	}
}
?>