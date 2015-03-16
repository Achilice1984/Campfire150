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
		$statement = "SELECT PrivacyTypeId AS Value, " . $this->getLanguage() . " AS Name FROM profileprivacytype WHERE profileprivacytype.Active = TRUE";

		return $this->fetchDropdownValues($statement);
	}

	public function getDropdownValues_StoryPrivacyType()
	{
		$statement = "SELECT StoryPrivacyTypeId AS Value, " . $this->getLanguage() . " AS Name FROM storyprivacytype WHERE storyprivacytype.Active = TRUE";

		return $this->fetchDropdownValues($statement);
	}

	public function getDropdownValues_LanguageType()
	{
		$statement = "SELECT LanguageId AS Value, " . $this->getLanguage() . " AS Name FROM languagetype WHERE languagetype.Active = TRUE";

		return $this->fetchDropdownValues($statement);
	}

	public function getDropdownValues_PictureType()
	{
		$statement = "SELECT PictureTypeId AS Value, " . $this->getLanguage() . " AS Name FROM picturetype WHERE picturetype.Active = TRUE";

		return $this->fetchDropdownValues($statement);
	}

	public function getDropdownValues_GenderType()
	{
		$statement = "SELECT GenderTypeId AS Value, " . $this->getLanguage() . " AS Name FROM gendertype WHERE gendertype.Active = TRUE";

		return $this->fetchDropdownValues($statement);
	}

	public function getDropdownValues_SecurityQuestions()
	{
		$statement = "SELECT SecurityQuestionId AS Value, " . $this->getLanguage() . " AS Name FROM securityquestion WHERE securityquestion.Active = TRUE";

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
		$dropdownValues = $this->fetchIntoClass($statement, null, "shared/DropDownItemViewModel");

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
		$statement = "SELECT QuestionId AS Value, " . $this->getLanguage() . " AS Name 
						FROM question
						WHERE question.Active = TRUE";

		$storyQuestions = $this->fetchIntoClass($statement, null, "shared/DropDownItemViewModel");

		foreach ($storyQuestions as $question) {
			$question->Answers = $this->getAnswersForQuestion($question->Value);
		}

		return $storyQuestions;	
	}

	public function getAnswersForQuestion($questionID)
	{
		$statement = "SELECT AnswerId AS Value, " . $this->getLanguage() . " AS Name 
						FROM answer a
						INNER JOIN answer_for_question afq
						ON afq.Answer_AnswerId = a.AnswerId
						WHERE a.Active = TRUE
						AND afq.Question_QuestionId = :questionID";

		$dropdownValues = $this->fetchIntoClass($statement, array(":questionID" => $questionID), "shared/DropDownItemViewModel");

		return $dropdownValues;
	}
}

?>
