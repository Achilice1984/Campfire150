<?php
/**
* 
*/
class QuestionViewModel extends ViewModel
{
	//Question properties same as in database

	public $QuestionId;
	public $QuestionE;
	public $QuestionF;

	function __construct()
	{
		// $errors["ProfilePrivacyType_PrivacyTypeId"] = array(
		// 	'required' =>
		// 		array(
		// 			'Message' => gettext('The privacy field is required!'),
		// 			'Properties' => array()
		// 		)
		// );


		// //Pass validation to the View Model
		// parent::__construct($errors);
	}
	}
}
?>