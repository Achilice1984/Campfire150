<?php

class AccountModel extends Model {

	/******************************************************************************************************************
	*
	*				Account Authentication
	*
	******************************************************************************************************************/

	public function login($loginViewModel)
	{		
		$authentication = new Authentication();

		$statement = "SELECT * FROM user WHERE Email = :Email";

		//Get user that matches email address
		$user = $this->fetchIntoClass($statement, array(":Email" => $loginViewModel->Email), "shared/UserViewModel");

		$isUserLoggedIn = false;

		// Does a user exists?
		if (isset($user[0])) 
		{
			$user = $user[0];

			if($user->VerifiedEmail) //Has user verified email?
			{
				if(!isset($user->LockoutTimes) || strtotime('-15 minutes') > $user->LockoutTimes) //Is user locked out?
				{
					//check to see if user is properly authenticated
					if($authentication->authenticate($loginViewModel->Password, $user)) //Is user peoperly authenticated?
					{
						//Set login and lockouts back to starting point
						$statement = "UPDATE user SET FailedLoginAttempt = :FailedLoginAttempt, LockoutTimes = :LockoutTimes";
						$statement .= " WHERE UserId = :UserId";

						$parameters = array( 					
							":FailedLoginAttempt" => 0, 
							":LockoutTimes" => NULL,
							":UserId" => $user->UserId
						);
						
						$this->fetch($statement, $parameters);

						$isUserLoggedIn = true;
					}
					else //User exists BUT Login failed, update failed attempts
					{
						//to many failed login attempts, lockout user
						if($user->FailedLoginAttempt >= 5)
						{
							//add a failed login attempt and set the lockout time
							$statement = "UPDATE user SET FailedLoginAttempt = :FailedLoginAttempt, LockoutTimes = :LockoutTimes";
							$statement .= " WHERE UserId = :UserId";

							$parameters = array( 
								":FailedLoginAttempt" => $user->FailedLoginAttempt + 1, 
								":LockoutTimes" => new DateTime(),
								":UserId" => $user->UserId
							);
							
							$this->fetch($statement, $parameters);
						}
						else
						{
							//add a failed login attempt
							$statement = "UPDATE user SET FailedLoginAttempt = :FailedLoginAttempt";
							$statement .= " WHERE UserId = :UserId";

							$parameters = array( 
								":FailedLoginAttempt" => $user->FailedLoginAttempt + 1, 
								":UserId" => $user->UserId
							);
							
							$this->fetch($statement, $parameters);
						}
					}
				}
			} // End of if($user->VerifiedEmail) //Has user verified email?
		}

		return $isUserLoggedIn;
	}

	public function logout()
	{	
		session_destroy();
	}

	public function updateUserPassword($user, $changePasswordViewModel)
	{
		//Accepts an email address, a new password, and an old password
		//Verifies that old password and email match
		//Updates the password in the database with the new password
		//Returns true or false if the password was updated properly or not		

		$statement = "SELECT * FROM user WHERE Email = :Email";

		//Get user that matches email address
		$dbUser = $this->fetchIntoClass($statement, array(":Email" => $user->Email), "shared/UserViewModel");

		if (isset($dbUser)) {
			$dbUser = $dbUser[0];

			$authentication = new Authentication();
		
			if($authentication->verifyPassword($changePasswordViewModel->OldPassword, $dbUser->Password))
			{
				$statement = "UPDATE user SET Password = :Password";
				$statement .= " WHERE UserId = :UserId";

				$parameters = array( 
					":UserId" => $user->UserId,
					":Password" => $authentication->hashPassword($changePasswordViewModel->Password)
				);
				
				return $this->fetch($statement, $parameters);
			}
		}

		return false;
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

		$statement = "SELECT * FROM user WHERE Email = ? AND HashedVerification = ?";

		$user = $this->fetchIntoClass($statement, array($email, $hashedValue), "shared/UserViewModel");

		$verified = false;
		//Does everything match?
		if(isset($user))
		{
			$updateStatement = "UPDATE User SET Verified = TRUE";

			$verified = $this->fetch($updateStatement, array());
		}

		return $verified;
	}

	/******************************************************************************************************************
	*
	*				Account Images
	*
	******************************************************************************************************************/

	public function saveUserImageMetadata($userId, $imageViewModel, $imageType)
	{
		// 1 = profile
		// 2 = background

		//If deactivating current image works
		$safeToSaveImage = true;

		//The returned id of the new picture
		$pictureId = 0;

		// Select any currently active images the user already has
		$selectStatement = "SELECT * FROM picture WHERE User_UserId = :User_UserId AND picturetype_PictureTypeId = :picturetype_PictureTypeId AND Active = TRUE";

		$selectParameters = array( 
			":User_UserId" => $userId,
			":picturetype_PictureTypeId" => $imageType
		);

		//Deactivate those images
		$currentActiveImage = $this->fetchIntoClass($selectStatement, $selectParameters, "shared/PictureViewModel");

		if (isset($currentActiveImage[0])) 
		{
			$safeToSaveImage = $this->removeImageMetadata($currentActiveImage[0]->PictureId);
		}

		if($safeToSaveImage == true)
		{
			$statement = "INSERT INTO picture (Title, Description, FileName, Active, InppropriateFlag, User_UserId, picturetype_PictureTypeId, PictureExtension)";
			$statement .= " VALUES (:Title, :Description, :FileName, :Active, :InppropriateFlag, :User_UserId, :picturetype_PictureTypeId, :PictureExtension)";


			$parameters = array( 
				":Title" => $imageViewModel->Title, 
				":Description" => $imageViewModel->Description,
				":FileName" => pathinfo($imageViewModel->PictureFile["name"], PATHINFO_FILENAME), 
				":Active" => true, 
				":InppropriateFlag" => false, 
				":User_UserId" => $userId, 
				":picturetype_PictureTypeId" => $imageType, 
				":PictureExtension" => pathinfo($imageViewModel->PictureFile["name"], PATHINFO_EXTENSION)
			);

			if($this->fetch($statement, $parameters, "shared/PictureViewModel"))
			{
				$pictureId = $this->lastInsertId();
			}
		}

		return $pictureId;
	}

	public function removeImageMetadata($pictureId)
	{
		$statement = "UPDATE picture SET Active = FALSE";
		$statement .= " WHERE PictureId = :PictureId";

		$parameters = array( 
			":PictureId" => $pictureId
		);

		return $this->fetch($statement, $parameters);
	}

	public function getCurrentProfilePictureMetadata($userId)
	{
		// 1 == profile picture
		$statement = "SELECT * FROM picture WHERE User_UserId = :User_UserId AND picturetype_PictureTypeId = 1 AND Active = TRUE";

		$pictureViewModel = $this->fetchIntoClass($statement, array(":User_UserId" => $userId), "shared/PictureViewModel");

		if(isset($pictureViewModel))
		{
			return $pictureViewModel[0];
		}

		return null;
	}

	public function getCurrentBackgroundPictureMetadata($userId)
	{
		// 2 == background picture
		$statement = "SELECT * FROM picture WHERE User_UserId = :User_UserId AND picturetype_PictureTypeId = 2 AND Active = TRUE";

		$pictureViewModel = $this->fetchIntoClass($statement, array(":User_UserId" => $userId), "shared/PictureViewModel");

		if(isset($pictureViewModel))
		{
			return $pictureViewModel[0];
		}

		return null;
	}

	public function getPictureMetadataByPictureId($pictureId)
	{
		$statement = "SELECT * FROM picture WHERE PictureId = :PictureId AND Active = TRUE";

		$pictureViewModel = $this->fetchIntoClass($statement, array(":PictureId" => $pictureId), "shared/PictureViewModel");

		if(isset($pictureViewModel[0]))
		{
			return $pictureViewModel[0];
		}

		return null;
	}

	


	/******************************************************************************************************************
	*
	*				Account Profile
	*
	******************************************************************************************************************/	

	public function registerUserProfile($user)
	{
		$authentication = new Authentication();

		$statement = "INSERT INTO user (Email, Password, LanguageType_LanguageId, FirstName, LastName, MidName, Address, PostalCode, PhoneNumber, VerificationCode, VerifiedEmail, ProfilePrivacyType_PrivacyTypeId)";
		$statement .= " VALUES (:Email, :Password, :LanguageType_LanguageId, :FirstName, :LastName, :MidName, :Address, :PostalCode, :PhoneNumber, :VerificationCode, :VerifiedEmail, :ProfilePrivacyType_PrivacyTypeId)";

		$user->Password = $authentication->hashPassword($user->Password);

		$hashedEmailVerification = md5(uniqid());

		$parameters = array( 
			":Email" => $user->Email, 
			":Password" => $user->Password,
			":LanguageType_LanguageId" => $user->LanguageType_LanguageId, 
			":FirstName" => $user->FirstName, 
			":LastName" => $user->LastName, 
			":MidName" => $user->MidName, 
			":Address" => $user->Address, 
			":PostalCode" => $user->PostalCode, 
			":PhoneNumber" => $user->PhoneNumber,			
			":VerificationCode" => $hashedEmailVerification,
			":VerifiedEmail" => true,
			":ProfilePrivacyType_PrivacyTypeId" => $user->ProfilePrivacyType_PrivacyTypeId
		);
		
		//$this->sendEmailVerification($user->Email, $hashedEmailVerification);

		return $this->fetch($statement, $parameters);
	}
	
	public function updateUserProfile($user)
	{
		$authentication = new Authentication();

		$statement = "UPDATE user SET LanguageType_LanguageId = :LanguageType_LanguageId, Email = :Email, Address = :Address, PostalCode = :PostalCode, PhoneNumber = :PhoneNumber, FirstName = :FirstName, LastName = :LastName, MidName = :MidName, ProfilePrivacyType_PrivacyTypeId = :ProfilePrivacyType_PrivacyTypeId";
		$statement .= " WHERE UserId = :UserId";

		$parameters = array( 
			":Email" => $user->Email, 
			":Address" => $user->Address, 
			":PostalCode" => $user->PostalCode,
			":PhoneNumber" => $user->PhoneNumber, 
			":FirstName" => $user->FirstName, 
			":LastName" => $user->LastName, 
			":MidName" => $user->MidName,
			":UserId" => $user->UserId,
			":LanguageType_LanguageId" => $user->LanguageType_LanguageId,
			":ProfilePrivacyType_PrivacyTypeId" => $user->ProfilePrivacyType_PrivacyTypeId
		);

		
		return $this->fetch($statement, $parameters);
	}

	public function updateUserLanguagePreference($userId, $languageId)
	{
		$statement = "UPDATE user SET LanguageType_LanguageId = :LanguageType_LanguageId";
		$statement .= " WHERE UserId = :UserId";

		$parameters = array( 
			":UserId" => $userId,
			":LanguageType_LanguageId" => $languageId
		);

		
		return $this->fetch($statement, $parameters);
	}	
	
	public function getUserProfileByEmail($email)
	{
		$statement = "SELECT * FROM user WHERE Email = :Email";

		$user = $this->fetchIntoClass($statement, array(":Email" => $email), "shared/UserViewModel");

		if(isset($user[0]))
		{
			return $user[0];
		}

		return null;
	}
	public function getUserProfileByID($userID)
	{
		$statement = "SELECT * FROM user WHERE UserId = :UserId";

		$user = $this->fetchIntoClass($statement, array( ":UserId" => $userID), "shared/UserViewModel");

		if(isset($user[0]))
		{
			return $user[0];
		}

		return null;
	}

	public function getProfileByEmail($email)
	{
		$statement = "SELECT * FROM user WHERE Email = :Email";

		$user = $this->fetchIntoClass($statement, array(":Email" => $email), "Account/ProfileViewModel");

		if(isset($user[0]))
		{
			return $user[0];
		}

		return null;
	}
	public function getProfileByID($userID)
	{
		$statement = "SELECT * FROM user WHERE UserId = :UserId";

		$user = $this->fetchIntoClass($statement, array( ":UserId" => $userID), "Account/ProfileViewModel");

		if(isset($user[0]))
		{
			return $user[0];
		}

		return null;
	}


	/******************************************************************************************************************
	*
	*				Account Stories
	*
	******************************************************************************************************************/	

	public function getTotalStoriesApproved($userID)
	{
		//Accepts an user id
		//Gets the total stories written by the user who owns this email address
		//Returns the total
		$statement = "SELECT count(*) FROM story WHERE User_UserId = ?";

		$totalStories = $this->fetchColumn($statement, array($userID));

		return $totalStories;
	}
	public function getTotalStoriesPending($userID)
	{
		//Accepts an user id
		//Gets the total stories written by the user who owns this email address
		//Returns the total
		$statement = "SELECT count(*) FROM story WHERE User_UserId = ?";

		$totalStories = $this->fetchColumn($statement, array($userID));

		return $totalStories;
	}
	public function getTotalStoriesDenied($userID)
	{
		//Accepts an user id
		//Gets the total stories written by the user who owns this email address
		//Returns the total
		$statement = "SELECT count(*) FROM story WHERE User_UserId = ?";

		$totalStories = $this->fetchColumn($statement, array($userID));

		return $totalStories;
	}

	public function getStoriesWrittenByCurrentUser($userID)
	{
		//Accepts a user id
		//Gets an array of stories written by the owner of this user id
		//Returns an array of Story class

		$statement = "SELECT * FROM story WHERE User_UserId = ?";

		$stories = $this->fetchIntoClass($statement, array($userID), "shared/Story");

		return $stories;
	}
	public function getStoriesRecommendedByFriends($userID)
	{
		//Accepts a user id
		//Gets an array of stories that were recommended to the owner of this user id
		//Returns an array of Story class
	}

	public function getStoriesRecommendedByCurrentUser($userID)
	{
		//Accepts a user id
		//Gets an array of stories that were recommended to the owner of this user id
		//Returns an array of Story class
	}


	/******************************************************************************************************************
	*
	*				Account Comments
	*
	******************************************************************************************************************/	

	public function getTotalCommentsApproved($userID)
	{
		//Accepts an user id
		//Gets the total stories written by the user who owns this email address
		//Returns the total
		$statement = "SELECT count(*) FROM story WHERE User_UserId = ?";

		$totalStories = $this->fetchColumn($statement, array($userID));

		return $totalStories;
	}
	public function getTotalCommentsPending($userID)
	{
		//Accepts an user id
		//Gets the total stories written by the user who owns this email address
		//Returns the total
		$statement = "SELECT count(*) FROM story WHERE User_UserId = ?";

		$totalStories = $this->fetchColumn($statement, array($userID));

		return $totalStories;
	}


	/******************************************************************************************************************
	*
	*				Account Followers
	*
	******************************************************************************************************************/	

	public function getTotalFollowers($userID)
	{
		//Accepts a user id
		//Gets the total follower for this userid
		//Returns the total

		$statement = "SELECT count(*) FROM following WHERE User_UserId = ?";

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

		$statement = "SELECT count(*) FROM following WHERE User_FollowerId = ?";

		$totalFollowers = $this->fetchColumn($statement, array($userID));

		return $totalFollowers;
	}
	public function getFollowing($userID)
	{
		//Accepts a user id
		//Gets all users that are following this user id
		//Returns array of user class
	}


	/******************************************************************************************************************
	*
	*				Account Users
	*
	******************************************************************************************************************/	
	
	public function searchForUser($userSearch, $howMany, $page)
	{
		//Accepts a string that will be someones name, how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets an array of users who most closely match the search string
		//Checks if user is following each user (add this to user viewmodel class)
		//Returns an array of User class		

		$statement = "SELECT *, MATCH(FirstName, LastName, Email, MidName) AGAINST('$userSearch') AS score FROM User LIMIT ?, ? WHERE MATCH(FirstName, LastName, Email, MidName) AGAINST(?) ORDER BY score DESC";

		$start = $howMany * ($page - 1);

		$user = $this->fetchIntoClass($statement, array($start, $howMany, $userSearch), "shared/User");

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

		$user = $this->fetchIntoClass($statement, array($start, $howMany), "shared/User");

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

		$user = $this->fetchIntoClass($statement, array($start, $howMany), "shared/User");

		return $user;
	}
}

?>
