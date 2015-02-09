<?php

class AccountModel extends Model {

	public function login($user)
	{		
		$authentication = new Authentication();

		$statement = "SELECT * FROM User WHERE Email = :Email";

		$userFromDB = $this->fetchIntoClass($statement, array(":Email" => $user->Email), "shared/UserViewModel");

		if($authentication->authenticate($user->Password, $userFromDB[0]))
		{
			//reset lockout 
			return true;
		}
		else
		{
			//add lockout
			return false;
		}
	}
	public function registerUserProfile($user)
	{
		$authentication = new Authentication();

		$statement = "INSERT INTO User (Email, Password, Address, PostalCode, PhoneNumber, FirstName, LastName, MidName, VerificationCode)";
		$statement .= " VALUES (:Email, :Password, :Address, :PostalCode, :PhoneNumber, :FirstName, :LastName, :MidName, :VerificationCode)";

		$user->Password = $authentication->hashPassword($user->Password);

		$hashedEmailVerification = md5(uniqid());

		$parameters = array( 
			":Email" => $user->Email, 
			":Password" => $user->Password, 
			":Address" => $user->Address, 
			":PostalCode" => $user->PostalCode, 
			":PhoneNumber" => $user->PhoneNumber, 
			":FirstName" => $user->FirstName, 
			":LastName" => $user->LastName, 
			":MidName" => $user->MidName, 
			":VerificationCode" => $hashedEmailVerification
		);
		
		$rowCount = $this->fetchRowCount($statement, $parameters);

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

	public function sendEmailVerification($email, $hashedEmailVerification)
	{
		$to      = $email; // Send email to our user
		$subject = 'Signup | Verification'; // Give the email a subject
		$message = '
		 
		Thanks for signing up for CampFire150!
		Your account has been created, you can login using the credentials you signed up with after you have activated your account by clicking the url below.
		 
		Please click this link to activate your account:
		http://localhost:8084/campfire150/account/verify/' . $email . '/' . $hashedEmailVerification . '
		 
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


	function userUpdate()
	{

		$stmt = $this->connection->prepare("UPDATE User SET Email=:email,Password=:password,RegisterDate=:registerDate,Address=:address,
		PostalCode=$postalCode,Notes=$notes,AchievementLevelType_LevelId=$achievementLevelType_LevelId,
		FirstName=:firstName,MidName=:midName,LastName=:lastName,LanguageType_LanguageId=:languageType_LanguageId
		WHERE UserId=:userId");

		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->bindParam(':password', $password, PDO::PARAM_STR);
		$stmt->bindParam(':registerDate', $registerDate, PDO::PARAM_STR);
		$stmt->bindParam(':address', $address, PDO::PARAM_STR);
		$stmt->bindParam(':postalCode', $postalCode, PDO::PARAM_STR);
		$stmt->bindParam(':notes', $notes, PDO::PARAM_STR);
		$stmt->bindParam(':achievementLevelType_LevelId', $achievementLevelType_LevelId, PDO::PARAM_INT);
		$stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
		$stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
		$stmt->bindParam(':midName', $midName, PDO::PARAM_STR);
		$stmt->bindParam(':languageType_LanguageId', $languageType_LanguageId, PDO::PARAM_STR);
		$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);


		$this->execute($stmt);
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
