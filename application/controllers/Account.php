<?php

class Account extends Controller {

	function __construct()
	{
		parent::__construct();
	}

	//The home view will be where a user can view all of their account information
	// function home()
	// {	
	// 	try
	// 	{
	// 		//Check if users is authenticated for this request
	// 		//Will kick out if not authenticated
	// 		$this->AuthRequest();

	// 		//Load the accountHomeViewModel
	// 		$accountHomeViewModel = $this->loadViewModel('AccountHomeViewModel');

	// 		//Load the AccountModel to access account functions
	// 		$model = $this->loadModel('AccountModel');

	// 		//Load the home view
	// 		$view = $this->loadView('home');

	// 		//Add a variable with data so that it can be accessed in the view
	// 		$view->set('accountHomeViewModel', $accountHomeViewModel);

	// 		//Render the home view. true indicates to load the layout pages as well
	// 		$view->render(true);
	// 	}
	// 	catch(Exception $ex)
	// 	{

	// 	}
	// }	

	function home($userID = null)
	{
		require_once(APP_DIR . 'helpers/image_get_path.php');

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
				$accountHomeViewModel->recommendedStoryList = $storyModel->getStoriesRecommendedByCurrentUser($userID);				
				$accountHomeViewModel->followingList = $model->getFollowing($userID);
				$accountHomeViewModel->followerList = $model->getFollowers($userID);

				$accountHomeViewModel->ActionTakenList = $model->getActionTakenList($userID);

				$accountHomeViewModel->backgroundImage = $model->getCurrentBackgroundPictureMetadata($userID);

				if(isset($accountHomeViewModel->backgroundImage))
				{
					$accountHomeViewModel->backgroundImage->PictureUrl = 
											image_get_path_basic($userID, $accountHomeViewModel->backgroundImage->PictureId, IMG_BACKGROUND, IMG_LARGE);
				}

				$accountHomeViewModel->profileImage = $model->getCurrentProfilePictureMetadata($userID);

				if(isset($accountHomeViewModel->profileImage))
				{
					$accountHomeViewModel->profileImage->PictureUrl = 
											image_get_path_basic($userID, $accountHomeViewModel->profileImage->PictureId, IMG_PROFILE, IMG_MEDIUM);
				}


				//get additional data
				if($userID == $this->currentUser->UserId)
				{
					$siteModel = $this->loadModel('SiteContent/SiteContentModel');
					$view->set('actionsTakenTypes', $siteModel->getDropdownValues_ActionsTaken());

					// public $newsFeed;
					// public $pendingStories;
					// public $draftStories;
					// public $rejectedStories;
					$accountHomeViewModel->newsFeed = $storyModel->getNewsFeed($userID);
					$accountHomeViewModel->pendingStories = $storyModel->getStoryListPendingApproval($userID);

					$accountHomeViewModel->rejectedStories = $storyModel->getStoryListRejected($userID);
					$accountHomeViewModel->draftStories = $storyModel->getStoryListDrafts($userID);
					$accountHomeViewModel->publishedStories = $storyModel->getStoriesPublished_Public_Private($userID);
					$accountHomeViewModel->pendingComments = $storyModel->getUnpublisedComments($userID);
					
					//debugit($accountHomeViewModel->pendingComments);
					//debugit($accountHomeViewModel->newsFeed);
				}
				else
				{
					$accountHomeViewModel->usersStoryList = $storyModel->getStoriesWrittenByCurrentUser($userID);
				}

				//How many people are they following
				$accountHomeViewModel->totalFollowing = $model->getTotalFollowing($userID);

				// How many people are following the user
				$accountHomeViewModel->totalFollowers = $model->getTotalFollowers($userID);

				$accountHomeViewModel->totalRecommendations = $storyModel->getTotalRecommendations($userID);

				//How many approved stories
				$accountHomeViewModel->totalApprovedStories = $storyModel->getTotalStoriesApproved($userID);

				//How many pending stories
				$accountHomeViewModel->totalPendingStories = $storyModel->getTotalStoriesPending($userID);

				//How many denied stories
				$accountHomeViewModel->totalDeniedStories = $storyModel->getTotalStoriesDenied($userID);

				//How many approved comments
				$accountHomeViewModel->totalApprovedComments = $storyModel->getTotalCommentsApproved($userID);

				//How many penfing comments
				$accountHomeViewModel->totalPendingComments = $storyModel->getTotalCommentsPending($userID);							

				if($userID == $this->currentUser->UserId)
				{
					//Load up some js files
					$view->setJS(array(
						array("static/js/followUser.js", "intern"),
						array("static/js/userHome.js", "intern"),
						array("static/js/storyButtons.js", "intern"),
						array("static/plugins/cropper/cropper.min.js", "intern"),
						array("static/plugins/datepicker/js/bootstrap-datepicker.min.js", "intern"),
						array("static/plugins/maxlength/js/bootstrap-maxlength.min.js", "intern")
					));

					$view->setCSS(array(
						array("static/plugins/cropper/cropper.min.css", "intern"),
						array("static/plugins/datepicker/css/bootstrap-datepicker3.min.css", "intern")
					));
				}
				else
				{
					//Load up some js files
					$view->setJS(array(
						array("static/js/followUser.js", "intern"),
						array("static/js/userHome.js", "intern")
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

		}
	}

	function login()
	{			
		//Load the userViewModel
		$userViewModel = $this->loadViewModel('shared/UserViewModel');

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
					//Redirect to users home page
					$this->redirect("account/home");	
				}
				else //Failed login
				{
					// Add an error message because login failed 
					addErrorMessage("dbError", gettext("Opps, it looks like your attempt to login faild."));
				}				
			}			
		}

		//Load the login view
		$view = $this->loadView('login');

		//Add a variable with old login data so that it can be accessed in the view
		$view->set('loginViewModel', $loginViewModel);

		//Render the login view. true indicates to load the layout pages as well
		$view->render(true);
	}

	function logout()
	{
		$model = $this->loadModel('AccountModel');
		$model->logout();

		$this->redirect("");
	}

	function changelanguage()
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

	function register()
	{	
		//Load the userViewModel
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
					addSuccessMessage("dbSuccess", gettext("Your Registered! Verify your email and log in!"));

					//If success, send user to the login page
					$this->redirect("account/login");	
				}
				else
				{
					addErrorMessage("dbError", gettext("Opps, it looks like something went wrong while trying to register your profile."));
				}					
			}			
		}		

		//Load the register view
		$view = $this->loadView('register');

		//Load up some js files
		$view->setJS(array(
			array("static/plugins/datepicker/js/bootstrap-datepicker.min.js", "intern"),
			array("static/js/register.js", "intern"),
		));

		$view->setCSS(array(
			array("static/plugins/datepicker/css/bootstrap-datepicker3.min.css", "intern")
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

	function verifyemail($email, $hashedEmailVerification)
	{
		//Load the AccountModel to access account functions
		$model = $this->loadModel('AccountModel');

		if($model->verifiyEmail($email, $hashedEmailVerification))
		{
			addSuccessMessage("dbError", gettext("Your email has been successfuly verified! Login to start using your account!"), 1);

			$this->redirect("account/login");
		}
		else
		{
			addErrorMessage("dbError", gettext("Oops, an error occurred while attempting to verify your account!"), 1);
			$this->redirect("");
		}
	}

	function changesecurityquestion()
	{
		//Check if users is authenticated for this request
		//Will kick out if not authenticated
		
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

	function changepassword()
	{
		//Check if users is authenticated for this request
		//Will kick out if not authenticated

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
						addErrorMessage("dbError", gettext("Opps, it looks like something went wrong while trying to update your password."), 1);
					}
				}
			}
			else
			{
				if(!$this->isAjax())
				{
					addErrorMessage("dbError", gettext("Opps, it looks like your passwords don't match."), 1);
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
			require_once(APP_DIR . 'helpers/image_get_path.php');

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

				echo image_get_path_basic($this->currentUser->UserId, $imageId, IMG_PROFILE, IMG_MEDIUM);
			}
			else
			{
				$this->redirect("");
			}
		}
	}

	function changebackgroundpicture()
	{
		require_once(APP_DIR.'helpers/image_save.php');
		require_once(APP_DIR . 'helpers/image_get_path.php');

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

	function profile()
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
			if($profileViewModel->validate(1))
			{		
				//Attempt to register the user with our website				
				if($model->updateUserProfile($profileViewModel))
				{
					$sessionManger = new SessionManager();
					$sessionManger->setLanguageSession($profileViewModel->LanguageType_LanguageId);

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
					addErrorMessage("dbError", gettext("Opps, it looks like something went wrong while trying to update your profile."), 1);
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

	function search()
	{
		$accountModel = $this->loadModel("AccountModel");
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

	function ajaxSearch()
	{
		$accountModel = $this->loadModel("AccountModel");
		$searchResults = array();

		if(isset($_POST["UserSearch"]))
		{
			$searchResults = $accountModel->searchForUser($_POST["UserSearch"], $this->currentUser->UserId, 10, isset($_POST["UserSearchPage"]) ? $_POST["UserSearchPage"] : 1);
		}

		if (isset($searchResults)) {

			$currentUser = $this->currentUser;
			
			foreach ($searchResults as $user)
			{
				include(APP_DIR . "views/Account/_searchPanel.php");
			}
		}
	}

	function mostFollowersUserList()
	{
		$accountModel = $this->loadModel("AccountModel");
		$searchResults = array();

		$searchResults = $accountModel->getMostFollowersUserList($this->currentUser->UserId, 10, isset($_POST["UserMostFollowersPage"]) ? $_POST["UserMostFollowersPage"] : 1);

		$currentUser = $this->currentUser;

		if (isset($searchResults)) {
			foreach ($searchResults as $user)
			{
				include(APP_DIR . "views/Account/_searchPanel.php");
			}
		}
	}	

	function latestUserList()
	{
		$accountModel = $this->loadModel("AccountModel");
		$searchResults = array();

		$searchResults = $accountModel->getLatestUserList($this->currentUser->UserId, 10, isset($_POST["UsersLatestPage"]) ? $_POST["UsersLatestPage"] : 1);

		$currentUser = $this->currentUser;

		if (isset($searchResults)) {
			foreach ($searchResults as $user)
			{
				include(APP_DIR . "views/Account/_searchPanel.php");
			}
		}
	}

	function follow()
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

	function unfollow($userID)
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

	function addActionsTaken()
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

	function updateAbout()
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

	function updateActionStatement()
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


	/*********************************************************
	*
	*			USER HOME PAGE FUNCTIONS
	*
	***********************************************************/

	function newsFeed()
	{
		require_once(APP_DIR.'helpers/image_get_path.php');

		$storyModel = $this->loadModel("Story/StoryModel");
		$searchResults = array();

		$searchResults = $storyModel->getNewsFeed($this->currentUser->UserId, 10, isset($_POST["Page"]) ? $_POST["Page"] : 1);

		if (isset($searchResults)) {
			foreach ($searchResults as $feed)
			{
				include(APP_DIR . "views/Account/_newsFeed.php");
			}
		}
	}

	function userStories()
	{
		if(isset($_POST["UserId"]))
		{
			require_once(APP_DIR.'helpers/image_get_path.php');

			$storyModel = $this->loadModel("Story/StoryModel");
			$searchResults = array();

			$searchResults = $storyModel->getStoriesWrittenByCurrentUser($_POST["UserId"], 10, isset($_POST["Page"]) ? $_POST["Page"] : 1);

			if (isset($searchResults)) {
				foreach ($searchResults as $story)
				{
					include(APP_DIR . "views/Account/_myStories.php");
				}
			}
		}
	}

	function recommendations()
	{
		if(isset($_POST["UserId"]))
		{
			require_once(APP_DIR.'helpers/image_get_path.php');

			$storyModel = $this->loadModel("Story/StoryModel");
			$searchResults = array();

			$searchResults = $storyModel->getStoriesRecommendedByCurrentUser($_POST["UserId"], 10, isset($_POST["Page"]) ? $_POST["Page"] : 1);

			if (isset($searchResults)) {
				foreach ($searchResults as $story)
				{
					include(APP_DIR . "views/Account/_myRecommendations.php");
				}
			}
		}
	}

	function followinglist()
	{
		if(isset($_POST["UserId"]))
		{
			require_once(APP_DIR.'helpers/image_get_path.php');

			$accountModel = $this->loadModel('AccountModel');
			$searchResults = array();

			$searchResults = $accountModel->getFollowing($_POST["UserId"], 10, isset($_POST["Page"]) ? $_POST["Page"] : 1);

			if (isset($searchResults)) {

				$currentUser = $this->currentUser;
				foreach ($searchResults as $user)
				{
					include(APP_DIR . "views/Account/_searchPanel.php");
				}
			}
		}
	}

	function followerslist()
	{
		if(isset($_POST["UserId"]))
		{
			require_once(APP_DIR.'helpers/image_get_path.php');

			$accountModel = $this->loadModel('AccountModel');
			$searchResults = array();

			$searchResults = $accountModel->getFollowers($_POST["UserId"], 10, isset($_POST["Page"]) ? $_POST["Page"] : 1);

			if (isset($searchResults)) {

				$currentUser = $this->currentUser;
				foreach ($searchResults as $user)
				{
					include(APP_DIR . "views/Account/_searchPanel.php");
				}
			}
		}
	}

	function publishedList()
	{
		if($this->isAuth() && $this->isAjax())
		{
			require_once(APP_DIR.'helpers/image_get_path.php');

			$siteModel = $this->loadModel('SiteContent/SiteContentModel');
			$privacyDropdownValues = $siteModel->getDropdownValues_StoryPrivacyType();

			$storyModel = $this->loadModel("Story/StoryModel");
			$searchResults = array();

			$searchResults = $storyModel->getStoriesPublished_Public_Private($this->currentUser->UserId, 10, isset($_POST["Page"]) ? $_POST["Page"] : 1);

			if (isset($searchResults)) {
				foreach ($searchResults as $story)
				{
					include(APP_DIR . "views/Account/_publishedStories.php");
				}
			}
		}
	}

	function draftsList()
	{
		if($this->isAuth() && $this->isAjax())
		{
			require_once(APP_DIR.'helpers/image_get_path.php');

			$storyModel = $this->loadModel("Story/StoryModel");
			$searchResults = array();

			$searchResults = $storyModel->getStoryListDrafts($this->currentUser->UserId, 10, isset($_POST["Page"]) ? $_POST["Page"] : 1);

			if (isset($searchResults)) {
				foreach ($searchResults as $story)
				{
					include(APP_DIR . "views/Account/_draftStories.php");
				}
			}
		}
	}

	function pendingList()
	{
		if($this->isAuth() && $this->isAjax())
		{
			require_once(APP_DIR.'helpers/image_get_path.php');

			$storyModel = $this->loadModel("Story/StoryModel");
			$searchResults = array();

			$searchResults = $storyModel->getStoryListPendingApproval($this->currentUser->UserId, 10, isset($_POST["Page"]) ? $_POST["Page"] : 1);

			if (isset($searchResults)) {
				foreach ($searchResults as $story)
				{
					include(APP_DIR . "views/Account/_pendingStories.php");
				}
			}
		}
	}

	function rejectedList()
	{
		if($this->isAuth() && $this->isAjax())
		{
			require_once(APP_DIR.'helpers/image_get_path.php');

			$storyModel = $this->loadModel("Story/StoryModel");
			$searchResults = array();

			$searchResults = $storyModel->getStoryListRejected($this->currentUser->UserId, 10, isset($_POST["Page"]) ? $_POST["Page"] : 1);

			if (isset($searchResults)) {
				foreach ($searchResults as $story)
				{
					include(APP_DIR . "views/Account/_rejectedStories.php");
				}
			}
		}
	}

	function commentsPendingApprovalList()
	{
		if($this->isAuth() && $this->isAjax())
		{
			require_once(APP_DIR.'helpers/image_get_path.php');

			$storyModel = $this->loadModel("Story/StoryModel");
			$searchResults = array();

			$searchResults = $storyModel->getUnpublisedComments($this->currentUser->UserId, 10, isset($_POST["Page"]) ? $_POST["Page"] : 1);

			if (isset($searchResults)) {
				foreach ($searchResults as $comment)
				{
					include(APP_DIR . "views/Account/_comments.php");
				}
			}
		}
	}

	function approveComment()
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

	function rejectComment()
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

	function changeStoryPrivacy()
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
}

?>
