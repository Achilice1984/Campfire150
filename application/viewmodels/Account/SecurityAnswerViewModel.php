<?php
/**
* 
*/
class SecurityAnswerViewModel extends ViewModel
{
	public $SecurityQuestionId;// = "Josh";
	public $Password;// = "josh.dvrs@gmail.com";
	public $SecurityAnswer;// = "josh.dvrs@gmail.com";

	function __construct()
	{		
		$validate["SecurityQuestionId"] = array(
			'required' =>
				array(
					'Message' => gettext('Invalid Security Question field is required.'),
					'Properties' => array()
				)
		);
		$errors["Password"] = array(
			'required' =>
				array(
					'Message' => gettext('The Password field is required.'),
					'Properties' => array()
				)
		);

		$errors["SecurityAnswer"] = array(
			'required' =>
				array(
					'Message' => gettext('The Security Question Answer field is required.'),
					'Properties' => array()
				)
		);

		//Pass validation to the View Model
		parent::__construct($errors);
	}
}
?>