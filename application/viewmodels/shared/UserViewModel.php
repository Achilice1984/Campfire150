<?php
/**
* 
*/
class UserViewModel extends ViewModel
{
	public $IsAdmin;
	public $IsAuth;
	public $LanguagePreference;

	public $UserId;
	public $Email;
	public $Password;
	public $RePassword;

	public $RegisterDate;
	public $Active;
	public $AdminFlag;
	public $PhoneNumber;
	public $FailedLoginAttempt;
	public $LockoutTimes;
	public $VerifiedEmail;
	
	public $AchievementLevelType_LevelId;
	public $Address;
	public $PostalCode;
	public $Notes;
	public $FirstName;
	public $MidName;
	public $LastName;
	public $LanguageType_LanguageId;

	public $ProfilePrivacyType_PrivacyTypeId;

	function __construct()
	{		
		parent::__construct(array(
							'Email' => 
							array('email' => 'Invalid Email Address',
									'required' => 'The Email field is required!'),
							'FirstName' =>
								array('required' => 'The First Name field is required!'),
							'LastName' =>
								array('required' => 'The Last Name is required!'),
							'Password' =>
								array('required' => 'The Password field is required!'),
							'RePassword' =>
								array('required' => 'The The Re-Type Password field is required!'),
							'Address' =>
								array('required' => 'The Address field is required!'),
							'PostalCode' =>
								array('required' => 'The Postal Code field is required!'),
							'LanguageType_LanguageId' =>
								array('required' => 'The Language field is required!')
						));
	}
}
?>