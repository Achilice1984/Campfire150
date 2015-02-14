<?php
/**
* 
*/
class AnswerViewModel extends ViewModel
{
	//Story properties same as in database
	public $AnswerId;
	public $AnswerE;
	public $AnswerF;
	
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