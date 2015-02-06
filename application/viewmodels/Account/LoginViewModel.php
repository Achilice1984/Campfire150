<?php
/**
* 
*/
class LoginViewModel extends ViewModel
{
	public $Email;// = "Josh";
	public $Password;// = "josh.dvrs@gmail.com";
	public $RememberMe;// = "josh.dvrs@gmail.com";

	function __construct()
	{		
		parent::__construct(array('Email' => 
									array('email' => 'Thats an invalid email!',
											'required' => 'the email field is required!'),
									'Password' =>
										array('required' => 'the password field is required!')
								));
	}
}
?>