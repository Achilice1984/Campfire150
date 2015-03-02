<?php
/**
* 
*/
class StoryViewModel extends ViewModel
{
	//Story properties same as in database
	public $StoryId;
	public $User_UserId;

	public $DatePosted;	
	public $DateCreated;
	public $DateUpdated;		

	public $StoryTitle;
	public $Content;
	public $Active;
	public $LatestChange;
	public $Published;
	public $StoryPrivacyType_StoryPrivacyTypeId;

	public $Tag;
	public $TagId;

	public $QuestionAnswers;

	function __construct()
	{
		$errors["ProfilePrivacyType_PrivacyTypeId"] = array(
			'required' =>
				array(
					'Message' => gettext('The privacy field is required!'),
					'Properties' => array()
				)
		);


		//Pass validation to the View Model
		parent::__construct($errors);
	}
}
?>