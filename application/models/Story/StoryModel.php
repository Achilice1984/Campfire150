<?php

class StoryModel extends Model {


	/******************************************************************************************************************
	*
	*				Story Lists
	*
	******************************************************************************************************************/

	public function searchStories($storySearch, $howMany, $page)
	{
		//Accepts string to search for a story
		//Checks if user has makrked story as inappropriate and if user has recommended story (add these to story viewmodel class)
		//returns an array of Story class that relate to the search string
	}

	public function getStoryListByCategoryID($categoryID, $howMany, $page)
	{
		//Accepts a categoryID, how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Check privacy type
		//Checks if user has makrked story as inappropriate and if user has recommended story (add these to story viewmodel class)
		//returns an array of Story class related to a category
	}

	public function getStoryList($howMany, $page)
	{
		//Accepts how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Check privacy type
		//Checks if user has makrked story as inappropriate and if user has recommended story (add these to story viewmodel class)
		//Should not contain any unpublished stories
		//returns an array of Story class
	}

	public function getStoryListPendingApproval($userID, $howMany, $page)
	{
		//Accepts a user id, how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of stories that a user has submited but hasn't been apprved yet.
		//Should not contain any published stories
		//returns an array of Story class
	}

	public function getStoryListRejected($userID, $howMany, $page)
	{
		//Accepts a user id, how many, page
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of stories that have been rejected by admin
		//Should not contain any published stories
		//Should have the admin user details an reason for being rejected
		//returns an array of Story class
	}

	public function getStoryListApproved($userID, $howMany, $page)
	{
		//Accepts a user id, how many, page
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of stories that have been approved by admin
		//Should not contain any unpublished stories
		//returns an array of Story class
	}

	public function getStoryListRecommendedByFriends($userID, $howMany, $page)
	{
		//Accepts a user id, how many, page
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of stories that have been recommended by friends
		//Checks if user has makrked story as inappropriate and if user has recommended story (add these to story viewmodel class)
		//Should not contain any unpublished stories
		//returns an array of Story class
	}

	public function getStoryListMostRecommended($howMany, $page)
	{
		//Accepts how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Check privacy type
		//Checks if user has makrked story as inappropriate and if user has recommended story (add these to story viewmodel class)
		//The list should be ordered by most recommended
		//Should not contain any unpublished stories
		//returns an array of Story class related to a category
	}

	public function getStoryListNewest($howMany, $page)
	{
		//Accepts how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Check privacy type
		//Checks if user has makrked story as inappropriate and if user has recommended story (add these to story viewmodel class)
		//The list should be ordered by newest story
		//Should not contain any unpublished stories
		//returns an array of Story class related to a category
	}


	/******************************************************************************************************************
	*
	*				Story Updates
	*
	******************************************************************************************************************/

	public function publishNewStory($story)
	{
		//Accepts a story class
		//inserts a new story with the publish flag set to false
		//returns bool if the story was saved succesfully
	}

	public function changeStoryPrivacySetting($userID, $storyID, $privacyTypeID)
	{
		//Accepts a user id (owner), a story id, and a privacy type
		//checks that userid is owner of story
		//Change the privacy setting
		//returns bool if the setting changed or not
	}

	public function flagStoryAsInapropriate($storyID, $userID, $isInappropriate)
	{
		//Accepts a storyID, a userID, and a bool for if it was thought to be inapropriate
		//checks to see if user already marked it as inapropriate
		//returns bool if saved correctly
	}

	
	/******************************************************************************************************************
	*
	*				Story Get Single
	*
	******************************************************************************************************************/	

	public function getStory($userID, $storyID)
	{
		//Accepts a user id, and a storyID
		//Check privacy type
		//Must be approved
		//Checks if user has makrked story as inappropriate and if user has recommended story (add these to story viewmodel class)
		//returns a Story class
	}

	public function getStoryAsAdmin($adminID, $storyID)
	{
		//Accepts an admin id and a storyID
		//Do not Check privacy type
		//Does not have to be approved
		//Checks if user has makrked story as inappropriate and if user has recommended story (add these to story viewmodel class)
		//returns a Story class
	}

	

	/******************************************************************************************************************
	*
	*				Story Comments
	*
	******************************************************************************************************************/	

	public function addCommentToStory($comment, $storyID, $userID)
	{
		//Accepts a comment class
		//inserts a new comment with the published flag set to false
		//returns bool if the comment was saved succesfully

		$statement = "INSERT INTO Comment Story_StoryId, User_UserId, Content VALUES(?, ?, ?)";

		$parameters = array($storyID, $userID, $comment);

		$this->execute($statement);
	}

	public function getCommentsForStory($storyID, $howMany, $page)
	{
		//Accepts a story id, how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Checks if user has makrked comment as inappropriate (add this to comment viewmodel class)
		//Gets a list of comments related to a story
		//The comments published flag must be true
		//returns an array of comment class related to a story

		$statement = "SELECT * FROM Comment WHERE Story_StoryId = ? ORDER BY CommentId ASC LIMIT ?, ?";

		$start = $howMany * ($page - 1);

		$comment = $this->fetchIntoClass($statement, array($storyID, $start, $howMany), "Shared/Comment");

		return $comment;
	}

	public function getCommentListInappropriate($adminID, $howMany, $page)
	{
		//Accepts how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Checks if user has makrked comment as inappropriate (add this to comment viewmodel class)
		//Gets a list of comments related to a story
		//The comments published flag must be true
		//returns an array of comment class related to a story

		$statement = "SELECT * FROM Comment WHERE PublishFlag = 1 AND CommentId IN ";

		$statement .= "(SELECT DISTINCT Comment_CommentId FROM user_inappropriateflag_comment) ORDER BY CommentId LIMIT ?, ?";

		$start = $howMany * ($page - 1);

		$comment = $this->fetchIntoClass($statement, array($start, $howMany), "Shared/Comment");

		return $comment;
	}

	public function getCommentListRejected($adminID, $howMany, $page)
	{
		//Accepts how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Checks if user has makrked comment as inappropriate (add this to comment viewmodel class)
		//Gets a list of comments related to a story
		//The comments published flag must be true
		//returns an array of comment class related to a story
	}

	public function getUnpublisedComments($userID)
	{
		//Accepts a user id
		//Gets a list of comments that haven't been published by a user
		//The comments published flag must be flase
		//returns an array of comment class that haven't been published yet
		$statement = "SELECT * FROM comment WHERE User_UserId = ? AND PublishFlag = 0" ORDER BY CommentId;

		$comment = $this->fetchIntoClass($statement, array($userID), "Shared/Comment");

		return $comment;
	}

	public function flagCommentAsInapropriate($commentID, $userID)
	{
		//Accepts a commentID, a userID, and a bool for if it was thought to be inapropriate
		//checks to see if user already marked it as inapropriate
		//returns bool if saved correctly

		$statement = "INSERT INTO user_inappropriateflag_comment VALUES(?, ?)";

		$parameters = array($userID, $commentID);

		$this->execute($statement);
	}
}

?>
