<?php
/**
* 
*/
class ActiveViewModel extends ViewModel
{
	public $TableName;
	public $Id; //Id of the user
	public $Active; // Active or deactive
	public $Reason; // For what kind of reason

	function __construct()
	{
		$errors["TableName"] = array(
			'required' =>
				array(
					'Message' => gettext('The TableName field is required!'),
					'Properties' => array()
				)
		);		
		$errors["UserId"] = array(
			'required' =>
				array(
					'Message' => gettext('The UserId field is required!'),
					'Properties' => array()
				)
		);
		$errors["Active"] = array(
			'required' =>
				array(
					'Message' => gettext('The Active Name field is required!'),
					'Properties' => array()
				)
		);

		$errors["Reason"] = array(
			'required' =>
				array(
					'Message' => gettext('The Reason name field is required!'),
					'Properties' => array()
				)
		);

		//Pass validation to the View Model
		parent::__construct($errors);
	}
}
?>