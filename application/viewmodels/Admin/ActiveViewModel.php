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
					'Message' => gettext('The Table Name field is required!'),
					'Properties' => array()
				)
		);		
		$errors["Id"] = array(
			'required' =>
				array(
					'Message' => gettext('The UserId field is required!'),
					'Properties' => array()
				)
		);
		$errors["Active"] = array(
			'required' =>
				array(
					'Message' => gettext('The Active field is required!'),
					'Properties' => array()
				)
		);

		$errors["Reason"] = array(
			'required' =>
				array(
					'Message' => gettext('The Reason field is required!'),
					'Properties' => array()
				)
		);

		//Pass validation to the View Model
		parent::__construct($errors);
	}
}
?>