<?php

class SiteContentModel extends Model {	

	/******************************************************************************************************************
	*
	*				Dropdowns
	*
	******************************************************************************************************************/	

	public function getDropdownValues_ProfilePrivacyType()
	{
		$sessionManager = new SessionManager();
		$statement;

		if($sessionManager->isEng())
		{
			$statement = "SELECT PrivacyTypeId AS Value, NameE AS Name FROM ProfilePrivacyType";
		}
		else
		{
			$statement = "SELECT PrivacyTypeId AS Value, NameF AS Name FROM ProfilePrivacyType";
		}

		//Get dropdown values
		$privacyDropdownValues = $this->fetchIntoClass($statement, null, "shared/DropDownViewModel");

		return $privacyDropdownValues;
	}

	public function getDropdownValues_StoryPrivacyType()
	{
		$statement = "SELECT * FROM StoryPrivacyType";

		//Get dropdown values
		$dropdownValues = $this->fetchIntoClass($statement, null, "shared/DropDownViewModel");

		return $dropdownValues;
	}

	public function getDropdownValues_LanguageType()
	{
		$statement = "SELECT * FROM languagetype";

		//Get dropdown values
		$dropdownValues = $this->fetchIntoClass($statement, null, "shared/DropDownViewModel");

		return $dropdownValues;
	}

	public function getDropdownValues_PictureType()
	{
		$statement = "SELECT * FROM picturetype";

		//Get dropdown values
		$dropdownValues = $this->fetchIntoClass($statement, null, "shared/DropDownViewModel");

		return $dropdownValues;
	}


	/******************************************************************************************************************
	*
	*				Questions
	*
	******************************************************************************************************************/	

	public function getStoryQuestions()
	{

	}

	public function getAnswersForQuestion()
	{

	}
}

?>
