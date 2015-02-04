<?php
/**
* 
*/
class QuestionViewModel extends ViewModel
{
	//Question properties same as in database

	public $QuestionId;
	public $QuestionE;
	public $QuestionF;

	function __construct()
	{
		//Add validation decorators
		// parent::__construct(array('Email' => 
		// 							array('email' => 'Invalid email',
		// 									'required' => 'email is required'),
		// 							'FirstName' =>
		// 								array('required' => 'the name field is required!')
		// 						));
	}
	}
}
?>