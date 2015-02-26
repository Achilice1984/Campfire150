<?php

class AdminModel extends Model {

	public function isAdmin($userID)  //TESTED
	{
		//Check if the ID is an admin ID

		try
		{
			$statement = "SELECT * FROM user WHERE userID = :ID AND AdminFlag = 1";

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

	public function searchStoriesPendingApproval($adminID, $storySearch, $howMany, $page)
	{
		//Accepts string to search for a story
		//Checks if user has marked story as inappropriate and if user has recommended story (add these to story viewmodel class)
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
		$offset = ($page - 1) * $howMany;

		try
		{
			$statement = "SELECT COUNT(*) FROM user WHERE userID = ? AND AdminFlag = 1";

			$rowCount = $this->fetchRowCount($statement, array($adminID));
			
			if($rowCount >= 1)
			{
				try
				{
					$statement = "SELECT *  FROM story WHERE storyID NOT IN ";

					$statement .= "(SELECT Story_StoryId FROM admin_approve_story)";

					$statement .= "LIMIT ? OFFSET ?";

					$parameters = array($howMany, $offset);

					$storyList = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

					return $storyList;

				}
				catch(PDOException $e) 
				{
					return $e->getMessage();
				}
			}
			else
			{
				echo "Sorry, you can not do this. You are not admin user";
			}

		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	public function getStoryListRejected($adminID, $howMany, $page)
	{
		//Accepts how many, page
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of stories that have been rejected by admin
		//Should not contain any published stories
		//Should have the admin user details an reason for being rejected
		//returns an array of Story class
		$offset = ($page - 1) * $howMany;

		try
		{
			$statement = "SELECT COUNT(*) FROM user WHERE userID = ? AND AdminFlag = 1";

			$rowCount = $this->fetchRowCount($statement, array($adminID));

			if($rowCount >= 1)
			{
				try
				{
					$statement = "SELECT *  FROM story WHERE storyID IN ";

					$statement .= "(SELECT Story_StoryId FROM admin_approve_story WHERE Approved = 0)";

					$statement .= "LIMIT ? OFFSET ?";

					$parameters = array($howMany, $offset);

					$storyList = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

					return $storyList;
				}
				catch(PDOException $e) 
				{
					return $e->getMessage();
				}
			}
			else
			{
				echo "Sorry, you can not do this. You are not admin user";
			}

		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	public function getStoryListFlaggedInappropriate($adminID, $howMany, $page)
	{
		//Accepts how many, page
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of stories that have been marked as inappropriate by users
		//Order the list by how many inappropriate flags there are
		//returns an array of Story class
		
		if(!($this->isAdmin($adminID)))
			return false;

		try
		{
			$start = $this->getStartValue($howMany, $page);

			$statement = "SELECT s.storyID, s.StoryTitle, COUNT(urs.User_UserId) AS NumberOfFlagged FROM story s RIGHT JOIN user_recommend_story urs ";
			$statement .= "ON s.storyID=urs.Story_StoryId WHERE urs.Opinion = 0 ";
			$statement .= "GROUP BY s.storyID ORDER BY NumberOfFlagged DESC LIMIT $howMany OFFSET $start";

			//$parameters = array($howMany, $start);
			//$storyList = $this->fetchIntoClass($statement, $parameters, "shared/StoryViewModel");

			return $this->fetchIntoObject($statement, array());
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

		if(!($this->isAdmin($adminID)))

			return false;

		try
		{
			$statement = "SELECT *  FROM admin_approve_story WHERE User_UserId = :UserID AND Story_StoryId = :StoryID";

			$rowCount = $this->fetchRowCount($statement, array("UserID"=>$adminID, "StoryID"=>$storyID));
			
			debugit($rowCount);

			if($rowCount <= 0)
			{
				echo "not exist";
				$statement2 = "INSERT INTO admin_approve_story VALUES(?, ?, ?, NULL, NULL, 0)";

				$parameters = array($adminID, $storyID, $reason);

				return $this->fetch($statement2, $parameters);
			}
			else
			{
				echo "exist";

				$statement2 = "UPDATE admin_approve_story SET ApprovalCommentE =  WHERE User_UserId = ? AND Story_StoryId = ?";

				$parameters = array( $reason, $adminID, $storyID);

				return $this->fetch($statement2, $parameters);		
			}
		}
		catch(PDOException $e)
		{
			return $e->getMessage();			
		}
	}

	public function approveStory($adminID, $storyID)
	{
		//Accepts the adminID and the story id
		//returns bool whether it was saved succesfully or not

		if(!($this->isAdmin($adminID)))

			return false;
		
		try
		{
			// $statement1 = "SELECT *  FROM admin_approve_story WHERE User_UserId = :UserID AND Story_StoryId = :StoryID";

			// $rowCount = $this->fetchRowCount($statement1, array("UserID" => $adminID, "StoryID" => $storyID));
			$statement = "SELECT *  FROM admin_approve_story WHERE ? AND ?";

			$parameters = array($adminID, $storyID);

			$rowCount = $this->fetchRowCount($statement, $parameters);

			if($rowCount > 0)
			{
				$statement2 = "UPDATE admin_approve_story SET Approved = 1 WHERE User_UserId = ? AND Story_StoryId = ?";

				$parameters = array($adminID, $storyID);

				return $this->fetch($statement2, $parameters);
			}
			else
			{
				$statement2 = "INSERT INTO admin_approve_story(User_UserId, Story_StoryId, Approved) VALUES(?, ?, 1)";

				$parameters = array($adminID, $storyID);

				return $this->fetch($statement2, $parameters);				
			}
		}
		catch(PDOException $e)
		{

			return $e->getMessage();

		}
	}

	public function changeRejectedToApproved($adminID, $storyID)
	{
		//Accepts the adminID and the story id
		//Change a rejected story to an approved story
		//returns bool whether it was saved succesfully or not

		try
		{
			$statement = "SELECT COUNT(*) FROM user WHERE userID = ? AND AdminFlag = 1";

			$rowCount = $this->fetchRowCount($statement, array($adminID));

			if($rowCount >= 1)
			{
				try
				{
					$statement2 = "UPDATE admin_approve_story SET Approved = 1, User_UserId = ? WHERE storyID = ?";

					$parameters = array($adminID, $storyID);

					return $this->execute($statement2);
				}
				catch(PDOException $e)
				{
					return $e->getMessage();
				}				
			}
		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function changeApprovedToRejected($adminID, $storyID, $reason)
	{
		//Accepts the adminID, the story id and the reason why it was rejected
		//Change an approved story to a rejected story
		//returns bool whether it was saved succesfully or not

		try
		{
			$statement = "SELECT COUNT(*) FROM user WHERE userID = ? AND AdminFlag = 1";

			$rowCount = $this->fetchRowCount($statement, array($adminID));

			if($rowCount >= 1)
			{
				try
				{
					$statement = "UPDATE admin_approve_story SET Approved = 0, ApprovalCommentE = ? WHERE userId = ? AND storyID = ?";

					$parameters = array($reason, $adminID, $storyID);

					return $this->execute($statement);
				}
				catch(PDOException $e)
				{
					return $e->getMessage();
				}
			}
			else
			{
				return false;
			}
		}
		catch(PDOException $e)
		{
			return $e->getMessage();			
		}
	}

	public function getCommentListFlaggedInappropriate($howMany, $page)
	{
		//Accepts how many, page
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of comments that have been marked as inappropriate by users
		//Order the list by how many inappropriate flags there are
		//returns an array of Comment class

		try
		{
			$statement = "SELECT COUNT(*) FROM user WHERE userID = ? AND AdminFlag = 1";

			$rowCount = $this->fetchRowCount($statement, array($adminID));

			if($rowCount >= 1)
			{
				try
				{

					$statement = "SELECT *  FROM comment WHERE CommentId in ";

					$statement .= "(SELECT Comment_CommentId FROM user_inappropriateflag_comment) ";

					$start = $howMany * ($page - 1);

					$statement .= "ORDER BY CommentId LIMIT ?, ?";

					$parameters = array($start, $howMany);

					$storyList = $this->fetchIntoClass($statement, $parameters, "Shared/Story");


					return $storyList;
				}
				catch(PDOException $e) 
				{

			$statement .= "ORDER BY CommentId LIMIT ? OFFSET ?";


					return $e->getMessage();

				}
			}
			else
			{
				return false;
			}

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

	public function getListUsers($adminID, $howMany, $page)
	{
		//Accepts how many, page
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of users
		//returns an array of User class

		if(!($this->isAdmin($adminID)))

			return false;

		try
		{
			$statement = "SELECT * FROM User ORDER BY UserId ASC LIMIT :start, :howmany";

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

	public function deActivateUser($userID, $adminID, $reason)  //TESTED
	{
		//Accepts a User class for $user and a User class for $admin
		//Sets the active flag to false in user profile
		//Uses admin details to say who deactivated the account

		if(!($this->isAdmin($adminID)))

			return false;
		
		try
		{
			$statement = "SELECT * FROM admin_actionon_user WHERE User_UserId=:UserID AND Admin_UserId=:AdminID AND Action=0";

			$exist = $this->fetchNum($statement, array(":UserID" => $userID, ":AdminID" => $adminID));

			if($exist)
			{
				$statement = "UPDATE admin_actionon_user SET Reason = :DeActivateReason";
				$statement .= "WHERE User_UserId=:UserID AND Admin_UserId=:AdminID ";

				$parameters = array( 
					":DeActivateReason" => $reason,
					":userID" => $userID,
					":AdminID" => $adminID
				);

				return $this->fetch($statement, $parameters) && $this->fetch("UPDATE user SET Active = 0 WHERE UserId=:UserID", array(":UserID" => $userID));
			}
			else
			{
				$statement = "INSERT INTO admin_actionon_user (Admin_UserId, User_UserId, Action, Reason)";
				$statement .= " VALUES (:AdminID, :UserID, 0, :Reason)";

				$parameters = array( 
					":AdminID" => $adminID,
					":UserID" => $userID,					
					":Reason" => $reason
				);

				return $this->fetch($statement, $parameters) && $this->fetch("UPDATE user SET Active = 0 WHERE UserId=:UserID", array(":UserID" => $userID));
			}
		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function getListUsersDisabled($adminID, $howMany, $page)
	{
		//Accepts how many, page
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of users that have been disabled with reason
		//returns an array of User class

		if(!($this->isAdmin($adminID)))
			return false;

		try
		{
			$statement = "SELECT * FROM User WHERE Active = 0 ORDER BY UserId ASC LIMIT :Start, :HowMany";

			$start = $this->getStartValue($howMany, $page);

			$parameters = array( 
					":Start" => $start,
					":HowMany" => $howMany
				);
//			$this->bindParams

			$userList = $this->fetchIntoClass($statement, $parameters, "shared/UserViewModel");

			if(isset($userList[0]))
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

	public function getListUsersOderedByMostInappropriateFlags($adminID, $howMany, $page)
	{
		//Accepts how many, page
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of users ordered by how many inapropriate flags they have issued
		//returns an array of User class

		
	}

	public function getListQuestionaireQuestions($adminID) //TESTED
	{
		//Gets a list of all the current questionaire questions
		//This will include a list of possible answers

		if(!($this->isAdmin($adminID)))
			return false;

		try
		{
			$statement = "SELECT * FROM question LEFT JOIN answer_for_question ON question.QuestionId = answer_for_question.Question_QuestionId";

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

	public function updateQuestion($adminID, $questionID, $questionE, $questionF) //tested
	{
		//Accepts a question id, and english question, a french question
		//returns bool if saved succesfully

		if(!($this->isAdmin($adminID)))
			return false;

		try
		{
			$statement = "UPDATE question SET QuestionE = :QuestionE, QuestionF = :QuestionF WHERE QuestionId = :QuestionId";

			return $this->fetch($statement, array(":QuestionE" => $questionE, ":QuestionF" => $questionF,  ":QuestionId" => $questionID));
		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}
	}
	
	public function addQuestion($adminID, $questionE, $questionF)//tested
	{
		//Accepts a english questionE, a french questionF
		//returns bool if saved succesfully

		if(!($this->isAdmin($adminID)))
			return false;

		try
		{
			$statement = "INSERT INTO question (QuestionE, QuestionF) VALUES (:QuestionE, :QuestionF)";

			return $this->fetch($statement, array(":QuestionE" => $questionE, ":QuestionF" => $questionF));
		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}
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

	public function delete($id)
	{
		return $result;
	}

	private function bindParams($pdo, $params)
    {
        if(isset($params))
        {
            foreach ($params as $key => $value) 
            {
                $pdo->bindParam($key, $value, !is_numeric($value) ? PDO::PARAM_STR : PDO::PARAM_INT);
            }
        }
    }
}

?>
