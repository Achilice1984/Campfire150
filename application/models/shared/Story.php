<?php
/**
* 
*/
class Story extends Model
{
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
		parent::__construct(array());
	}

	
}
?>