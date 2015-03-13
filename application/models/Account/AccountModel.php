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
			//Eliminate array 
			$user = $user[0];

			//echo "<br /><br /><br /><br /><br /><br />". strtotime($user->LockoutTimes) . "<br />" . strtotime('2 minutes') . "<br />" . (strtotime('-1 minutes') > strtotime($user->LockoutTimes));
			if($user->VerifiedEmail && !isset($user->LockoutTimes) || strtotime('+10 minutes') > strtotime($user->LockoutTimes)) //Is user locked out?
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
					if($user->FailedLoginAttempt >= 10)
					{		
						//add a failed login attempt and set the lockout time
						$statement = "UPDATE user SET FailedLoginAttempt = :FailedLoginAttempt, LockoutTimes = :LockoutTimes";
						$statement .= " WHERE UserId = :UserId";

						$parameters = array( 
							":FailedLoginAttempt" => $user->FailedLoginAttempt + 1, 
							":LockoutTimes" => $this->getDateNow(),
							":UserId" => $user->UserId
						);

						//If this is already set, we need to remove the current values as login attempts are reset
						if(isset($user->LockoutTimes))	
						{
							$parameters = array( 
								":FailedLoginAttempt" => 1, 
								":LockoutTimes" => NULL,
								":UserId" => $user->UserId
							);
						}
						
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
		   
	   	$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";                  
		$headers = 	'From: webmaster@example.com' . "\r\n" .
    				'Reply-To: webmaster@example.com' . "\r\n" .
					'X-Mailer: PHP/' . phpversion(); // Set from headers

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

			if($this->fetch($statement, $parameters))
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
		$user->Password = $authentication->hashPassword($user->Password);

		$statement = "INSERT INTO user (Email, Password, LanguageType_LanguageId, FirstName, LastName, MidName, Address, PostalCode, PhoneNumber, VerificationCode, VerifiedEmail, ProfilePrivacyType_PrivacyTypeId, Gender_GenderId, Ethnicity, Birthday)";
		$statement .= " VALUES (:Email, :Password, :LanguageType_LanguageId, :FirstName, :LastName, :MidName, :Address, :PostalCode, :PhoneNumber, :VerificationCode, :VerifiedEmail, :ProfilePrivacyType_PrivacyTypeId, :Gender_GenderId, :Ethnicity, :Birthday)";

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
			":ProfilePrivacyType_PrivacyTypeId" => $user->ProfilePrivacyType_PrivacyTypeId,
			":Gender_GenderId" => $user->Gender_GenderId,
			":Ethnicity" => $user->Ethnicity,
			":Birthday" => $user->Birthday//DateTime::createFromFormat("d/m/Y", $user->Birthday)->format('Y-m-d H:i:s')
		);
		
		//$this->sendEmailVerification($user->Email, $hashedEmailVerification);
		$rowCount = $this->fetchRowCount($statement, $parameters);
		$success = $rowCount > 0;

		//Successfully added a new user
		if($success)
		{
			$userID = $this->lastInsertId();

			//Add security questions, add action statement
			if($this->insertSecurityQuestionAnswer($userID, $user->SecurityQuestionId, $user->SecurityAnswer) &&
				$this->insertUserActionStatement($userID, $user->ActionStatement))
			{
				$success = true;
			}
			else
			{
				//Something strage happened, delete everything
				$this->fetch("DELETE FROM securityquestionanswer WHERE user_UserId = :UserId", array(":UserId" => $userID));
				$this->fetch("DELETE FROM useractionstatement WHERE user_UserId = :UserId", array(":UserId" => $userID));
				$this->fetch("DELETE FROM user WHERE UserId = :UserId", array(":UserId" => $userID));

				$success = false;
			}
		}

		return $success;
	}

	public function insertSecurityQuestionAnswer($userID, $questionID, $questionAnswer)
	{
		$authentication = new Authentication();
		$questionAnswer = $authentication->hashPassword($questionAnswer);

		$statement = "INSERT INTO securityquestionanswer (user_UserId, SecurityQuestion_SecurityQuestionId, SecurityAnswer)";
		$statement .= " VALUES (:user_UserId, :SecurityQuestion_SecurityQuestionId, :SecurityAnswer)";

		$parameters = array( 
			":user_UserId" => $userID, 
			":SecurityQuestion_SecurityQuestionId" => $questionID,
			":SecurityAnswer" => $questionAnswer
		);

		return $this->fetchRowCount($statement, $parameters) > 0;
	}

	public function insertUserActionStatement($userID, $userActionStatement)
	{
		$statement = "INSERT INTO useractionstatement (user_UserId, ActionStatement, Active)";
		$statement .= " VALUES (:user_UserId, :ActionStatement, :Active)";

		$parameters = array( 
			":user_UserId" => $userID,
			":ActionStatement" => $userActionStatement,
			":Active" => true
		);

		return $this->fetchRowCount($statement, $parameters) > 0;
	}
	
	public function updateUserProfile($user)
	{
		$authentication = new Authentication();

		$statement = "UPDATE user SET LanguageType_LanguageId = :LanguageType_LanguageId, Email = :Email, Address = :Address, PostalCode = :PostalCode, PhoneNumber = :PhoneNumber, FirstName = :FirstName, LastName = :LastName, MidName = :MidName, ProfilePrivacyType_PrivacyTypeId = :ProfilePrivacyType_PrivacyTypeId, Gender_GenderId = :Gender_GenderId, Ethnicity = :Ethnicity, Birthday = :Birthday";
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
			":ProfilePrivacyType_PrivacyTypeId" => $user->ProfilePrivacyType_PrivacyTypeId,
			":Gender_GenderId" => $user->Gender_GenderId,
			":Ethnicity" => $user->Ethnicity,
			":Birthday" => $user->Birthday
		);
		
		return $this->fetch($statement, $parameters);
	}

	public function updateSecurityQuestionAnswer($userID, $questionAnswer)
	{
		$statement = "UPDATE securityquestionanswer SET SecurityQuestion_SecurityQuestionId = :SecurityQuestion_SecurityQuestionId, SecurityAnswer = :SecurityAnswer";
		$statement .= " WHERE user_UserId = :user_UserId";

		$authentication = new Authentication();
		$questionAnswer = $authentication->hashPassword($questionAnswer);

		$parameters = array( 
			":user_UserId" => $userID,
			":SecurityAnswer" => $questionAnswer
		);

		return $this->fetch($statement, $parameters);
	}

	public function updateUserActionStatement($userID, $userActionStatement)
	{
		$statement = "INSERT INTO useractionstatement (user_UserId, ActionStatement, Active)";
		$statement .= " VALUES (:user_UserId, :ActionStatement, :Active)";

		$parameters = array( 
			":user_UserId" => $userID,
			":ActionStatement" => $userActionStatement,
			":Active" => false
		);

		return $this->fetch($statement, $parameters);
	}

	public function updateUserLanguagePreference($userId, $languageId)
	{
		$statement = "UPDATE user SET LanguageType_LanguageId = :LanguageType_LanguageId
			 			WHERE UserId = :UserId";

		$parameters = array( 
			":UserId" => $userId,
			":LanguageType_LanguageId" => $languageId
		);

		
		return $this->fetch($statement, $parameters);
	}	
	
	public function getUserProfileByEmail($email)
	{
		$statement = "SELECT * FROM user
						LEFT JOIN useractionstatement u    ON user.UserId = u.user_UserId
						LEFT JOIN securityquestionanswer s ON user.UserId = s.user_UserId
						WHERE user.Email = :Email
						AND user.Active = TRUE";

		$user = $this->fetchIntoClass($statement, array(":Email" => $email), "shared/UserViewModel");

		if(isset($user[0]))
		{
			return $user[0];
		}

		return null;
	}
	public function getUserProfileByID($userID)
	{
		$statement = "SELECT * FROM user
						LEFT JOIN useractionstatement u    ON user.UserId = u.user_UserId
						LEFT JOIN securityquestionanswer s ON user.UserId = s.user_UserId
						WHERE user.UserId = :UserId
						AND user.Active = TRUE";

		$user = $this->fetchIntoClass($statement, array(":UserId" => $userID), "shared/UserViewModel");

		if(isset($user[0]))
		{
			return $user[0];
		}

		return null;
	}

	public function getProfileByEmail($email)
	{
		$statement = "SELECT * FROM user
						LEFT JOIN useractionstatement u    ON user.UserId = u.user_UserId
						LEFT JOIN securityquestionanswer s ON user.UserId = s.user_UserId
						WHERE user.Email = :Email
						AND user.Active = TRUE";

		$user = $this->fetchIntoClass($statement, array(":Email" => $email), "Account/ProfileViewModel");

		if(isset($user[0]))
		{
			return $user[0];
		}

		return null;
	}
	public function getProfileByID($userID)
	{
		$statement = "SELECT * FROM user
						LEFT JOIN useractionstatement u    ON user.UserId = u.user_UserId
						LEFT JOIN securityquestionanswer s ON user.UserId = s.user_UserId
						WHERE user.UserId = :UserId
						AND user.Active = TRUE";

		$user = $this->fetchIntoClass($statement, array(":UserId" => $userID), "Account/ProfileViewModel");

		if(isset($user[0]))
		{
			return $user[0];
		}

		return null;
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

		$statement = "SELECT count(*) 
						FROM following 
						WHERE User_FollowerId = :UserId
						AND Active = TRUE";

		$totalFollowers = $this->fetchNum($statement, array(":UserId" => $userID));

		return $totalFollowers;
	}
	public function getTotalFollowing($userID)
	{
		//Accepts a user id
		//Gets the total amount of people the current user is following
		//Returns the total

		$statement = "SELECT count(*) 
						FROM following 
						WHERE User_UserId = :UserId
						AND Active = TRUE";

		$totalFollowing = $this->fetchNum($statement, array(":UserId" => $userID));

		return $totalFollowing;
	}
	public function followUser($userID, $userToFollowID)
	{
		//Accepts a user id and the id of the user to follow
		//Check that not already following other user
		//Returns bool if saved succesfully

		try
		{
			$statement = "INSERT INTO following (User_UserId, User_FollowerId, DateCreated) 
						  VALUES(:User_UserId, :User_FollowerId, :DateCreated)
						  ON DUPLICATE KEY
						  	UPDATE Active = TRUE";

			$parameters = array(":User_UserId" => $userID, ":User_FollowerId" => $userToFollowID, ":DateCreated" => $this->getDateNow());

			return $this->fetch($statement, $parameters);		
		}
		catch(Exception $e) 
		{
			return $e->getMessage();
		}
	}
	public function unfollowUser($userID, $userToUnFollowID)
	{
		//Accepts a user id and the id of the user to stop following
		//Check that user is following other user
		//Returns bool if saved succesfully

		try
		{
			$statement = "UPDATE following SET Active = FALSE
			 			WHERE User_UserId = :User_UserId
			 			AND User_FollowerId = :User_FollowerId";

			$parameters = array( 
				":User_UserId" => $userID,
				":User_FollowerId" => $userToUnFollowID
			);

			
			return $this->fetch($statement, $parameters);	
		}
		catch(Exception $e) 
		{
			return $e->getMessage();
		}
	}
	public function getFollowers($userID, $howMany = self::HOWMANY, $page = self::PAGE)
	{
		//Accepts a user id
		//Gets all users that are following this userid
		//Returns array of user class
		$statement = "SELECT * 
						FROM user
						INNER JOIN following 
						ON user.UserId = following.User_UserId
						WHERE following.User_FollowerId = :UserId
						AND following.Active = TRUE
						LIMIT :start, :howmany";

		$start = $this-> getStartValue($howMany, $page);

		$parameters = array(
			":UserId" => $userID,
			":start" => $start,
			":howmany" => $howMany
			);


		$followers = $this->fetchIntoClass($statement, $parameters, "shared/UserViewModel");

		return $followers;
	}
	
	public function getFollowing($userID, $howMany = self::HOWMANY, $page = self::PAGE)
	{
		//Accepts a user id
		//Gets all users that this user is following
		//Returns array of user class

		$statement = "SELECT * 
						FROM user
						INNER JOIN following 
						ON user.UserId = following.User_FollowerId
						WHERE following.User_UserId = :UserId
						AND following.Active = TRUE
						LIMIT :start, :howmany";

		$start = $this-> getStartValue($howMany, $page);

		$parameters = array(			
			":start" => $start,
			":howmany" => $howMany,
			":UserId" => $userID
			);

		$following = $this->fetchIntoClass($statement, $parameters, "shared/UserViewModel");

		return $following;
	}


	/******************************************************************************************************************
	*
	*				Account Users
	*
	******************************************************************************************************************/	
	
	public function searchForUser($userSearch, $userId, $howMany = self::HOWMANY, $page = self::PAGE)
	{
		//Accepts a string that will be someones name, how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets an array of users who most closely match the search string
		//Checks if user is following each user (add this to user viewmodel class)
		//Returns an array of User class		

		$userSearch = explode(" ", strtolower($userSearch));

		$fName = " ";
		$lName = " ";

		if(count($userSearch) > 1)
		{
			$fName = "%" . $userSearch[0] . "%";
			
			for ($i=1; $i < count($userSearch); $i++) { 
				$lName .= $userSearch[$i] . " ";
			}

			$lName = trim($lName);
			$lName = "%" . $lName . "%";
		}
		else
		{
			$fName = "%" . $userSearch[0] . "%";
			$lName = "%" . $userSearch[0] . "%";
		}

		$statement = "SELECT u.*,

						f.Active AS FollowingUser,

						uas.ActionStatement,

						(
							SELECT COUNT(1)
							FROM user_recommend_story 
							WHERE user_recommend_story.User_UserId = u.UserId
						    AND user_recommend_story.Active = TRUE
						    AND user_recommend_story.Opinion = TRUE
						) AS totalRecommends,
						
						(
							SELECT COUNT(1)
							FROM story 
							WHERE story.User_UserId = u.UserId
						    AND story.Active = TRUE
						    AND story.Published = TRUE
						) AS totalPublishedStories,
						
						(
							SELECT COUNT(1)
							FROM comment 
							WHERE comment.User_UserId = u.UserId
						    AND comment.Active = TRUE
						    AND comment.PublishFlag = TRUE
						) AS totalPublishedComments,

						(
							SELECT COUNT(1)
							FROM following 
							WHERE following.User_FollowerId = u.UserId
						    AND following.Active = TRUE
						) AS totalFollowers,

						((LOWER(FirstName) LIKE :firstName) + 
						(LOWER(LastName) LIKE :lastName)) as hits
						FROM   user u

						LEFT JOIN following f
						ON (f.User_FollowerId = u.UserId) AND (f.User_UserId = :UserId) AND (f.Active = TRUE)

						LEFT JOIN useractionstatement uas
						ON (uas.User_UserId = u.UserId) AND (uas.Active = TRUE)

						WHERE u.Active = TRUE
						
						ORDER BY hits DESC
						LIMIT :start, :howmany";

		$start = $this-> getStartValue($howMany, $page);

		$parameters = array(
			":lastName" => $lName,
			":firstName" => $fName,
			":UserId" => $userId,
			//":UserId2" => $userId,
			//":UserId3" => $userId,
			":start" => $start,
			":howmany" => $howMany
			);

		$users = $this->fetchIntoClass($statement, $parameters, "shared/UserViewModel");

		return $users;
	}

	public function getUserList($howMany = self::HOWMANY, $page = self::PAGE)
	{
		//Accepts how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Checks if user is following each user (add this to user viewmodel class)
		//Users must have verified flag set to true
		//Returns an array of User class

		$statement = "SELECT * 
						FROM user 
						WHERE user.Active = TRUE  
						LIMIT :start, :howmany";

		$start = $this->getStartValue($howMany, $page);

		$parameters = array(
			":start" => $start,
			":howmany" => $howMany
			);

		$users = $this->fetchIntoClass($statement, $parameters, "shared/UserViewModel");

		return $users;
	}

	public function getLatestUserList($userId, $howMany = self::HOWMANY, $page = self::PAGE)
	{
		//Accepts how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Checks if user is following each user (add this to user viewmodel class)
		//Gets a list of the most recently registered users
		//Users must have verified flag set to true
		//Returns an array of User class

		$statement = "SELECT u.*,

						f.Active AS FollowingUser,

						uas.ActionStatement,

						(
							SELECT COUNT(1)
							FROM user_recommend_story 
							WHERE user_recommend_story.User_UserId = u.UserId
						    AND user_recommend_story.Active = TRUE
						    AND user_recommend_story.Opinion = TRUE
						) AS totalRecommends,
						
						(
							SELECT COUNT(1)
							FROM story 
							WHERE story.User_UserId = u.UserId
						    AND story.Active = TRUE
						    AND story.Published = TRUE
						) AS totalPublishedStories,
						
						(
							SELECT COUNT(1)
							FROM comment 
							WHERE comment.User_UserId = u.UserId
						    AND comment.Active = TRUE
						    AND comment.PublishFlag = TRUE
						) AS totalPublishedComments,

						(
							SELECT COUNT(1)
							FROM following 
							WHERE following.User_FollowerId = u.UserId
						    AND following.Active = TRUE
						) AS totalFollowers

						FROM   user u

						LEFT JOIN following f
						ON (f.User_FollowerId = u.UserId) AND (f.User_UserId = :UserId) AND (f.Active = TRUE)

						LEFT JOIN useractionstatement uas
						ON (uas.User_UserId = u.UserId) AND (uas.Active = TRUE)

						WHERE u.Active = TRUE
						ORDER BY u.DateCreated
						LIMIT :start, :howmany";

		$start = $this-> getStartValue($howMany, $page);

		$parameters = array(
			":UserId" => $userId,
			//":UserId2" => $userId,
			//":UserId3" => $userId,
			":start" => $start,
			":howmany" => $howMany
			);

		$users = $this->fetchIntoClass($statement, $parameters, "shared/UserViewModel");

		return $users;
	}

	public function getMostFollowersUserList($userId, $howMany = self::HOWMANY, $page = self::PAGE)
	{
		//Accepts how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Checks if user is following each user (add this to user viewmodel class)
		//Gets a list of the most recently registered users
		//Users must have verified flag set to true
		//Returns an array of User class

		$statement = "SELECT u.*,

						f.Active AS FollowingUser,

						uas.ActionStatement,

						(
							SELECT COUNT(1)
							FROM user_recommend_story 
							WHERE user_recommend_story.User_UserId = u.UserId
						    AND user_recommend_story.Active = TRUE
						    AND user_recommend_story.Opinion = TRUE
						) AS totalRecommends,
						
						(
							SELECT COUNT(1)
							FROM story 
							WHERE story.User_UserId = u.UserId
						    AND story.Active = TRUE
						    AND story.Published = TRUE
						) AS totalPublishedStories,
						
						(
							SELECT COUNT(1)
							FROM comment 
							WHERE comment.User_UserId = u.UserId
						    AND comment.Active = TRUE
						    AND comment.PublishFlag = TRUE
						) AS totalPublishedComments,

						(
							SELECT COUNT(1)
							FROM following 
							WHERE following.User_FollowerId = u.UserId
						    AND following.Active = TRUE
						) AS totalFollowers

						FROM   user u

						LEFT JOIN following f
						ON (f.User_FollowerId = u.UserId) AND (f.User_UserId = :UserId) AND (f.Active = TRUE)

						LEFT JOIN useractionstatement uas
						ON (uas.User_UserId = u.UserId) AND (uas.Active = TRUE)

						WHERE u.Active = TRUE
						ORDER BY totalFollowers DESC
						LIMIT :start, :howmany";

		$start = $this-> getStartValue($howMany, $page);

		$parameters = array(
			":UserId" => $userId,
			//":UserId2" => $userId,
			//":UserId3" => $userId,
			":start" => $start,
			":howmany" => $howMany
			);

		$users = $this->fetchIntoClass($statement, $parameters, "shared/UserViewModel");

		return $users;
	}
}

?>
