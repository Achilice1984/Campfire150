<?php
/**
* 
*/
class User extends ViewModel
{
	public $name;// = "Josh";
	public $email;// = "josh.dvrs@gmail.com";

	function __construct()
	{	
		$validators['email'] = 	array('email' => 'Invalid email',
											'required' => 'email is required');

		$validators['name'] = array('required' => 'the name field is required!');


		parent::__construct($validators);
		
		// parent::__construct(array('email' => 
		// 							array('email' => 'Invalid email',
		// 									'required' => 'email is required'),
		// 							'name' =>
		// 								array('required' => 'the name field is required!')
		// 						));
	}
}
?>