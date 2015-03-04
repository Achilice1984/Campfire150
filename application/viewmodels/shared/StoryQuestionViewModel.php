<?php
/**
* 
*/
class StoryQuestionViewModel extends ViewModel
{
	//Story properties same as in database
	public $Value;
	public $Name;
	public $Answers;//DropDownViewModel
	
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
?>