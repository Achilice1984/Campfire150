<?php

class Account extends Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		try
		{
			$this->redirect("account/search");
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}	

	function home($userID = null)
	{
		try
		{
			$userID = $userID != null ? $userID : $this->currentUser->UserId;

			//Check if users is authenticated for this request
			//Will kick out if not authenticated
			if(!isset($userID))
			{
				$this->AuthRequest();
			}


			/*******************************************
			*
			*		Populate data
			*
			**********************************************/		

			//Load the accountHomeViewModel
			$accountHomeViewModel = $this->loadViewModel('AccountHomeViewModel');

			//Load the AccountModel to access account functions
			$model = $this->loadModel('AccountModel');

			//Load the AccountModel to access account functions
			$storyModel = $this->loadModel('Story/StoryModel');

			//Load the home view
			$view = $this->loadView('home');

			$accountHomeViewModel->userDetails = $model->getUserProfileByID_home($this->currentUser->UserId, $userID);

			if(isset($accountHomeViewModel->userDetails) && 
				($accountHomeViewModel->userDetails->ProfilePrivacyType_PrivacyTypeId == 1 || $userID == $this->currentUser->UserId) && $accountHomeViewModel->userDetails->Active == TRUE)
			{
				//Populate data to be shown on the page
				$accountHomeViewModel->recommendedStoryList = $storyModel->getStoriesRecommendedByCurrentUser($this->currentUser->UserId, $userID);				
				$accountHomeViewModel->followingList = $model->getFollowing($userID);
				$accountHomeViewModel->followerList = $model->getFollowers($userID);

				$accountHomeViewModel->ActionTakenList = $model->getActionTakenList($userID);


				if(isset($accountHomeViewModel->userDetails->BackgroundPictureId))
				{
					$accountHomeViewModel->backgroundPictureURL = 
											image_get_path_basic($userID, $accountHomeViewModel->userDetails->BackgroundPictureId, IMG_BACKGROUND, (IS_MOBILE ? IMG_MEDIUM : IMG_LARGE));
				}

				if(isset($accountHomeViewModel->userDetails->ProfilePictureId))
				{
					$accountHomeViewModel->profilePictureURL = 
											image_get_path_basic($userID, $accountHomeViewModel->userDetails->ProfilePictureId, IMG_PROFILE, (IS_MOBILE ? IMG_XSMALL : IMG_SMALL));
				}


				//get additional data
				if($userID == $this->currentUser->UserId)
				{
					$siteModel = $this->loadModel('SiteContent/SiteContentModel');
					$view->set('actionsTakenTypes', $siteModel->getDropdownValues_ActionsTaken());

					$accountHomeViewModel->newsFeed = $storyModel->getNewsFeed($userID);
					$accountHomeViewModel->pendingStories = $storyModel->getStoryListPendingApproval($userID);

					$accountHomeViewModel->rejectedStories = $storyModel->getStoryListRejected($userID);
					$accountHomeViewModel->draftStories = $storyModel->getStoryListDrafts($userID);
					$accountHomeViewModel->publishedStories = $storyModel->getStoriesPublished_Public_Private($userID);
					$accountHomeViewModel->pendingComments = $storyModel->getUnpublisedComments($userID);
				}
				else
				{
					$accountHomeViewModel->usersStoryList = $storyModel->getStoriesWrittenByCurrentUser($this->currentUser->UserId, $userID);

					//How many approved stories
					$accountHomeViewModel->totalApprovedStories = $storyModel->getTotalStoriesApproved($userID);
				}

				//How many people are they following
				$accountHomeViewModel->totalFollowing = $model->getTotalFollowing($userID);

				// How many people are following the user
				$accountHomeViewModel->totalFollowers = $model->getTotalFollowers($userID);

				$accountHomeViewModel->totalRecommendations = $storyModel->getTotalRecommendations($userID);
										

				if($userID == $this->currentUser->UserId)
				{
					//Load up some js files
					$view->setJS(array(
						array("static/js/followUser.js", "intern"),
						array("static/js/userHome.js", "intern"),
						array("static/js/storyButtons.js", "intern"),
						array("static/plugins/cropper/cropper.min.js", "intern"),
						array("static/plugins/maxlength/js/bootstrap-maxlength.min.js", "intern"),
						array("static/plugins/validation/js/formValidation.min.js", "intern"),
						array("static/plugins/validation/js/framework/bootstrap.min.js", "intern"),
						array("static/plugins/select2/js/select2.min.js", "intern"),
						array("static/plugins/validation/js/language/en_US.js", "intern"),
						array("static/plugins/validation/js/language/fr_FR.js", "intern"),
						array("static/js/validation.js", "intern")
					));

					$view->setCSS(array(
						array("static/plugins/cropper/cropper.min.css", "intern"),
						array("static/plugins/datepicker/css/bootstrap-datepicker3.min.css", "intern"),
						array("static/plugins/validation/css/formValidation.min.css", "intern"),
						array("static/plugins/select2/css/select2.min.css", "intern")
					));
				}
				else
				{
					//Load up some js files
					$view->setJS(array(
						array("static/js/followUser.js", "intern"),
						array("static/js/userHome.js", "intern"),
						array("static/js/storyButtons.js", "intern"),
					));
				}				

				$siteModel = $this->loadModel('SiteContent/SiteContentModel');
				$view->set('privacyDropdownValues', $siteModel->getDropdownValues_StoryPrivacyType());

				//Add a variable with data so that it can be accessed in the view
				$view->set('accountHomeViewModel', $accountHomeViewModel);

				//Render the home view. true indicates to load the layout pages as well
				$view->render(true);
			}
			else
			{
				addErrorMessage("dbError", gettext("An error occurred while attempting to retrieve user details."), 1);

				$this->redirect("");				
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function login()
	{			
		try
		{
			//Load the loginViewModel
			$loginViewModel = $this->loadViewModel('LoginViewModel');

			//Execute code if a post back
			if($this->isPost())
			{			
				//Map post values to the loginViewModel
				$loginViewModel = AutoMapper::mapPost($loginViewModel);

				//Load the AccountModel to access account functions
				$model = $this->loadModel('AccountModel');
				
				//Validate data that was posted to the server
				//This will also set the temp errors to be shown in the view
				if($loginViewModel->validate())
				{		
					//Attempt to log user into website
					$isLoggedIn = $model->login($loginViewModel);				

					if($isLoggedIn) //Success
					{
						if(isset($_SESSION["Just_Registered"]))
						{							
							$this->redirect("story/add");
						}
						//Redirect to users home page
						$this->redirect("account/home");	
					}
					else //Failed login
					{
						// Add an error message because login failed 
						addErrorMessage("dbError", gettext("Oops, it looks like your attempt to login failed."));
					}				
				}	

				//This was causing weir redirect issues
				//$model->logout();echo "string";exit;
			}

			//Load the login view
			$view = $this->loadView('login');

			//Add a variable with old login data so that it can be accessed in the view
			$view->set('loginViewModel', $loginViewModel);

			//Load up some js files
			$view->setJS(array(
				array("static/plugins/validation/js/formValidation.min.js", "intern"),
				array("static/plugins/validation/js/framework/bootstrap.min.js", "intern"),
				array("static/plugins/select2/js/select2.min.js", "intern"),
				array("static/plugins/validation/js/language/en_US.js", "intern"),
				array("static/plugins/validation/js/language/fr_FR.js", "intern"),
				array("static/js/validation.js", "intern"),
				array("static/js/login.js", "intern")
			));

			$view->setCSS(array(
				array("static/plugins/validation/css/formValidation.min.css", "intern"),
				array("static/plugins/select2/css/select2.min.css", "intern")
			));

			//Render the login view. true indicates to load the layout pages as well
			$view->render(true);
		}
		catch(Exception $ex)
		{
			//Load the AccountModel to access account functions
			$model = $this->loadModel('AccountModel');
			$model->logout();
			
			throw $ex;
		}
	}

	function logout()
	{
		try
		{
			$model = $this->loadModel('AccountModel');
			$model->logout();

			$this->redirect("");
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function changelanguage()
	{		
		try
		{
			$sessionManger = new SessionManager();
			$model = $this->loadModel('AccountModel');

			if(isset($this->currentUser) && $this->isAuth())
			{
				if($this->currentUser->LanguagePreference == "en_CA")
				{
					$this->currentUser->LanguagePreference = "fr_CA";
					$sessionManger->setLanguageSession(2);

					$model->updateUserLanguagePreference($this->currentUser->UserId, 2);
				}
				else
				{
					$this->currentUser->LanguagePreference = "en_CA";
					$sessionManger->setLanguageSession(1);

					$model->updateUserLanguagePreference($this->currentUser->UserId, 1);
				}			
			}
			else
			{
				if($_SESSION["languagePreference"] == "en_CA")
				{
					$_SESSION["languagePreference"] = "fr_CA";
				}
				else
				{
					$_SESSION["languagePreference"] = "en_CA";
				}			
			}	

			$this->redirect("");
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function register()
	{	
		try
		{			//Load the userViewModel
			$userViewModel = $this->loadViewModel('shared/UserViewModel');

			//Execute code if a post back
			if($this->isPost())
			{			
				//Map post values to the userViewModel
				$userViewModel = AutoMapper::mapPost($userViewModel);

				//Load the AccountModel to access account functions
				$model = $this->loadModel('AccountModel');

				//Validate data that was posted to the server
				//This will also set the temp errors to be shown in the view
				if($userViewModel->validate())
				{		
					//Attempt to register the user with our website				
					if($model->registerUserProfile($userViewModel))
					{
						addSuccessMessage("dbSuccess", gettext("You are Registered! Verify your email and log in!"), 1);

						//If success, send user to the login page
						$this->redirect("account/login");	
					}
					else
					{
						addErrorMessage("dbError", gettext("Oops, it looks like something went wrong while trying to register your profile."));
					}					
				}			
			}		

			//Load the register view
			$view = $this->loadView('register');

			//Load up some js files
			$view->setJS(array(
				array("static/plugins/datepicker/js/bootstrap-datepicker.min.js", "intern"),
				array("static/plugins/validation/js/formValidation.min.js", "intern"),
				array("static/plugins/validation/js/framework/bootstrap.min.js", "intern"),
				array("static/plugins/select2/js/select2.min.js", "intern"),
				array("static/plugins/validation/js/language/en_US.js", "intern"),
				array("static/plugins/validation/js/language/fr_FR.js", "intern"),
				array("static/js/validation.js", "intern")
			));

			$view->setCSS(array(
				array("static/plugins/datepicker/css/bootstrap-datepicker3.min.css", "intern"),
				array("static/plugins/validation/css/formValidation.min.css", "intern"),
				array("static/plugins/select2/css/select2.min.css", "intern")
			));		

			//Add a variable with old userViewModel data so that it can be accessed in the view
			$view->set('userViewModel', $userViewModel);

			$siteModel = $this->loadModel('SiteContent/SiteContentModel');

			$view->set('privacyDropdownValues', $siteModel->getDropdownValues_ProfilePrivacyType());
			$view->set('genderDropdownValues', $siteModel->getDropdownValues_GenderType());
			$view->set('secureityQuestionDropdownValues', $siteModel->getDropdownValues_SecurityQuestions());
			
			//Render the register view. true indicates to load the layout pages as well
			$view->render(true);
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function verifyemail($email, $hashedEmailVerification)
	{
		try
		{
			//Load the AccountModel to access account functions
			$model = $this->loadModel('AccountModel');

			if($model->verifiyEmail($email, $hashedEmailVerification))
			{
				//Stkaeholder wanted first login to redirect to add story page, this how its determined
				$_SESSION["Just_Registered"] = TRUE;

				addSuccessMessage("dbError", gettext("Your email has been successfully verified! Login to start using your account!"), 1);

				$this->redirect("account/login");
			}
			else
			{
				addErrorMessage("dbError", gettext("Oops, an error occurred while attempting to verify your account!"), 1);
				$this->redirect("");
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function changesecurityquestion()
	{
		//Check if users is authenticated for this request
		//Will kick out if not authenticated
		try
		{		
			$IsSuccess = FALSE;
			
			if($this->isAuth())
			{
				$model = $this->loadModel('AccountModel');
				$securityAnswerViewModel = $this->loadViewModel('Account/SecurityAnswerViewModel');

				//Map post values to the userViewModel
				$securityAnswerViewModel = AutoMapper::mapPost($securityAnswerViewModel);

				if($securityAnswerViewModel->validate())
				{
					$model = $this->loadModel('AccountModel');

					if($model->updateSecurityQuestionAnswer($this->currentUser->UserId, $securityAnswerViewModel))
					{
						$IsSuccess = TRUE;
					}
				}
			}

			if ($this->isAjax()) 
			{
				if($IsSuccess)
				{
					echo getSuccessMessage();
				}	
				else
				{
					echo getErrorMessage();
				}		

				exit;
			}
			else
			{
				$this->redirect("Account/home");			
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function changepassword()
	{
		//Check if users is authenticated for this request
		//Will kick out if not authenticated
		try
		{
			$IsSuccess = FALSE;

			if($this->isAuth())
			{		
				$model = $this->loadModel('AccountModel');

				//Load the userViewModel
				$changePasswordViewModel = $this->loadViewModel('Account/ChangePasswordViewModel');

				//Map post values to the userViewModel
				$changePasswordViewModel = AutoMapper::mapPost($changePasswordViewModel);			

				if($changePasswordViewModel->Password == $changePasswordViewModel->RePassword)
				{
					if($model->updateUserPassword($this->currentUser, $changePasswordViewModel))
					{
						$IsSuccess = TRUE;
					}
					else
					{
						if(!$this->isAjax())
						{
							addErrorMessage("dbError", gettext("Oops, it looks like something went wrong while trying to update your password."), 1);
						}
					}
				}
				else
				{
					if(!$this->isAjax())
					{
						addErrorMessage("dbError", gettext("Oops, it looks like your passwords don't match."), 1);
					}
				}
			}

			if ($this->isAjax()) 
			{
				if($IsSuccess)
				{
					echo getSuccessMessage();
				}	
				else
				{
					echo getErrorMessage();
				}		

				exit;
			}
			else
			{
				$this->redirect("Account/home");			
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function changeprofilepicture()
	{
		//Hey Darren

		//You have access to the following functions in the AccountModel:

		// getPictureMetadataByPictureId($pictureId)
			// Returns a PictureViewModel
		// getCurrentBackgroundPictureMetadata($userId)
			// Returns a PictureViewModel
		// getCurrentProfilePictureMetadata($userId)
			// Returns a PictureViewModel
		// saveUserImageMetadata($userId, $pictureViewModel, $imageType)
			// Returns a picture id

		try
		{
			//Check if users is authenticated for this request
			//Will kick out if not authenticated
			$this->AuthRequest();
			
			//This loads up your model for talking to the database
			//it contains all functions needed to update database
			$model = $this->loadModel('AccountModel');

			//Load the userViewModel
			$pictureViewModel = $this->loadViewModel('shared/PictureViewModel');

			//Execute code if a post back
			//This just checks to see if a form was submitted
			if($this->isPost())
			{				
				require_once(APP_DIR.'helpers/image_save.php');

				//Check if users is authenticated for this request
				//Will kick out if not authenticated
				$this->AuthRequest();
				
				//This loads up your model for talking to the database
				//it contains all functions needed to update database
				$model = $this->loadModel('AccountModel');

				//Load the userViewModel
				$pictureViewModel = $this->loadViewModel('shared/PictureViewModel');

				$pictureViewModel->PictureFile = $_FILES["ProfileImage"];

				//Execute code if a post back
				//This just checks to see if a form was submitted
				if($this->isPost())
				{			
					$imageId = $model->saveUserImageMetadata($this->currentUser->UserId, $pictureViewModel, IMG_PROFILE);
					
					if($imageId != 0)
					{
						if(isset($imageId) && $imageId > 0)
						{
							image_save($pictureViewModel->PictureFile, $this->currentUser->UserId, $imageId, IMG_PROFILE_URL, 
											 $_POST["image_profile_height"], $_POST["image_profile_width"], $_POST["image_profile_x"], $_POST["image_profile_y"]); 					
						}
					}

					echo image_get_path_basic($this->currentUser->UserId, $imageId, IMG_PROFILE, IMG_SMALL);
				}
				else
				{
					$this->redirect("");
				}
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function changebackgroundpicture()
	{
		try
		{
			require_once(APP_DIR.'helpers/image_save.php');

			//Check if users is authenticated for this request
			//Will kick out if not authenticated
			$this->AuthRequest();
			
			//This loads up your model for talking to the database
			//it contains all functions needed to update database
			$model = $this->loadModel('AccountModel');

			//Load the userViewModel
			$pictureViewModel = $this->loadViewModel('shared/PictureViewModel');

			$pictureViewModel->PictureFile = $_FILES["HeaderImage"];

			//Execute code if a post back
			//This just checks to see if a form was submitted
			if($this->isPost())
			{			
				$imageId = $model->saveUserImageMetadata($this->currentUser->UserId, $pictureViewModel, IMG_BACKGROUND);

				if($imageId != 0)
				{
					if(isset($imageId) && $imageId > 0)
					{
						image_save($pictureViewModel->PictureFile, $this->currentUser->UserId, $imageId, IMG_BACKGROUND_URL, 
										 $_POST["image_header_height"], $_POST["image_header_width"], $_POST["image_header_x"], $_POST["image_header_y"]); 					
					}
				}

				echo image_get_path_basic($this->currentUser->UserId, $imageId, IMG_BACKGROUND, IMG_LARGE);
			}
			else
			{
				$this->redirect("");
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function profile()
	{
		try
		{
			//Check if users is authenticated for this request
			//Will kick out if not authenticated
			$this->AuthRequest();

			//Load the userViewModel
			$profileViewModel = $this->loadViewModel('ProfileViewModel');

			//Load the AccountModel to access account functions
			$model = $this->loadModel('AccountModel');

			$profileViewModel = $model->getProfileByID($this->currentUser->UserId);

			$IsSuccess = FALSE;

			//Execute code if a post back
			if($this->isPost())
			{			
				//Map post values to the userViewModel
				$profileViewModel = AutoMapper::mapPost($profileViewModel);			
				
				//Validate data that was posted to the server
				//This will also set the temp errors to be shown in the view
				if($profileViewModel->validate())
				{		
					//Attempt to register the user with our website				
					if($model->updateUserProfile($profileViewModel))
					{
						$sessionManger = new SessionManager();
						$sessionManger->setLanguageSession($profileViewModel->LanguageType_LanguageId);

						$sessionManger->setUserSessions($model->getAllUserDetails($this->currentUser->UserId), isset($_SESSION['remember']) ? $_SESSION['remember'] : null);

						$IsSuccess = TRUE;	
					}				
				}

				if ($this->isAjax()) 
				{
					if($IsSuccess)
					{
						echo getSuccessMessage();
					}	
					else
					{
						echo getErrorMessage();
					}		

					exit;
				}
				else
				{
					if(!$IsSuccess)
					{
						addErrorMessage("dbError", gettext("Oops, it looks like something went wrong while trying to update your profile."), 1);
					}	

					//If success, send user to the home page
					$this->redirect("account/home");
				}			
			}		

			$siteModel = $this->loadModel('SiteContent/SiteContentModel');
			$privacyDropdownValues = $siteModel->getDropdownValues_ProfilePrivacyType();

			//Load the profile view
			$view = $this->loadView('profile');

			//Add a variable with old userViewModel data so that it can be accessed in the view
			$view->set('userViewModel', $profileViewModel);
			$view->set('privacyDropdownValues', $privacyDropdownValues);
			$view->set('genderDropdownValues', $siteModel->getDropdownValues_GenderType());
			$view->set('secureityQuestionDropdownValues', $siteModel->getDropdownValues_SecurityQuestions());
			
			//Render the profile view. true indicates to load the layout pages as well
			$view->render(false);
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function search()
	{
		try
		{			
			$accountModel = $this->loadModel("Account/AccountModel");
			
			$searchResults = array();

			if($this->isPost())
			{
				if(isset($_POST["UserSearch"]))
				{
					$_GET["search"] = true;
					
					$searchResults = $accountModel->searchForUser($_POST["UserSearch"], $this->currentUser->UserId);
				}
			}		


			$latestUsersList = $accountModel->getLatestUserList($this->currentUser->UserId);
			$mostFollowUsersList = $accountModel->getMostFollowersUserList($this->currentUser->UserId);

			//debugit($searchResults);

			//Load the profile view
			$view = $this->loadView('search');

			$view->set('searchResults', $searchResults);
			$view->set('latestUsersList', $latestUsersList);
			$view->set('mostFollowUsersList', $mostFollowUsersList);

			//Load up some js files
			$view->setJS(array(
				array("static/js/usersearch.js", "intern"),
				array("static/js/followUser.js", "intern")
			));
			$view->setCSS(array(
				array("static/css/usersearch.css", "intern")
			));

			//Render the profile view. true indicates to load the layout pages as well
			$view->render(true);
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function ajaxSearch()
	{
		try
		{
			$accountModel = $this->loadModel("AccountModel");
			$searchResults = array();

			if(isset($_POST["UserSearch"]))
			{
				$searchResults = $accountModel->searchForUser($_POST["UserSearch"], $this->currentUser->UserId, MAX_USERS_LISTS, isset($_POST["UserSearchPage"]) ? $_POST["UserSearchPage"] : 1);
			}

			if (isset($searchResults)) {

				$currentUser = $this->currentUser;
				
				foreach ($searchResults as $user)
				{
					include(APP_DIR . "views/Account/_searchPanel.php");
				}
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function mostFollowersUserList()
	{
		try
		{
			$accountModel = $this->loadModel("AccountModel");
			$searchResults = array();

			$searchResults = $accountModel->getMostFollowersUserList($this->currentUser->UserId, MAX_USERS_LISTS, isset($_POST["UserMostFollowersPage"]) ? $_POST["UserMostFollowersPage"] : 1);

			$currentUser = $this->currentUser;

			if (isset($searchResults)) {
				foreach ($searchResults as $user)
				{
					include(APP_DIR . "views/Account/_searchPanel.php");
				}
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}	

	function latestUserList()
	{
		try
		{
			$accountModel = $this->loadModel("AccountModel");
			$searchResults = array();

			$searchResults = $accountModel->getLatestUserList($this->currentUser->UserId, MAX_USERS_LISTS, isset($_POST["UsersLatestPage"]) ? $_POST["UsersLatestPage"] : 1);

			$currentUser = $this->currentUser;

			if (isset($searchResults)) {
				foreach ($searchResults as $user)
				{
					include(APP_DIR . "views/Account/_searchPanel.php");
				}
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function follow()
	{
		try
		{
			//Check if users is authenticated for this request
			//Will kick out if not authenticated
			if($this->isAuth())
			{
				$result;

				//Load the AccountModel to access account functions
				$accountModel = $this->loadModel('AccountModel');

				if(isset($_POST["UserID"]) && isset($_POST["FollowUser"]) && $_POST["UserID"] != $this->currentUser->UserId)
				{
					if($_POST["FollowUser"] == TRUE)
					{
						$result = $accountModel->followUser($this->currentUser->UserId, $_POST["UserID"]);
					}
					else
					{
						$result = $accountModel->unfollowUser($this->currentUser->UserId, $_POST["UserID"]);
					}		

					if ($this->isAjax()) {
						return $result;			
					}
					else
					{
						$this->redirect("account/home");
					}
				}

				echo json_encode($result);
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function unfollow($userID)
	{
		try
		{
			//Check if users is authenticated for this request
			//Will kick out if not authenticated
			if($this->isAuth())
			{
				$result;

				//Load the AccountModel to access account functions
				$accountModel = $this->loadModel('AccountModel');

				if($userID != $this->currentUser->UserId)
				{
					$result = $accountModel->unfollowUser($this->currentUser->UserId, $userID);
				}

				if ($this->isAjax()) {
					return $result;			
				}
				else
				{
					$this->redirect("account/home");
				}
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function addActionsTaken()
	{
		try
		{
			if($this->currentUser->IsAuth)
			{
				$result;

				//Load the AccountModel to access account functions
				$accountModel = $this->loadModel('AccountModel');

				if($this->isPost() && isset($_POST["ActionTakenType"]) && isset($_POST["Content"]))
				{
					$result = $accountModel->addActionTaken($this->currentUser->UserId, $_POST["ActionTakenType"], $_POST["Content"]);
				}

				if ($this->isAjax()) {
					if($result)
					{
						$actionsTaken = $accountModel->getActionTakenList($this->currentUser->UserId);

						$currentUser = $this->currentUser;

						foreach ($actionsTaken as $action) {
							include(APP_DIR . "views/Account/_actionsTaken.php");
						}
					}			
				}
				else
				{
					$this->redirect("account/home");
				}
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function updateAbout()
	{
		try
		{
			if($this->currentUser->IsAuth)
			{
				$result;

				//Load the AccountModel to access account functions
				$accountModel = $this->loadModel('AccountModel');

				if($this->isPost() && isset($_POST["About"]))
				{
					$result = $accountModel->updateUserAbout($this->currentUser->UserId, $_POST["About"]);
				}

				if ($this->isAjax()) {
					if($result)
					{
						echo getSuccessMessage();
					}	
					else
					{
						echo getErrorMessage();
					}		
				}
				else
				{
					$this->redirect("account/home");
				}
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function updateActionStatement()
	{
		try
		{
			if($this->currentUser->IsAuth)
			{
				$result;

				//Load the AccountModel to access account functions
				$accountModel = $this->loadModel('AccountModel');

				if($this->isPost() && isset($_POST["UserActionStatement"]))
				{
					$result = $accountModel->updateUserActionStatement($this->currentUser->UserId);

					if($result == TRUE)
					{
						$result = $accountModel->insertUserActionStatement($this->currentUser->UserId, $_POST["UserActionStatement"]);
					}
				}

				if ($this->isAjax()) {
					if($result)
					{
						echo getSuccessMessage();
					}	
					else
					{
						echo getErrorMessage();
					}			
				}
				else
				{
					$this->redirect("account/home");
				}
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}


	/*********************************************************
	*
	*			USER HOME PAGE FUNCTIONS
	*
	***********************************************************/

	function newsFeed()
	{
		try
		{
			require_once(APP_DIR.'helpers/image_get_path.php');

			$storyModel = $this->loadModel("Story/StoryModel");
			$searchResults = array();

			$searchResults = $storyModel->getNewsFeed($this->currentUser->UserId, MAX_STORIES_LISTS, isset($_POST["Page"]) ? $_POST["Page"] : 1);

			if (isset($searchResults)) {
				foreach ($searchResults as $feed)
				{
					include(APP_DIR . "views/Account/_newsFeed.php");
				}
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function userStories()
	{
		try
		{
			if(isset($_POST["UserId"]))
			{
				require_once(APP_DIR.'helpers/image_get_path.php');

				$storyModel = $this->loadModel("Story/StoryModel");
				$searchResults = array();

				$searchResults = $storyModel->getStoriesWrittenByCurrentUser($this->currentUser->UserId, $_POST["UserId"], MAX_STORIES_LISTS, isset($_POST["Page"]) ? $_POST["Page"] : 1);

				if (isset($searchResults)) {
					foreach ($searchResults as $story)
					{
						include(APP_DIR . "views/Account/_myStories.php");
					}
				}
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function recommendations()
	{
		try
		{
			if(isset($_POST["UserId"]))
			{
				require_once(APP_DIR.'helpers/image_get_path.php');

				$storyModel = $this->loadModel("Story/StoryModel");
				$searchResults = array();

				$searchResults = $storyModel->getStoriesRecommendedByCurrentUser($this->currentUser->UserId, $_POST["UserId"], MAX_STORIES_LISTS, isset($_POST["Page"]) ? $_POST["Page"] : 1);

				if (isset($searchResults)) {
					foreach ($searchResults as $story)
					{
						include(APP_DIR . "views/Account/_myRecommendations.php");
					}
				}
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function followinglist()
	{
		try
		{
			if(isset($_POST["UserId"]))
			{
				require_once(APP_DIR.'helpers/image_get_path.php');

				$accountModel = $this->loadModel('AccountModel');
				$searchResults = array();

				$searchResults = $accountModel->getFollowing($_POST["UserId"], MAX_USERS_LISTS, isset($_POST["Page"]) ? $_POST["Page"] : 1);

				if (isset($searchResults)) {

					$currentUser = $this->currentUser;
					foreach ($searchResults as $user)
					{
						include(APP_DIR . "views/Account/_searchPanel.php");
					}
				}
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function followerslist()
	{
		try
		{
			if(isset($_POST["UserId"]))
			{
				require_once(APP_DIR.'helpers/image_get_path.php');

				$accountModel = $this->loadModel('AccountModel');
				$searchResults = array();

				$searchResults = $accountModel->getFollowers($_POST["UserId"], MAX_USERS_LISTS, isset($_POST["Page"]) ? $_POST["Page"] : 1);

				if (isset($searchResults)) {

					$currentUser = $this->currentUser;
					foreach ($searchResults as $user)
					{
						include(APP_DIR . "views/Account/_searchPanel.php");
					}
				}
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function publishedList()
	{
		try
		{
			if($this->isAuth() && $this->isAjax())
			{
				require_once(APP_DIR.'helpers/image_get_path.php');

				$siteModel = $this->loadModel('SiteContent/SiteContentModel');
				$privacyDropdownValues = $siteModel->getDropdownValues_StoryPrivacyType();

				$storyModel = $this->loadModel("Story/StoryModel");
				$searchResults = array();

				$searchResults = $storyModel->getStoriesPublished_Public_Private($this->currentUser->UserId, MAX_STORIES_LISTS, isset($_POST["Page"]) ? $_POST["Page"] : 1);

				if (isset($searchResults)) {
					foreach ($searchResults as $story)
					{
						include(APP_DIR . "views/Account/_publishedStories.php");
					}
				}
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function draftsList()
	{
		try
		{
			if($this->isAuth() && $this->isAjax())
			{
				require_once(APP_DIR.'helpers/image_get_path.php');

				$storyModel = $this->loadModel("Story/StoryModel");
				$searchResults = array();

				$searchResults = $storyModel->getStoryListDrafts($this->currentUser->UserId, MAX_STORIES_LISTS, isset($_POST["Page"]) ? $_POST["Page"] : 1);

				if (isset($searchResults)) {
					foreach ($searchResults as $story)
					{
						include(APP_DIR . "views/Account/_draftStories.php");
					}
				}
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function pendingList()
	{
		try
		{
			if($this->isAuth() && $this->isAjax())
			{
				require_once(APP_DIR.'helpers/image_get_path.php');

				$storyModel = $this->loadModel("Story/StoryModel");
				$searchResults = array();

				$searchResults = $storyModel->getStoryListPendingApproval($this->currentUser->UserId, MAX_STORIES_LISTS, isset($_POST["Page"]) ? $_POST["Page"] : 1);

				if (isset($searchResults)) {
					foreach ($searchResults as $story)
					{
						include(APP_DIR . "views/Account/_pendingStories.php");
					}
				}
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function rejectedList()
	{
		try
		{
			if($this->isAuth() && $this->isAjax())
			{
				require_once(APP_DIR.'helpers/image_get_path.php');

				$storyModel = $this->loadModel("Story/StoryModel");
				$searchResults = array();

				$searchResults = $storyModel->getStoryListRejected($this->currentUser->UserId, MAX_STORIES_LISTS, isset($_POST["Page"]) ? $_POST["Page"] : 1);

				if (isset($searchResults)) {
					foreach ($searchResults as $story)
					{
						include(APP_DIR . "views/Account/_rejectedStories.php");
					}
				}
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function commentsPendingApprovalList()
	{
		try
		{
			if($this->isAuth() && $this->isAjax())
			{
				require_once(APP_DIR.'helpers/image_get_path.php');

				$storyModel = $this->loadModel("Story/StoryModel");
				$searchResults = array();

				$searchResults = $storyModel->getUnpublisedComments($this->currentUser->UserId, MAX_COMMENTS_LISTS, isset($_POST["Page"]) ? $_POST["Page"] : 1);

				if (isset($searchResults)) {
					foreach ($searchResults as $comment)
					{
						include(APP_DIR . "views/Account/_comments.php");
					}
				}
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function approveComment()
	{
		try
		{
			if($this->isAuth() && $this->isAjax())
			{
				$storyModel = $this->loadModel("Story/StoryModel");

				if(isset($_POST["CommentID"]))
				{
					$result = $storyModel->approveComment($this->currentUser->UserId, $_POST["CommentID"]);

					if($result)
					{
						echo $result;
					}
				}
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function rejectComment()
	{
		try
		{
			if($this->isAuth() && $this->isAjax())
			{
				$storyModel = $this->loadModel("Story/StoryModel");

				if(isset($_POST["CommentID"]))
				{
					$result = $storyModel->rejectComment($this->currentUser->UserId, $_POST["CommentID"]);

					if($result)
					{
						echo $result;
					}
				}
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}
	function removeAction()
	{
		try
		{
			if($this->isAuth() && $this->isAjax())
			{
				$model = $this->loadModel("Account/AccountModel");

				if(isset($_POST["ActionID"]))
				{
					$result = $model->removeAction($this->currentUser->UserId, $_POST["ActionID"]);

					if($result)
					{
						echo $result;
					}
				}
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function changeStoryPrivacy()
	{
		try
		{
			if($this->isAuth() && $this->isAjax())
			{
				$storyModel = $this->loadModel("Story/StoryModel");

				if(isset($_POST["StoryID"]) && isset($_POST["PrivacyType"]))
				{
					$result = $storyModel->changeStoryPrivacy($this->currentUser->UserId, $_POST["StoryID"], $_POST["PrivacyType"]);

					if($result)
					{
						echo $result;
					}
				}
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function sendPasswordReset()
	{
		$model = $this->loadModel("Account/AccountModel");

		if(isset($_POST["ResetEmail"]))
		{
			$result = $model->sendResetPassword($_POST["ResetEmail"]);

			if($this->isAjax())
			{
				if($result)
				{
					echo $result;
				}
			}
			else
			{
				if($result)
				{
					addSuccessMessage("dbSuccess", gettext("An email was sent to help reset your password!"), 1);
					$this->redirect("");
				}
			}
		}
	}

	function resetPassword($email = null, $hash = null)
	{
		try
		{
			if($this->isPost())
			{
				$email = $_POST["Email"];
				$hash = $_POST["Hash"];

				if(isset($_POST["Email"]) && isset($_POST["Hash"]) && isset($_POST["Password"]) && isset($_POST["RePassword"]))
				{
					if($_POST["Password"] == $_POST["RePassword"])
					{
						$accountModel = $this->loadModel("Account/AccountModel");

						$result = $accountModel->resetPassword($_POST["Email"], $_POST["Password"], $_POST["Hash"]);

						if($result)
						{
							addSuccessMessage("dbSuccess", gettext("Password was reset, please login using your new password!"), 1);

							$this->redirect("account/login");
						}
					}
				}

				addErrorMessage("dbError", gettext("Oops, something went wrong while resetting your password."));
			}		

			//Load the profile view
			$view = $this->loadView('reset');

			$view->set('email', $email);
			$view->set('hash', $hash);

			//Load up some js files
			$view->setJS(array(
				array("static/plugins/validation/js/formValidation.min.js", "intern"),
				array("static/plugins/validation/js/framework/bootstrap.min.js", "intern"),
				array("static/plugins/select2/js/select2.min.js", "intern"),
				array("static/plugins/validation/js/language/en_US.js", "intern"),
				array("static/plugins/validation/js/language/fr_FR.js", "intern"),
				array("static/js/validation.js", "intern")
			));

			$view->setCSS(array(
				array("static/plugins/validation/css/formValidation.min.css", "intern"),
				array("static/plugins/select2/css/select2.min.css", "intern")
			));

			//Render the profile view. true indicates to load the layout pages as well
			$view->render(true);
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}
}

?>
