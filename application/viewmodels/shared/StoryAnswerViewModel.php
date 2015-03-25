<?php
/**
* 
*/
class StoryAnswerViewModel extends ViewModel
{
	public $AnswerId; //Id of item
	public $NameE; // English Name
	public $NameF; // French Name
	public $Question_QuestionId; //Id of item
	public $DateCreated;
	public $DateUpdated;
	public $Active;

	function __construct()
	{		
		// $errors["QuestionId"] = array(
		// 	'required' =>
		// 		array(
		// 			'Message' => gettext('The table field is required!'),
		// 			'Properties' => array()
		// 		)
		// );
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