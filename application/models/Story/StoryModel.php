<?php

class StoryModel extends Model {

	public function searchStories($storySearch, $howMany, $page)
	{
		//Accepts string to search for a story
		//Checks if user has makrked story as inappropriate and if user has recommended story (add these to story viewmodel class)
		//returns an array of Story class that relate to the search string
	}

	public function publishNewStory($story)
	{
		//Accepts a story class
		//inserts a new story with the publish flag set to false
		//returns bool if the story was saved succesfully
		try
		{
			$statement = "INSERT INTO story (Story_StoryId, User_UserId, PrivacyType_PrivacyTypeId) VALUES(?, ?, 1)";

			$parameters = array($story->StoryID, $story->User_UserId);

			return $this->execute($statement);
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	public function changeStoryPrivacySetting($userID, $storyID, $privacyTypeID)
	{
		//Accepts a user id (owner), a story id, and a privacy type
		//checks that userid is owner of story
		//Change the privacy setting
		//returns bool if the setting changed or not

		try
		{
			$statement = "UPDATE story SET PrivacyType_PrivacyTypeId=? WHERE User_UserId=? AND StoryId=?";

			$parameters = array($privacyTypeID, $userID, $storyID);

			ru $this->execute($statement);
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	public function flagStoryAsInapropriate($storyID, $userID)
	{
		//Accepts a storyID, a userID, and a bool for if it was thought to be inapropriate
		//checks to see if user already marked it as inapropriate
		//returns bool if saved correctly

		try
		{
			$statement = "INSERT INTO user_recommend_story (Story_StoryId, User_UserId, Opinion) VALUES(?, ?, 0)";

			$parameters = array($storyID, $userID);

			return $this->execute($statement);
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	public function getStory($userID, $storyID)
	{
		//Accepts a user id, and a storyID
		//Check privacy type
		//Must be approved
		//Checks if user has makrked story as inappropriate and if user has recommended story (add these to story viewmodel class)
		//returns a Story class

		try
		{
			$statement = "SELECT * FROM Story User_UserId=? AND StoryId=?";

			$story = $this->fetchIntoClass($statement, array($userID, $storyID), "Shared/Story");

			return $story;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}

	}

	public function getStoryAsAdmin($adminID, $storyID)
	{
		//Accepts an admin id and a storyID
		//Do not Check privacy type
		//Does not have to be approved
		//Checks if user has makrked story as inappropriate and if user has recommended story (add these to story viewmodel class)
		//returns a Story class
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

		try
		{
			$statement = "SELECT * FROM Story ORDER BY StoryId ASC LIMIT ?, ?";

			$start = $howMany * ($page - 1);

			$storyList = $this->fetchIntoClass($statement, array($storyID, $start, $howMany), "Shared/Story");

			return $storyList;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}

	}

	public function getStoryListPendingApproval($userID, $howMany, $page)
	{
		//Accepts a user id, how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of stories that a user has submited but hasn't been apprved yet.
		//Should not contain any published stories
		//returns an array of Story class

		try
		{
			$statement = "SELECT * FROM Story WHERE User_UserId=? ORDER BY StoryId ASC LIMIT ?, ?";

			$start = $howMany * ($page - 1);

			$storyList = $this->fetchIntoClass($statement, array($storyID, $start, $howMany), "Shared/Story");

			return $storyList;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}		
	}

	public function getStoryListRejected($userID, $howMany, $page)
	{
		//Accepts a user id, how many, page
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of stories that have been rejected by admin
		//Should not contain any published stories
		//Should have the admin user details an reason for being rejected
		//returns an array of Story class
		try
		{
			$statement = "SELECT * FROM Story WHERE StoryId IN ";

			$statement .= "(SELECT Story_StoryId FROM admin_approve_story WHERE Approved = 0)";

			$statement .= "ORDER BY StoryId ASC LIMIT ?, ?";

			$start = $howMany * ($page - 1);

			$storyList = $this->fetchIntoClass($statement, array($storyID, $start, $howMany), "Shared/Story");

			return $storyList;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	public function getStoryListApproved($userID, $howMany, $page)
	{
		//Accepts a user id, how many, page
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of stories that have been approved by admin
		//Should not contain any unpublished stories
		//returns an array of Story class

		try
		{
			$statement = "SELECT * FROM Story WHERE StoryId IN ";

			$statement .= "(SELECT Story_StoryId FROM admin_approve_story WHERE Approved = 1)";

			$statement .= "ORDER BY StoryId ASC LIMIT ?, ?";

			$start = $howMany * ($page - 1);

			$storyList = $this->fetchIntoClass($statement, array($storyID, $start, $howMany), "Shared/Story");

			return $storyList;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	public function getStoryListRecommendedByFriends($userID, $howMany, $page)
	{
		//Accepts a user id, how many, page
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of stories that have been recommended by friends
		//Checks if user has makrked story as inappropriate and if user has recommended story (add these to story viewmodel class)
		//Should not contain any unpublished stories
		//returns an array of Story class

		try
		{
			$statement = "SELECT * FROM Story WHERE StoryId IN ";

			$statement .= "(SELECT Story_StoryId FROM user_recommend_story WHERE Opinion = 1)";

			$statement .= "ORDER BY StoryId ASC LIMIT ?, ?";

			$start = $howMany * ($page - 1);

			$storyList = $this->fetchIntoClass($statement, array($storyID, $start, $howMany), "Shared/Story");

			return $storyList;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
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

		try
		{
			$statement = "SELECT * FROM Story ORDER BY LatestChange DESC LIMIT ?, ?";

			$start = $howMany * ($page - 1);

			$storyList = $this->fetchIntoClass($statement, array($storyID, $start, $howMany), "Shared/Story");

			return $storyList;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}

	}

	public function addCommentToStory($comment, $storyID, $userID)
	{
		//Accepts a comment class
		//inserts a new comment with the published flag set to false
		//returns bool if the comment was saved succesfully

		$statement = "INSERT INTO Comment (Story_StoryId, User_UserId, Content) VALUES(?, ?, ?)";

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

		try
		{

			$statement = "SELECT * FROM Comment WHERE Story_StoryId = ? ORDER BY CommentId ASC LIMIT ?, ?";

			$start = $howMany * ($page - 1);

			$comment = $this->fetchIntoClass($statement, array($storyID, $start, $howMany), "Shared/Comment");

			return $comment;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	public function getCommentListInappropriate($adminID, $howMany, $page)
	{
		//Accepts how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Checks if user has makrked comment as inappropriate (add this to comment viewmodel class)
		//Gets a list of comments related to a story
		//The comments published flag must be true
		//returns an array of comment class related to a story
		try
		{

			$statement = "SELECT * FROM Comment WHERE PublishFlag = 1 AND CommentId IN ";

			$statement .= "(SELECT DISTINCT Comment_CommentId FROM user_inappropriateflag_comment) ORDER BY CommentId LIMIT ?, ?";

			$start = $howMany * ($page - 1);

			$comment = $this->fetchIntoClass($statement, array($start, $howMany), "Shared/Comment");

			return $comment;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
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
		
		try
		{
			$statement = "SELECT * FROM comment WHERE User_UserId = ? AND PublishFlag = 0" ORDER BY CommentId;

			$comment = $this->fetchIntoClass($statement, array($userID), "Shared/Comment");

			return $comment;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	public function flagCommentAsInapropriate($commentID, $userID)
	{
		//Accepts a commentID, a userID, and a bool for if it was thought to be inapropriate
		//checks to see if user already marked it as inapropriate
		//returns bool if saved correctly
	
		try
		{
			$statement = "INSERT INTO user_inappropriateflag_comment VALUES(?, ?)";

			$parameters = array($userID, $commentID);

			$this->execute($statement);	
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
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
