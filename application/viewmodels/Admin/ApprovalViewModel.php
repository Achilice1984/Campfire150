<?php
/**
* 
*/
class ApprovalViewModel extends ViewModel
{
	//public $Id; //Id of story, or comment
	public $Content; // Comment from admin
	public $Approved; // if story is apporved or not

	function __construct()
	{		
		/*$errors["Id"] = array(
			'required' =>
				array(
					'Message' => gettext('The Id field is required!'),
					'Properties' => array()
				)
		);*/
		$errors["Content"] = array(
			'required' =>
				array(
					'Message' => gettext('The Content field is required!'),
					'Properties' => array()
				)
		);

		$errors["Approved"] = array(
			'required' =>
				array(
					'Message' => gettext('The Approved field is required!'),
					'Properties' => array()
				)
		);

		//Pass validation to the View Model
		parent::__construct($errors);
	}
}
?>