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
	public $AchievementLevelType_LevelId;
	public $Address;
	public $PostalCode;
	public $Notes;
	public $FirstName;
	public $MidName;
	public $LastName;
	public $LanguageType_LanguageId;
	public $Active;
	public $AdminFlag;
	public $VerifiedEmail;
	public $PhoneNumber;
	public $VerificationCode;
	public $FailedLoginAttempt;
	public $LockoutTimes;

	function __construct()
	{		
		// parent::__construct(array('Email' => 
		// 							array('email' => 'Invalid email',
		// 									'required' => 'email is required'),
		// 							'FirstName' =>
		// 								array('required' => 'the name field is required!')
		// 						));
	}
}
?>