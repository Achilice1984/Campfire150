<?php
/**
* 
*/
class StoryViewModel extends ViewModel
{
	//Story properties same as in database
	public $StoryId;
	public $DatePosted;
	public $User_UserId;
	public $StoryTitle;
	public $Content;
	public $PrivacyType_PrivacyTypeId;
	public $Active;
	public $LatestChange;

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