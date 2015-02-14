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
		$validate["Email"] = array(
			'email' =>
				array(
					'Message' => gettext('Invalid Email Address.'),
					'Properties' => array()
				)
		);
		$errors["Password"] = array(
			'required' =>
				array(
					'Message' => gettext('The Password field is required!'),
					'Properties' => array()
				)
		);

		//Pass validation to the View Model
		parent::__construct($errors);
	}
}
?>