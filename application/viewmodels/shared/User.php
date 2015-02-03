<?php
/**
* 
*/
class User extends ViewModel
{
	public $UserId;
	public $Email;
	public $Password;
	public $RegisterDate;
	public $Address;
	public $PostalCode;
	public $Notes;
	public $AchievementLevelType_LevelId;
	public $FirstName;
	public $MidName;
	public $LastName;
	public $LanguageType_LanguageId;
	public $IsAdmin;

	function __construct()
	{		
		parent::__construct(array('email' => 
									array('email' => 'Invalid email',
											'required' => 'email is required'),
									'name' =>
										array('required' => 'the name field is required!')
								));
	}
}
?>