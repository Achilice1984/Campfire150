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

		$errors["OldPassword"] = array(
			'required' =>
				array(
					'Message' => gettext('The The Old Password field is required!'),
					'Properties' => array()
				)
		);
		$errors["Password"] = array(
			'required' =>
				array(
					'Message' => gettext('The Password field is required!'),
					'Properties' => array()
				),
			'fieldMatch' =>
				array(
					'Message' => gettext('The Password field does not match the Re-Type Password field!'),
					'Properties' => array('RePassword')
				)
		);
		$errors["RePassword"] = array(
			'required' =>
				array(
					'Message' => gettext('The The Re-Type Password field is required!'),
					'Properties' => array()
				)
		);

		//Pass validation to the View Model
		parent::__construct($errors);
	}
}
?>