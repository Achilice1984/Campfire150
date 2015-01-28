<?php
/**
* 
*/
class Comment extends Model
{
	public $CommentId;
	public $Story_StoryId;
	public $User_UserId;
	public $Title;
	public $CommentContent;
	public $PublishFlag;

	function __construct()
	{
		parent::__construct(array());
	}
}
?>