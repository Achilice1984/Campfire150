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
	public $AchievementLevelType_LevelId;
	public $Address;
	public $PostalCode;
	public $Notes;
	public $FirstName;
	public $MidName;
	public $LastName;
	public $LanguageType_LanguageId;
<<<<<<< HEAD:application/viewmodels/shared/User.php
	public $Active;
	public $AdminFlag;
	public $VerifiedEmail;
	public $PhoneNumber;
	public $VerificationCode;
	public $FailedLoginAttempt;
	public $LockoutTimes;
=======
	public $IsAdmin;
	public $IsAuth;
	public $LanguagePreference;
	public $PhoneNumber;
>>>>>>> origin/continue-admin-module:application/viewmodels/shared/UserViewModel.php

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