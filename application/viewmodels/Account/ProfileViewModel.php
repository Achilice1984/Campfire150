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

	public $Ethnicity;
	public $Birthday;

	public $YearsInCanada;

	public $ProfilePrivacyType_PrivacyTypeId;
	public $Gender_GenderId;

	public $UserActionStatement;

	function __construct()
	{		

		$errors["Email"] = array(
			'email' =>
				array(
					'Message' => gettext('Invalid email address.'),
					'Properties' => array()
				),
			'required' =>
				array(
					'Message' => gettext('The Email field is required.'),
					'Properties' => array()
				)
		);
		$errors["FirstName"] = array(
			'required' =>
				array(
					'Message' => gettext('The First Name field is required.'),
					'Properties' => array()
				)
		);
		$errors["LastName"] = array(
			'required' =>
				array(
					'Message' => gettext('The Last Name field is required.'),
					'Properties' => array()
				)
		);
		// $errors["Password"] = array(
		// 	'required' =>
		// 		array(
		// 			'Message' => gettext('The Password field is required.'),
		// 			'Properties' => array()
		// 		),
		// 	'fieldMatch' =>
		// 		array(
		// 			'Message' => gettext('The Password field does not match the Re-Type Password field.'),
		// 			'Properties' => array('RePassword')
		// 		)
		// );

		$errors["PostalCode"] = array(
			'required' =>
				array(
					'Message' => gettext('The Postal Code field is required.'),
					'Properties' => array()
				)
		);
		$errors["LanguageType_LanguageId"] = array(
			'required' =>
				array(
					'Message' => gettext('The Language field is required.'),
					'Properties' => array()
				)
		);
		$errors["ProfilePrivacyType_PrivacyTypeId"] = array(
			'required' =>
				array(
					'Message' => gettext('The Privacy field is required.'),
					'Properties' => array()
				)
		);
		$errors["Birthday"] = array(
			'required' =>
				array(
					'Message' => gettext('The Birthday field is required.'),
					'Properties' => array()
				),
			'date' =>
				array(
					'Message' => gettext('The Birthday field is not a valid date.'),
					'Properties' => array()
				)
		);

		$errors["Gender_GenderId"] = array(
			'required' =>
				array(
					'Message' => gettext('The Gender field is required.'),
					'Properties' => array()
				)
		);

		//Pass validation to the View Model
		parent::__construct($errors);
	}
}
?>