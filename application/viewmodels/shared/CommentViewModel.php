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