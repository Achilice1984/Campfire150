<?php

class SiteContentModel extends Model {	

	private $sessionManager;

	function __construct()
	{
		$this->sessionManager = new SessionManager();

		parent::__construct();
	}

	/******************************************************************************************************************
	*
	*				Dropdowns
	*
	******************************************************************************************************************/	

	public function getDropdownValues_ProfilePrivacyType()
	{
		$statement = "SELECT PrivacyTypeId AS Value, " . $this->getLanguage() . " AS Name FROM profileprivacytype";

		return $this->fetchDropdownValues($statement);
	}

	public function getDropdownValues_StoryPrivacyType()
	{
		$statement = "SELECT StoryPrivacyTypeId AS Value, " . $this->getLanguage() . " AS Name FROM storyprivacytype";

		return $this->fetchDropdownValues($statement);
	}

	public function getDropdownValues_LanguageType()
	{
		$statement = "SELECT LanguageId AS Value, " . $this->getLanguage() . " AS Name FROM languagetype";

		return $this->fetchDropdownValues($statement);
	}

	public function getDropdownValues_PictureType()
	{
		$statement = "SELECT PictureTypeId AS Value, " . $this->getLanguage() . " AS Name FROM picturetype";

		return $this->fetchDropdownValues($statement);
	}

	public function getDropdownValues_GenderType()
	{
		$statement = "SELECT GenderTypeId AS Value, " . $this->getLanguage() . " AS Name FROM gendertype";

		return $this->fetchDropdownValues($statement);
	}

	public function getDropdownValues_SecurityQuestions()
	{
		$statement = "SELECT SecurityQuestionId AS Value, " . $this->getLanguage() . " AS Name FROM securityquestion";

		return $this->fetchDropdownValues($statement);
	}


	/******************************************************************************************************************
	*
	*				Private Functions
	*
	******************************************************************************************************************/	

	private function fetchDropdownValues($statement)
	{
		//Get dropdown values
		$dropdownValues = $this->fetchIntoClass($statement, null, "shared/DropDownViewModel");

		return $dropdownValues;
	}


	private function getLanguage()
	{
		return ($this->sessionManager->isEng() ? "NameE" : "NameF");
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
