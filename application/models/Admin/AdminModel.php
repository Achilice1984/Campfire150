<?php

class AdminModel extends Model {

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
			$qry = "SELECT COUNT(*) FROM user WHERE userID = ? AND AdminFlag = 1";
			$rowCount = $this->fetchRowCount($qry, array($adminID));
			if($rowCount >= 1)
			{
				try
				{
					$statement = "SELECT *  FROM story WHERE storyID NOT IN ";
					$statement .= "(SELECT Story_StoryId FROM admin_approve_story)";
					$statement .= "LIMIT ? OFFSET ?"
					$parameters = array($howMany, $page);

					$storyList = $this->fetchIntoObject($statement, $parameters);
					return $storyList;
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

	public function getStoryListRejected($adminID, $howMany, $page)
	{
		//Accepts how many, page
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of stories that have been rejected by admin
		//Should not contain any published stories
		//Should have the admin user details an reason for being rejected
		//returns an array of Story class
		$offset = ($page - 1) * $howMany;

		try{
			$qry = "SELECT COUNT(*) FROM user WHERE userID = ? AND AdminFlag = 1";
			$rowCount = $this->fetchRowCount($qry, array($adminID));
			if($rowCount >= 1)
			{
				try{
					$statement = "SELECT *  FROM story WHERE storyID IN ";
					$statement .= "(SELECT Story_StoryId FROM admin_approve_story WHERE Approved = 0)";
					$statement .= "LIMIT ? OFFSET ?"
					$parameters = array($howMany, $page);

					$storyList = $this->fetchIntoObject($statement, $parameters);
					return $storyList;
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

	public function getStoryListFlaggedInappropriate($adminID, $howMany, $page)
	{
		//Accepts how many, page
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets a list of stories that have been marked as inappropriate by users
		//Order the list by how many inappropriate flags there are
		//returns an array of Story class
		$offset = ($page - 1) * $howMany;

		try{
			$qry = "SELECT COUNT(*) FROM user WHERE userID = ? AND AdminFlag = 1";
			$rowCount = $this->fetchRowCount($qry, array($adminID));
			if($rowCount >= 1)
			{
				try{
					$statement = "SELECT *  FROM story WHERE storyID in ";
					$statement .= "(SELECT Story_StoryId FROM user_recommend_story WHERE Opinion = 0) ";
					$statement .= "LIMIT ? OFFSET ?"
					$parameters = array($howMany, $page);

					$storyList = $this->fetchIntoObject($statement, $parameters);
					return $storyList;
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

	public function rejectStory($adminID, $storyID, $reason)
	{
		//Accepts the adminID, the story id and the reason why it was rejected
		//returns bool whether it was saved succesfully or not

		try
		{
			$qry1 = "SELECT *  FROM admin_approve_story WHERE userId = ? AND storyID = ?";
			$parameters = array($adminID, $storyID);

			$exist = $this->fetchRowCount($qry1, $parameters);
			if(!$exist)
			{
				try{
					$qry2 = "INSERT INTO admin_approve_story VALUES(?, ?, ?, ?, NULL, 0)";
					$parameters = array($adminID, $storyID, $reason, $reason,);

					$this->execute(qry2);
				}
				catch(PDOException $e)
				{
					return $e->getMessage();
				}
			}
			else
			{
				try
				{
					$qry2 = "UPDATE admin_approve_story SET ApprovalCommentE = ? WHERE userId = ? AND storyID = ?";
					$parameters = array( $reason, $adminID, $storyID);

					$this->execute(qry2);
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

	public function approveStory($adminID, $storyID)
	{
		//Accepts the adminID and the story id
		//returns bool whether it was saved succesfully or not
		try
		{
			$qry1 = "SELECT *  FROM admin_approve_story WHERE userId = ? AND storyID = ?";
			$parameters = array($adminID, $storyID);

			$exist = $this->fetchRowCount($qry1, $parameters);

			if(!$exist)
			{
				try{
					$qry2 = "INSERT INTO admin_approve_story(userId, storyID, Approved) VALUES(?, ?, 1)";
					$parameters = array($adminID, $storyID);

					$this->execute(qry2);
				}
				catch(PDOException $e)
				{
					return $e->getMessage();
				}
			}
			else
			{
				try
				{
					$qry2 = "UPDATE admin_approve_story SET Approved = 1 WHERE userId = ? AND storyID = ?";
					$parameters = array($adminID, $storyID);

					$this->execute(qry2);
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

	public function delete($id)
	{
		return $result;
	}

	// 	public function registerUserProfile($user)
	// {
	// 	$authentication = new Authentication();

	// 	$statement = "INSERT INTO User (Email, Password, Address, PostalCode, PhoneNumber, FirstName, LastName, MidName, HashedVerification)";
	// 	$statement .= " VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

	// 	$user->Password = $authentication->hashPassword($user->password);

	// 	$hashedEmailVerification = md5(uniqid());

	// 	$parameters = array($user->Email, $user->Password, $user->Address, $user->PostalCode, $user->PhoneNumber, $user->FirstName, $user->LastName, $user->MidName, $hashedEmailVerification);

		
	// 	$rowCount = $this->fetchRowCount($statement, $parameters);

	// 	//Success insert
	// 	if($rowCount >= 1)
	// 	{
	// 		$emailSent = sendEmailVerification($email, $hashedEmailVerification);

	// 		return true;
	// 	}

	// 	//Accepts a User class
	// 	//Returns true or false if the user was registered properly or not
	// 	//verified flag should be set to false
	// }


}

?>
