<?php
/**
* 
*/
class CommentViewModel extends ViewModel
{
	//Comment properties same as in database

	public $CommentId;
	public $Story_StoryId;
	public $User_UserId;
	public $Content;
	public $PublishFlag;
	public $TimeStamp;
	
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