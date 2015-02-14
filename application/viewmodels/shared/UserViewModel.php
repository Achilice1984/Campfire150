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

	public $UserActionStatement;

	function __construct()
	{
		$validate = array();

		/**********************************
		*
		*	Add validation to this viewmodel
		*
		*************************************/
		$validate["Email"] = array(
			'email' =>
				array(
					'Message' => gettext('Invalid Email Address.'),
					'Properties' => array()
				),
			'required' =>
				array(
					'Message' => gettext('The Email field is required!'),
					'Properties' => array()
				)
		);
		$errors["FirstName"] = array(
			'required' =>
				array(
					'Message' => gettext('The First Name field is required!'),
					'Properties' => array()
				)
		);
		$errors["LastName"] = array(
			'required' =>
				array(
					'Message' => gettext('The Last Name is required!'),
					'Properties' => array()
				)
		);
		$errors["Password"] = array(
			'required' =>
				array(
					'Message' => gettext('The Password field is required!'),
					'Properties' => array()
				),
			'fieldMatch' =>
				array(
					'Message' => gettext('The Password field does not match the Re-Type Password field!'),
					'Properties' => array('RePassword')
				)
		);
		$errors["RePassword"] = array(
			'required' =>
				array(
					'Message' => gettext('The The Re-Type Password field is required!'),
					'Properties' => array()
				)
		);
		$errors["PostalCode"] = array(
			'required' =>
				array(
					'Message' => gettext('The Postal Code field is required!'),
					'Properties' => array()
				)
		);
		$errors["LanguageType_LanguageId"] = array(
			'required' =>
				array(
					'Message' => gettext('The Language field is required!'),
					'Properties' => array()
				)
		);
		$errors["ProfilePrivacyType_PrivacyTypeId"] = array(
			'required' =>
				array(
					'Message' => gettext('The privacy field is required!'),
					'Properties' => array()
				)
		);


		//Pass validation to the View Model
		parent::__construct($errors);
	}
}
?>