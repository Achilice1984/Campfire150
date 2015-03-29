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

	//Flags
	public $RegisterDate;
	public $Active;
	public $AdminFlag;
	public $PhoneNumber;
	public $FailedLoginAttempt;
	public $LockoutTimes;
	public $VerifiedEmail;
	
	//Contact Details
	public $Address;
	public $PostalCode;
	public $Notes;
	public $FirstName;
	public $MidName;
	public $LastName;

	
	public $Ethnicity;
	public $Birthday;

	public $Gender_GenderId;
	public $AchievementLevelType_LevelId;
	public $ProfilePrivacyType_PrivacyTypeId;
	public $LanguageType_LanguageId;

	public $SecurityQuestionId;
	public $SecurityAnswer;

	public $YearsInCanada;

	public $ActionStatement;

	public $PicUrl;

	function __construct()
	{
		/**********************************
		*
		*	Add validation to this viewmodel
		*
		*************************************/
		

		$errors["Email"] = array(
			'email' =>
				array(
					'Message' => gettext('Invalid email address.'),
					'Properties' => array()
				),
			'required' =>
				array(
					'Message' => gettext('The Email field is required!'),
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
		// $errors["SecurityQuestionId"] = array(
		// 	'required' =>
		// 		array(
		// 			'Message' => gettext('The Security Question field is required!'),
		// 			'Properties' => array()
		// 		)
		// );
		// $errors["SecurityAnswer"] = array(
		// 	'required' =>
		// 		array(
		// 			'Message' => gettext('The Security Question Answer field is required!'),
		// 			'Properties' => array()
		// 		)
		// );
		$errors["ProfilePrivacyType_PrivacyTypeId"] = array(
			'required' =>
				array(
					'Message' => gettext('The Privacy field is required!'),
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
		$errors["Gender_GenderId"] = array(
			'required' =>
				array(
					'Message' => gettext('The Gender field is required!'),
					'Properties' => array()
				)
		);
		$errors["Birthday"] = array(
			'required' =>
				array(
					'Message' => gettext('The Birthday field is required!'),
					'Properties' => array()
				),
			'date' =>
				array(
					'Message' => gettext('The Birthday field is not a valid date!'),
					'Properties' => array()
				)
		);
		$errors["YearsInCanada"] = array(
			'required' =>
				array(
					'Message' => gettext('The Years Living in Canada field is required!'),
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
		$errors["PostalCode"] = array(
			'required' =>
				array(
					'Message' => gettext('The Postal Code field is required!'),
					'Properties' => array()
				),
			'postalCode' =>
				array(
					'Message' => gettext('The postal code is invalid!'),
					'Properties' => array()
				)
		);

		//Pass validation to the View Model
		parent::__construct($errors);
	}
}
?>