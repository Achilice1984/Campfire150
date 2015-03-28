<?php
require_once(APP_DIR .'helpers/storysearch.php');

class StoryModel extends Model {

	// Test doesn't work 
	public function searchStories($storySearch, $userID, $howMany = MAX_STORIES_LISTS, $page = self::PAGE)
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
		catch(Exception $e) 
		{
			throw $ex;
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
											 published, DateCreated, DatePosted, Active)
						  VALUES(:StoryId, :User_UserId, :StoryPrivacyType_StoryPrivacyTypeId, :StoryTitle, :Content, 
						  	     :published, :DateCreated, :DatePosted, :Active)";
 
			$parameters = array(":StoryId" => $story->StoryId, 
								":User_UserId" => $userId,
								":StoryPrivacyType_StoryPrivacyTypeId" => $story->StoryPrivacyType_StoryPrivacyTypeId,
								":StoryTitle" => $story->StoryTitle, 
								":Content" => $story->Content, 
								":published" => $story->Published, 
								":DateCreated" => $this->getDateNow(), 
								":DatePosted" => $this->getDateNow(), 
								":Active" => TRUE
								);

			return $this->fetch($statement, $parameters);
		}
		catch(Exception $e) 
		{
			throw $ex;
		}
	}

	// tested User_Id FK issue need to check the user
	public function updateDraft($story, $userId)
	{
		//Accepts a story class
		//inserts a new story with the publish flag set to false
		//returns bool if the story was saved succesfully
		try
		{
			// create a php timestamp for inserting into the created and updated date fields in the database 
			//$timestamp = date('Y-m-d G:i:s');


			//TAGS
			$statement = "UPDATE story_has_tag 
							SET Active=FALSE
							 WHERE story_has_tag.Story_StoryId = :StoryId";
 
			$parameters = array(":StoryId" => $story->StoryId);

			$this->fetch($statement, $parameters);

			//ADMIN
			$statement = "UPDATE admin_approve_story 
							SET Active=FALSE
							 WHERE Story_StoryId = :StoryId 
							 AND Active = TRUE";
 
			$parameters = array(":StoryId" => $story->StoryId);

			$this->fetch($statement, $parameters);

			//Questionaire
			$statement = "UPDATE story_has_answer_for_question 
							SET Active=FALSE
							 WHERE Story_StoryId = :StoryId 
							 AND Active = TRUE";
 
			$parameters = array(":StoryId" => $story->StoryId);

			$this->fetch($statement, $parameters);

			$statement = "UPDATE story 
							SET StoryPrivacyType_StoryPrivacyTypeId=:StoryPrivacyType_StoryPrivacyTypeId, StoryTitle=:StoryTitle, Content=:Content, published=:published, Active=:Active

							 WHERE story.User_UserId = :User_UserId
							 AND story.StoryId = :StoryId";
 
			$parameters = array(":StoryId" => $story->StoryId, 
								":User_UserId" => $userId,
								":StoryPrivacyType_StoryPrivacyTypeId" => $story->StoryPrivacyType_StoryPrivacyTypeId,
								":StoryTitle" => $story->StoryTitle, 
								":Content" => $story->Content, 
								":published" => $story->Published, 
								":Active" => TRUE
								);

			return $this->fetch($statement, $parameters);
		}
		catch(Exception $e) 
		{
			throw $ex;
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
		catch(Exception $e) 
		{
			throw $ex;
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
		catch(Exception $e) 
		{
			throw $ex;
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
						  VALUES(:StoryId, :Tag_TagId, :DateCreated)
						  ON DUPLICATE KEY UPDATE Active=TRUE";
 
			$parameters = array(":StoryId" => $storyId, 
								":Tag_TagId" => $tagId, 
								":DateCreated" => $this->getDateNow()
								);

			return $this->fetch($statement, $parameters);
		}
		catch(Exception $e) 
		{
			throw $ex;
		}
	}

	public function saveStoryImageMetadata($userId, $image, $storyId)
	{
		// 3 = story picture

		try
		{
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

				$statement = "UPDATE story_has_picture SET Active = FALSE
								WHERE story_has_picture.Story_StoryId = :Story_StoryId";
				$parameters = array( 
					":Story_StoryId" => $storyId
				);

				$this->fetch($statement, $parameters);

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
		catch(Exception $e) 
		{
			throw $ex;
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
		catch(Exception $e) 
		{
			throw $ex;
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
		catch(Exception $e) 
		{
			throw $ex;
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
		catch(Exception $e) 
		{
			throw $ex;
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
		catch(Exception $e) 
		{
			throw $ex;
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
		catch(Exception $e) 
		{
			throw $ex;
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
							s.StoryId, s.User_UserId AS UserId, s.StoryTitle, s.Content, s.DatePosted, 

							urs.Opinion, shp.PictureId, p.PictureId, u.Active, u.FirstName, u.LastName,

							f.Active AS FollowingUser,

							up.PictureId as UserProfilePicureId,

							uas.ActionStatement,

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
							    AND c.PublishFlag = TRUE
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

							LEFT JOIN useractionstatement uas
							ON (uas.User_UserId = s.User_UserId) AND (uas.Active = TRUE)

							LEFT JOIN following f
							ON (f.User_FollowerId = s.User_UserId) AND (f.Active = TRUE)

							LEFT JOIN picture up
							ON (up.User_UserId = s.User_UserId) AND (up.Active = TRUE) AND (up.Picturetype_PictureTypeId = 1)

							WHERE s.StoryId = :StoryId
							AND StoryPrivacyType_StoryPrivacyTypeId = 1
							AND s.Active = TRUE
							AND u.ProfilePrivacyType_PrivacyTypeId = 1
							AND s.Published = TRUE
							AND aps.Active = TRUE
							AND aps.Approved = TRUE
							";
							
			$parameters = array(":User_UserId" => $userID, 
								":StoryId" => $storyID);

			$story = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

			return $story;
		}
		catch(Exception $e) 
		{
			throw $ex;
		}
	}

	// tested getStory(2,11)
	public function getStory_unpublished($userID, $storyID)
	{
		//Accepts a user id, and a storyID
		//Check privacy type
		//Must be approved
		//Checks if user has marked story as inappropriate and if user has recommended story (add these to story viewmodel class)
		//returns a Story class

		try
		{
			$statement = "SELECT
							s.StoryId, s.User_UserId AS UserId, s.StoryTitle, s.Content, s.DatePosted, s.Published,

							urs.Opinion, shp.PictureId, p.PictureId, u.Active, u.FirstName, u.LastName,

							up.PictureId as UserProfilePicureId,

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
							    AND c.PublishFlag = TRUE
							) AS totalComments
							 
							FROM story s

							INNER JOIN user u
							ON (u.UserId = s.User_UserId) AND (u.Active = TRUE)

							LEFT JOIN user_recommend_story urs
							ON (urs.Story_StoryId = s.StoryId) AND (urs.User_UserId = :User_UserId) AND (urs.Active = TRUE)

							LEFT JOIN story_has_picture shp
							ON (shp.Story_StoryId = s.StoryId) AND (shp.Active = TRUE)
							LEFT JOIN picture p
							ON (p.PictureId = shp.PictureId) AND (p.Active = TRUE)

							LEFT JOIN picture up
							ON (up.User_UserId = s.User_UserId) AND (up.Active = TRUE) AND (up.Picturetype_PictureTypeId = 1)							

							WHERE s.StoryId = :StoryId
							AND u.ProfilePrivacyType_PrivacyTypeId = 1
							AND s.Active = TRUE							
							GROUP BY s.StoryId
							";
							
			$parameters = array(":User_UserId" => $userID, 
								":StoryId" => $storyID);

			$story = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

			return $story;
		}
		catch(Exception $e) 
		{
			throw $ex;
		}
	}

	//Tested getStoryListByTag("Art", 5, 1);
	public function getStoryListByTag($userId, $tag, $howMany = MAX_STORIES_LISTS, $page = self::PAGE)
	{
		//Accepts a categoryID, how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Check privacy type
		//Checks if user has makrked story as inappropriate and if user has recommended story (add these to story viewmodel class)
		//returns an array of Story class related to a category
		try 
		{
			
			$statement = "	SELECT
							s.StoryId, s.User_UserId AS UserId, s.StoryTitle, s.Content, s.DatePosted, 

							urs.Opinion, shp.PictureId, p.PictureId, u.Active, u.FirstName, u.LastName,

							f.Active AS FollowingUser,

							up.PictureId as UserProfilePicureId,

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
							    AND c.PublishFlag = TRUE
							) AS totalComments

							FROM story s 
						  	INNER JOIN user u
						  	ON (u.UserId = s.User_UserId) AND (u.Active = TRUE)

						  	INNER JOIN story_has_answer_for_question saq
						  	ON s.StoryId = saq.Story_StoryId

						  	LEFT JOIN user_recommend_story urs
							ON (urs.Story_StoryId = s.StoryId) AND (urs.User_UserId = :userid) AND (urs.Active = TRUE)

							LEFT JOIN story_has_picture shp
							ON (shp.Story_StoryId = s.StoryId) AND (shp.Active = TRUE)
							LEFT JOIN picture p
							ON (p.PictureId = shp.PictureId) AND (p.Active = TRUE)

							LEFT JOIN following f
							ON (f.User_FollowerId = s.User_UserId) AND (f.Active = TRUE)

							LEFT JOIN admin_approve_story aps
							ON (aps.Story_StoryId = s.StoryId) AND (aps.Active = TRUE)

							LEFT JOIN picture up
							ON (up.User_UserId = s.User_UserId) AND (up.Active = TRUE) AND (up.Picturetype_PictureTypeId = 1)

							INNER JOIN story_has_tag sht
						  	ON s.StoryId = sht.Story_StoryId
						  	INNER JOIN tag t 
						  	ON sht.Tag_TagId = t.TagId 

							  WHERE StoryPrivacyType_StoryPrivacyTypeId = 1
							  AND aps.Approved = TRUE
							  AND aps.Active = TRUE
							  AND s.Active = TRUE
							  AND s.Published = TRUE
							  AND u.Active = TRUE
							  AND u.ProfilePrivacyType_PrivacyTypeId = 1
							  AND t.Tag= :tag
							  GROUP BY s.StoryId
							  LIMIT :start , :howmany";

		
			$start = $this->getStartValue($howMany, $page);

			$parameters = array(":userid" => $userId, ":tag" => $tag, ":start" => $start, ":howmany" => $howMany);
			//debugit($parameters);
			$story = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

			return $story;
		}
		catch(Exception $e) 
		{
			throw $ex;
		}		
	}

	//Tested getStoryListByIssueID(1,6,1); it works but we need to know the exact issueID
	public function getStoryListByIssueID($issueID, $howMany = MAX_STORIES_LISTS, $page = self::PAGE)
	{
		//Accepts a categoryID, how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Check privacy type
		//Checks if user has makrked story as inappropriate and if user has recommended story (add these to story viewmodel class)
		//returns an array of Story class related to a category
		try 
		{			
			$statement = "SELECT s.*, saq.answer_for_question_answer_answerId
						  FROM story s 
						  INNER JOIN story_has_answer_for_question saq
						  ON s.StoryId = saq.Story_StoryId
						  INNER JOIN admin_approve_story aas
						  ON s.StoryId = aas.Story_StoryId
						  WHERE saq.answer_for_question_answer_answerId = :issueID
						  AND StoryPrivacyType_StoryPrivacyTypeId = 1
						  AND aas.Approved = TRUE
						  AND s.Active = TRUE
						  GROUP BY s.StoryId
						  LIMIT :start , :howmany";

		
			$start = $this-> getStartValue($howMany, $page);

			$parameters = array(":issueID" => $issueID, ":start" => $start, ":howmany" => $howMany);
			$story = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

			return $story;
		}
		catch(Exception $e) 
		{
			throw $ex;
		}		
	}
	// it works but we need to know the exact challengesID
	public function getStoryListByChallengesID($userId, $challengesID, $howMany = MAX_STORIES_LISTS, $page = self::PAGE)
	{
		//Accepts a categoryID, how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Check privacy type
		//Checks if user has makrked story as inappropriate and if user has recommended story (add these to story viewmodel class)
		//returns an array of Story class related to a category
		try 
		{
			
			$statement = "SELECT
							s.StoryId, s.User_UserId AS UserId, s.StoryTitle, s.Content, s.DatePosted, 

							urs.Opinion, shp.PictureId, p.PictureId, u.Active, u.FirstName, u.LastName,

							f.Active AS FollowingUser,

							up.PictureId as UserProfilePicureId,

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
							    AND c.PublishFlag = TRUE
							) AS totalComments

						  FROM story s 
						  INNER JOIN user u
						  ON (u.UserId = s.User_UserId) AND (u.Active = TRUE)

						  INNER JOIN story_has_answer_for_question saq
						  ON s.StoryId = saq.Story_StoryId

						  LEFT JOIN user_recommend_story urs
							ON (urs.Story_StoryId = s.StoryId) AND (urs.User_UserId = :userid) AND (urs.Active = TRUE)

							LEFT JOIN story_has_picture shp
							ON (shp.Story_StoryId = s.StoryId) AND (shp.Active = TRUE)
							LEFT JOIN picture p
							ON (p.PictureId = shp.PictureId) AND (p.Active = TRUE)

							LEFT JOIN following f
							ON (f.User_FollowerId = s.User_UserId) AND (f.Active = TRUE)

						LEFT JOIN admin_approve_story aps
						ON (aps.Story_StoryId = s.StoryId) AND (aps.Active = TRUE)

						LEFT JOIN picture up
						ON (up.User_UserId = s.User_UserId) AND (up.Active = TRUE) AND (up.Picturetype_PictureTypeId = 1)

						  WHERE saq.answer_for_question_answer_answerId = :challengesID
						  AND StoryPrivacyType_StoryPrivacyTypeId = 1
						  AND u.ProfilePrivacyType_PrivacyTypeId = 1
						  AND aps.Approved = TRUE
						  AND aps.Active = TRUE
						  AND s.Active = TRUE
						  AND s.Published = TRUE
						  AND u.Active = TRUE
						  GROUP BY s.StoryId
						  LIMIT :start , :howmany";

		
			$start = $this-> getStartValue($howMany, $page);

			$parameters = array(":challengesID" => $challengesID, ":start" => $start, ":howmany" => $howMany, ":userid" => $userId);
			$story = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

			return $story;
		}
		catch(Exception $e) 
		{
			throw $ex;
		}		
	}

	//it works but we need to know the exact genreID
	// public function getStoryListByGenreID($genreID, $howMany = MAX_STORIES_LISTS, $page = self::PAGE)
	// {
	// 	//Accepts a categoryID, how many results to return, what page of results your on
	// 	//for example, if how many = 10 and page = 2, you would take results 11 to 20
	// 	//Check privacy type
	// 	//Checks if user has makrked story as inappropriate and if user has recommended story (add these to story viewmodel class)
	// 	//returns an array of Story class related to a category
	// 	try 
	// 	{
			
	// 		$statement = "SELECT s.*, saq.answer_for_question_answer_answerId
	// 					  FROM story s 
	// 					  INNER JOIN story_has_answer_for_question saq
	// 					  ON s.StoryId = saq.Story_StoryId
	// 					  INNER JOIN admin_approve_story aas
	// 					  ON s.StoryId = aas.Story_StoryId
	// 					  WHERE saq.answer_for_question_answer_answerId = :challengesID
	// 					  AND StoryPrivacyType_StoryPrivacyTypeId = 1
	// 					  AND aas.Approved = TRUE
	// 					  AND s.Active = TRUE
	// 					  WHERE saq.answer_for_question_answer_answerId = :genreID
	// 					  GROUP BY s.StoryId
	// 					  LIMIT :start , :howmany";

		
	// 		$start = $this-> getStartValue($howMany, $page);

	// 		$parameters = array(":genreID" => $genreID, ":start" => $start, ":howmany" => $howMany);
	// 		$story = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

	// 		return $story;

	// 	}
	// 	catch(PDOException $e)
	// 	{
	// 		return $e->getMessage();
	// 	}
		
	// }
	
	// //Tested getStoryList(6,1) will show 5 stories 
	// public function getStoryList($howMany = MAX_STORIES_LISTS, $page = self::PAGE)
	// {
	// 	//Accepts how many results to return, what page of results your on
	// 	//for example, if how many = 10 and page = 2, you would take results 11 to 20
	// 	//Check privacy type
	// 	//Checks if user has makrked story as inappropriate and if user has recommended story (add these to story viewmodel class)
	// 	//Should not contain any unpublished stories
	// 	//returns an array of Story class
	// 	try
	// 	{
	// 		$statement = "SELECT s.StoryId, s.StoryTitle, s.Content, s.DatePosted, s.DateUpdated
	// 					  FROM story s
	// 					  INNER JOIN admin_approve_story aas
	// 					  ON s.StoryId = aas.Story_StoryId
	// 					  WHERE aas.Approved = TRUE
	// 					  AND StoryPrivacyType_StoryPrivacyTypeId = 1
	// 					  AND s.Active = TRUE
	// 					  ORDER BY StoryTitle ASC 
	// 					  GROUP BY s.StoryId
	// 					  LIMIT :start, :howmany";

	// 		$start = $this-> getStartValue($howMany, $page);
 
	// 		$parameters = array(":start" => $start,
	// 							":howmany" => $howMany);

	// 		$story = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

	// 		return $story;
	// 	}
	// 	catch(PDOException $e) 
	// 	{
	// 		return $e->getMessage();
	// 	}

	// }

	//Tested getStoryListPendingApproval(3,5,1);
	public function getStoryListPendingApproval($userID, $howMany = MAX_STORIES_LISTS, $page = self::PAGE)
	{
		//Accepts a user id, how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of stories that a user has submited but hasn't been apprved yet.
		//Should not contain any published stories
		//returns an array of Story class

		try
		{
			$statement = "SELECT s.*, aas.Approved, aas.Pending,

							p.PictureId, p.User_UserId, p.FileName, p.PictureExtension, p.Active, p.Picturetype_PictureTypeId

							FROM story s 

							LEFT JOIN admin_approve_story aas
							ON s.StoryId = aas.Story_StoryId AND aas.Active = TRUE

							LEFT JOIN story_has_picture shp
							ON (shp.Story_StoryId = s.StoryId) AND (shp.Active = TRUE)
							LEFT JOIN picture p
							ON (p.PictureId = shp.PictureId) AND (p.Active = TRUE)

							WHERE ((s.User_UserId = :User_UserId AND aas.Pending IS NULL )
							OR (s.User_UserId = :User_UserId2 AND aas.Approved = FALSE AND aas.Pending = TRUE AND aas.Active = TRUE))
							AND s.Published = TRUE
							GROUP BY s.StoryId
							LIMIT :start,:howmany";

			$start = $this-> getStartValue($howMany, $page);
 
			$parameters = array(":User_UserId" => $userID, ":User_UserId2" => $userID, ":start" => $start, ":howmany" => $howMany);

			$storyList = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

			return $storyList;
		}
		catch(Exception $e) 
		{
			throw $ex;
		}		
	}

	//Tested getStoryListPendingApproval(3,5,1);
	public function getStoryListDrafts($userID, $howMany = MAX_STORIES_LISTS, $page = self::PAGE)
	{
		//Accepts a user id, how many, page
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of stories that have been rejected by admin
		//Should not contain any published stories
		//Should have the admin user details an reason for being rejected
		//returns an array of Story class
		try
		{
			
			$statement = "SELECT s.*, 

						 	p.PictureId, p.User_UserId, p.FileName, p.PictureExtension, p.Active, p.Picturetype_PictureTypeId

							FROM story s 

							LEFT JOIN story_has_picture shp
							ON (shp.Story_StoryId = s.StoryId) AND (shp.Active = TRUE)
							LEFT JOIN picture p
							ON (p.PictureId = shp.PictureId) AND (p.Active = TRUE)

							WHERE s.Published = FALSE
							AND s.User_UserId = :UserId
							GROUP BY s.StoryId
							LIMIT :start , :howmany";

			$start = $this-> getStartValue($howMany, $page);
 
			$parameters = array(":UserId" => $userID, ":start" => $start, ":howmany" => $howMany);

			$story = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

			return $story;
		}
		catch(Exception $e) 
		{
			throw $ex;
		}
	}

	//Tested getStoryListRejected(3,5,1);
	public function getStoryListRejected($userID, $howMany = MAX_STORIES_LISTS, $page = self::PAGE)
	{
		//Accepts a user id, how many, page
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of stories that have been rejected by admin
		//Should not contain any published stories
		//Should have the admin user details an reason for being rejected
		//returns an array of Story class
		try
		{
			
			$statement = "SELECT s.*, 

							aas.Approved, aas.Pending, aas.Reason,
						 	
						 	p.PictureId, p.User_UserId, p.FileName, p.PictureExtension, p.Active, p.Picturetype_PictureTypeId

							FROM story s 

							LEFT JOIN admin_approve_story aas
							ON s.StoryId = aas.Story_StoryId AND aas.Approved = FALSE AND aas.Active = TRUE

							LEFT JOIN story_has_picture shp
							ON (shp.Story_StoryId = s.StoryId) AND (shp.Active = TRUE)
							LEFT JOIN picture p
							ON (p.PictureId = shp.PictureId) AND (p.Active = TRUE)

							WHERE aas.Active = TRUE
							AND aas.Approved = FALSE
							AND s.User_UserId = :UserId
							LIMIT :start , :howmany";

			$start = $this-> getStartValue($howMany, $page);
 
			$parameters = array(":UserId" => $userID, ":start" => $start, ":howmany" => $howMany);

			$story = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

			return $story;
		}
		catch(Exception $e) 
		{
			throw $ex;
		}
	}

	//Tested getStoryListApproved(9,5,1)
	public function getStoryListApproved($howMany = MAX_STORIES_LISTS, $page = self::PAGE)
	{
		//Accepts a user id, how many, page
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of stories that have been approved by admin
		//Should not contain any unpublished stories
		//returns an array of Story class

		try
		{
			
			$statement = "SELECT s.*, aas.Approved
						  FROM story s 
						  INNER JOIN admin_approve_story aas
						  ON s.StoryId = aas.Story_StoryId
						  WHERE aas.Approved = TRUE
						  LIMIT :start , :howmany";

			$start = $this-> getStartValue($howMany, $page);
 
			$parameters = array(":start" => $start, ":howmany" => $howMany);

			$story = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

			return $story;
		}
		catch(Exception $e) 
		{
			throw $ex;
		}
	}

	public function getTotalRecommendations($userID)
	{
		try
		{
			//Accepts an user id
			//Gets the total stories written by the user who owns this email address
			//Returns the total
			$statement = "SELECT count(*)
							FROM story 

							LEFT JOIN user_recommend_story urs
							ON (urs.Story_StoryId = story.StoryId) AND (urs.Active = TRUE) AND (urs.User_UserId = :UserId)
							LEFT JOIN admin_approve_story 
							ON (story.StoryId = admin_approve_story.Story_StoryId) AND (admin_approve_story.Active = TRUE)
							INNER JOIN user u
							ON (u.UserId = story.User_UserId) AND (u.Active = TRUE)

							WHERE story.Published = TRUE 
							AND StoryPrivacyType_StoryPrivacyTypeId = 1
							AND admin_approve_story.Approved = TRUE
							AND admin_approve_story.Active = TRUE
							AND urs.Active = TRUE
							AND urs.Opinion = TRUE
							AND story.Published = TRUE
							AND u.Active = TRUE
							AND u.ProfilePrivacyType_PrivacyTypeId = 1	
							";

			$totalStories = $this->fetchNum($statement, array(":UserId" => $userID));

			return $totalStories;
		}
		catch(Exception $e) 
		{
			throw $ex;
		}
	}

	// Tested getStoryListRecommendedByFriends(2,5,1)
	public function getTotalStoriesApproved($userID)
	{
		try
		{
			//Accepts an user id
			//Gets the total stories written by the user who owns this email address
			//Returns the total
			$statement = "SELECT count(*)
							FROM story 

							LEFT JOIN admin_approve_story 
							ON (story.StoryId = admin_approve_story.Story_StoryId) AND (admin_approve_story.Active = TRUE)

							WHERE story.User_UserId = :UserId 
							AND story.Published = TRUE 
							AND StoryPrivacyType_StoryPrivacyTypeId = 1
							AND admin_approve_story.Approved = TRUE
							AND admin_approve_story.Active = TRUE";

			$totalStories = $this->fetchNum($statement, array(":UserId" => $userID));

			return $totalStories;
		}
		catch(Exception $e) 
		{
			throw $ex;
		}
	}
	public function getTotalStoriesPending($userID)
	{
		try
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
		catch(Exception $e) 
		{
			throw $ex;
		}
	}
	public function getTotalStoriesDenied($userID)
	{
		try
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
		catch(Exception $e) 
		{
			throw $ex;
		}
	}

	public function getStoriesWrittenByCurrentUser($userID, $howMany = MAX_STORIES_LISTS, $page = self::PAGE)
	{
		try
		{
			//Accepts a user id
			//Gets an array of stories written by the owner of this user id
			//Returns an array of Story class

			$statement = "SELECT
						s.StoryId, s.User_UserId AS UserId, s.StoryTitle, s.Content, s.DatePosted, 

						urs.Opinion, shp.PictureId, p.PictureId, u.Active, u.FirstName, u.LastName,

						f.Active AS FollowingUser,

						up.PictureId as UserProfilePicureId,

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

							INNER JOIN user
							ON (user.UserId = user_recommend_story.User_UserId) AND (user.Active = TRUE) AND (user.ProfilePrivacyType_PrivacyTypeId = 1)

							WHERE user_recommend_story.Story_StoryId = s.StoryId
						    AND user_recommend_story.Active = TRUE
						    AND user_recommend_story.Opinion = TRUE
						) AS totalRecommends,

						(
							SELECT COUNT(1)
							FROM comment c
							WHERE c.Story_StoryId = s.StoryId
						    AND c.Active = TRUE
						    AND c.PublishFlag = TRUE
						) AS totalComments
						 
						FROM story s

						INNER JOIN user u
						ON (u.UserId = s.User_UserId) AND (u.Active = TRUE)
						LEFT JOIN admin_approve_story aps
						ON (aps.Story_StoryId = s.StoryId) AND (aps.Active = TRUE)

						LEFT JOIN user_recommend_story urs
						ON (urs.Story_StoryId = s.StoryId) AND (urs.Active = TRUE)

						LEFT JOIN story_has_picture shp
						ON (shp.Story_StoryId = s.StoryId) AND (shp.Active = TRUE)
						LEFT JOIN picture p
						ON (p.PictureId = shp.PictureId) AND (p.Active = TRUE)

						LEFT JOIN following f
						ON (f.User_FollowerId = s.User_UserId) AND (f.User_UserId = :UserId2) AND (f.Active = TRUE)

						LEFT JOIN picture up
						ON (up.User_UserId = s.User_UserId) AND (up.Active = TRUE) AND (up.Picturetype_PictureTypeId = 1)

						WHERE StoryPrivacyType_StoryPrivacyTypeId = 1
						AND s.Active = TRUE
						AND aps.Active = TRUE
						AND aps.Approved = TRUE
						AND u.Active = TRUE
						AND s.Published = TRUE
						AND s.User_UserId = :UserId 
						AND u.ProfilePrivacyType_PrivacyTypeId = 1	
						GROUP BY s.StoryId	
						ORDER BY totalRecommends DESC
						LIMIT :start,:howmany";

			$start = $this-> getStartValue($howMany, $page);			

			$stories = $this->fetchIntoClass($statement, array(":UserId" => $userID, ":UserId2" => $userID, ":start" => $start, ":howmany" => $howMany), "shared/StoryViewModel");

			return $stories;
		}
		catch(Exception $e) 
		{
			throw $ex;
		}
	}

	public function getStoriesPublished_Public_Private($userID, $howMany = MAX_STORIES_LISTS, $page = self::PAGE)
	{
		try
		{
			//Accepts a user id
			//Gets an array of stories written by the owner of this user id
			//Returns an array of Story class

			$statement = "SELECT
						s.StoryId, s.User_UserId AS UserId, s.StoryTitle, s.Content, s.DatePosted, 

						urs.Opinion, shp.PictureId, p.PictureId, u.Active, u.FirstName, u.LastName,

						f.Active AS FollowingUser,

						up.PictureId as UserProfilePicureId,

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

							INNER JOIN user
							ON (user.UserId = user_recommend_story.User_UserId) AND (user.Active = TRUE) AND (user.ProfilePrivacyType_PrivacyTypeId = 1)

							WHERE user_recommend_story.Story_StoryId = s.StoryId
						    AND user_recommend_story.Active = TRUE
						    AND user_recommend_story.Opinion = TRUE
						) AS totalRecommends,

						(
							SELECT COUNT(1)
							FROM comment c
							WHERE c.Story_StoryId = s.StoryId
						    AND c.Active = TRUE
						    AND c.PublishFlag = TRUE
						) AS totalComments
						 
						FROM story s

						INNER JOIN user u
						ON (u.UserId = s.User_UserId) AND (u.Active = TRUE)
						LEFT JOIN admin_approve_story aps
						ON (aps.Story_StoryId = s.StoryId) AND (aps.Active = TRUE)

						LEFT JOIN user_recommend_story urs
						ON (urs.Story_StoryId = s.StoryId) AND (urs.Active = TRUE)

						LEFT JOIN story_has_picture shp
						ON (shp.Story_StoryId = s.StoryId) AND (shp.Active = TRUE)
						LEFT JOIN picture p
						ON (p.PictureId = shp.PictureId) AND (p.Active = TRUE)

						LEFT JOIN following f
						ON (f.User_FollowerId = s.User_UserId) AND (f.User_UserId = :UserId2) AND (f.Active = TRUE)

						LEFT JOIN picture up
						ON (up.User_UserId = s.User_UserId) AND (up.Active = TRUE) AND (up.Picturetype_PictureTypeId = 1)

						WHERE s.Active = TRUE
						AND aps.Active = TRUE
						AND aps.Approved = TRUE
						AND u.Active = TRUE
						AND s.Published = TRUE
						AND s.User_UserId = :UserId 	
						GROUP BY s.StoryId	
						ORDER BY totalRecommends DESC
						LIMIT :start,:howmany";

			$start = $this-> getStartValue($howMany, $page);			

			$stories = $this->fetchIntoClass($statement, array(":UserId" => $userID, ":UserId2" => $userID, ":start" => $start, ":howmany" => $howMany), "shared/StoryViewModel");

			return $stories;
		}
		catch(Exception $e) 
		{
			throw $ex;
		}
	}

	public function getStoriesRecommendedByFriends_MostPopular($userID, $howMany = MAX_STORIES_LISTS, $page = self::PAGE)
	{
		try
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
		catch(Exception $e) 
		{
			throw $ex;
		}
	}

	public function getStoriesRecommendedByFriends_Latest($userID, $howMany = MAX_STORIES_LISTS, $page = self::PAGE)
	{
		try
		{
			//Accepts a user id
			//Gets an array of stories that were recommended to the owner of this user id
			//Returns an array of Story class
			
			$statement = "SELECT
							s.StoryId, s.User_UserId AS UserId, s.StoryTitle, s.Content, s.DatePosted, 

							urs.Opinion, shp.PictureId, p.PictureId, u.Active, u.FirstName, u.LastName,

							f.Active AS FollowingUser,

							up.PictureId as UserProfilePicureId,

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

								INNER JOIN user
								ON (user.UserId = user_recommend_story.User_UserId) AND (user.Active = TRUE) AND (user.ProfilePrivacyType_PrivacyTypeId = 1)

								WHERE user_recommend_story.Story_StoryId = s.StoryId
							    AND user_recommend_story.Active = TRUE
							    AND user_recommend_story.Opinion = TRUE
							) AS totalRecommends,

							(
								SELECT COUNT(1)
								FROM comment c
								WHERE c.Story_StoryId = s.StoryId
							    AND c.Active = TRUE
							    AND c.PublishFlag = TRUE
							) AS totalComments
							

							FROM story s

							INNER JOIN user u
							ON (u.UserId = s.User_UserId) AND (u.Active = TRUE)
							LEFT JOIN admin_approve_story aps
							ON (aps.Story_StoryId = s.StoryId) AND (aps.Active = TRUE)

							LEFT JOIN user_recommend_story urs
							ON (urs.Story_StoryId = s.StoryId) AND (urs.User_UserId = :UserId) AND (urs.Active = TRUE)

							LEFT JOIN story_has_picture shp
							ON (shp.Story_StoryId = s.StoryId) AND (shp.Active = TRUE)
							LEFT JOIN picture p
							ON (p.PictureId = shp.PictureId) AND (p.Active = TRUE)

							LEFT JOIN following f
							ON (f.User_FollowerId = s.User_UserId) AND (f.Active = TRUE)

							LEFT JOIN picture up
							ON (up.User_UserId = s.User_UserId) AND (up.Active = TRUE) AND (up.Picturetype_PictureTypeId = 1)

							WHERE
							(
								SELECT DISTINCT user_recommend_story.Opinion 
								FROM user_recommend_story 
								
								INNER JOIN user
								ON (user.UserId = user_recommend_story.User_UserId) AND (user.Active = TRUE) AND (user.ProfilePrivacyType_PrivacyTypeId = 1)

								INNER JOIN following
								ON (following.User_FollowerId = user_recommend_story.User_UserId) AND (following.User_UserId = :UserId2) AND (following.Active = TRUE)

								WHERE user_recommend_story.Story_StoryId = s.StoryId 
								AND user_recommend_story.Opinion = TRUE
								AND user_recommend_story.Active = TRUE
							)

							
							AND StoryPrivacyType_StoryPrivacyTypeId = 1
							AND s.Active = TRUE
							AND aps.Active = TRUE
							AND aps.Approved = TRUE
							AND u.Active = TRUE
							AND s.Published = TRUE						
							
							AND u.ProfilePrivacyType_PrivacyTypeId = 1	
							GROUP BY s.StoryId
							
							LIMIT :start, :howmany";

			$start = $this-> getStartValue($howMany, $page);

			$stories = $this->fetchIntoClass($statement, array(":UserId" => $userID, ":UserId2" => $userID, ":start" => $start, ":howmany" => $howMany), "shared/StoryViewModel");

			return $stories;
		}
		catch(Exception $e) 
		{
			throw $ex;
		}
	}

	public function getNewsFeed($userID, $howMany = MAX_STORIES_LISTS, $page = self::PAGE)
	{
		try
		{
			//Accepts a user id
			//Gets an array of stories that were recommended to the owner of this user id
			//Returns an array of Story class
			
			$statement = "SELECT
							s.StoryId, s.User_UserId AS UserId, s.StoryTitle, s.Content, s.DatePosted, 

							urs.Opinion, shp.PictureId, p.PictureId, u.Active, u.FirstName, u.LastName,

							f.Active AS FollowingUser,

							up.PictureId as UserProfilePicureId,

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

								INNER JOIN user
								ON (user.UserId = user_recommend_story.User_UserId) AND (user.Active = TRUE) AND (user.ProfilePrivacyType_PrivacyTypeId = 1)

								WHERE user_recommend_story.Story_StoryId = s.StoryId
							    AND user_recommend_story.Active = TRUE
							    AND user_recommend_story.Opinion = TRUE
							) AS totalRecommends,

							(
								SELECT COUNT(1)
								FROM comment c
								WHERE c.Story_StoryId = s.StoryId
							    AND c.Active = TRUE
							    AND c.PublishFlag = TRUE
							) AS totalComments
							

							FROM story s

							INNER JOIN user u
							ON (u.UserId = s.User_UserId) AND (u.Active = TRUE)
							LEFT JOIN admin_approve_story aps
							ON (aps.Story_StoryId = s.StoryId) AND (aps.Active = TRUE)

							LEFT JOIN user_recommend_story urs
							ON (urs.Story_StoryId = s.StoryId) AND (urs.User_UserId = :UserId) AND (urs.Active = TRUE)

							LEFT JOIN story_has_picture shp
							ON (shp.Story_StoryId = s.StoryId) AND (shp.Active = TRUE)
							LEFT JOIN picture p
							ON (p.PictureId = shp.PictureId) AND (p.Active = TRUE)

							LEFT JOIN following f
							ON (f.User_FollowerId = s.User_UserId) AND (f.Active = TRUE)

							LEFT JOIN picture up
							ON (up.User_UserId = s.User_UserId) AND (up.Active = TRUE) AND (up.Picturetype_PictureTypeId = 1)

							WHERE
							(
								SELECT DISTINCT user_recommend_story.Opinion 
								FROM user_recommend_story 
								
								INNER JOIN user
								ON (user.UserId = user_recommend_story.User_UserId) AND (user.Active = TRUE) AND (user.ProfilePrivacyType_PrivacyTypeId = 1)

								INNER JOIN following
								ON (following.User_FollowerId = user_recommend_story.User_UserId) AND (following.User_UserId = :UserId2) AND (following.Active = TRUE)

								WHERE user_recommend_story.Story_StoryId = s.StoryId 
								AND user_recommend_story.Opinion = TRUE
								AND user_recommend_story.Active = TRUE
							)

							
							AND StoryPrivacyType_StoryPrivacyTypeId = 1
							AND s.Active = TRUE
							AND aps.Active = TRUE
							AND aps.Approved = TRUE
							AND u.Active = TRUE
							AND s.Published = TRUE						
							
							AND u.ProfilePrivacyType_PrivacyTypeId = 1	
							GROUP BY s.StoryId
							
							LIMIT :start, :howmany";

			$start = $this-> getStartValue($howMany, $page);

			$stories = $this->fetchIntoClass($statement, array(":UserId" => $userID, ":UserId2" => $userID, ":start" => $start, ":howmany" => $howMany), "shared/StoryViewModel");

			return $stories;
		}
		catch(Exception $e) 
		{
			throw $ex;
		}
	}

	public function getStoriesRecommendedByCurrentUser($userID, $howMany = MAX_STORIES_LISTS, $page = self::PAGE)
	{
		try
		{
			//Accepts a user id
			//Gets an array of stories that were recommended to the owner of this user id
			//Returns an array of Story class

			$statement = "SELECT
						s.StoryId, s.User_UserId AS UserId, s.StoryTitle, s.Content, s.DatePosted, 

						urs.Opinion, shp.PictureId, p.PictureId, u.Active, u.FirstName, u.LastName,

						f.Active AS FollowingUser,

						up.PictureId as UserProfilePicureId,

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

							INNER JOIN user
							ON (user.UserId = user_recommend_story.User_UserId) AND (user.Active = TRUE) AND (user.ProfilePrivacyType_PrivacyTypeId = 1)

							WHERE user_recommend_story.Story_StoryId = s.StoryId
						    AND user_recommend_story.Active = TRUE
						    AND user_recommend_story.Opinion = TRUE
						) AS totalRecommends,

						(
							SELECT COUNT(1)
							FROM comment c
							WHERE c.Story_StoryId = s.StoryId
						    AND c.Active = TRUE
						    AND c.PublishFlag = TRUE
						) AS totalComments
						 
						FROM story s

						INNER JOIN user u
						ON (u.UserId = s.User_UserId) AND (u.Active = TRUE)
						LEFT JOIN admin_approve_story aps
						ON (aps.Story_StoryId = s.StoryId) AND (aps.Active = TRUE)

						LEFT JOIN user_recommend_story urs
						ON (urs.Story_StoryId = s.StoryId) AND (urs.Active = TRUE) AND (urs.User_UserId = :UserId)

						LEFT JOIN story_has_picture shp
						ON (shp.Story_StoryId = s.StoryId) AND (shp.Active = TRUE)
						LEFT JOIN picture p
						ON (p.PictureId = shp.PictureId) AND (p.Active = TRUE)

						LEFT JOIN following f
						ON (f.User_FollowerId = s.User_UserId) AND (f.Active = TRUE)

						LEFT JOIN picture up
						ON (up.User_UserId = s.User_UserId) AND (up.Active = TRUE) AND (up.Picturetype_PictureTypeId = 1)

						WHERE StoryPrivacyType_StoryPrivacyTypeId = 1
						AND s.Active = TRUE
						AND aps.Active = TRUE
						AND aps.Approved = TRUE
						AND u.Active = TRUE
						AND s.Published = TRUE
						AND urs.Opinion = TRUE
						AND urs.Active = TRUE
						AND u.ProfilePrivacyType_PrivacyTypeId = 1		
						GROUP BY s.StoryId
						ORDER BY totalRecommends DESC
						LIMIT :start,:howmany";

			$start = $this-> getStartValue($howMany, $page);

			$stories = $this->fetchIntoClass($statement, array(":UserId" => $userID, ":start" => $start, ":howmany" => $howMany), "shared/StoryViewModel");

			return $stories;
		}
		catch(Exception $e) 
		{
			throw $ex;
		}
	}

	// Tested getStoryListMostRecommended(6,1)
	public function getStoryListMostRecommended($userid, $howMany = MAX_STORIES_LISTS, $page = self::PAGE)
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

		try
		{
			$statement = "SELECT
						s.StoryId, s.User_UserId AS UserId, s.StoryTitle, s.Content, s.DatePosted, 

						urs.Opinion, shp.PictureId, p.PictureId, u.Active, u.FirstName, u.LastName,

						f.Active AS FollowingUser,

						up.PictureId as UserProfilePicureId,

						(
							SELECT COUNT(1)
							FROM user_recommend_story 

							INNER JOIN user
							ON (user.UserId = user_recommend_story.User_UserId) AND (user.Active = TRUE) AND (user.ProfilePrivacyType_PrivacyTypeId = 1)

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
						    AND c.PublishFlag = TRUE
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

						LEFT JOIN following f
						ON (f.User_FollowerId = s.User_UserId) AND (f.Active = TRUE)

						LEFT JOIN picture up
						ON (up.User_UserId = s.User_UserId) AND (up.Active = TRUE) AND (up.Picturetype_PictureTypeId = 1)

						WHERE StoryPrivacyType_StoryPrivacyTypeId = 1
						AND s.Active = TRUE
						AND aps.Active = TRUE
						AND aps.Approved = TRUE
						AND u.Active = TRUE
						AND s.Published = TRUE
						AND u.ProfilePrivacyType_PrivacyTypeId = 1	
						GROUP BY s.StoryId	
						ORDER BY totalRecommends DESC
						LIMIT :start,:howmany";


			$start = $this-> getStartValue($howMany, $page);

			$stories = $this->fetchIntoClass($statement, array(":start" => $start, ":howmany" => $howMany, ":userid" => $userid), "shared/StoryViewModel");

			return $stories;
		}
		catch(Exception $e) 
		{
			throw $ex;
		}
	}

	//Tested getStoryListNewest(1,5,1)
	public function getStoryListNewest($userid, $howMany = MAX_STORIES_LISTS, $page = self::PAGE)
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
					s.StoryId, s.User_UserId AS UserId, s.StoryTitle, s.Content, s.DatePosted, 

					urs.Opinion, shp.PictureId, p.PictureId, u.Active, u.FirstName, u.LastName,

					f.Active AS FollowingUser,

					up.PictureId as UserProfilePicureId,
					
					(
						SELECT COUNT(1)
						FROM user_recommend_story 

						INNER JOIN user
						ON (user.UserId = user_recommend_story.User_UserId) AND (user.Active = TRUE) AND (user.ProfilePrivacyType_PrivacyTypeId = 1)

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
					    AND c.PublishFlag = TRUE
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

					LEFT JOIN following f
					ON (f.User_FollowerId = s.User_UserId) AND (f.Active = TRUE)

					LEFT JOIN picture up
					ON (up.User_UserId = s.User_UserId) AND (up.Active = TRUE) AND (up.Picturetype_PictureTypeId = 1)

					WHERE StoryPrivacyType_StoryPrivacyTypeId = 1
					AND s.Active = TRUE
					AND u.ProfilePrivacyType_PrivacyTypeId = 1
					AND aps.Active = TRUE
					AND aps.Approved = TRUE
					AND u.Active = TRUE
					GROUP BY s.StoryId		
					ORDER BY s.DatePosted DESC
					LIMIT :start,:howmany";

			$start = $this-> getStartValue($howMany, $page);
 
			$parameters = array(":start" => $start, ":howmany" => $howMany, ":userid" => $userid);

			$story = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

			return $story;
		}
		catch(Exception $e) 
		{
			throw $ex;
		}
	}


	public function getTotalCommentsApproved($userID)
	{
		try
		{
			$statement = "SELECT count(*)
							FROM comment c 
							WHERE c.User_UserId = :UserId
							AND c.PublishFlag = TRUE";

			$totalComments = $this->fetchNum($statement, array(":UserId" => $userID));

			return $totalComments;
		}
		catch(Exception $e) 
		{
			throw $ex;
		}
	}

	public function getTotalCommentsPending($userID)
	{
		try
		{
			$statement = "SELECT count(*)
							FROM comment c 
							WHERE c.User_UserId = :UserId
							AND c.PublishFlag = FALSE";

			$totalComments = $this->fetchNum($statement, array(":UserId" => $userID));

			return $totalComments;
		}
		catch(Exception $e) 
		{
			throw $ex;
		}
	}

	//This doesn't work related the story FK
	public function addCommentToStory($comment, $storyID, $userID)
	{
		//Accepts a comment class
		//inserts a new comment with the published flag set to false
		//returns bool if the comment was saved succesfully
		try
		{
			$statement = "INSERT INTO comment (Story_StoryId, User_UserId, Content, DateCreated) 
							VALUES(:storyID, :userID, :comment, :DateCreated)";

			$parameters = array(":storyID" => $storyID, ":userID" => $userID, ":comment" => $comment, ":DateCreated" => $this->getDateNow());

			return $this->fetch($statement, $parameters);
		}
		catch(Exception $e) 
		{
			throw $ex;
		}
	}

	public function flagCommentAsInapropriate($commentID, $userID, $flag)
	{
		//Accepts a commentID, a userID, and a bool for if it was thought to be inapropriate
		//checks to see if user already marked it as inapropriate
		//returns bool if saved correctly
		try
		{
			$statement = "INSERT INTO user_inappropriateflag_comment (User_UserId, Comment_CommentId, DateCreated) 
						  VALUES(:UserId, :CommentID, :DateCreated)
						  ON DUPLICATE KEY
						  	UPDATE Active = :Active";

			$parameters = array(":UserId" => $userID, ":CommentID" => $commentID, ":DateCreated" => $this->getDateNow(), ":Active" => $flag);

			return $this->fetch($statement, $parameters);	
		}
		catch(Exception $e) 
		{
			throw $ex;
		}
	}

	public function getCommentsForStory($userID, $storyID, $howMany = MAX_STORIES_LISTS, $page = self::PAGE)
	{
		//Accepts a story id, how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Checks if user has makrked comment as inappropriate (add this to comment viewmodel class)
		//Gets a list of comments related to a story
		//The comments published flag must be true
		//returns an array of comment class related to a story

		try
		{
			$statement = "SELECT c.*, 

							u.FirstName, u.LastName, u.ProfilePrivacyType_PrivacyTypeId, u.Active as IsUserActive,
							arc.Rejected as IsAdminRejected,
							p.PictureId,
							uic.Active as IsFlagged

							FROM comment c

							LEFT JOIN user u
							ON u.UserId = c.User_UserId

							LEFT JOIN picture p
							ON c.User_UserId = p.User_UserId AND (p.Active = TRUE) AND (p.Picturetype_PictureTypeId = 1)
							
							LEFT JOIN admin_reject_comment arc
							ON arc.Comment_CommentId = c.CommentId AND arc.Active = TRUE

							LEFT JOIN user_inappropriateflag_comment uic
							ON uic.Comment_CommentId = c.CommentId AND uic.User_UserId = :UserId AND uic.Active = TRUE

							WHERE Story_StoryId = :storyID 
							AND c.Active = TRUE
							AND c.PublishFlag
							GROUP BY CommentId
							ORDER BY CommentId 							
							ASC LIMIT :start, :howmany";

			$start = $this-> getStartValue($howMany, $page);

			$comments = $this->fetchIntoClass($statement, array(":storyID" => $storyID, ":start" => $start, ":howmany" => $howMany, ":UserId" => $userID), "shared/CommentViewModel");

			return $comments;
		}
		catch(Exception $e) 
		{
			throw $ex;
		}
	}

	public function getCommentListInappropriate($adminID, $howMany = MAX_STORIES_LISTS, $page = self::PAGE)
	{
		//Accepts how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Checks if user has makrked comment as inappropriate (add this to comment viewmodel class)
		//Gets a list of comments related to a story
		//The comments published flag must be true
		//returns an array of comment class related to a story
		try
		{

			$statement = "SELECT * FROM comment WHERE PublishFlag = 1 AND CommentId IN ";

			$statement .= "(SELECT DISTINCT Comment_CommentId FROM user_inappropriateflag_comment) ORDER BY CommentId LIMIT ?, ?";

			$start = $this-> getStartValue($howMany, $page);

			$comment = $this->fetchIntoClass($statement, array($start, $howMany), "shared/CommentViewModel");

			return $comment;
		}
		catch(Exception $e) 
		{
			throw $ex;
		}
	}

	public function getCommentListRejected($adminID, $howMany = MAX_STORIES_LISTS, $page = self::PAGE)
	{
		//Accepts how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Checks if user has makrked comment as inappropriate (add this to comment viewmodel class)
		//Gets a list of comments related to a story
		//The comments published flag must be true
		//returns an array of comment class related to a story
	}

	public function getUnpublisedComments($userID, $howMany = MAX_STORIES_LISTS, $page = self::PAGE)
	{
		//Accepts a user id
		//Gets a list of comments that haven't been published by a user
		//The comments published flag must be flase
		//returns an array of comment class that haven't been published yet
		
		try
		{
			$statement = "SELECT c.*,

							up.PictureId as UserProfilePicureId, up.User_UserId as commenterUserId,

							u.FirstName, u.LastName,

							s.StoryTitle

							FROM comment c

							LEFT JOIN picture up
							ON (up.User_UserId = c.User_UserId) AND (up.Active = TRUE) AND (Picturetype_PictureTypeId = 1)

							LEFT JOIN user u
							ON (u.UserId = c.User_UserId) AND (u.Active = TRUE)

							LEFT JOIN story s
							ON (s.StoryId = c.Story_StoryId)

							WHERE s.User_UserId = :userID 
							AND c.PublishFlag = 0 
							AND c.Active = TRUE
							AND u.Active = TRUE
							ORDER BY c.CommentId
							LIMIT :start, :howmany";

			$start = $this-> getStartValue($howMany, $page);

			$comment = $this->fetchIntoClass($statement, array(":userID" => $userID, ":start" => $start, ":howmany" => $howMany), "shared/CommentViewModel");

			return $comment;
		}
		catch(Exception $e) 
		{
			throw $ex;
		}
	}

	public function approveComment($userID, $commentID)
	{
		//Accepts a commentID, a userID, and a bool for if it was thought to be inapropriate
		//checks to see if user already marked it as inapropriate
		//returns bool if saved correctly
		try
		{
			$statement = "UPDATE comment c
							
							LEFT JOIN story s
							ON (s.StoryId = c.Story_StoryId)
							
							SET c.Active=TRUE, c.PublishFlag=TRUE 

							WHERE s.User_UserId = :UserId
							AND c.CommentId = :CommentID";

			$parameters = array(":UserId" => $userID, ":CommentID" => $commentID);

			return $this->fetch($statement, $parameters);	
		}
		catch(Exception $e) 
		{
			throw $ex;
		}
	}

	public function changeStoryPrivacy($userID, $storyID, $privacyTypeID)
	{
		//Accepts a commentID, a userID, and a bool for if it was thought to be inapropriate
		//checks to see if user already marked it as inapropriate
		//returns bool if saved correctly
		try
		{
			$statement = "UPDATE story s
							
							SET s.StoryPrivacyType_StoryPrivacyTypeId=:PrivacyTypeID

							WHERE s.User_UserId = :UserId
							AND s.StoryId = :StoryID";

			$parameters = array(":UserId" => $userID, ":StoryID" => $storyID, ":PrivacyTypeID" => $privacyTypeID);

			return $this->fetch($statement, $parameters);	
		}
		catch(Exception $e) 
		{
			throw $ex;
		}
	}


	public function rejectComment($userID, $commentID)
	{
		//Accepts a commentID, a userID, and a bool for if it was thought to be inapropriate
		//checks to see if user already marked it as inapropriate
		//returns bool if saved correctly
		try
		{
			$statement = "UPDATE comment c
							
							LEFT JOIN story s
							ON (s.StoryId = c.Story_StoryId)
							
							SET c.Active=FALSE, c.PublishFlag=FALSE 

							WHERE s.User_UserId = :UserId
							AND c.CommentId = :CommentID";

			$parameters = array(":UserId" => $userID, ":CommentID" => $commentID);

			return $this->fetch($statement, $parameters);	
		}
		catch(Exception $e) 
		{
			throw $ex;
		}
	}

	public function searchTags($query, $howMany = MAX_STORIES_LISTS, $page = self::PAGE)
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
		catch(Exception $e) 
		{
			throw $ex;
		}
	}

	public function checkTagExists($tag)
	{
		try
		{
			$statement = "SELECT t.TagId
							FROM tag t 
							WHERE t.Tag = :Tag
							LIMIT 1";

			$result = $this->fetchIntoObject($statement, array(":Tag" => $tag));
			
			if(isset($result[0]))
			{
				$tag = $result[0]->TagId;
			}

			return $tag;
		}
		catch(Exception $e) 
		{
			throw $ex;
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
		catch(Exception $e) 
		{
			throw $ex;
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
		catch(Exception $e) 
		{
			throw $ex;
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
		catch(Exception $e) 
		{
			throw $ex;
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
		catch(Exception $e) 
		{
			throw $ex;
		}
	}

	public function getTagsForStory($storyID)
	{
		try
		{
			$statement = "SELECT t.*,
							
							t.Tag as text, t.TagId as id

							FROM tag t
							INNER JOIN story_has_tag sht
							ON sht.Tag_TagId = t.TagId
							WHERE t.Active = TRUE
							AND sht.Story_StoryId = :storyID
							AND sht.Active = TRUE";

			$result = $this->fetchIntoObject($statement, array(":storyID" => $storyID));

			return $result;
		}
		catch(Exception $e) 
		{
			throw $ex;
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

			// for ($i=0; $i < count($jsonFormat); $i++) { 
			// 	$jsonFormat[$i][1] = (($jsonFormat[$i][1] / $totalValue) * 100);

			// 	if($jsonFormat[$i][1] > 10)
			// 	{}
			// }

			return $jsonFormat;
		}
		catch(Exception $e) 
		{
			throw $ex;
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
		catch(Exception $e) 
		{
			throw $ex;
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
		catch(Exception $e) 
		{
			throw $ex;
		}
	}

	public function getTopChallenges($howMany = MAX_STORIES_LISTS, $page = self::PAGE)
	{
		try
		{
			$statement = "SELECT a.*,
							(
							    SELECT COUNT(1)
							    FROM story_has_answer_for_question saq

							    LEFT JOIN story s
								ON (saq.Story_StoryId = s.StoryId)
								LEFT JOIN user u
								ON (u.UserId = s.User_UserId)
								LEFT JOIN admin_approve_story aps
								ON (aps.Story_StoryId = s.StoryId)

							    WHERE saq.Active = TRUE
							    AND saq.Answer_for_Question_Answer_AnswerId = a.AnswerId
							    AND saq.Answer_for_Question_Question_QuestionId = 2
							    AND s.Active = TRUE
							    AND s.Published = TRUE
							    AND u.Active = TRUE
							    AND aps.Active = TRUE
							    AND aps.Approved = TRUE

							)as count
							FROM answer a
							HAVING count > 0 
							LIMIT :start, :howmany";

			$start = $this-> getStartValue($howMany, $page);

			$result = $this->fetchIntoObject($statement, array(":start" => $start, ":howmany" => $howMany));

			return $result;
		}
		catch(Exception $e) 
		{
			throw $ex;
		}
	}

}

?>
