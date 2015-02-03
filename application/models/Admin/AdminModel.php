<?php

class AdminModel extends Model {

	public function searchStoriesPendingApproval($adminID, $storySearch, $howMany, $page)
	{
		//Accepts string to search for a story
		//Checks if user has makrked story as inappropriate and if user has recommended story (add these to story viewmodel class)
		//returns an array of Story class that relate to the search string
	}

	public function searchStoriesRejected($adminID, $storySearch, $howMany, $page)
	{
		//Accepts string to search for a story
		//Checks if user has makrked story as inappropriate and if user has recommended story (add these to story viewmodel class)
		//returns an array of Story class that relate to the search string
	}

	public function getStoryListPendingApproval($adminID, $howMany, $page)
	{
		//Accepts how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of stories that a user has submited but hasn't been apprved yet.
		//Should not contain any published stories
		//returns an array of Story class
	}

	public function getStoryListRejected($adminID, $howMany, $page)
	{
		//Accepts how many, page
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of stories that have been rejected by admin
		//Should not contain any published stories
		//Should have the admin user details an reason for being rejected
		//returns an array of Story class
	}

	public function getStoryListFlaggedInappropriate($adminID, $howMany, $page)
	{
		//Accepts how many, page
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of stories that have been marked as inappropriate by users
		//Order the list by how many inappropriate flags there are
		//returns an array of Story class
	}

	public function rejectStory($adminID, $storyID, $reason)
	{
		//Accepts the adminID, the story id and the reason why it was rejected
		//returns bool whether it was saved succesfully or not
	}

	public function approveStory($adminID, $storyID)
	{
		//Accepts the adminID and the story id
		//returns bool whether it was saved succesfully or not
	}

	public function changeRejectedToApproved($adminID, $storyID)
	{
		//Accepts the adminID and the story id
		//Change a rejected story to an approved story
		//returns bool whether it was saved succesfully or not
	}

	public function changeApprovedToRejected($adminID, $storyID, $reason)
	{
		//Accepts the adminID, the story id and the reason why it was rejected
		//Change an approved story to a rejected story
		//returns bool whether it was saved succesfully or not
	}

	public function getCommentListFlaggedInappropriate($howMany, $page)
	{
		//Accepts how many, page
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of comments that have been marked as inappropriate by users
		//Order the list by how many inappropriate flags there are
		//returns an array of Comment class
	}

	public function rejectCommentAsAdmin($adminID, $commentID, $reason)
	{
		//Accepts the adminID, the comment id and the reason why it was rejected
		//Allows admin users to hide comments if they feel they are innappropriate
		//returns bool whether it was saved succesfully or not
	}

	public function approveCommentAsAdmin($adminID, $commentID)
	{
		//Accepts the adminID and the comment id
		//Allows admin users to remove their rejected status placed on comments
		//returns bool whether it was saved succesfully or not
	}

	public function changeRejectedToApprovedAsAdmin($adminID, $commentID)
	{
		//Accepts the adminID and the comment id
		//Change a rejected comment to an approved comment
		//returns bool whether it was saved succesfully or not
	}

	public function changeApprovedToRejectedAsAdmin($adminID, $commentID, $reason)
	{
		//Accepts the adminID, the comment id and the reason why it was rejected
		//Change an approved comment to a rejected comment
		//returns bool whether it was saved succesfully or not
	}

	public function disableUserAccount($adminID, $userID, $reason)
	{
		//Accepts the adminID, the user id and the reason why it was rejected
		//Disable a user account
		//returns bool whether it was saved succesfully or not
	}

	public function enableUserAccount($adminID, $userID, $reason)
	{
		//Accepts the adminID, the user id and the reason why it was rejected
		//Enable a user account
		//returns bool whether it was saved succesfully or not
	}

	public function getListUsers($adminID, $howMany, $page)
	{
		//Accepts how many, page
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of users
		//returns an array of User class
	}

	public function deActivateUser($user, $admin)
	{
		//Accepts a User class for $user and a User class for $admin
		//Sets the active flag to false in user profile
		//Uses admin details to say who deactivated the account
	}

	public function getListUsersDisabled($adminID, $howMany, $page)
	{
		//Accepts how many, page
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of users that have been disabled with reason
		//returns an array of User class
	}

	public function getListUsersOderedByMostInappropriateFlags($adminID, $howMany, $page)
	{
		//Accepts how many, page
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of users ordered by how many inapropriate flags they have issued
		//returns an array of User class
	}

	public function getListQuestionaireQuestions($adminID)
	{
		//Gets a list of all the current questionaire questions
		//This will include a list of possible answers
	}

	public function updateQuestionAnswer($adminID, $questionAnswerID, $answerE, $answerF)
	{
		//Accepts a question answer id, and english answer, a french answer
		//returns bool if saved succesfully
	}
	
	public function addQuestionAnswer($adminID, $questionID, $answerE, $answerF)
	{
		//Accepts a question id, and english answer, a french answer
		//returns bool if saved succesfully
	}

	public function updateQuestion($adminID, $questionID, $questionE, $questionF)
	{
		//Accepts a question id, and english question, a french question
		//returns bool if saved succesfully
	}
	
	public function addQuestion($adminID, $questionE, $questionF)
	{
		//Accepts a english questionE, a french questionF
		//returns bool if saved succesfully
	}

	public function getListDropdowns($adminID)
	{
		//Accepts admin id
		//returns list of dropdowns and their values
	}
	public function addDropdownValue($adminID, $dropdownValueE, $dropdownValueF)
	{
		//Accepts a english dropdownValueE, a french dropdownValueF
		//returns bool if saved succesfully
	}
	public function updateDropdownValue($adminID, $dropdownValueE, $dropdownValueF)
	{
		//Accepts a english dropdownValueE, a french dropdownValueF
		//returns bool if saved succesfully
	}

	public function get($id)
	{
		return $result;
	}

	public function insert()
	{
		return $result;
	}

	public function update()
	{
		return $result;
	}

	public function delete()
	{
		return $result;
	}

}

?>
