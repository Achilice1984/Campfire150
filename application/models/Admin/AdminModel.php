<?php
	require_once(APP_DIR .'helpers/storysearch.php');

class AdminModel extends Model {

	public function isAdmin($userID)
	{
		//Check if the ID is an admin ID

		try
		{
			$statement = "SELECT * FROM user 
							WHERE userID = :ID AND AdminFlag = 1";

			$rowCount = $this->fetchRowCount($statement, array("ID" => $userID));

			if($rowCount >= 1)
				return true;
			else
				return false;
		}
		catch(PDOException $e)
		{ 
			return $e->getMessage();
		}
	}

	public function searchStoriesPendingApproval($storySearch, $adminID, $howMany = self::HOWMANY, $page = self::PAGE)
	{
		//Accepts string to search for a story
		//Checks if user has marked story as inappropriate and if user has recommended story (add these to story viewmodel class)
		//returns an array of Story class that relate to the search string

		try 
		{
			$searchObject = new StorySearch();
			$story = $searchObject->SearchQuery($storySearch, $userID, $howMany, $page, $approved = FALSE, $active = TRUE); 

			return $story;
		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function searchStoriesRejected($storySearch, $userID, $howMany = self::HOWMANY, $page = self::PAGE)
	{
		//Accepts string to search for a story
		//Checks if user has makrked story as inappropriate and if user has recommended story (add these to story viewmodel class)
		//returns an array of Story class that relate to the search string

		try 
		{
			$searchObject = new StorySearch();

			$story = $searchObject->SearchQuery($storySearch, $userID, $howMany, $page, $approved = FALSE, $active = TRUE); 

			return $story;
		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}	
	}

	public function getStory($storyID)
	{
		try
		{
			$statement = "SELECT *
							FROM story s
							LEFT JOIN user u
							ON s.User_UserId = u.UserId
							WHERE storyID = :StoryID";

			$parameters = array(":StoryID" => $storyID);

			$storyList = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

			return $storyList;

		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	public function getStoryListPendingApproval($howMany = self::HOWMANY, $page = self::PAGE)
	{
		//Accepts how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of stories that a user has submited but hasn't been apprved yet.
		//Should not contain any published stories
		//returns an array of Story class

		try
		{
			$statement = "SELECT *, 
								(SELECT COUNT(*) FROM story WHERE storyID 
									NOT IN (SELECT Story_StoryId FROM admin_approve_story)
									) AS totalStories
							FROM story s
							INNER JOIN user u
							ON s.User_UserId = u.UserId
							WHERE storyID 
							NOT IN (SELECT Story_StoryId FROM admin_approve_story) 
							LIMIT :Start, :HowMany";

			$start = $this->getStartValue($howMany, $page);

			$parameters = array(
				":Start"=>$start, 
				":HowMany"=>$howMany
				);

			$storyList = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

			return $storyList;

		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}		
	}

	public function getStoryListRejected($howMany = self::HOWMANY, $page = self::PAGE)
	{
		//Accepts how many, page
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of stories that have been rejected by admin
		//Should not contain any published stories
		//Should have the admin user details an reason for being rejected
		//returns an array of Story class

		try
		{
			$statement = "SELECT *,
								(SELECT COUNT(*) FROM story s LEFT JOIN admin_approve_story aas ON s.storyID=aas.Story_StoryId 
									INNER JOIN user u ON s.User_UserId = u.UserId WHERE aas.Approved = 0) AS totalStories
							FROM story s 
							LEFT JOIN admin_approve_story aas 
							ON s.storyID=aas.Story_StoryId 
							INNER JOIN user u 
							ON s.User_UserId = u.UserId 
							WHERE aas.Approved = 0 
							LIMIT :Start, :HowMany";

			$start = $this->getStartValue($howMany, $page);

			$parameters = array(
				":Start"=>$start, 
				":HowMany"=>$howMany
				);

			$storyList = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

			return $storyList;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	public function getStoryListFlaggedInappropriate($howMany = self::HOWMANY, $page = self::PAGE)
	{
		//Accepts how many, page
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of stories that have been marked as inappropriate by users
		//Order the list by how many inappropriate flags there are
		//returns an array of Story class

		try
		{
			$start = $this->getStartValue($howMany, $page);

			$statement = "SELECT *, COUNT(urs.User_UserId) AS NumberOfFlagged,
								(SELECT COUNT(*) FROM (SELECT StoryId
									FROM story s
									INNER JOIN user_recommend_story u ON StoryID = Story_StoryId
									WHERE Opinion =0
									GROUP BY StoryID) tmptable
								) AS totalStories
							FROM story s 
							INNER JOIN user_recommend_story urs 
							ON s.StoryID=urs.Story_StoryId 
							LEFT JOIN user u 
							ON s.User_UserId=u.UserId 
							WHERE urs.Opinion = 0 
							GROUP BY s.StoryID 
							ORDER BY NumberOfFlagged DESC 
							LIMIT :Start, :HowMany";

			$parameters = array(
				":Start"=>$start, 
				":HowMany"=>$howMany
				);

			$storyList = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

			return $storyList;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}		
	}

	public function rejectStory($adminID, $storyID, $reason)
	{
		//Accepts the adminID, the story id and the reason why it was rejected
		//returns bool whether it was saved succesfully or not

		try
		{
			$this->fetch(
				"UPDATE admin_approve_story 
				SET Active = 0
			 	WHERE Story_StoryId = :StoryID AND Active = 1", 
			 	array(":StoryID"=>$storyID)
			 	);//Set the active record for the story to deactive;

			$statement = "INSERT INTO admin_approve_story (User_UserId, Story_StoryId, Reason, Approved)
			  				VALUES(:AdminID, :StoryID, :Reason, FALSE)
							ON DUPLICATE KEY
							UPDATE Reason=:NewReason, Approved=0, Active=1";

			$parameters = array(
					":AdminID" => $adminID,
					":StoryID" => $storyID,
					":Reason" => $reason,
					":NewReason" => $reason
					);

			return $this->fetch($statement, $parameters);
		}
		catch(PDOException $e)
		{
			return $e->getMessage();			
		}
	}

	public function approveStory($adminID, $storyID, $reason)
	{
		//Accepts the adminID and the story id
		//returns bool whether it was saved succesfully or not
		
		try
		{
			$this->fetch(
				"UPDATE admin_approve_story SET Active = 0 WHERE Story_StoryId = :StoryID AND Active = 1", 
				array(":StoryID"=>$storyID)
				);//Set the active record for the story to deactive;

			$statement = "SELECT *  
							FROM admin_approve_story 
							WHERE User_UserId = :UserID AND Story_StoryId = :StoryID";

			$rowCount = $this->fetchRowCount($statement, array(":UserID"=>$adminID, ":StoryID"=>$storyID));
			
			if($rowCount <= 0)
			{
				$statement2 = "INSERT INTO admin_approve_story 
								VALUES(:AdminID, :StoryID, :Reason, NULL, NULL, 1)";

				$parameters = array(
					":AdminID" => $adminID, 
					":StoryID" => $storyID, 
					":Reason" => $reason);

				return $this->fetch($statement2, $parameters);
			}
			else
			{
				$statement2 = "UPDATE admin_approve_story 
								SET Reason = :Reason, Active = 1, Approved = 1  ";
				$statement2 .= "WHERE User_UserId = :AdminID AND Story_StoryId = :StoryID";

				$parameters = array(
					":Reason" => $reason, 
					":StoryID" => $storyID, 
					":AdminID" => $adminID
					);

				return $this->fetch($statement2, $parameters);	
			}
		}
		catch(PDOException $e)
		{

			return $e->getMessage();

		}
	}

// Is this function necessary?
	public function changeRejectedToApproved($adminID, $storyID, $reason)
	{
		//Accepts the adminID and the story id
		//Change a rejected story to an approved story
		//returns bool whether it was saved succesfully or not

		try
		{
			$this->fetch(
				"UPDATE admin_approve_story SET Active = 0 WHERE storyID = :StoryID AND Active = 1", 
				array(":StoryID" => $storyID)
				);

			$statement = "INSERT INTO admin_approve_story (User_UserId, Story_StoryId, Reason, Approved)
				VALUES(:AdminID, :StoryID, :Reason, 1) 
				ON DUPLICATE KEY 
					UPDATE Reason = :NewReason, Approved = 1, Active = 1";

			$parameters = array(
					":Reason" => $reason, 
					":StoryID" => $storyID, 
					":AdminID" => $adminID,
					":NewReason" => $reason
					);

			return $this->fetch($statement, $parameters);
		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}
	}

// Is this function necessary?
	public function changeApprovedToRejected($adminID, $storyID, $reason)
	{
		//Accepts the adminID, the story id and the reason why it was rejected
		//Change an approved story to a rejected story
		//returns bool whether it was saved succesfully or not

		try
		{
			$this->fetch(
				"UPDATE admin_approve_story SET Active = 0 WHERE storyID = :StoryID AND Active = 1", 
				array(":StoryID" => $storyID)
				);

			$statement = "INSERT INTO admin_approve_story (User_UserId, Story_StoryId, Reason, Approved) 
							VALUES(:AdminID, :StoryID, :Reason, 0)
							ON DUPLICATE KEY 
							UPDATE Reason = :Reason, Approved = 0, Active = 1";

			$parameters = array(
					":Reason" => $reason, 
					":StoryID" => $storyID, 
					":AdminID" => $adminID
					);

			return $this->fetch($statement, $parameters);
		}
		catch(PDOException $e)
		{
			return $e->getMessage();			
		}
	}

	public function getCommentListFlaggedInappropriate($howMany = self::HOWMANY, $page = self::PAGE)
	{
		//Accepts how many, page
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of comments that have been marked as inappropriate by users
		//Order the list by how many inappropriate flags there are
		//returns an array of Comment class
		
		try
		{
			$statement = "SELECT *, COUNT(uic.User_UserId) as NumberOfFlagged, (
								SELECT COUNT( * )
									FROM (
									SELECT COUNT( * )
									FROM user_inappropriateflag_comment
									GROUP BY Comment_CommentId
									)tmpTable
								) AS TotalComments
							FROM comment c 
							INNER JOIN user_inappropriateflag_comment uic 
							ON c.CommentId = uic.Comment_CommentId 
							INNER JOIN story s 
							ON c.Story_StoryId = s.StoryId 
							INNER JOIN user u 
							ON c.User_UserId=u.UserId
							GROUP BY CommentId 
							ORDER BY COUNT(uic.User_UserId) DESC 
							LIMIT :Start, :HowMany";
			
			$start = $this->getStartValue($howMany, $page);
			$parameters = array(
				":Start"=>$start,
				":HowMany"=>$howMany
				);

			$storyList = $this->fetchIntoClass($statement, $parameters, "shared/CommentViewModel");

			return $storyList;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	public function getCommentListRejected($howMany = self::HOWMANY, $page = self::PAGE)
	{
		//Accepts how many, page
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of comments that have been marked as inappropriate by users
		//Order the list by how many inappropriate flags there are
		//returns an array of Comment class
		
		try
		{
			
			
			$statement = "SELECT *, COUNT(uic.User_UserId) as NumberOfFlagged, (
								SELECT COUNT( * )
									FROM (
									SELECT COUNT( * )
									FROM user_inappropriateflag_comment
									GROUP BY Comment_CommentId
									)tmpTable
								) AS TotalComments
							FROM comment c 
							INNER JOIN user_inappropriateflag_comment uic 
							ON c.CommentId = uic.Comment_CommentId 
							INNER JOIN story s 
							ON c.Story_StoryId = s.StoryId 
							INNER JOIN user u 
							ON c.User_UserId=u.UserId
							GROUP BY CommentId 
							ORDER BY COUNT(uic.User_UserId) DESC 
							LIMIT :Start, :HowMany";
			
			$start = $this->getStartValue($howMany, $page);
			$parameters = array(
				":Start"=>$start,
				":HowMany"=>$howMany
				);

			$storyList = $this->fetchIntoClass($statement, $parameters, "shared/CommentViewModel");

			return $storyList;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}


	public function rejectCommentAsAdmin($adminID, $commentID, $reason)
	{
		//Accepts the adminID, the comment id and the reason why it was rejected
		//Allows admin users to hide comments if they feel they are innappropriate
		//returns bool whether it was saved succesfully or not

		try
		{
			$this->fetch(
				"UPDATE admin_reject_comment SET Active = 0 WHERE Active = 1 AND Comment_CommentId = :CommentID", 
				array(':CommentID' => $commentID)
				);

			$statement = "INSERT INTO admin_reject_comment (Comment_CommentId, User_UserId, Rejected, Reason) 
							VALUES (:CommentID, :AdminID, 1, :Reason) 
							ON DUPLICATE KEY 
							UPDATE Reason = :NewReason, Rejected = 1, Active = 1";

			$parameters = array(					 
					":CommentID" => $commentID, 
					":AdminID" => $adminID,
					":Reason" => $reason,
					":NewReason" => $reason
					);

			return $this->fetch($statement, $parameters);
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	public function approveCommentAsAdmin($adminID, $commentID, $reason)
	{
		//Accepts the adminID and the comment id
		//Allows admin users to remove their rejected status placed on comments
		//returns bool whether it was saved succesfully or not

		try
		{
			$this->fetch(
				"UPDATE admin_reject_comment SET Active = 0 WHERE Active = 1 AND Comment_CommentId = :CommentID", 
				array(':CommentID' => $commentID)
				);

			$statement = "INSERT INTO admin_reject_comment (Comment_CommentId, User_UserId, Rejected, Reason) 
							VALUES (:CommentID, :AdminID, 0, :Reason) 
							ON DUPLICATE KEY 
							UPDATE Reason = :NewReason, Rejected = 0, Active = 1";

			$parameters = array(					 
					":CommentID" => $commentID, 
					":AdminID" => $adminID,
					":Reason" => $reason,
					":NewReason" => $reason
					);

			return $this->fetch($statement, $parameters);
		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function getListUsers($howMany = self::HOWMANY, $page = self::PAGE)
	{
		//Accepts how many, page
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of users
		//returns an array of User class

		try
		{
			$statement = "SELECT *,
							(SELECT COUNT(*) FROM user) AS totalUsers
							FROM user
							ORDER BY UserId ASC
							LIMIT :start, :howmany";

			$start = $this-> getStartValue($howMany, $page);

			$parameters = array(
				":start" => $start,
				":howmany" => $howMany
				);

			$userList = $this->fetchIntoClass($statement, $parameters, "shared/UserViewModel");

			return $userList;
		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function deActivateUser($userID, $adminID, $reason)
	{
		//Accepts a User class for $user and a User class for $admin
		//Sets the active flag to false in user profile
		//Uses admin details to say who deactivated the account
		
		try
		{
			$this->fetch(
				"UPDATE admin_actionon_user SET Active = 0 WHERE User_UserId=:UserID AND Active = 1", 
				array('UserID' => $userID)
				);

			$this->fetch(
				"UPDATE user SET Active = 0 WHERE UserId=:UserID", 
				array('UserID' => $userID)
				);

			$statement = "INSERT INTO admin_actionon_user (Admin_UserId, User_UserId, Action, Reason)
							VALUES(:AdminID, :UserID, 0, :Reason)
							ON DUPLICATE KEY 
							UPDATE Action = 0, Active = 1, Reason = :NewReason";

			$parameters = array( 
					":AdminID" => $adminID,
					":UserID" => $userID,
					":Reason" => $reason,
					":NewReason" => $reason
				);

			return $this->fetch($statement, $parameters);
		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}
	}


	public function activateUser($userID, $adminID, $reason)
	{
		//Accepts a User class for $user and a User class for $admin
		//Sets the active flag to false in user profile
		//Uses admin details to say who deactivated the account
		
		try
		{
			$this->fetch(
				"UPDATE admin_actionon_user SET Active = 0 WHERE User_UserId=:UserID AND Active = 1", 
				array('UserID' => $userID)
				);

			$this->fetch(
				"UPDATE user SET Active = 1 WHERE UserId=:UserID", 
				array('UserID' => $userID)
				);

			$statement = "INSERT INTO admin_actionon_user (Admin_UserId, User_UserId, Action, Reason) 
							VALUES(:AdminID, :UserID, 1, :Reason)
							ON DUPLICATE KEY 
							UPDATE Action = 1, Active = 1, Reason = :NewReason";

			$parameters = array( 
					":AdminID" => $adminID,
					":UserID" => $userID,
					":Reason" => $reason,
					":NewReason" => $reason
				);

			return $this->fetch($statement, $parameters);
		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function getListUsersDisabled($howMany = self::HOWMANY, $page = self::PAGE)
	{
		//Accepts how many, page
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of users that have been disabled with reason
		//returns an array of User class

		try
		{
			$statement = "SELECT * ,
								(SELECT COUNT(*) FROM user WHERE Active = 0) AS totalUsers
							FROM user 
							WHERE Active = 0 
							ORDER BY UserId ASC 
							LIMIT :Start, :HowMany";

			$start = $this->getStartValue($howMany, $page);

			$parameters = array( 
					":Start" => $start,
					":HowMany" => $howMany
				);

			$userList = $this->fetchIntoClass($statement, $parameters, "shared/UserViewModel");

			return $userList;
		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}
	}

////////////////////////////////////////confuse about how to calculate the number of flags////////////////////
	public function getListUsersOderedByMostInappropriateFlags($howMany = self::HOWMANY, $page = self::PAGE)
	{
		//Accepts how many, page
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of users ordered by how many inapropriate flags they have issued
		//returns an array of User class

		try
		{
			$statement = "SELECT *, COUNT(uic.User_UserId) as NumberOfFlagged 
							FROM comment c 
							INNER JOIN user u
							ON c.User_UserId = u.UserId
							INNER JOIN story s
							ON u.UserId = s.User_UserId
							INNER JOIN user_inappropriateflag_comment uic 
							ON c.CommentId = uic.Comment_CommentId					
							GROUP BY u.UserId
							LIMIT :Start, :HowMany";
			
			$start = $this-> getStartValue($howMany, $page);
			
			$parameters = array( 
					":Start" => $start,
					":HowMany" => $howMany
				);

			$userList = $this->fetchIntoClass($statement, $parameters, "shared/CommentViewModel");

			return $userList;
		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function getListQuestionaireQuestions()
	{
		//Gets a list of all the current questionaire questions
		//This will include a list of possible answers

		try
		{
			$statement = "SELECT * , (
								SELECT COUNT(*) FROM question
							) AS TotalQuestions
							FROM question";

			// $statement = "SELECT * , (
			// 					SELECT COUNT(*) FROM question
			// 				) AS TotalQuestions
			// 				FROM question 
			// 				LEFT JOIN answer_for_question 
			// 				ON question.QuestionId=answer_for_question.Question_QuestionId";

			$userList = $this->fetchIntoObject($statement, array());

			if(isset($userList))
			{
				return $userList;
			}

			return null;
		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function getListQuestionaireAnswers()
	{
		//Gets a list of all the current questionaire questions
		//This will include a list of possible answers

		try
		{
			$statement = "SELECT * , a.NameE AS AnswerE, a.NameF AS AnswerF, 
							q.NameE AS QuestionE, q.NameE AS QuestionF, (
								SELECT COUNT(*) 
								FROM answer
								LEFT JOIN answer_for_question
								ON AnswerId = Answer_AnswerId
								LEFT JOIN question q
								ON QuestionId = Question_QuestionId
							) AS TotalAnswers
							FROM answer a
							LEFT JOIN answer_for_question afq
							ON a.AnswerId = afq.Answer_AnswerId
							LEFT JOIN question q
							ON q.QuestionId = afq.Question_QuestionId
							ORDER BY afq.Question_QuestionId";

			$answerList = $this->fetchIntoObject($statement, array());

			if(isset($answerList))
			{
				return $answerList;
			}

			return null;
		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function addAnswer($answerE, $answerF)
	{
		//Accepts a question answer id, and english answer, a french answer
		//returns bool if saved succesfully

		try
		{
			$statement = "INSERT INTO answer (NameE, NameF) 
							VALUES(:AnswerE, :AnswerF)";

			$parameters = array(
				":AnswerE" => $answerE,
				":AnswerF" => $answerF
				);

			return $this->fetch($statement, $parameters);

			//return $this->fetch("INSERT INTO answer_for_question (Question_QuestionId, Answer_AnswerId) VALUES(:QeustionID, :AnswerID)",
			// array(":QeustionID" => $questionID, ":AnswerID" => $newAnswerID));
		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function updateAnswer($answerID, $answerE, $answerF)
	{
		//Accepts a question answer id, and english answer, a french answer
		//returns bool if saved succesfully

		try
		{
			$statement = "UPDATE answer 
							SET NameE = :AnswerE, NameF = :AnswerF 
							WHERE AnswerId = :AnswerID";

			$parameters = array(
				":AnswerE" => $answerE,
				":AnswerF" => $answerF,
				":AnswerID" => $answerID
				);
			
			return $this->fetch($statement, $parameters);

			//return $this->fetch("INSERT INTO answer_for_question (Question_QuestionId, Answer_AnswerId) VALUES(:QeustionID, :AnswerID)",
			// array(":QeustionID" => $questionID, ":AnswerID" => $newAnswerID));
		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function addQuestionAnswerById($questionID, $answerID)
	{
		//Accepts a question id, and english answer, a french answer
		//returns bool if saved succesfully

		try
		{
			return $this->fetch(
				"INSERT INTO answer_for_question (Question_QuestionId, Answer_AnswerId) VALUES(:QeustionID, :AnswerID)",
			 	array(":QeustionID" => $questionID, ":AnswerID" => $answerID)
			 	);
		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}
	}
	
	public function addQuestionAnswer($questionID, $answerE, $answerF)
	{
		//Accepts a question id, and english answer, a french answer
		//returns bool if saved succesfully

		try
		{
			$statement = "SELECT * 
							FROM answer 
							WHERE NameE = :NameE AND NameF = :NameF";

			$rowCount = $this->fetchRowCount($statement, array("NameE" => $answerE, "NameF" => $answerF));

			if($rowCount < 1)
			{
				$this->addAnswer($answerE, $answerF);
				$answerID = $this->lastInsertId();				
			}
			else
			{
				$tmpAnswer = $this->fetchIntoObject($statement, array("NameE" => $answerE, "NameF" => $answerF));
				$answerID = $tmpAnswer[0]->AnswerId;
			}			
			return $this->addQuestionAnswerById($questionID, $answerID);
		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function updateQuestion($questionID, $questionE, $questionF)
	{
		//Accepts a question id, and english question, a french question
		//returns bool if saved succesfully

		try
		{
			$statement = "UPDATE question 
							SET QuestionE = :QuestionE, QuestionF = :QuestionF 
							WHERE QuestionId = :QuestionId";

			$parameters = array(
				":QuestionE" => $questionE,
				":QuestionF" => $questionF,
				":QuestionId" => $questionID
				);

			return $this->fetch($statement, $parameters);
		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}
	}
	
	public function addQuestion($questionE, $questionF)
	{
		//Accepts a english questionE, a french questionF
		//returns bool if saved succesfully

		try
		{
			$statement = "INSERT INTO question (QuestionE, QuestionF) 
							VALUES (:QuestionE, :QuestionF)";

			$parameters = array(
				":QuestionE" => $questionE,
				":QuestionF" => $questionF
				);

			return $this->fetch($statement, $parameters);
		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}
	}

public function getDropdownListItem($tableName, $itemId)
	{
		try
		{
			$statement = "";

			switch(true)
			{
				case strtolower($tableName) == "languagetype":
					$statement = "SELECT *, LanguageId AS Id FROM languagetype WHERE LanguageId = :Id";
					break;
				case strtolower($tableName) == "gendertype":
					$statement = "SELECT *, GenderTypeId AS Id FROM gendertype WHERE GenderTypeId = :Id";
					break;
				case strtolower($tableName) == "achievementleveltype":
					$statement = "SELECT *, LevelId AS Id FROM achievementleveltype WHERE LevelId = :Id";
					break;
				case strtolower($tableName) == "securityquestion":
					$statement = "SELECT *, SecurityQuestionId AS Id FROM securityquestion WHERE SecurityQuestionId = :Id";
					break;
				case strtolower($tableName) == "picturetype":
					$statement = "SELECT *, PictureTypeId AS Id FROM picturetype WHERE PictureTypeId = :Id";
					break;
				case strtolower($tableName) == "profileprivacytype":
					$statement = "SELECT *, PrivacyTypeId AS Id FROM profileprivacytype WHERE PrivacyTypeId = :Id";
					break;
				case strtolower($tableName) == "storyprivacytype":
					$statement = "SELECT *, StoryPrivacyTypeId AS Id FROM storyprivacytype WHERE StoryPrivacyTypeId = :Id";
					break;
				default:
					return $tableName." is not a proper table name";
			}			

			return $this->fetchIntoClass($statement, array(":Id" => $itemId), "shared/DropdownItemViewModel");
		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function getListDropdowns($tableName)
	{
		//Accepts admin id
		//returns list of dropdowns and their values

		try
		{
			$statement = "";

			switch(true)
			{
				case strtolower($tableName) == "languagetype":
					$statement = "SELECT *, LanguageId AS Id, (SELECT COUNT(*) FROM languagetype) AS TotalNumber FROM languagetype";
					break;
				case strtolower($tableName) == "gendertype":
					$statement = "SELECT *, GenderTypeId AS Id, (SELECT COUNT(*) FROM gendertype) AS TotalNumber FROM gendertype";
					break;
				case strtolower($tableName) == "achievementleveltype":
					$statement = "SELECT *, LevelId AS Id, (SELECT COUNT(*) FROM achievementleveltype) AS TotalNumber FROM achievementleveltype";
					break;
				case strtolower($tableName) == "securityquestion":
					$statement = "SELECT *, SecurityQuestionId AS Id, (SELECT COUNT(*) FROM securityquestion) AS TotalNumber FROM securityquestion";
					break;
				case strtolower($tableName) == "picturetype":
					$statement = "SELECT *, PictureTypeId AS Id, (SELECT COUNT(*) FROM picturetype) AS TotalNumber FROM picturetype";
					break;
				case strtolower($tableName) == "profileprivacytype":
					$statement = "SELECT *, PrivacyTypeId AS Id, (SELECT COUNT(*) FROM profileprivacytype) AS TotalNumber FROM profileprivacytype";
					break;
				case strtolower($tableName) == "storyprivacytype":
					$statement = "SELECT *, StoryPrivacyTypeId AS Id, (SELECT COUNT(*) FROM storyprivacytype) AS TotalNumber FROM storyprivacytype";
					break;
				default:
					return $tableName." is not a proper table name";
			}			

			return $this->fetchIntoClass($statement, array(), "shared/DropdownItemViewModel");
		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}
	}
	public function addDropdownItem($tableName, $dropdownValueE, $dropdownValueF)
	{
		//Accepts a english dropdownValueE, a french dropdownValueF
		//returns bool if saved succesfully

		try
		{
			$statement = "";

			switch(true)
			{
				case strtolower($tableName) == "languagetype":
					$statement = "INSERT INTO languagetype (NameE, NameF) VALUES (:NameE, :NameF)";
					break;
				case strtolower($tableName) == "gendertype":
					$statement = "INSERT INTO gendertype (NameE, NameF) VALUES (:NameE, :NameF)";
					break;
				case strtolower($tableName) == "achievementleveltype":
					$statement = "INSERT INTO achievementleveltype (NameE, NameF) VALUES (:NameE, :NameF)";
					break;
				case strtolower($tableName) == "securityquestion":
					$statement = "INSERT INTO securityquestion (NameE, NameF) VALUES (:NameE, :NameF)";
					break;
				case strtolower($tableName) == "picturetype":
					$statement = "INSERT INTO picturetype (NameE, NameF) VALUES (:NameE, :NameF)";
					break;
				case strtolower($tableName) == "profileprivacytype":
					$statement = "INSERT INTO profileprivacytype (NameE, NameF) VALUES (:NameE, :NameF)";
					break;
				case strtolower($tableName) == "storyprivacytype":
					$statement = "INSERT INTO storyprivacytype (NameE, NameF) VALUES (:NameE, :NameF)";
					break;
				default:
					return $tableName." is not a proper table name";
			}

			$parameters = array(
				":NameE" => $dropdownValueE,
				":NameF" => $dropdownValueF
				);

			return $this->fetch($statement, $parameters);
		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}
	}
	public function updateDropdownValue($tableName, $id, $dropdownValueE, $dropdownValueF)
	{
		//Accepts a english dropdownValueE, a french dropdownValueF
		//returns bool if saved succesfully

		try
		{
			$statement = "";

			switch(true)
			{
				case strtolower($tableName) == "languagetype":
					$statement = "UPDATE languagetype SET NameE = :NameE, NameF = :NameF  WHERE LanguageId = :Id";
					break;
				case strtolower($tableName) == "gendertype":
					$statement = "UPDATE gendertype SET NameE = :NameE, NameF = :NameF  WHERE GenderTypeId = :Id";
					break;
				case strtolower($tableName) == "achievementleveltype":
					$statement = "UPDATE achievementleveltype SET NameE = :NameE, NameF = :NameF  WHERE LevelId = :Id";
					break;
				case strtolower($tableName) == "securityquestion":
					$statement = "UPDATE securityquestion SET NameE = :NameE, NameF = :NameF  WHERE SecurityQuestionId = :Id";
					break;
				case strtolower($tableName) == "picturetype":
					$statement = "UPDATE picturetype SET NameE = :NameE, NameF = :NameF  WHERE PictureTypeId = :Id";
					break;
				case strtolower($tableName) == "profileprivacytype":
					$statement = "UPDATE profileprivacytype SET NameE = :NameE, NameF = :NameF  WHERE PrivacyTypeId = :Id";
					break;
				case strtolower($tableName) == "storyprivacytype":
					$statement = "UPDATE storyprivacytype SET NameE = :NameE, NameF = :NameF  WHERE StoryPrivacyTypeId = :Id";
					break;
				default:
					return $tableName." is not a proper table name";
			}

			$parameters = array(
				":NameE" => $dropdownValueE,
				":NameF" => $dropdownValueF,
				":Id" => $id
				);

			return $this->fetch($statement, $parameters);
		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}
	}
}

?>
