<?php
require_once(APP_DIR .'helpers/storysearch.php');

class StoryModel extends Model {

	// Test doesn't work 
	public function searchStories($storySearch, $userID, $howMany = self::HOWMANY, $page = self::PAGE)
	{
		//Accepts string to search for a story
		//check privacy
		//check active
		//check is not equal to the userid 
		//how many stories will return in the
		//returns an array of Story class that relate to the search string
		try 
		{
			$searchObject = new StorySearch();

			$story = $searchObject->SearchQuery($storySearch, $userID, $howMany, $page); 

			return $story;

		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}
	}

	// tested User_Id FK issue need to check the user
	public function publishNewStory($story, $userId)
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
 
			$parameters = array(":StoryId" => $story->StoryId, 
								":User_UserId" => $userId,
								":StoryPrivacyType_StoryPrivacyTypeId" => $story->StoryPrivacyType_StoryPrivacyTypeId,
								":StoryTitle" => $story->StoryTitle, 
								":Content" => $story->Content, 
								":published" => $story->Published, 
								":DateCreated" => $this->getDateNow(), 
								":Active" => TRUE
								);

			return $this->fetch($statement, $parameters);
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	public function setPublishFlag($storyID, $userID, $publish)
	{
		//Accepts a storyID, a userID, and a bool for if it was thought to be inapropriate
		//checks to see if user already marked it as inapropriate
		//returns bool if saved correctly

		try
		{

			$statement = "UPDATE story s SET Published = :Published
							WHERE s.User_UserId = :User_UserId
							AND s.StoryId = :StoryId";

			$parameters = array(":StoryId" => $storyID, ":User_UserId" => $userID, ":Published" => $publish);

			return $this->fetch($statement, $parameters);		
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	// tested User_Id FK issue need to check the user
	public function addAnswerToStoryQuestion($storyId, $questionID, $answerId)
	{
		//Accepts a story class
		//inserts a new story with the publish flag set to false
		//returns bool if the story was saved succesfully
		try
		{
			// create a php timestamp for inserting into the created and updated date fields in the database 
			//$timestamp = date('Y-m-d G:i:s');
			$statement = "INSERT INTO story_has_answer_for_question (Story_StoryId, Answer_for_Question_Question_QuestionId, Answer_for_Question_Answer_AnswerId, DateCreated)
						  VALUES(:StoryId, :Answer_for_Question_Question_QuestionId, :Answer_for_Question_Answer_AnswerId, :DateCreated)";
 
			$parameters = array(":StoryId" => $storyId, 
								":Answer_for_Question_Question_QuestionId" => $questionID,
								":Answer_for_Question_Answer_AnswerId" => $answerId, 
								":DateCreated" => $this->getDateNow()
								);

			return $this->fetch($statement, $parameters);
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	// tested User_Id FK issue need to check the user
	public function addTagToStory($storyId, $tagId)
	{
		//Accepts a story class
		//inserts a new story with the publish flag set to false
		//returns bool if the story was saved succesfully
		try
		{
			// create a php timestamp for inserting into the created and updated date fields in the database 
			//$timestamp = date('Y-m-d G:i:s');
			$statement = "INSERT INTO story_has_tag (Story_StoryId, Tag_TagId, DateCreated)
						  VALUES(:StoryId, :Tag_TagId, :DateCreated)";
 
			$parameters = array(":StoryId" => $storyId, 
								":Tag_TagId" => $tagId, 
								":DateCreated" => $this->getDateNow()
								);

			return $this->fetch($statement, $parameters);
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	public function saveStoryImageMetadata($userId, $image, $storyId)
	{
		// 3 = story picture

		//The returned id of the new picture
		$pictureId = 0;

		$statement = "INSERT INTO picture (FileName, Active, InppropriateFlag, User_UserId, picturetype_PictureTypeId, PictureExtension, DateCreated)
						VALUES (:FileName, :Active, :InppropriateFlag, :User_UserId, :picturetype_PictureTypeId, :PictureExtension, NOW())";


		$parameters = array( 
			":FileName" => pathinfo($image["name"], PATHINFO_FILENAME), 
			":Active" => true, 
			":InppropriateFlag" => false, 
			":User_UserId" => $userId, 
			":picturetype_PictureTypeId" => 3, 
			":PictureExtension" => pathinfo($image["name"], PATHINFO_EXTENSION)
		);

		if($this->fetch($statement, $parameters))
		{
			$pictureId = $this->lastInsertId();

			$statement = "INSERT INTO story_has_picture(Story_StoryId, PictureId, DateCreated)
						VALUES(:Story_StoryId, :PictureId, NOW())";
			$parameters = array( 
				":PictureId" => $pictureId, 
				":Story_StoryId" => $storyId
			);

			$this->fetch($statement, $parameters);
		}

		return $pictureId;
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
			$statement = "UPDATE story s
							INNER JOIN user u
							ON (u.UserId = s.User_UserId) AND (u.Active = TRUE)
							INNER JOIN admin_approve_story aps
							ON (aps.Story_StoryId = s.StoryId) AND (aps.Active = TRUE)
							SET StoryPrivacyType_StoryPrivacyTypeId=:StoryPrivacyType_StoryPrivacyTypeId 
							WHERE s.User_UserId=:User_UserId 
							AND s.StoryId=:StoryId
							AND s.Active = TRUE
							AND u.Active = TRUE
							AND aps.Active = TRUE
							AND aps.Approved = TRUE";

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

			$statement = "INSERT INTO user_recommend_story (Story_StoryId, User_UserId, Opinion, DateCreated) 
						  VALUES(:Story_StoryId, :User_UserId, FALSE, :DateCreated)
						  ON DUPLICATE KEY
						  	UPDATE Active = TRUE, Opinion = FALSE";

			$parameters = array(":Story_StoryId" => $storyID, ":User_UserId" => $userID, ":DateCreated" => $this->getDateNow());

			return $this->fetch($statement, $parameters);		
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	public function unFlagStoryAsInapropriate($storyID, $userID)
	{
		//Accepts a storyID, a userID, and a bool for if it was thought to be inapropriate
		//checks to see if user already marked it as inapropriate
		//returns bool if saved correctly

		try
		{

			$statement = "UPDATE user_recommend_story SET Active = FALSE
							WHERE user_recommend_story.Story_StoryId = :Story_StoryId
							AND user_recommend_story.User_UserId = :User_UserId";

			$parameters = array(":Story_StoryId" => $storyID, ":User_UserId" => $userID);

			return $this->fetch($statement, $parameters);		
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	//tested flagStoryAsInapropriate(22,1)
	public function recommendStory($storyID, $userID)
	{
		//Accepts a storyID, a userID, and a bool for if it was thought to be inapropriate
		//checks to see if user already marked it as inapropriate
		//returns bool if saved correctly

		try
		{

			$statement = "INSERT INTO user_recommend_story (Story_StoryId, User_UserId, Opinion, DateCreated) 
						  VALUES(:Story_StoryId, :User_UserId, TRUE, :DateCreated)
						  ON DUPLICATE KEY
						  	UPDATE Active = TRUE, Opinion = TRUE";

			$parameters = array(":Story_StoryId" => $storyID, ":User_UserId" => $userID, ":DateCreated" => $this->getDateNow());

			return $this->fetch($statement, $parameters);		
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	//tested flagStoryAsInapropriate(22,1)
	public function unRecommendStory($storyID, $userID)
	{
		//Accepts a storyID, a userID, and a bool for if it was thought to be inapropriate
		//checks to see if user already marked it as inapropriate
		//returns bool if saved correctly

		try
		{

			$statement = "UPDATE user_recommend_story SET Active = FALSE 
						  WHERE user_recommend_story.User_UserId = :User_UserId
						  AND Story_StoryId = :Story_StoryId";

			$parameters = array(":Story_StoryId" => $storyID, ":User_UserId" => $userID);

			return $this->fetch($statement, $parameters);		
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	//Tested getStoryAsAdmin(2,8)
	public function getStoryAsAdmin($adminID, $storyID)
	{
		//Accepts a user id, and a storyID
		//Check privacy type
		//Must be approved
		//Checks if user has marked story as inappropriate and if user has recommended story (add these to story viewmodel class)
		//returns a Story class

		try
		{
			$statement = "SELECT 

							s.StoryId, s.User_UserId, s.StoryPrivacyType_StoryPrivacyTypeId, s.StoryTitle, s.Content, s.Active, s.DatePosted, s.Published,

							urs.User_UserId, urs.Story_StoryId, urs.Active, urs.Opinion,

							aps.User_UserId, aps.Story_StoryId, aps.Active, aps.Approved,

							shp.Story_StoryId, shp.PictureId, shp.Active,

							p.PictureId, p.User_UserId, p.FileName, p.PictureExtension, p.Active,

							u.UserId, u.Active, u.FirstName, u.LastName, u.ProfilePrivacyType_PrivacyTypeId,

							(
								SELECT COUNT(1)
								FROM comment c
								WHERE c.Story_StoryId = s.StoryId
							    AND c.Active = TRUE
							) AS totalComments
							 
							FROM story s

							INNER JOIN user u
							ON (u.UserId = s.User_UserId) AND (u.Active = TRUE)
							LEFT JOIN admin_approve_story aps
							ON (aps.Story_StoryId = s.StoryId) AND (aps.Active = TRUE)

							LEFT JOIN user_recommend_story urs
							ON (urs.Story_StoryId = s.StoryId) AND (urs.User_UserId = :userid) AND (urs.Active = TRUE)

							LEFT JOIN story_has_picture shp
							ON (shp.Story_StoryId = s.StoryId) AND (shp.Active = TRUE)
							LEFT JOIN picture p
							ON (p.PictureId = shp.PictureId) AND (p.Active = TRUE)

							WHERE s.StoryId = :StoryId
							AND aps.Active = TRUE";

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
			$statement = "SELECT 

							s.StoryId, s.User_UserId, s.StoryPrivacyType_StoryPrivacyTypeId, s.StoryTitle, s.Content, s.Active, s.DatePosted, s.Published,

							urs.User_UserId, urs.Story_StoryId, urs.Active, urs.Opinion,

							aps.User_UserId, aps.Story_StoryId, aps.Active, aps.Approved,

							shp.Story_StoryId, shp.PictureId, shp.Active,

							p.PictureId, p.User_UserId, p.FileName, p.PictureExtension, p.Active,

							u.UserId, u.Active, u.FirstName, u.LastName, u.ProfilePrivacyType_PrivacyTypeId,

							(
								SELECT COUNT(1)
								FROM comment c
								WHERE c.Story_StoryId = s.StoryId
							    AND c.Active = TRUE
							) AS totalComments
							 
							FROM story s

							INNER JOIN user u
							ON (u.UserId = s.User_UserId) AND (u.Active = TRUE)
							LEFT JOIN admin_approve_story aps
							ON (aps.Story_StoryId = s.StoryId) AND (aps.Active = TRUE)

							LEFT JOIN user_recommend_story urs
							ON (urs.Story_StoryId = s.StoryId) AND (urs.User_UserId = :User_UserId) AND (urs.Active = TRUE)

							LEFT JOIN story_has_picture shp
							ON (shp.Story_StoryId = s.StoryId) AND (shp.Active = TRUE)
							LEFT JOIN picture p
							ON (p.PictureId = shp.PictureId) AND (p.Active = TRUE)

							WHERE s.StoryId = :StoryId
							AND StoryPrivacyType_StoryPrivacyTypeId = 1
							AND s.Active = TRUE
							AND u.ProfilePrivacyType_PrivacyTypeId = 1
							";
							// AND aps.Active = TRUE
							// AND aps.Approved = TRUE
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

	//Tested getStoryListByTag("Art", 5, 1);
	public function getStoryListByTag($tag, $howMany = self::HOWMANY, $page = self::PAGE)
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
						  LEFT JOIN admin_approve_story aas
						  ON s.StoryId = aas.Story_StoryId
						  WHERE s.Active = TRUE 
						  AND StoryPrivacyType_StoryPrivacyTypeId = 1
						  AND t.Tag= :tag
						  
						  GROUP BY s.StoryId DESC
						  LIMIT :start , :howmany";

		
			$start = $this->getStartValue($howMany, $page);

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
	public function getStoryListByIssueID($issueID, $howMany = self::HOWMANY, $page = self::PAGE)
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
						  INNER JOIN admin_approve_story aas
						  ON s.StoryId = aas.Story_StoryId
						  WHERE saq.answer_for_question_answer_answerId = :issueID
						  AND StoryPrivacyType_StoryPrivacyTypeId = 1
						  AND aas.Approved = TRUE
						  AND s.Active = TRUE
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
	public function getStoryListByChallengesID($challengesID, $howMany = self::HOWMANY, $page = self::PAGE)
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
						  INNER JOIN admin_approve_story aas
						  ON s.StoryId = aas.Story_StoryId
						  WHERE saq.answer_for_question_answer_answerId = :challengesID
						  AND StoryPrivacyType_StoryPrivacyTypeId = 1
						  AND aas.Approved = TRUE
						  AND s.Active = TRUE
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
	public function getStoryListByGenreID($genreID, $howMany = self::HOWMANY, $page = self::PAGE)
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
						  INNER JOIN admin_approve_story aas
						  ON s.StoryId = aas.Story_StoryId
						  WHERE saq.answer_for_question_answer_answerId = :challengesID
						  AND StoryPrivacyType_StoryPrivacyTypeId = 1
						  AND aas.Approved = TRUE
						  AND s.Active = TRUE
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
	public function getStoryList($howMany = self::HOWMANY, $page = self::PAGE)
	{
		//Accepts how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Check privacy type
		//Checks if user has makrked story as inappropriate and if user has recommended story (add these to story viewmodel class)
		//Should not contain any unpublished stories
		//returns an array of Story class
		try
		{
			$statement = "SELECT s.StoryId, s.StoryTitle, s.Content, s.DatePosted, s.DateUpdated
						  FROM Story s
						  INNER JOIN admin_approve_story aas
						  ON s.StoryId = aas.Story_StoryId
						  WHERE aas.Approved = TRUE
						  AND StoryPrivacyType_StoryPrivacyTypeId = 1
						  AND s.Active = TRUE
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
	public function getStoryListPendingApproval($userID, $howMany = self::HOWMANY, $page = self::PAGE)
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
						  LEFT JOIN admin_approve_story aas
						  ON s.StoryId = aas.Story_StoryId
						  WHERE (s.User_UserId = :User_UserId AND aas.Pending IS NULL )
                          OR (s.User_UserId = :User_UserId2 AND aas.Approved = FALSE AND aas.Pending = TRUE)
						  LIMIT :start,:howmany";

			$start = $this-> getStartValue($howMany, $page);
 
			$parameters = array(":User_UserId" => $userID, ":User_UserId2" => $userID, ":start" => $start, ":howmany" => $howMany);

			$storyList = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

			return $storyList;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}		
	}

	//Tested getStoryListRejected(3,5,1);
	public function getStoryListRejected($howMany = self::HOWMANY, $page = self::PAGE)
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
						  LEFT JOIN admin_approve_story aas
						  ON s.StoryId = aas.Story_StoryId
						  AND aas.Approved = FALSE
						  LIMIT :start , :howmany";

			$start = $this-> getStartValue($howMany, $page);
 
			$parameters = array(":start" => $start, ":howmany" => $howMany);

			$story = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

			return $story;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	//Tested getStoryListApproved(9,5,1)
	public function getStoryListApproved($howMany = self::HOWMANY, $page = self::PAGE)
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
						  WHERE aas.Approved = TRUE
						  LIMIT :start , :howmany";

			$start = $this-> getStartValue($howMany, $page);
 
			$parameters = array(":start" => $start, ":howmany" => $howMany);

			$story = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

			return $story;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	// Tested getStoryListRecommendedByFriends(2,5,1)
	public function getTotalStoriesApproved($userID)
	{
		//Accepts an user id
		//Gets the total stories written by the user who owns this email address
		//Returns the total
		$statement = "SELECT count(*)
						FROM story 
						LEFT JOIN admin_approve_story 
						ON story.StoryId = admin_approve_story.Story_StoryId
						WHERE story.User_UserId = :UserId AND story.Published = TRUE 
						AND StoryPrivacyType_StoryPrivacyTypeId = 1
						AND admin_approve_story.Approved = TRUE";

		$totalStories = $this->fetchNum($statement, array(":UserId" => $userID));

		return $totalStories;
	}
	public function getTotalStoriesPending($userID)
	{
		//Accepts an user id
		//Gets the total stories written by the user who owns this email address
		//Returns the total
		$statement = "SELECT count(*)
						FROM story 
						LEFT JOIN admin_approve_story 
						ON story.StoryId = admin_approve_story.Story_StoryId
						WHERE (s.User_UserId = :User_UserId AND aas.Pending IS NULL )
                          OR (s.User_UserId = :User_UserId2 AND aas.Approved = FALSE AND aas.Pending = TRUE)";

		$totalStories = $this->fetchNum($statement, array(":UserId" => $userID, ":User_UserId2" => $userID));

		return $totalStories;
	}
	public function getTotalStoriesDenied($userID)
	{
		//Accepts an user id
		//Gets the total stories written by the user who owns this email address
		//Returns the total
		$statement = "SELECT count(*)
						FROM story 
						LEFT JOIN admin_approve_story 
						ON story.StoryId = admin_approve_story.Story_StoryId
						WHERE story.User_UserId = :UserId 
						AND admin_approve_story.Approved = FALSE";

		$totalStories = $this->fetchNum($statement, array(":UserId" => $userID));

		return $totalStories;
	}

	public function getStoriesWrittenByCurrentUser($userID, $howMany = self::HOWMANY, $page = self::PAGE)
	{
		//Accepts a user id
		//Gets an array of stories written by the owner of this user id
		//Returns an array of Story class

		$statement = "SELECT *
						FROM story 
						LEFT JOIN admin_approve_story 
						ON story.StoryId = admin_approve_story.Story_StoryId
						WHERE story.User_UserId = :UserId 
						AND story.Active = TRUE 
						AND story.Published = TRUE
						AND admin_approve_story.Approved = TRUE
						AND StoryPrivacyType_StoryPrivacyTypeId = 1
						LIMIT :start, :howmany";

		$start = $this-> getStartValue($howMany, $page);			

		$stories = $this->fetchIntoClass($statement, array(":UserId" => $userID, ":start" => $start, ":howmany" => $howMany), "shared/StoryViewModel");

		return $stories;
	}
	public function getStoriesRecommendedByFriends_MostPopular($userID, $howMany = self::HOWMANY, $page = self::PAGE)
	{
		//Accepts a user id
		//Gets an array of stories that were recommended to the owner of this user id
		//Returns an array of Story class

		$statement = "SELECT story.*, COUNT(user_recommend_story.Opinion) AS recommendation_count
		FROM story LEFT JOIN user_recommend_story
		ON story.StoryId = user_recommend_story.Story_StoryId
		WHERE story.User_UserId IN
		(SELECT DISTINCT following.User_FollowerId
		FROM following
		WHERE following.User_UserId = :UserId AND following.Active = TRUE)
		AND user_recommend_story.Opinion = TRUE
		AND story.Published = TRUE
		AND StoryPrivacyType_StoryPrivacyTypeId = 1
		GROUP BY story.StoryId
		ORDER BY recommendation_count DESC
		LIMIT :start, :howmany";

		$start = $this-> getStartValue($howMany, $page);

		$stories = $this->fetchIntoClass($statement, array(":UserId" => $userID, ":start" => $start, ":howmany" => $howMany), "shared/StoryViewModel");

		return $stories;
	}

	public function getStoriesRecommendedByFriends_Latest($userID, $howMany = self::HOWMANY, $page = self::PAGE)
	{
		//Accepts a user id
		//Gets an array of stories that were recommended to the owner of this user id
		//Returns an array of Story class
		
		$statement = "SELECT story.*, user_recommend_story.LatestChange
		FROM story LEFT JOIN user_recommend_story 
		ON story.StoryId = user_recommend_story.Story_StoryId
		WHERE story.User_UserId IN 
		(SELECT DISTINCT following.User_FollowerId 
		FROM following 
		WHERE following.User_UserId = :UserId AND following.Active = TRUE)
		AND user_recommend_story.Opinion = TRUE
		AND story.Published = TRUE
		AND StoryPrivacyType_StoryPrivacyTypeId = 1
		GROUP BY story.StoryId
		ORDER BY user_recommend_story.LatestChange DESC
		LIMIT :start, :howmany";

		$start = $this-> getStartValue($howMany, $page);

		$stories = $this->fetchIntoClass($statement, array(":UserId" => $userID, ":start" => $start, ":howmany" => $howMany), "shared/StoryViewModel");

		return $stories;
	}

	public function getStoriesRecommendedByCurrentUser($userID, $howMany = self::HOWMANY, $page = self::PAGE)
	{
		//Accepts a user id
		//Gets an array of stories that were recommended to the owner of this user id
		//Returns an array of Story class

		$statement = "SELECT *
						FROM story 
						LEFT JOIN admin_approve_story 
						ON story.StoryId = admin_approve_story.Story_StoryId
						LEFT JOIN user_recommend_story
						ON story.StoryId = user_recommend_story.Story_StoryId
						WHERE user_recommend_story.User_UserId = :UserId
						AND story.Active = TRUE 
						AND story.Published = TRUE
						AND admin_approve_story.Approved = TRUE
						AND StoryPrivacyType_StoryPrivacyTypeId = 1
						LIMIT :start, :howmany";

		$start = $this-> getStartValue($howMany, $page);

		$stories = $this->fetchIntoClass($statement, array(":UserId" => $userID, ":start" => $start, ":howmany" => $howMany), "shared/StoryViewModel");

		return $stories;
	}

	// Tested getStoryListMostRecommended(6,1)
	public function getStoryListMostRecommended($userid, $howMany = self::HOWMANY, $page = self::PAGE)
	{
		//Accepts how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Check privacy type
		//Checks if user has makrked story as inappropriate and if user has recommended story (add these to story viewmodel class)
		//The list should be ordered by most recommended
		//Should not contain any unpublished stories
		//returns an array of Story class related to a category

		// $statement = "SELECT story.*, COUNT(user_recommend_story.Opinion) AS recommendation_count
		// 				FROM story LEFT JOIN user_recommend_story
		// 				ON story.StoryId = user_recommend_story.Story_StoryId
		// 				WHERE story.User_UserId IN
		// 				(SELECT DISTINCT following.User_FollowerId
		// 				FROM following
		// 				WHERE following.Active = TRUE)
		// 				AND user_recommend_story.Opinion = TRUE
		// 				AND story.Published = TRUE
		// 				AND StoryPrivacyType_StoryPrivacyTypeId = 1
		// 				GROUP BY story.StoryId
		// 				ORDER BY recommendation_count DESC
		// 				LIMIT :start, :howmany";


		$statement = "SELECT 
					s.StoryId, s.User_UserId, s.StoryPrivacyType_StoryPrivacyTypeId, s.StoryTitle, s.Content, s.Active, s.DatePosted, 

					urs.User_UserId, urs.Story_StoryId, urs.Active, urs.Opinion,

					aps.User_UserId, aps.Story_StoryId, aps.Active, aps.Approved,

					shp.Story_StoryId, shp.PictureId, shp.Active,

					p.PictureId, p.User_UserId, p.FileName, p.PictureExtension, p.Active,

					u.UserId, u.Active, u.FirstName, u.LastName, u.ProfilePrivacyType_PrivacyTypeId, 
					(
						SELECT COUNT(1)
						FROM user_recommend_story 
						WHERE user_recommend_story.Story_StoryId = s.StoryId
					    AND user_recommend_story.Active = TRUE
					    AND user_recommend_story.Opinion = FALSE
					) AS totalFlags,
					(
						SELECT COUNT(1)
						FROM user_recommend_story 
						WHERE user_recommend_story.Story_StoryId = s.StoryId
					    AND user_recommend_story.Active = TRUE
					    AND user_recommend_story.Opinion = TRUE
					) AS totalRecommends,

					(
						SELECT COUNT(1)
						FROM comment c
						WHERE c.Story_StoryId = s.StoryId
					    AND c.Active = TRUE
					) AS totalComments
					 
					FROM story s

					INNER JOIN user u
					ON (u.UserId = s.User_UserId) AND (u.Active = TRUE)
					LEFT JOIN admin_approve_story aps
					ON (aps.Story_StoryId = s.StoryId) AND (aps.Active = TRUE)

					LEFT JOIN user_recommend_story urs
					ON (urs.Story_StoryId = s.StoryId) AND (urs.User_UserId = :userid) AND (urs.Active = TRUE)

					LEFT JOIN story_has_picture shp
					ON (shp.Story_StoryId = s.StoryId) AND (shp.Active = TRUE)
					LEFT JOIN picture p
					ON (p.PictureId = shp.PictureId) AND (p.Active = TRUE)

					WHERE StoryPrivacyType_StoryPrivacyTypeId = 1
					AND s.Active = TRUE
					AND aps.Active = TRUE
					AND aps.Approved = TRUE
					AND u.Active = TRUE
		
					ORDER BY totalRecommends DESC
					LIMIT :start,:howmany";


		$start = $this-> getStartValue($howMany, $page);

		$stories = $this->fetchIntoClass($statement, array(":start" => $start, ":howmany" => $howMany, ":userid" => $userid), "shared/StoryViewModel");

		return $stories;
	}

	//Tested getStoryListNewest(1,5,1)
	public function getStoryListNewest($userid, $howMany = self::HOWMANY, $page = self::PAGE)
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
			// $statement = "SELECT s.*, aas.Approved, spt.NameE
			// 		  FROM Story s 
			// 		  INNER JOIN admin_approve_story aas 
			// 		  ON s.StoryId = aas.Story_StoryId
			// 		  WHERE s.Active = TRUE 
			// 		  AND aas.Approved = TRUE
			// 		  AND StoryPrivacyType_StoryPrivacyTypeId = 1
			// 		  GROUP BY s.StoryId DESC
			// 		  LIMIT :start , :howmany";

			$statement = "SELECT 
					s.StoryId, s.User_UserId, s.StoryPrivacyType_StoryPrivacyTypeId, s.StoryTitle, s.Content, s.Active, s.DatePosted, 

					urs.User_UserId, urs.Story_StoryId, urs.Active, urs.Opinion,

					aps.User_UserId, aps.Story_StoryId, aps.Active, aps.Approved,

					shp.Story_StoryId, shp.PictureId, shp.Active,

					p.PictureId, p.User_UserId, p.FileName, p.PictureExtension, p.Active,

					u.UserId, u.Active, u.FirstName, u.LastName, u.ProfilePrivacyType_PrivacyTypeId, 
					(
						SELECT COUNT(1)
						FROM user_recommend_story 
						WHERE user_recommend_story.Story_StoryId = s.StoryId
					    AND user_recommend_story.Active = TRUE
					    AND user_recommend_story.Opinion = FALSE
					) AS totalFlags,
					(
						SELECT COUNT(1)
						FROM user_recommend_story 
						WHERE user_recommend_story.Story_StoryId = s.StoryId
					    AND user_recommend_story.Active = TRUE
					    AND user_recommend_story.Opinion = TRUE
					) AS totalRecommends,

					(
						SELECT COUNT(1)
						FROM comment c
						WHERE c.Story_StoryId = s.StoryId
					    AND c.Active = TRUE
					) AS totalComments
					 
					FROM story s

					INNER JOIN user u
					ON (u.UserId = s.User_UserId) AND (u.Active = TRUE)
					LEFT JOIN admin_approve_story aps
					ON (aps.Story_StoryId = s.StoryId) AND (aps.Active = TRUE)

					LEFT JOIN user_recommend_story urs
					ON (urs.Story_StoryId = s.StoryId) AND (urs.User_UserId = :userid) AND (urs.Active = TRUE)

					LEFT JOIN story_has_picture shp
					ON (shp.Story_StoryId = s.StoryId) AND (shp.Active = TRUE)
					LEFT JOIN picture p
					ON (p.PictureId = shp.PictureId) AND (p.Active = TRUE)

					WHERE StoryPrivacyType_StoryPrivacyTypeId = 1
					AND s.Active = TRUE
					AND aps.Active = TRUE
					AND aps.Approved = TRUE
					AND u.Active = TRUE
		
					ORDER BY s.DatePosted DESC
					LIMIT :start,:howmany";

			$start = $this-> getStartValue($howMany, $page);
 
			$parameters = array(":start" => $start, ":howmany" => $howMany, ":userid" => $userid);

			$story = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

			return $story;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}

	}


	public function getTotalCommentsApproved($userID)
	{

		$statement = "SELECT count(*)
						FROM comment c 
						WHERE c.User_UserId = :UserId
						AND c.PublishFlag = TRUE";

		$totalComments = $this->fetchNum($statement, array(":UserId" => $userID));

		return $totalComments;
	}

	public function getTotalCommentsPending($userID)
	{
		$statement = "SELECT count(*)
						FROM comment c 
						WHERE c.User_UserId = :UserId
						AND c.PublishFlag = FALSE";

		$totalComments = $this->fetchNum($statement, array(":UserId" => $userID));

		return $totalComments;
	}

	//This doesn't work related the story FK
	public function addCommentToStory($comment, $storyID, $userID)
	{
		//Accepts a comment class
		//inserts a new comment with the published flag set to false
		//returns bool if the comment was saved succesfully

		$statement = "INSERT INTO Comment (Story_StoryId, User_UserId, Content, DateCreated) 
						VALUES(:storyID, :userID, :comment, :DateCreated)";

		$parameters = array(":storyID" => $storyID, ":userID" => $userID, ":comment" => $comment, ":DateCreated" => $this->getDateNow());

		return $this->fetch($statement, $parameters);
	}

	public function getCommentsForStory($storyID, $howMany = self::HOWMANY, $page = self::PAGE)
	{
		//Accepts a story id, how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Checks if user has makrked comment as inappropriate (add this to comment viewmodel class)
		//Gets a list of comments related to a story
		//The comments published flag must be true
		//returns an array of comment class related to a story

		try
		{
			$statement = "SELECT c.*, u.FirstName, u.LastName  
							FROM Comment c
							LEFT JOIN user u
							ON u.UserId = c.User_UserId
							WHERE Story_StoryId = :storyID 
							AND c.Active = TRUE
							AND c.PublishFlag
							AND u.Active = TRUE
							ORDER BY CommentId 
							ASC LIMIT :start, :howmany";

			$start = $this-> getStartValue($howMany, $page);

			$comment = $this->fetchIntoClass($statement, array(":storyID" => $storyID, ":start" => $start, ":howmany" => $howMany), "shared/CommentViewModel");

			return $comment;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	public function getCommentListInappropriate($adminID, $howMany = self::HOWMANY, $page = self::PAGE)
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

			$start = $this-> getStartValue($howMany, $page);

			$comment = $this->fetchIntoClass($statement, array($start, $howMany), "shared/CommentViewModel");

			return $comment;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	public function getCommentListRejected($adminID, $howMany = self::HOWMANY, $page = self::PAGE)
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

			$comment = $this->fetchIntoClass($statement, array($userID), "shared/CommentViewModel");

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
			$statement = "INSERT INTO user_inappropriateflag_comment (User_UserId, Comment_CommentId, DateCreated) 
						  VALUES(:UserId, :CommentID, :DateCreated)
						  ON DUPLICATE KEY
						  	UPDATE Active = TRUE";

			$parameters = array(":UserId" => $userID, ":CommentID" => $commentID, ":DateCreated" => $this->getDateNow());

			return $this->fetch($statement, $parameters);	
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	public function searchTags($query, $howMany = self::HOWMANY, $page = self::PAGE)
	{
		try
		{
			$query .= "%";
			$statement = "SELECT t.TagId as id, t.Tag as text
							FROM tag t 
							WHERE LOWER(t.Tag) LIKE :query
							LIMIT :start, :howmany";

			$start = $this-> getStartValue($howMany, $page);

			$tags = $this->fetchIntoClass($statement, array(":query" => strtolower($query), ":start" => $start, ":howmany" => $howMany), "shared/TagViewModel");

			return $tags;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	public function getTagByID($tagId)
	{
		try
		{
			$statement = "SELECT t.TagId as id, t.Tag as text
							FROM tag t 
							WHERE t.TagId = :TagID";

			$tags = $this->fetchIntoClass($statement, array(":TagID" => $tagId), "shared/TagViewModel");

			return $tags;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	public function isValidAnswer($questionID, $answerID)
	{
		try
		{
			$statement = "SELECT COUNT(*)
							FROM answer_for_question
							WHERE Question_QuestionId = :QuestionID
							AND Answer_AnswerId = :AnswerID";

			$count = $this->fetchNum($statement, array(":QuestionID" => $questionID, ":AnswerID" =>$answerID));

			return $count > 0;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	public function getActiveQuestionCount()
	{
		try
		{
			$statement = "SELECT COUNT(*)
							FROM question q
							WHERE q.Active = TRUE";

			$count = $this->fetchNum($statement, array());

			return $count;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	public function addNewTag($tag)
	{
		try
		{
			$statement = "INSERT INTO tag (Tag, DateCreated) 
						  VALUES(:Tag, :DateCreated)";

			$parameters = array(":Tag" => $tag, ":DateCreated" => $this->getDateNow());

			return $this->fetch($statement, $parameters);	
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	public function getTagsForStory($storyID)
	{
		try
		{
			$statement = "SELECT *
							FROM tag t
							INNER JOIN story_has_tag sht
							ON sht.Tag_TagId = t.TagId
							WHERE t.Active = TRUE
							AND sht.Story_StoryId = :storyID";

			$result = $this->fetchIntoObject($statement, array(":storyID" => $storyID));

			return $result;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	public function getTagsForWordCloud()
	{
		try
		{
			$statement = "SELECT t.Tag,
							(
							    SELECT COUNT(*)
							    FROM story_has_tag sht
							    WHERE t.TagId = sht.Tag_TagId
							    
							) AS count
							FROM tag t
							ORDER BY count DESC
							LIMIT 0,50";

			$result = $this->fetchIntoObject($statement, array());

			$jsonFormat = array();

			$totalValue = 0;

			foreach ($result as $tag) {
				$totalValue += $tag->count;

				$jsonFormat[] = array($tag->Tag, $tag->count);
			}

			for ($i=0; $i < count($jsonFormat); $i++) { 
				$jsonFormat[$i][1] = round( (($jsonFormat[$i][1] / $totalValue) * 100));
			}

			return $jsonFormat;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	public function getQuestionAnswersForStory($storyID)
	{
		try
		{
			$statement = "SELECT *
							FROM story_has_answer_for_question
							WHERE Story_StoryId = :storyID
							ORDER BY
							Answer_for_Question_Question_QuestionId";

			$result = $this->fetchIntoObject($statement, array(":storyID" => $storyID));

			return $result;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	public function getPicturesForStory($storyID)
	{
		try
		{
			$statement = "SELECT *
							FROM picture p
							INNER JOIN story_has_picture shp
							ON shp.PictureId = p.PictureId
							WHERE shp.Story_StoryId = :storyID
							AND shp.Active = TRUE
							AND p.Active = TRUE";

			$result = $this->fetchIntoObject($statement, array(":storyID" => $storyID));

			return $result;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

}

?>
