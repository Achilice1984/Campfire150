<?php
/**
* 
*/
class ChangeProfilePictureViewModel extends ViewModel
{
	public $ProfilePicture;

	function __construct()
	{		
		parent::__construct(array('ProfilePciture' => 
										//array('validFileType' => gettext("invalid image file type")),
										array('required' => gettext('missing image file'))
								));
	}
}
?>