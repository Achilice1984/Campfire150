<?php

class AccountModel extends Model {

	/******************************************************************************************************************
	*
	*				Account Authentication
	*
	******************************************************************************************************************/

	public function login($loginViewModel)
	{	
		try
		{
			$authentication = new Authentication();
			$isUserLoggedIn = false;

			$statement = "SELECT * FROM user WHERE Email = :Email";

			//Get user that matches email address
			$user = $this->fetchIntoClass($statement, array(":Email" => $loginViewModel->Email), "shared/UserViewModel");		

			// Does a user exists?
			if (isset($user[0])) 
			{
				//Eliminate array 
				$user = $user[0];

				//echo "<br /><br /><br /><br /><br /><br />". strtotime($user->LockoutTimes) . "<br />" . strtotime('2 minutes') . "<br />" . (strtotime('-1 minutes') > strtotime($user->LockoutTimes));
				if(!isset($user->LockoutTimes) || strtotime('+10 minutes') > strtotime($user->LockoutTimes)) //Is user locked out?
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

						if($user->VerifiedEmail == TRUE)
						{
							$isUserLoggedIn = true;
						}
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
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	public function logout()
	{	
		try
		{
			session_destroy();
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	public function updateUserPassword($user, $changePasswordViewModel)
	{
		//Accepts an email address, a new password, and an old password
		//Verifies that old password and email match
		//Updates the password in the database with the new password
		//Returns true or false if the password was updated properly or not		
		try
		{
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
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	public function sendEmailVerification($email, $hashedEmailVerification)
	{
		try
		{
			$message = '<html stlye="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;">
						<head>
							<title>Campfire 150</title>
						</head>
						<body style="padding:0; margin:0;">
							<div style="background-color: #f8f8f8; padding: 40px;">
								<h1 style="text-align: center; color: #333; font-weight: bolder; font-size: 4em;">Campfire 150! <small style="font-size: .4em; color:#808080;"><br />Share your story. Shape our future.</small></h1>
							</div>
							<div style="padding: 10%; padding-right: 0px; color: #333;">
								<h1>Your almost done!</h1>

								<p>Thank you so much for registering with Campfire 150!</p>
								<p>Your profile is almost set up, just click the link below to activate your account.</p>
								<a style="background-color: #eea236; padding: 10px; color:white; text-decoration: none; width:250px;" href="' . BASE_URL . 'account/verifyemail/' . $email . '/' . $hashedEmailVerification . '">Active Now!</a>
							</div>
							<div style="background-color: #2e6da4; color:white; min-width:450px;">
								<article style="display:block; padding: 100px; padding-bottom: 200px;">
									<h1 style="font-size: 2.4em;">Trending</h1>
									<div style="width:50px;	height:50px; border-radius:50%;	font-size:10px; color:#fff; line-height:50px; text-align:center; background:#eea236; margin: 10px; float: left;">Canada</div>
									<div style="width:50px;	height:50px; border-radius:50%;	font-size:10px; color:#fff; line-height:50px; text-align:center; background:#eea236; margin: 10px; float: left;">Art</div>
									<div style="width:50px;	height:50px; border-radius:50%;	font-size:10px; color:#fff; line-height:50px; text-align:center; background:#eea236; margin: 10px; float: left;">Technology</div>
									<div style="width:50px;	height:50px; border-radius:50%;	font-size:10px; color:#fff; line-height:50px; text-align:center; background:#eea236; margin: 10px; float: left;">Winter</div>
									<div style="width:50px;	height:50px; border-radius:50%;	font-size:10px; color:#fff; line-height:50px; text-align:center; background:#eea236; margin: 10px; float: left;">People</div>
									<div style="width:50px;	height:50px; border-radius:50%;	font-size:10px; color:#fff; line-height:50px; text-align:center; background:#eea236; margin: 10px; float: left;">Time</div>
								</article>		
							</div>
							<div style="padding: 10%; padding-right: 0px; color: #333;">
								<article style="width:100%; display:block;">
									<h1 style="font-size: 2.4em;">How the Campfire Works</h1>
									<ol style="font-size: 1.4em;">
										<li>Submit a story</li>
										<li>Answer some simple questions</li>
										<li>We all create a national story</li>
										<li>Repeat</li>
									</ol>

									<h1 style="font-size: 2.4em;">Enjoy!</h1>
								</article>
							</div>
						</body>
					</html>'; 
			   
		   	$to      = $email;
			$subject = 'Welcome to Campfire 150';
			$headers = 'From: admin@campfire150.com' . "\r\n" .
			    'Reply-To: admin@campfire150.com' . "\r\n" .
			    'Content-Type: text/html; charset=ISO-8859-1' . "\r\n" .
			    'X-Mailer: PHP/' . phpversion();

			mail($to, $subject, $message, $headers);
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	public function verifiyEmail($email, $hashedValue)
	{
		//Accepts users email address and some hashed value
		//Checks that email address and hashedValue matches in the database
		//Sets verified flag to true
		//return bool

		try
		{
			$statement = "SELECT * FROM user WHERE Email = :Email AND VerificationCode = :HashCode";

			$user = $this->fetchIntoClass($statement, array(":Email" => $email, ":HashCode" => $hashedValue), "shared/UserViewModel");

			$verified = false;
			
			//Does everything match?
			if(isset($user[0]))
			{			
				$updateStatement = "UPDATE user SET VerifiedEmail = TRUE
									WHERE user.UserId = :UserId";

				$this->fetch($updateStatement, array(":UserId" => $user[0]->UserId));
			}

			$statement = "SELECT * FROM user WHERE Email = :Email";

			$user = $this->fetchIntoClass($statement, array(":Email" => $email), "shared/UserViewModel");
			if(isset($user[0]) && $user[0]->VerifiedEmail == TRUE)
			{
				$verified = TRUE;
			}

			return $verified;
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
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

		try
		{
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
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	public function removeImageMetadata($pictureId)
	{
		try
		{
			$statement = "UPDATE picture SET Active = FALSE";
			$statement .= " WHERE PictureId = :PictureId";

			$parameters = array( 
				":PictureId" => $pictureId
			);

			return $this->fetch($statement, $parameters);
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	public function getCurrentProfilePictureMetadata($userId)
	{
		try
		{
			// 1 == profile picture
			$statement = "SELECT * FROM picture WHERE User_UserId = :User_UserId AND picturetype_PictureTypeId = 1 AND Active = TRUE";

			$pictureViewModel = $this->fetchIntoClass($statement, array(":User_UserId" => $userId), "shared/PictureViewModel");

			if(isset($pictureViewModel[0]))
			{
				return $pictureViewModel[0];
			}

			return null;
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	public function getCurrentBackgroundPictureMetadata($userId)
	{
		try
		{
			// 2 == background picture
			$statement = "SELECT * FROM picture WHERE User_UserId = :User_UserId AND picturetype_PictureTypeId = 2 AND Active = TRUE";

			$pictureViewModel = $this->fetchIntoClass($statement, array(":User_UserId" => $userId), "shared/PictureViewModel");

			if(isset($pictureViewModel[0]))
			{
				return $pictureViewModel[0];
			}

			return null;
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	public function getPictureMetadataByPictureId($pictureId)
	{
		try
		{
			$statement = "SELECT * FROM picture WHERE PictureId = :PictureId AND Active = TRUE";

			$pictureViewModel = $this->fetchIntoClass($statement, array(":PictureId" => $pictureId), "shared/PictureViewModel");

			if(isset($pictureViewModel[0]))
			{
				return $pictureViewModel[0];
			}

			return null;
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	


	/******************************************************************************************************************
	*
	*				Account Profile
	*
	******************************************************************************************************************/	

	public function registerUserProfile($user)
	{	
		try
		{
			$authentication = new Authentication();
			$user->Password = $authentication->hashPassword($user->Password);

			$statement = "INSERT INTO user (YearsInCanada, Email, Password, LanguageType_LanguageId, FirstName, LastName, MidName, Address, PostalCode, PhoneNumber, VerificationCode, VerifiedEmail, ProfilePrivacyType_PrivacyTypeId, Gender_GenderId, Ethnicity, Birthday)";
			$statement .= " VALUES (:YearsInCanada, :Email, :Password, :LanguageType_LanguageId, :FirstName, :LastName, :MidName, :Address, :PostalCode, :PhoneNumber, :VerificationCode, :VerifiedEmail, :ProfilePrivacyType_PrivacyTypeId, :Gender_GenderId, :Ethnicity, :Birthday)";

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
				":VerifiedEmail" => FALSE,
				":ProfilePrivacyType_PrivacyTypeId" => $user->ProfilePrivacyType_PrivacyTypeId,
				":Gender_GenderId" => $user->Gender_GenderId,
				":Ethnicity" => $user->Ethnicity,
				":Birthday" => $user->Birthday,
				":YearsInCanada" => $user->YearsInCanada//DateTime::createFromFormat("d/m/Y", $user->Birthday)->format('Y-m-d H:i:s')
			);
			
			$this->sendEmailVerification($user->Email, $hashedEmailVerification);
			$rowCount = $this->fetchRowCount($statement, $parameters);
			$success = $rowCount > 0;

			//Successfully added a new user
			if($success)
			{
				$userID = $this->lastInsertId();

				//Add security questions, add action statement
				if($this->insertSecurityQuestionAnswer($userID, $user->SecurityQuestionId, $user->SecurityAnswer))
					//&& $this->insertUserActionStatement($userID, $user->ActionStatement))
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
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	public function insertSecurityQuestionAnswer($userID, $questionID, $questionAnswer)
	{
		try
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

			return $this->fetch($statement, $parameters);
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	public function insertUserActionStatement($userID, $userActionStatement)
	{
		try
		{
			$statement = "INSERT INTO useractionstatement (user_UserId, ActionStatement, Active, DateCreated)";
			$statement .= " VALUES (:user_UserId, :ActionStatement, :Active, :DateCreated)";

			$parameters = array( 
				":user_UserId" => $userID,
				":ActionStatement" => $userActionStatement,
				":Active" => true,
				":DateCreated" => $this->getDateNow()
			);

			return $this->fetch($statement, $parameters) > 0;
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}
	
	public function updateUserProfile($user)
	{
		try
		{
			$authentication = new Authentication();

			$statement = "UPDATE user SET YearsInCanada = :YearsInCanada, LanguageType_LanguageId = :LanguageType_LanguageId, Email = :Email, Address = :Address, PostalCode = :PostalCode, PhoneNumber = :PhoneNumber, FirstName = :FirstName, LastName = :LastName, MidName = :MidName, ProfilePrivacyType_PrivacyTypeId = :ProfilePrivacyType_PrivacyTypeId, Gender_GenderId = :Gender_GenderId, Ethnicity = :Ethnicity, Birthday = :Birthday";
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
				":Birthday" => $user->Birthday,
				":YearsInCanada" => $user->YearsInCanada
			);
			
			return $this->fetch($statement, $parameters);
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	public function updateSecurityQuestionAnswer($userID, $questionAnswerViewModel)
	{
		try
		{
			$authentication = new Authentication();

			$statement = "SELECT * FROM user WHERE UserId = :UserId";

			//Get user that matches email address
			$user = $this->fetchIntoClass($statement, array(":UserId" => $userID), "shared/UserViewModel");

			// Does a user exists?
			if (isset($user[0])) 
			{
				//Eliminate array 
				$user = $user[0];

				//check to see if user is properly authenticated
				if($authentication->authenticate($questionAnswerViewModel->Password, $user)) //Is user peoperly authenticated?
				{
					$statement = "SELECT * 
									FROM securityquestionanswer sqa
									WHERE sqa.Active = TRUE
									AND sqa.user_UserId = :user_UserId";

					$rowCount = $this->fetchRowCount($statement, array(":user_UserId" => $userID));

					if($rowCount > 0)
					{
						$statement = "UPDATE securityquestionanswer SET SecurityQuestion_SecurityQuestionId = :SecurityQuestion_SecurityQuestionId, SecurityAnswer = :SecurityAnswer";
						$statement .= " WHERE user_UserId = :user_UserId";

						$parameters = array( 
							":user_UserId" => $userID,
							":SecurityAnswer" => $authentication->hashPassword($questionAnswerViewModel->SecurityAnswer),
							":SecurityQuestion_SecurityQuestionId" => $questionAnswerViewModel->SecurityQuestionId
						);

						return $this->fetch($statement, $parameters);
					}
					else
					{
						return $this->insertSecurityQuestionAnswer($userID, $questionAnswerViewModel->SecurityQuestionId, $questionAnswerViewModel->SecurityAnswer);
					}
				}
			}	
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	public function updateUserActionStatement($userID)
	{
		try
		{
			$statement = "UPDATE useractionstatement SET Active = FALSE, DateDeactived = :Deactive
			 				WHERE User_UserId = :user_UserId 
			 				AND Active = TRUE";

			$parameters = array( 
				":user_UserId" => $userID,
				":Deactive" => $this->getDateNow()
			);

			return $this->fetch($statement, $parameters);
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	public function updateUserAbout($userID, $content)
	{
		try
		{
			$statement = "UPDATE user SET About = :Content
			 				WHERE UserId = :user_UserId";

			$parameters = array( 
				":user_UserId" => $userID,
				":Content" => $content
			);

			return $this->fetch($statement, $parameters);
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	public function updateUserLanguagePreference($userId, $languageId)
	{
		try
		{
			$statement = "UPDATE user SET LanguageType_LanguageId = :LanguageType_LanguageId
				 			WHERE UserId = :UserId";

			$parameters = array( 
				":UserId" => $userId,
				":LanguageType_LanguageId" => $languageId
			);

			
			return $this->fetch($statement, $parameters);
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}	
	
	public function getUserProfileByEmail($email)
	{
		try
		{
			$statement = "SELECT * FROM user
							LEFT JOIN useractionstatement u    ON user.UserId = u.user_UserId  AND u.Active = TRUE
							LEFT JOIN securityquestionanswer s ON user.UserId = s.user_UserId
							WHERE user.Email = :Email
							AND user.Active = TRUE
							AND user.VerifiedEmail = TRUE";

			$user = $this->fetchIntoClass($statement, array(":Email" => $email), "shared/UserViewModel");

			if(isset($user[0]))
			{
				return $user[0];
			}

			return null;
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}
	public function getUserProfileByID($userID)
	{
		try
		{
			$statement = "SELECT * FROM user
							LEFT JOIN useractionstatement u    ON user.UserId = u.user_UserId AND u.Active = TRUE
							LEFT JOIN securityquestionanswer s ON user.UserId = s.user_UserId
							WHERE user.UserId = :UserId
							AND user.Active = TRUE
							AND user.VerifiedEmail = TRUE";

			$user = $this->fetchIntoClass($statement, array(":UserId" => $userID), "shared/UserViewModel");

			if(isset($user[0]))
			{
				return $user[0];
			}

			return null;
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	public function getUserProfileByID_home($currentUserId, $userID)
	{
		try
		{
			$statement = "SELECT user.UserId, user.FirstName, user.LastName, user.DateCreated, user.About, user.ProfilePrivacyType_PrivacyTypeId, user.Active,
							
							pp.PictureId as ProfilePictureId,

							bp.PictureId as BackgroundPictureId,
							
							u.ActionStatement as UserActionStatement,
							f.Active AS FollowingUser

							FROM user

							LEFT JOIN useractionstatement u    ON user.UserId = u.user_UserId AND u.Active = TRUE
							LEFT JOIN securityquestionanswer s ON user.UserId = s.user_UserId

							LEFT JOIN picture pp 
							ON user.UserId = pp.User_UserId AND (pp.Picturetype_PictureTypeId = 1) AND (pp.Active = TRUE)

							LEFT JOIN picture bp 
							ON user.UserId = bp.User_UserId AND (bp.Picturetype_PictureTypeId = 2) AND (bp.Active = TRUE)


							LEFT JOIN following f
							ON (f.User_FollowerId = user.UserId) AND (f.User_UserId = :CurrentUserId) AND (f.Active = TRUE)

							WHERE user.UserId = :UserId
							AND user.Active = TRUE
							AND user.VerifiedEmail = TRUE";

			$user = $this->fetchIntoClass($statement, array(":UserId" => $userID, ":CurrentUserId" => $currentUserId), "shared/UserViewModel");

			if(isset($user[0]))
			{
				return $user[0];
			}

			return null;
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	public function getProfileByEmail($email)
	{
		try
		{
			$statement = "SELECT user.* FROM user,

							LEFT JOIN useractionstatement uas ON user.UserId = uas.user_UserId AND uas.Active = TRUE
							LEFT JOIN securityquestionanswer sq ON user.UserId = s.user_UserId
							WHERE user.Email = :Email
							AND user.Active = TRUE
							AND user.VerifiedEmail = TRUE";

			$user = $this->fetchIntoClass($statement, array(":Email" => $email), "Account/ProfileViewModel");

			if(isset($user[0]))
			{
				return $user[0];
			}

			return null;
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}
	public function getProfileByID($userID)
	{
		try
		{
			$statement = "SELECT user.*
							
							FROM user

							LEFT JOIN useractionstatement uas    
							ON user.UserId = uas.user_UserId AND uas.Active = TRUE

							WHERE user.UserId = :UserId
							AND user.Active = TRUE
							AND user.VerifiedEmail = TRUE";

			$user = $this->fetchIntoClass($statement, array(":UserId" => $userID), "Account/ProfileViewModel");

			if(isset($user[0]))
			{
				return $user[0];
			}

			return null;
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
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

		try
		{
			$statement = "SELECT count(*) 
							FROM following f

							LEFT JOIN user u 
							ON u.UserId = f.User_UserId

							WHERE f.User_FollowerId = :UserId
							AND u.Active = TRUE
							AND u.ProfilePrivacyType_PrivacyTypeId = 1
							AND u.VerifiedEmail = TRUE
							AND f.Active = TRUE";

			$totalFollowers = $this->fetchNum($statement, array(":UserId" => $userID));

			return $totalFollowers;
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}
	public function getTotalFollowing($userID)
	{
		//Accepts a user id
		//Gets the total amount of people the current user is following
		//Returns the total

		try
		{
			$statement = "SELECT count(*) 
							FROM following f

							LEFT JOIN user u 
							ON u.UserId = f.User_FollowerId

							WHERE f.User_UserId = :UserId
							AND f.Active = TRUE
							AND u.Active = TRUE
							AND u.VerifiedEmail = TRUE
							AND u.ProfilePrivacyType_PrivacyTypeId = 1";

			$totalFollowing = $this->fetchNum($statement, array(":UserId" => $userID));

			return $totalFollowing;
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
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
	// public function getFollowers($userID, $howMany = self::HOWMANY, $page = self::PAGE)
	// {
	// 	//Accepts a user id
	// 	//Gets all users that are following this userid
	// 	//Returns array of user class
	// 	$statement = "SELECT * 
	// 					FROM user
	// 					INNER JOIN following 
	// 					ON user.UserId = following.User_UserId
	// 					WHERE following.User_FollowerId = :UserId
	// 					AND following.Active = TRUE
	// 					LIMIT :start, :howmany";

	// 	$start = $this-> getStartValue($howMany, $page);

	// 	$parameters = array(
	// 		":UserId" => $userID,
	// 		":start" => $start,
	// 		":howmany" => $howMany
	// 		);


	// 	$followers = $this->fetchIntoClass($statement, $parameters, "shared/UserViewModel");

	// 	return $followers;
	// }

	public function getFollowers($userID, $howMany = MAX_USERS_LISTS, $page = self::PAGE)
	{
		//Accepts a user id
		//Gets all users that this user is following
		//Returns array of user class

		try
		{
			$statement = "SELECT u.UserId, u.FirstName, u.LastName, u.DateCreated, u.About, 

							f.Active AS FollowingUser,

							uas.ActionStatement,

							up.PictureId as UserProfilePicureId,

							(
								SELECT COUNT(1)
								FROM user_recommend_story 

								INNER JOIN story 
								ON (story.StoryId = user_recommend_story.Story_StoryId) AND (story.Active = TRUE) AND (story.Published = TRUE) AND (story.StoryPrivacyType_StoryPrivacyTypeId = 1)

								INNER JOIN user 
								ON (user.UserId = story.User_UserId) AND (user.Active = TRUE) AND (user.ProfilePrivacyType_PrivacyTypeId = 1)

								INNER JOIN admin_approve_story 
								ON (admin_approve_story.Story_StoryId = story.StoryId) AND (admin_approve_story.Approved = TRUE) AND (admin_approve_story.Active = TRUE)

								WHERE user_recommend_story.User_UserId = u.UserId
							    AND user_recommend_story.Active = TRUE
							    AND user_recommend_story.Opinion = TRUE
							) AS totalRecommends,
							
							(
								SELECT COUNT(1)
								FROM story 
								LEFT JOIN admin_approve_story
								ON (admin_approve_story.Story_StoryId = story.StoryId) AND (admin_approve_story.Active = TRUE)
								WHERE story.User_UserId = u.UserId
							    AND story.Active = TRUE
							    AND story.Published = TRUE
							    AND story.StoryPrivacyType_StoryPrivacyTypeId = 1
							    AND admin_approve_story.Approved = TRUE
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

							FROM user u
							LEFT JOIN following f
							ON (f.User_UserId = u.UserId) AND (f.User_FollowerId = :UserId) AND (f.Active = TRUE)

							LEFT JOIN useractionstatement uas
							ON (uas.User_UserId = u.UserId) AND (uas.Active = TRUE)

							LEFT JOIN picture up
							ON (up.User_UserId = u.UserId) AND (up.Active = TRUE) AND (Picturetype_PictureTypeId = 1)

							WHERE u.Active = TRUE
							AND u.ProfilePrivacyType_PrivacyTypeId = 1
							AND u.VerifiedEmail = TRUE
							AND f.Active = TRUE
							GROUP BY u.UserId
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
		catch(Exception $ex)
		{
			throw $ex;
		}
	}
	
	public function getFollowing($userID, $howMany = MAX_USERS_LISTS, $page = self::PAGE)
	{
		//Accepts a user id
		//Gets all users that this user is following
		//Returns array of user class

		try
		{
			$statement = "SELECT u.UserId, u.FirstName, u.LastName, u.DateCreated, u.About, 

							f.Active AS FollowingUser,

							uas.ActionStatement,

							up.PictureId as UserProfilePicureId,

							(
								SELECT COUNT(1)
								FROM user_recommend_story 

								INNER JOIN story 
								ON (story.StoryId = user_recommend_story.Story_StoryId) AND (story.Active = TRUE) AND (story.Published = TRUE) AND (story.StoryPrivacyType_StoryPrivacyTypeId = 1)

								INNER JOIN user 
								ON (user.UserId = story.User_UserId) AND (user.Active = TRUE) AND (user.ProfilePrivacyType_PrivacyTypeId = 1)

								INNER JOIN admin_approve_story 
								ON (admin_approve_story.Story_StoryId = story.StoryId) AND (admin_approve_story.Approved = TRUE) AND (admin_approve_story.Active = TRUE)

								WHERE user_recommend_story.User_UserId = u.UserId
							    AND user_recommend_story.Active = TRUE
							    AND user_recommend_story.Opinion = TRUE
							) AS totalRecommends,
							
							(
								SELECT COUNT(1)
								FROM story 
								LEFT JOIN admin_approve_story
								ON (admin_approve_story.Story_StoryId = story.StoryId) AND (admin_approve_story.Active = TRUE)
								WHERE story.User_UserId = u.UserId
							    AND story.Active = TRUE
							    AND story.Published = TRUE
							    AND story.StoryPrivacyType_StoryPrivacyTypeId = 1
							    AND admin_approve_story.Approved = TRUE
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

							FROM user u
							LEFT JOIN following f
							ON (f.User_FollowerId = u.UserId) AND (f.User_UserId = :UserId) AND (f.Active = TRUE)

							LEFT JOIN useractionstatement uas
							ON (uas.User_UserId = u.UserId) AND (uas.Active = TRUE)

							LEFT JOIN picture up
							ON (up.User_UserId = u.UserId) AND (up.Active = TRUE) AND (Picturetype_PictureTypeId = 1)

							WHERE u.Active = TRUE
							AND u.ProfilePrivacyType_PrivacyTypeId = 1
							AND u.VerifiedEmail = TRUE
							AND f.Active = TRUE
							GROUP BY u.UserId
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
		catch(Exception $ex)
		{
			throw $ex;
		}
	}


	/******************************************************************************************************************
	*
	*				Account Users
	*
	******************************************************************************************************************/	
	
	public function searchForUser($userSearch, $userId, $howMany = MAX_USERS_LISTS, $page = self::PAGE)
	{
		//Accepts a string that will be someones name, how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Gets an array of users who most closely match the search string
		//Checks if user is following each user (add this to user viewmodel class)
		//Returns an array of User class		

		try
		{
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

			$statement = "SELECT u.UserId, u.FirstName, u.LastName, u.DateCreated, u.About, 

							f.Active AS FollowingUser,

							uas.ActionStatement,

							up.PictureId as UserProfilePicureId,

							(
								SELECT COUNT(1)
								FROM user_recommend_story 

								INNER JOIN story 
								ON (story.StoryId = user_recommend_story.Story_StoryId) AND (story.Active = TRUE) AND (story.Published = TRUE) AND (story.StoryPrivacyType_StoryPrivacyTypeId = 1)

								INNER JOIN user 
								ON (user.UserId = story.User_UserId) AND (user.Active = TRUE) AND (user.ProfilePrivacyType_PrivacyTypeId = 1)

								INNER JOIN admin_approve_story 
								ON (admin_approve_story.Story_StoryId = story.StoryId) AND (admin_approve_story.Approved = TRUE) AND (admin_approve_story.Active = TRUE)

								WHERE user_recommend_story.User_UserId = u.UserId
							    AND user_recommend_story.Active = TRUE
							    AND user_recommend_story.Opinion = TRUE
							) AS totalRecommends,
							
							(
								SELECT COUNT(1)
								FROM story 
								LEFT JOIN admin_approve_story
								ON (admin_approve_story.Story_StoryId = story.StoryId) AND (admin_approve_story.Active = TRUE)
								WHERE story.User_UserId = u.UserId
							    AND story.Active = TRUE
							    AND story.Published = TRUE
							    AND story.StoryPrivacyType_StoryPrivacyTypeId = 1
							    AND admin_approve_story.Approved = TRUE
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

							LEFT JOIN picture up
							ON (up.User_UserId = u.UserId) AND (up.Active = TRUE) AND (Picturetype_PictureTypeId = 1)

							WHERE u.Active = TRUE
							AND u.ProfilePrivacyType_PrivacyTypeId = 1
							AND u.VerifiedEmail = TRUE
							GROUP BY u.UserId
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
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	public function getUserList($howMany = MAX_USERS_LISTS, $page = self::PAGE)
	{
		//Accepts how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Checks if user is following each user (add this to user viewmodel class)
		//Users must have verified flag set to true
		//Returns an array of User class

		try
		{
			$statement = "SELECT * 
							FROM user 
							WHERE user.Active = TRUE  
							AND user.VerifiedEmail = TRUE
							LIMIT :start, :howmany";

			$start = $this->getStartValue($howMany, $page);

			$parameters = array(
				":start" => $start,
				":howmany" => $howMany
				);

			$users = $this->fetchIntoClass($statement, $parameters, "shared/UserViewModel");

			return $users;
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	public function getLatestUserList($userId, $howMany = MAX_USERS_LISTS, $page = self::PAGE)
	{
		//Accepts how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Checks if user is following each user (add this to user viewmodel class)
		//Gets a list of the most recently registered users
		//Users must have verified flag set to true
		//Returns an array of User class

		try
		{
			$statement = "SELECT u.UserId, u.FirstName, u.LastName, u.DateCreated, u.About, 

							f.Active AS FollowingUser,

							uas.ActionStatement,

							up.PictureId as UserProfilePicureId,

							(
								SELECT COUNT(1)
								FROM user_recommend_story 

								INNER JOIN story 
								ON (story.StoryId = user_recommend_story.Story_StoryId) AND (story.Active = TRUE) AND (story.Published = TRUE) AND (story.StoryPrivacyType_StoryPrivacyTypeId = 1)

								INNER JOIN user 
								ON (user.UserId = story.User_UserId) AND (user.Active = TRUE) AND (user.ProfilePrivacyType_PrivacyTypeId = 1)

								INNER JOIN admin_approve_story 
								ON (admin_approve_story.Story_StoryId = story.StoryId) AND (admin_approve_story.Approved = TRUE) AND (admin_approve_story.Active = TRUE)

								WHERE user_recommend_story.User_UserId = u.UserId
							    AND user_recommend_story.Active = TRUE
							    AND user_recommend_story.Opinion = TRUE
							) AS totalRecommends,
							
							(
								SELECT COUNT(1)
								FROM story 
								LEFT JOIN admin_approve_story
								ON (admin_approve_story.Story_StoryId = story.StoryId) AND (admin_approve_story.Active = TRUE)
								WHERE story.User_UserId = u.UserId
							    AND story.Active = TRUE
							    AND story.Published = TRUE
							    AND story.StoryPrivacyType_StoryPrivacyTypeId = 1
							    AND admin_approve_story.Approved = TRUE						    
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

							LEFT JOIN picture up
							ON (up.User_UserId = u.UserId) AND (up.Active = TRUE) AND (Picturetype_PictureTypeId = 1)

							WHERE u.Active = TRUE
							AND u.ProfilePrivacyType_PrivacyTypeId = 1
							AND u.VerifiedEmail = TRUE
							GROUP BY u.UserId
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
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	public function getMostFollowersUserList($userId, $howMany = MAX_USERS_LISTS, $page = self::PAGE)
	{
		//Accepts how many results to return, what page of results your on
		//for example, if how many = 10 and page = 2, you would take results 11 to 20
		//Checks if user is following each user (add this to user viewmodel class)
		//Gets a list of the most recently registered users
		//Users must have verified flag set to true
		//Returns an array of User class

		try
		{
			$statement = "SELECT u.UserId, u.FirstName, u.LastName, u.DateCreated, u.About, 

							f.Active AS FollowingUser,

							uas.ActionStatement,

							up.PictureId as UserProfilePicureId,

							(
								SELECT COUNT(1)
								FROM user_recommend_story 

								INNER JOIN story 
								ON (story.StoryId = user_recommend_story.Story_StoryId) AND (story.Active = TRUE) AND (story.Published = TRUE) AND (story.StoryPrivacyType_StoryPrivacyTypeId = 1)

								INNER JOIN user 
								ON (user.UserId = story.User_UserId) AND (user.Active = TRUE) AND (user.ProfilePrivacyType_PrivacyTypeId = 1)

								INNER JOIN admin_approve_story 
								ON (admin_approve_story.Story_StoryId = story.StoryId) AND (admin_approve_story.Approved = TRUE) AND (admin_approve_story.Active = TRUE)

								WHERE user_recommend_story.User_UserId = u.UserId
							    AND user_recommend_story.Active = TRUE
							    AND user_recommend_story.Opinion = TRUE
							) AS totalRecommends,
							
							(
								SELECT COUNT(1)
								FROM story 
								LEFT JOIN admin_approve_story
								ON (admin_approve_story.Story_StoryId = story.StoryId) AND (admin_approve_story.Active = TRUE)
								WHERE story.User_UserId = u.UserId
							    AND story.Active = TRUE
							    AND story.Published = TRUE
							    AND story.StoryPrivacyType_StoryPrivacyTypeId = 1
							    AND admin_approve_story.Approved = TRUE
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

							LEFT JOIN picture up
							ON (up.User_UserId = u.UserId) AND (up.Active = TRUE) AND (Picturetype_PictureTypeId = 1)

							WHERE u.Active = TRUE
							AND u.ProfilePrivacyType_PrivacyTypeId = 1
							AND u.VerifiedEmail = TRUE
							GROUP BY u.UserId
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
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	public function addActionTaken($userId, $actionTypeId, $content)
	{
		try
		{
			$statement = "INSERT INTO actions_taken
							(user_UserId, actions_taken_type_ActionsTakenTypeId, Content, DateCreated) 
							VALUES (:UserID, :ActionTypeID, :Content, :DateCreated)";

			$parameters = array( 
				":UserID" => $userId, 
				":ActionTypeID" => $actionTypeId, 
				":Content" => $content,
				":DateCreated" => $this->getDateNow()
			);
			
			return $this->fetch($statement, $parameters);
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	public function getActionTakenList($userId)
	{
		try
		{
			$statement = "SELECT at.*, att.*
							FROM actions_taken at

							LEFT JOIN actions_taken_type att
							ON att.ActionsTakenTypeId = at.actions_taken_type_ActionsTakenTypeId

							WHERE at.Active = TRUE
							AND at.user_UserId = :UserID";

			$parameters = array( 
				":UserID" => $userId
			);
			
			return $this->fetchIntoObject($statement, $parameters);
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}
}

?>
