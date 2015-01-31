<?php
/**
* 
*/
class UserPicture extends ViewModel
{
	public $PictureId;
	public $PictureName;
	public $InappropiateFlag_IsAppropriateFlag;


	function __construct()
	{		
		parent::__construct(array('Email' => 
									array('email' => 'Invalid email',
											'required' => 'email is required'),
									'FirstName' =>
										array('required' => 'the name field is required!')
								));
	}
}
?>