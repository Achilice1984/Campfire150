<?php
/**
* 
*/
class UserViewModel extends ViewModel
{
	public $UserId;
	public $Email;
	public $Password;
	public $RePassword;
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
	public $IsAuth;
	public $LanguagePreference;
	public $PhoneNumber;

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