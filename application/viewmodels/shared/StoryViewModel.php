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
		//Add validation decorators
		// parent::__construct(array('Email' => 
		// 							array('email' => 'Invalid email',
		// 									'required' => 'email is required'),
		// 							'FirstName' =>
		// 								array('required' => 'the name field is required!')
		// 						));
	}
	}
}
?>