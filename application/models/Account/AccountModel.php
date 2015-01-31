<?php

class AccountModel extends Model {

	public function login($email, $password)
	{		
		//Accepts an email address and their hashed password
		//Returns bool if email
		//Account must be verified to login

		$hashedPasswordFromDatabase; //Get the hashed password from the database using email address

		return PasswordHasher::verifyPassword($password, $hashedPasswordFromDatabase);
	}
	public function registerUserProfile($user)
	{
		//This is how you hash the password
		$hashedPassword = PasswordHasher::hashPassword($user->password);

		//Accepts a User class
		//Returns true or false if the user was registered properly or not
		//verified flag should be set to false
	}
	public function verifiyEmail($email, $hashedValue)
	{
		//Accepts users email address and some hashed value
		//Checks that email address and hashedValue matches in the database
		//Sets verified flag to true
		//return bool
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
	public function deActivateUser($user, $admin)
	{
		//Accepts a User class for $user and a User class for $admin
		//Sets the active flag to false in user profile
		//Uses admin details to say who deactivated the account
	}
	public function getUserProfileByEmail($email)
	{
		//Accepts an email
		//Returns a User class with profile info relate to an email address
	}
	public function getUserProfileByID($userID)
	{
		//Accepts a user id
		//Returns a User class with profile info relate to its id
	}
	public function getTotalStoriesWritten($userID)
	{
		//Accepts an user id
		//Gets the total stories written by the user who owns this email address
		//Returns the total
	}
	public function getTotalFollowers($userID)
	{
		//Accepts a user id
		//Gets the total follower for this userid
		//Returns the total
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
		//Gets the total amount of people following the owner of this user id
		//Returns the total
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
	}

	public function getUserList($howMany, $page)
	{
		//Accepts how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Checks if user is following each user (add this to user viewmodel class)
		//Users must have verified flag set to true
		//Returns an array of User class
	}

	public function getLatestUserList($howMany, $page)
	{
		//Accepts how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Checks if user is following each user (add this to user viewmodel class)
		//Gets a list of the most recently registered users
		//Users must have verified flag set to true
		//Returns an array of User class
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
