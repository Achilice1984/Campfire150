<?php
/**
* 
*/
class PictureViewModel extends ViewModel
{
	//Picture properties same as in database

	public $PictureId;
	public $Title;
	public $Description;
	public $FileName;
	public $Active;
	public $InppropriateFlag;
	public $User_UserId;
	public $TimeStamp;
	public $picturetype_PictureTypeId;
	public $PictureExtension;	

	public $PictureUrl;
	public $PictureFile;
	

	function __construct()
	{
		parent::__construct(array());
		//Add validation decorators
		// parent::__construct(array('Email' => 
		// 							array('email' => 'Invalid email',
		// 									'required' => 'email is required'),
		// 							'FirstName' =>
		// 								array('required' => 'the name field is required!')
		// 						));
		//}
	}
}
?>