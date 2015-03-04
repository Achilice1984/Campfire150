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
		$errors["Story_StoryId"] = array(
			'required' =>
				array(
					'Message' => gettext('Please refresh the page.'),
					'Properties' => array()
				)
		);

		$errors["Content"] = array(
			'required' =>
				array(
					'Message' => gettext('The comment field is required!'),
					'Properties' => array()
				)
		);


		//Pass validation to the View Model
		parent::__construct($errors);
	}
}
?>