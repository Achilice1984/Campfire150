<?php
/**
* 
*/
class UserPicture extends Model
{
	public $PictureId;
	public $PictureName;
	public $InappropiateFlag_IsAppropriateFlag;

	function __construct()
	{
		parent::__construct(array());
	}
}
?>