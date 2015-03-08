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
	public $Picturetype_PictureTypeId;
	public $PictureExtension;	

	public $PictureUrl;
	public $PictureFile;
	

	function __construct()
	{
		$errors["PictureFile"] = array(
			'validFileType' =>
				array(
					'Message' => gettext('The file you choose is not a valid file type.'),
					'Properties' => array()
				)
		);

		//Pass validation to the View Model
		parent::__construct($errors);
	}
}
?>