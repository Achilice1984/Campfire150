<?php
/**
* 
*/
class DropdownItemViewModel extends ViewModel
{
	public $Id; //Id of item
	public $NameE; // English Name
	public $NameF; // French Name
	public $DateCreated;
	public $DateUpdated;

	function __construct()
	{		
		/*$errors["Id"] = array(
			'required' =>
				array(
					'Message' => gettext('The Id field is required!'),
					'Properties' => array()
				)
		);*/
		$errors["NameE"] = array(
			'required' =>
				array(
					'Message' => gettext('The english Name field is required!'),
					'Properties' => array()
				)
		);

		$errors["NameF"] = array(
			'required' =>
				array(
					'Message' => gettext('The french name field is required!'),
					'Properties' => array()
				)
		);

		//Pass validation to the View Model
		parent::__construct($errors);
	}
}
?>