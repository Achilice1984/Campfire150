<?php
/**
* 
*/
class ChangePasswordViewModel extends ViewModel
{
	public $OldPassword;
	public $Password;
	public $RePassword;

	function __construct()
	{		
		parent::__construct(array('OldPassword' => 
										array('required' => 'the old password field is required!'),
									'Password' =>
										array('required' => 'the password field is required!'),
									'RePassword' =>
										array('required' => 'the re-type password field is required!')
								));
	}
}
?>