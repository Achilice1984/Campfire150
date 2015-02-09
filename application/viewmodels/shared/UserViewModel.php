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
							array('email' => 'Invalid email',
									'required' => 'email is required'),
							'FirstName' =>
								array('required' => 'the name field is required!'),
							'LastName' =>
								array('required' => 'the name field is required!'),
							'Password' =>
								array('required' => 'the name field is required!'),
							'RePassword' =>
								array('required' => 'the name field is required!'),
							'Address' =>
								array('required' => 'the name field is required!'),
							'PostalCode' =>
								array('required' => 'the name field is required!'),
							'LanguageType_LanguageId' =>
								array('required' => 'the name field is required!')
						));
	}
}
?>