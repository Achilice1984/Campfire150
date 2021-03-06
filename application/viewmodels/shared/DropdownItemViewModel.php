<?php
/**
* 
*/
class DropdownItemViewModel extends ViewModel
{
	public $TableName; //Name of the table
	public $Id; //Id of item
	public $NameE; // English Name
	public $NameF; // French Name
	public $DateCreated;
	public $DateUpdated;

	function __construct()
	{		
		$errors["TableName"] = array(
			'required' =>
				array(
					'Message' => gettext('The Table field is required.'),
					'Properties' => array()
				)
		);
		$errors["NameE"] = array(
			'required' =>
				array(
					'Message' => gettext('The English Name field is required.'),
					'Properties' => array()
				)
		);

		$errors["NameF"] = array(
			'required' =>
				array(
					'Message' => gettext('The French Name field is required.'),
					'Properties' => array()
				)
		);

		//Pass validation to the View Model
		parent::__construct($errors);
	}
}
?>