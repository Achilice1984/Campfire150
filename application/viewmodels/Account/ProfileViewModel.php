<?php
/**
* 
*/
class ProfileViewModel extends ViewModel
{
	public $IsAdmin;
	public $IsAuth;
	public $LanguagePreference;

	public $UserId;
	public $Email;

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