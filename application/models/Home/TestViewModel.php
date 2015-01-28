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
		array('email' => 
			array('email' => 'Invalid email',
					'required' => 'email is required')
		)
		parent::__construct(array('email' => 'email'));
	}
}
?>