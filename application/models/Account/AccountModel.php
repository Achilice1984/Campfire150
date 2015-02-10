<?php

class AccountModel extends Model {

	public function login($loginViewModel)
	{		
		$authentication = new Authentication();

		$statement = "SELECT * FROM User WHERE Email = :Email";

		//Get user that matches email address
		$user = $this->fetchIntoClass($statement, array(":Email" => $loginViewModel->Email), "shared/UserViewModel");

		if($user->VerifiedEmail) //Has user verified email?
		{
			$currentTime = new DateTime();

			if(!isset($user->LockoutTimes) || strtotime('-15 minutes') > $user->LockoutTimes) //Is user locked out?
			{
				//check to see if user is properly authenticated
				if($authentication->authenticate($loginViewModel->Password, $user[0])) //Is user peoperly authenticated?
				{
					//Set login and lockouts back to starting point
					$statement = "UPDATE User SET FailedLoginAttempt = :FailedLoginAttempt, LockoutTimes = :LockoutTimes";
					$statement .= " WHERE UserId = :UserId";

					$parameters = array( 					
						":FailedLoginAttempt" => 0, 
						":LockoutTimes" => NULL,
						":UserId" => $user->UserId
					);
					
					$rowCount = $this->fetchRowCount($statement, $parameters);

					//reset lockout 
					return true;
				}
				else //Login failed, update failed attempts
				{
					if($user->FailedLoginAttempt >= 5)
					{
						//add a failed login attempt and set the lockout time
						$statement = "UPDATE User SET FailedLoginAttempt = :FailedLoginAttempt, LockoutTimes = :LockoutTimes";
						$statement .= " WHERE UserId = :UserId";

						$parameters = array( 
							":FailedLoginAttempt" => $user->FailedLoginAttempt + 1, 
							":LockoutTimes" => $currentTime,
							":UserId" => $user->UserId
						);
						
						$rowCount = $this->fetchRowCount($statement, $parameters);
					}
					else
					{
						//add a failed login attempt
						$statement = "UPDATE User SET FailedLoginAttempt = :FailedLoginAttempt";
						$statement .= " WHERE UserId = :UserId";

						$parameters = array( 
							":FailedLoginAttempt" => $user->FailedLoginAttempt + 1, 
							":UserId" => $user->UserId
						);
						
						$rowCount = $this->fetchRowCount($statement, $parameters);
					}

					//add lockout
					return false;
				}
			}
		} // End of if($user->VerifiedEmail) //Has user verified email?
		else
		{
			return false; //Email not verified
		}
	}

	public function logout()
	{	
		session_destroy();
	}

	public function registerUserProfile($user)
	{
		$authentication = new Authentication();

		$statement = "INSERT INTO User (Email, Password, LanguageType_LanguageId, FirstName, LastName, MidName, Address, PostalCode, PhoneNumber, VerificationCode)";
		$statement .= " VALUES (:Email, :Password, :LanguageType_LanguageId, :FirstName, :LastName, :MidName, :Address, :PostalCode, :PhoneNumber, :VerificationCode)";

		$user->Password = $authentication->hashPassword($user->Password);

		$hashedEmailVerification = md5(uniqid());

		$parameters = array( 
			":Email" => $user->Email, 
			":Password" => $user->Password, 
			":FirstName" => $user->FirstName, 
			":LastName" => $user->LastName, 
			":MidName" => $user->MidName, 
			":Address" => $user->Address, 
			":PostalCode" => $user->PostalCode, 
			":PhoneNumber" => $user->PhoneNumber,			
			":VerificationCode" => $hashedEmailVerification
		);
		
		$rowCount = $this->fetchRowCount($statement, $parameters);

		//Success insert
		if($rowCount >= 1)
		{
			sendEmailVerification($user->Email, $hashedEmailVerification);

			return true;
		}
		else
		{
			return false;
		}
	}

	public function sendEmailVerification($email, $hashedEmailVerification)
	{
		$to      = $email; // Send email to our user
		$subject = 'Signup | Verification'; // Give the email a subject
		$message = '
		 
		Thanks for signing up for CampFire150!
		Your account has been created, you can login using the credentials you signed up with after you have activated your account by clicking the url below.
		 
		Please click this link to activate your account:
		http://localhost:8084/campfire150/account/verifyemail/' . $email . '/' . $hashedEmailVerification . '
		 
		'; // Our message above including the link
		                     
		$headers = 'From:' . $email . "\r\n"; // Set from headers
		mail($to, $subject, $message, $headers); // Send our email
	}

	public function verifiyEmail($email, $hashedValue)
	{
		//Accepts users email address and some hashed value
		//Checks that email address and hashedValue matches in the database
		//Sets verified flag to true
		//return bool

		$statement = "SELECT * FROM User WHERE Email = ? AND HashedVerification = ?";

		$user = $this->fetchIntoClass($statement, array($email, $hashedValue), "Shared/User");

		$verified = false;
		//Does everything match?
		if(isset($user))
		{
			$updateStatement = "UPDATE User SET Verified = TRUE";

			$rowCount = $this->fetchRowCount($updateStatement, array());
			//Success insert
			if($rowCount >= 1)
			{
				$verified = true;
			}
		}

		return $verified;
	}
	public function updateUserProfile($user)
	{
		//Accepts a User class
		//Update user profile in database
		//Returns true or false if the user was updated properly or not

		$authentication = new Authentication();

		$statement = "UPDATE User SET Email = :Email, Address = :Address, PostalCode = :PostalCode, City = :City, Province = :Province, Country = :Country, PhoneNumber = :PhoneNumber, FirstName = :FirstName, LastName = :LastName, MidName = :MidName";
		$statement .= " WHERE UserId = :UserId";

		$parameters = array( 
			":Email" => $user->Email, 
			":Address" => $user->Address, 
			":PostalCode" => $user->PostalCode, 
			":City" => $user->City,
			":Province" => $user->Province,
			":Country" => $user->Country,

			":PhoneNumber" => $user->PhoneNumber, 
			":FirstName" => $user->FirstName, 
			":LastName" => $user->LastName, 
			":MidName" => $user->MidName,
			":UserId" => $userID
		);

		
		$rowCount = $this->fetchRowCount($statement, $parameters);
		//echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />" . $rowCount . "sdnbfkbnsdfkb";
		//Success insert
		if($rowCount >= 1)
		{
			//$emailSent = sendEmailVerification($email, $hashedEmailVerification);

			return true;
		}
		else
		{
			return false;
		}
	}
	public function updateUserPassword($userID, $newPassword, $oldPassword)
	{
		//Accepts an email address, a new password, and an old password
		//Verifies that old password and email match
		//Updates the password in the database with the new password
		//Returns true or false if the password was updated properly or not
	}
	
	public function getUserProfileByEmail($email)
	{
		//Accepts an email
		//Returns a User class with profile info relate to an email address
		$authentication = new Authentication();

		$statement = "SELECT * FROM User WHERE Email = ?";

		$user = $this->fetchIntoClass($statement, array($email), "Shared/User");

		return $user;
	}
	public function getUserProfileByID($userID)
	{
		//Accepts a user id
		//Returns a User class with profile info relate to its id
		$authentication = new Authentication();

		$statement = "SELECT * FROM User WHERE UserId = ?";

		$user = $this->fetchIntoClass($statement, array($userID), "Shared/User");

		return $user;
	}
	public function getTotalStoriesApproved($userID)
	{
		//Accepts an user id
		//Gets the total stories written by the user who owns this email address
		//Returns the total
		$statement = "SELECT count(*) FROM Story WHERE User_UserId = ?";

		$totalStories = $this->fetchColumn($statement, array($userID));

		return $totalStories;
	}
	public function getTotalStoriesPending($userID)
	{
		//Accepts an user id
		//Gets the total stories written by the user who owns this email address
		//Returns the total
		$statement = "SELECT count(*) FROM Story WHERE User_UserId = ?";

		$totalStories = $this->fetchColumn($statement, array($userID));

		return $totalStories;
	}
	public function getTotalStoriesDenied($userID)
	{
		//Accepts an user id
		//Gets the total stories written by the user who owns this email address
		//Returns the total
		$statement = "SELECT count(*) FROM Story WHERE User_UserId = ?";

		$totalStories = $this->fetchColumn($statement, array($userID));

		return $totalStories;
	}
	public function getTotalCommentsApproved($userID)
	{
		//Accepts an user id
		//Gets the total stories written by the user who owns this email address
		//Returns the total
		$statement = "SELECT count(*) FROM Story WHERE User_UserId = ?";

		$totalStories = $this->fetchColumn($statement, array($userID));

		return $totalStories;
	}
	public function getTotalCommentsPending($userID)
	{
		//Accepts an user id
		//Gets the total stories written by the user who owns this email address
		//Returns the total
		$statement = "SELECT count(*) FROM Story WHERE User_UserId = ?";

		$totalStories = $this->fetchColumn($statement, array($userID));

		return $totalStories;
	}
	public function getTotalFollowers($userID)
	{
		//Accepts a user id
		//Gets the total follower for this userid
		//Returns the total

		$statement = "SELECT count(*) FROM Following WHERE User_UserId = ?";

		$totalFollowing = $this->fetchColumn($statement, array($userID));

		return $totalFollowing;
	}
	public function followUser($userID, $userToFollowID)
	{
		//Accepts a user id and the id of the user to follow
		//Check that not already following other user
		//Returns bool if saved succesfully
	}
	public function unfollowUser($userID, $userToUnFollowID)
	{
		//Accepts a user id and the id of the user to stop following
		//Check that user is following other user
		//Returns bool if saved succesfully
	}
	public function getFollowers($userID)
	{
		//Accepts a user id
		//Gets all users that are following this userid
		//Returns array of user class
	}
	public function getTotalFollowing($userID)
	{
		//Accepts a user id
		//Gets the total amount of people the current user is following
		//Returns the total

		$statement = "SELECT count(*) FROM Following WHERE User_FollowerId = ?";

		$totalFollowers = $this->fetchColumn($statement, array($userID));

		return $totalFollowers;
	}
	public function getFollowing($userID)
	{
		//Accepts a user id
		//Gets all users that are following this user id
		//Returns array of user class
	}
	public function getStoriesWrittenByCurrentUser($userID)
	{
		//Accepts a user id
		//Gets an array of stories written by the owner of this user id
		//Returns an array of Story class

		$statement = "SELECT * FROM Story WHERE User_UserId = ?";

		$stories = $this->fetchIntoClass($statement, array($userID), "Shared/Story");

		return $stories;
	}
	public function getStoriesRecommendedByFriends($userID)
	{
		//Accepts a user id
		//Gets an array of stories that were recommended to the owner of this user id
		//Returns an array of Story class
	}
	public function searchForUser($userSearch, $howMany, $page)
	{
		//Accepts a string that will be someones name, how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets an array of users who most closely match the search string
		//Checks if user is following each user (add this to user viewmodel class)
		//Returns an array of User class		

		$statement = "SELECT *, MATCH(FirstName, LastName, Email, MidName) AGAINST('$userSearch') AS score FROM User LIMIT ?, ? WHERE MATCH(FirstName, LastName, Email, MidName) AGAINST(?) ORDER BY score DESC";

		$start = $howMany * ($page - 1);

		$user = $this->fetchIntoClass($statement, array($start, $howMany, $userSearch), "Shared/User");

		return $user;
	}

	public function getUserList($howMany, $page)
	{
		//Accepts how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Checks if user is following each user (add this to user viewmodel class)
		//Users must have verified flag set to true
		//Returns an array of User class

		$statement = "SELECT * FROM User LIMIT ?, ?";

		$start = $howMany * ($page - 1);

		$user = $this->fetchIntoClass($statement, array($start, $howMany), "Shared/User");

		return $user;
	}

	public function getLatestUserList($howMany, $page)
	{
		//Accepts how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Checks if user is following each user (add this to user viewmodel class)
		//Gets a list of the most recently registered users
		//Users must have verified flag set to true
		//Returns an array of User class

		$statement = "SELECT * FROM User ORDER BY RegisterDate DESC LIMIT ?, ?";

		$start = $howMany * ($page - 1);

		$user = $this->fetchIntoClass($statement, array($start, $howMany), "Shared/User");

		return $user;
	}


	function getListOfStories()
	{

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
