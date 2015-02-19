<?php
/**
* 
*/
class SecurityAnswerViewModel extends ViewModel
{
	//Story properties same as in database
	public $SecurityQuestionId;
	public $SecurityAnswer;

	function __construct()
	{
		$errors["SecurityQuestionId"] = array(
			'required' =>
				array(
					'Message' => gettext('The security question field is required!'),
					'Properties' => array()
				)
		);
		$errors["SecurityAnswer"] = array(
			'required' =>
				array(
					'Message' => gettext('The security question answer field is required!'),
					'Properties' => array()
				)
		);

		// //Pass validation to the View Model
		parent::__construct($errors);
	}
}
?>