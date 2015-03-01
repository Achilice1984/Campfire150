<?php

class StoryModel extends Model {

	// Test doesn't work 
	public function searchStories($storySearch, $userID, $howMany, $page)
	{
		//Accepts string to search for a story
		//check privacy
		//check active
		//check is not equal to the userid 
		//how many stories will return in the
		//returns an array of Story class that relate to the search string
		try 
		{
			
			$statement = "SELECT *,((Lower(StoryTitle) LIKE '%:sTitle%')) AS hits
						  FROM Story 
						  HAVING hits > 0
						  ORDER BY hits DESC
						  LIMIT :start, :howmany";
			
			$start = $this-> getStartValue($howMany, $page);
 
			$parameters = array(":sTitle" => $storySearch, 
								":userid" => $userID, 
								":start" => $start, 
								":howmany" => $howMany
								);
 
			$story = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");


			return $story;

		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}
	}

	// tested User_Id FK issue need to check the user
	public function publishNewStory($story)
	{
		//Accepts a story class
		//inserts a new story with the publish flag set to false
		//returns bool if the story was saved succesfully
		try
		{
			// create a php timestamp for inserting into the created and updated date fields in the database 
			//$timestamp = date('Y-m-d G:i:s');
			$statement = "INSERT INTO story (StoryId, User_UserId, StoryPrivacyType_StoryPrivacyTypeId, StoryTitle, Content,
											 published, DateCreated, Active)
						  VALUES(:StoryId, :User_UserId, :StoryPrivacyType_StoryPrivacyTypeId, :StoryTitle, :Content, 
						  	     :published, :DateCreated, :Active)";
 
			$parameters = array(":StoryId" => $story, 
								":User_UserId" => $story,
								":StoryPrivacyType_StoryPrivacyTypeId" => $story,
								":StoryTitle" => $story, 
								":Content" => $story, 
								":published" => $story, 
								":DateCreated" => $story, 
								":Active" => $story
								);

			return $this->fetch($statement, $parameters);
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

 	//tested
	public function changeStoryPrivacySetting($storyID, $userID, $privacyTypeID)
	{
		//Accepts a user id (owner), a story id, and a privacy type
		//checks that userid is owner of story
		//Change the privacy setting
		//returns bool if the setting changed or not

		try
		{
			$statement = "UPDATE story 
						  SET StoryPrivacyType_StoryPrivacyTypeId=:StoryPrivacyType_StoryPrivacyTypeId 
						  WHERE User_UserId=:User_UserId 
						  AND StoryId=:StoryId";

			$parameters = array(":StoryPrivacyType_StoryPrivacyTypeId" => $privacyTypeID, 
								":User_UserId" => $userID, 
								":StoryId" => $storyID);

			return $this->fetch($statement, $parameters);
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

  //tested flagStoryAsInapropriate(22,1)
	public function flagStoryAsInapropriate($storyID, $userID)
	{
		//Accepts a storyID, a userID, and a bool for if it was thought to be inapropriate
		//checks to see if user already marked it as inapropriate
		//returns bool if saved correctly

		try
		{

			$statement = "INSERT INTO user_recommend_story (Story_StoryId, User_UserId, Opinion) 
						  VALUES(:Story_StoryId, :User_UserId, 0)";

			$parameters = array(":Story_StoryId" => $storyID, ":User_UserId" => $userID);

			return $this->fetch($statement, $parameters);		
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	// tested getStory(2,11)
	public function getStory($userID, $storyID)
	{
		//Accepts a user id, and a storyID
		//Check privacy type
		//Must be approved
		//Checks if user has marked story as inappropriate and if user has recommended story (add these to story viewmodel class)
		//returns a Story class

		try
		{
			$statement = "SELECT * FROM Story 
						  WHERE User_UserId=:User_UserId
						  AND StoryId=:StoryId 
						  AND Active=TRUE";

			$parameters = array(":User_UserId" => $userID, 
								":StoryId" => $storyID);

			$story = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

			return $story;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}

	}

	//Tested getStoryAsAdmin(2,8)
	public function getStoryAsAdmin($adminID, $storyID)
	{
		//Accepts an admin id and a storyID
		//Do not Check privacy type
		//Does not have to be approved
		//Checks if user has makrked story as inappropriate and if user has recommended story (add these to story viewmodel class)
		//returns a Story class
		try 
		{
			$statement = "SELECT * FROM admin_approve_story 
						  WHERE User_UserId=:User_UserId 
						  AND Story_StoryId=:Story_StoryId";
			
			$parameters = array(":User_UserId" => $adminID, 
								":Story_StoryId" => $storyID);

			$story = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

			return $story;
		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}
	}

	//Tested getStoryListByTag("Art", 5, 1);
	public function getStoryListByTag($tag, $howMany, $page)
	{
		//Accepts a categoryID, how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Check privacy type
		//Checks if user has makrked story as inappropriate and if user has recommended story (add these to story viewmodel class)
		//returns an array of Story class related to a category
		try 
		{
			
			$statement = "SELECT s.*, t.Tag, aas.Approved
						  FROM Story s 
						  INNER JOIN story_has_tag sht
						  ON s.StoryId = sht.Story_StoryId
						  INNER JOIN tag t 
						  ON sht.Tag_TagId = t.TagId 
						  INNER JOIN admin_approve_story aas
						  ON s.StoryId = aas.Story_StoryId
						  WHERE s.Active = TRUE 
						  AND t.Tag= :tag
						  AND aas.Approved = TRUE
						  GROUP BY s.StoryId DESC
						  LIMIT :start , :howmany";

		
			$start = $this-> getStartValue($howMany, $page);

			$parameters = array(":tag" => $tag, ":start" => $start, ":howmany" => $howMany);
			//debugit($parameters);
			$story = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

			return $story;

		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}
		
	}

	//Tested getStoryListByIssueID(1,6,1); it works but we need to know the exact issueID
	public function getStoryListByIssueID($issueID, $howMany, $page)
	{
		//Accepts a categoryID, how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Check privacy type
		//Checks if user has makrked story as inappropriate and if user has recommended story (add these to story viewmodel class)
		//returns an array of Story class related to a category
		try 
		{
			
			$statement = "SELECT s.*, saq.answer_for_question_answer_answerId
						  FROM Story s 
						  INNER JOIN story_has_answer_for_question saq
						  ON s.StoryId = saq.Story_StoryId
						  WHERE saq.answer_for_question_answer_answerId = :issueID
						  LIMIT :start , :howmany";

		
			$start = $this-> getStartValue($howMany, $page);

			$parameters = array(":issueID" => $issueID, ":start" => $start, ":howmany" => $howMany);
			$story = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

			return $story;

		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}
		
	}
	// it works but we need to know the exact challengesID
	public function getStoryListByChallengesID($challengesID, $howMany, $page)
	{
		//Accepts a categoryID, how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Check privacy type
		//Checks if user has makrked story as inappropriate and if user has recommended story (add these to story viewmodel class)
		//returns an array of Story class related to a category
		try 
		{
			
			$statement = "SELECT s.*, saq.answer_for_question_answer_answerId
						  FROM Story s 
						  INNER JOIN story_has_answer_for_question saq
						  ON s.StoryId = saq.Story_StoryId
						  WHERE saq.answer_for_question_answer_answerId = :challengesID
						  LIMIT :start , :howmany";

		
			$start = $this-> getStartValue($howMany, $page);

			$parameters = array(":challengesID" => $challengesID, ":start" => $start, ":howmany" => $howMany);
			$story = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

			return $story;

		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}
		
	}

	//it works but we need to know the exact genreID
	public function getStoryListByGenreID($genreID, $howMany, $page)
	{
		//Accepts a categoryID, how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Check privacy type
		//Checks if user has makrked story as inappropriate and if user has recommended story (add these to story viewmodel class)
		//returns an array of Story class related to a category
		try 
		{
			
			$statement = "SELECT s.*, saq.answer_for_question_answer_answerId
						  FROM Story s 
						  INNER JOIN story_has_answer_for_question saq
						  ON s.StoryId = saq.Story_StoryId
						  WHERE saq.answer_for_question_answer_answerId = :genreID
						  LIMIT :start , :howmany";

		
			$start = $this-> getStartValue($howMany, $page);

			$parameters = array(":genreID" => $genreID, ":start" => $start, ":howmany" => $howMany);
			$story = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

			return $story;

		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}
		
	}
	
	//Tested getStoryList(6,1) will show 5 stories 
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
			$statement = "SELECT StoryId, StoryTitle, Content, DatePosted, DateUpdated
						  FROM Story 
						  ORDER BY StoryTitle ASC 
						  LIMIT :start, :howmany";

			$start = $this-> getStartValue($howMany, $page);
 
			$parameters = array(":start" => $start,
								":howmany" => $howMany);

			$story = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

			return $story;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}

	}

	//Tested getStoryListPendingApproval(3,5,1);
	public function getStoryListPendingApproval($userID, $howMany, $page)
	{
		//Accepts a user id, how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of stories that a user has submited but hasn't been apprved yet.
		//Should not contain any published stories
		//returns an array of Story class

		try
		{
			$statement = "SELECT s.*, aas.Approved, aas.Pending 
						  FROM Story s 
						  INNER JOIN admin_approve_story aas
						  ON s.StoryId = aas.Story_StoryId
						  WHERE s.Active = TRUE 
						  AND s.User_UserId = :User_UserId
						  AND aas.Approved = FALSE
						  AND aas.Pending = TRUE
						  LIMIT :start , :howmany";

			$start = $this-> getStartValue($howMany, $page);
 
			$parameters = array(":User_UserId" => $userID, ":start" => $start, ":howmany" => $howMany);

			$storyList = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

			return $storyList;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}		
	}

	//Tested getStoryListRejected(3,5,1);
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
			
			$statement = "SELECT s.*, aas.Approved
						  FROM Story s 
						  INNER JOIN admin_approve_story aas
						  ON s.StoryId = aas.Story_StoryId
						  WHERE s.Active = TRUE 
						  AND s.User_UserId = :User_UserId
						  AND aas.Approved = FALSE
						  LIMIT :start , :howmany";

			$start = $this-> getStartValue($howMany, $page);
 
			$parameters = array(":User_UserId" => $userID, ":start" => $start, ":howmany" => $howMany);

			$story = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

			return $story;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	//Tested getStoryListApproved(9,5,1)
	public function getStoryListApproved($userID, $howMany, $page)
	{
		//Accepts a user id, how many, page
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of stories that have been approved by admin
		//Should not contain any unpublished stories
		//returns an array of Story class

		try
		{
			
			$statement = "SELECT s.*, aas.Approved
						  FROM Story s 
						  INNER JOIN admin_approve_story aas
						  ON s.StoryId = aas.Story_StoryId
						  WHERE s.Active = TRUE 
						  AND s.User_UserId = :User_UserId
						  AND aas.Approved = TRUE
						  LIMIT :start , :howmany";

			$start = $this-> getStartValue($howMany, $page);
 
			$parameters = array(":User_UserId" => $userID, ":start" => $start, ":howmany" => $howMany);

			$story = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

			return $story;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	// Tested getStoryListRecommendedByFriends(2,5,1)
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
		$statement = "SELECT s.*, urs.opinion, spt.NameE
					  FROM Story s 
					  INNER JOIN user_recommend_story urs 
					  ON s.StoryId = urs.Story_StoryId
					  INNER JOIN storyprivacytype spt
					  ON spt.StoryPrivacyTypeId = s.StoryPrivacyType_StoryPrivacyTypeId
					  WHERE s.Active = TRUE 
					  AND s.User_UserId = :User_UserId
					  AND urs.opinion = TRUE
					  AND spt.StoryPrivacyTypeId = 3
					  LIMIT :start , :howmany";

			$start = $this-> getStartValue($howMany, $page);
 
			$parameters = array(":User_UserId" => $userID, ":start" => $start, ":howmany" => $howMany);

			$story = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

			return $story;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	// Tested getStoryListMostRecommended(6,1)
	public function getStoryListMostRecommended($howMany, $page)
	{
		//Accepts how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Check privacy type
		//Checks if user has makrked story as inappropriate and if user has recommended story (add these to story viewmodel class)
		//The list should be ordered by most recommended
		//Should not contain any unpublished stories
		//returns an array of Story class related to a category
		try
		{
			$statement = "SELECT DISTINCT(s.StoryId), s.StoryTitle, s.Content, s.DatePosted, urs.DateCreated, urs.DateUpdated
						  FROM story s
						  INNER JOIN user_recommend_story urs
						  ON s.StoryId = urs.Story_StoryId
						  WHERE opinion = TRUE
						  ORDER BY StoryTitle ASC 
						  LIMIT :start, :howmany";

			$start = $this-> getStartValue($howMany, $page);
 
			$parameters = array(":start" => $start,
								":howmany" => $howMany);

			$story = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

			return $story;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}


	}

	//Tested getStoryListNewest(1,5,1)
	public function getStoryListNewest($privacyType,$howMany, $page)
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
		$statement = "SELECT s.*, aas.Approved, spt.NameE
					  FROM Story s 
					  INNER JOIN admin_approve_story aas 
					  ON s.StoryId = aas.Story_StoryId
					  INNER JOIN storyprivacytype spt
					  ON spt.StoryPrivacyTypeId = s.StoryPrivacyType_StoryPrivacyTypeId
					  WHERE s.Active = TRUE 
					  AND aas.Approved = TRUE
					  AND spt.StoryPrivacyTypeId = :StoryPrivacyTypeId
					  GROUP BY s.StoryId DESC
					  LIMIT :start , :howmany";

			$start = $this-> getStartValue($howMany, $page);
 
			$parameters = array(":StoryPrivacyTypeId" => $privacyType, 
				                ":start" => $start, ":howmany" => $howMany);

			$story = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

			return $story;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}

	}

	//This doesn't work related the story FK
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

			$comment = $this->fetchIntoClass($statement, array($storyID, $start, $howMany), "shared/CommentView");

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

			$comment = $this->fetchIntoClass($statement, array($start, $howMany), "shared/CommentView");

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
			$statement = "SELECT * FROM comment WHERE User_UserId = ? AND PublishFlag = 0 ORDER BY CommentId";

			$comment = $this->fetchIntoClass($statement, array($userID), "shared/CommentView");

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
}

?>
