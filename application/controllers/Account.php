<?php

class Account extends Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	//The home view will be where a user can view all of their account information
	function home()
	{	
		//Check if users is authenticated for this request
		//Will kick out if not authenticated
		$this->AuthRequest();


		/*******************************************
		*
		*		Populate data
		*
		**********************************************/		

		//Load the accountHomeViewModel
		$accountHomeViewModel = $this->loadViewModel('AccountHomeViewModel');

		//Load the AccountModel to access account functions
		$model = $this->loadModel('AccountModel');

		//Populate data to be shown on the page
		// $accountHomeViewModel->$recommendedStoryList = $model->getStoriesRecommendedByFriends($currentUser->UserId);
		// $accountHomeViewModel->$usersStoryList = $model->getStoriesWrittenByCurrentUser($currentUser->UserId);
		// $accountHomeViewModel->$followingList = $model->getFollowing($currentUser->UserId);

		// //How many people are they following
		// $accountHomeViewModel->$totalFollowing = $model->getTotalFollowing($currentUser->UserId);

		// // How many people are following the user
		// $accountHomeViewModel->$totalFollowers = $model->totalFollowers($currentUser->UserId);

		// //How many approved stories
		// $accountHomeViewModel->$totalApprovedStories = $model->getTotalStoriesApproved($currentUser->UserId);

		// //How many pending stories
		// $accountHomeViewModel->$totalPendingStories = $model->getTotalStoriesPending($currentUser->UserId);

		// //How many denied stories
		// $accountHomeViewModel->$totalDeniedStories = $model->getTotalStoriesDenied($currentUser->UserId);

		// //How many approved comments
		// $accountHomeViewModel->$totalApprovedComments = $model->getTotalCommentsApproved($currentUser->UserId);

		// //How many penfing comments
		// $accountHomeViewModel->$totalPendingComments = $model->getTotalCommentsPending($currentUser->UserId);



		//Load the home view
		$view = $this->loadView('home');

		//Add a variable with data so that it can be accessed in the view
		$view->set('accountHomeViewModel', $accountHomeViewModel);

		//Render the home view. true indicates to load the layout pages as well
		$view->render(true);
	}	

	function testAdmin()
	{
		$model = $this->loadModel('Admin/AdminModel');
		
		$returnData = $model->testStory();
		
		debugit($returnData);
	}

	function testStory()
	{
		$model = $this->loadModel('Story/StoryModel');
		
		$returnData = $model->publishNewStory($story);
		
		debugit($returnData);
	}

	function testAccount()
	{
		$model = $this->loadModel('Account/AccountModel');
		$model->sendEmailVerification("josh.dvrs@gmail.com", "454545454545454545454");
		// $returnData = $model->getCurrentProfilePictureMetadata(1);
		
		// debugit($returnData);
	}

	function login()
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
					//If success, send user to the login page
					$this->redirect("account/login");	
				}
				else
				{
					addErrorMessage("dbError", gettext("Opps, it looks like something went wrong while trying to register your profile."));
				}					
			}			
		}

		$siteModel = $this->loadModel('SiteContent/SiteContentModel');
		$privacyDropdownValues = $siteModel->getDropdownValues_ProfilePrivacyType();

		//Load the register view
		$view = $this->loadView('register');

		//Add a variable with old userViewModel data so that it can be accessed in the view
		$view->set('userViewModel', $userViewModel);
		$view->set('privacyDropdownValues', $privacyDropdownValues);
		
		//Render the register view. true indicates to load the layout pages as well
		$view->render(true);
	}

	function verifyemail($email, $hashedEmailVerification)
	{
	}

	function changepassword()
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
				//If success
				$this->redirect("Account/profile");	
			}
			else
			{
				addErrorMessage("dbError", gettext("Opps, it looks like something went wrong while trying to update your password."));
			}
		}
		else
		{
			addErrorMessage("dbError", gettext("Opps, it looks like your passwords don't match."));
		}

		//Load the userViewModel
		$userViewModel = $this->loadViewModel('shared/UserViewModel');		

		//Load the register view
		$view = $this->loadView('profile');

		//Add a variable with old userViewModel data so that it can be accessed in the view
		$view->set('userViewModel', $userViewModel);
		
		//Render the register view. true indicates to load the layout pages as well
		$view->render(true);
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
			//Map post values to the userViewModel
			$pictureViewModel = AutoMapper::mapPost($pictureViewModel);

			//Validate data that was posted to the server
			//This will also set the temp errors to be shown in the view
			if($pictureViewModel->validate())
			{	
				//Call the database
				//this function will save image meta data in the database
				//it will return the image id
				//1 == profile type image in the database
				$imageId = $model->saveUserImageMetadata($this->currentUser->UserId, $pictureViewModel, 1);

				if($imageId != 0)
				{
					//image saved succefully in database
					//process image and save in file system
					//debugit($pictureViewModel);

					//this is your image file
					//$pictureViewModel->ProfilePicture;

					$savedSuccessfuly = saveImage($cuurentUser->UserId, $pictureViewModel, 1);

					if($savedSuccessfuly == false)
					{
						//Ann error occoured you hvae to remove new profile picture meta data from the database
						$model->removeImageMetaData($imageId);

						//add error message so user knows whats up
						addErrorMessage("imageError", gettext("Opps, it looks like something went wrong while trying to save your profile picture."));
					}
				}
				else
				{
					//add error message so user knows whats up
					addErrorMessage("imageError", gettext("Opps, it looks like something went wrong while trying to save your profile picture."));
				}

			}

		}
		else
		{
			$this->redirect("");
		}


		//$this->redirect("account/profile");
	}

	function changebackgroundpicture()
	{
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

					//If success, send user to the home page
					$this->redirect("account/home");	
				}
				else
				{
					addErrorMessage("dbError", gettext("Opps, it looks like something went wrong while trying to update your profile."));
				}					
			}			
		}

		$siteModel = $this->loadModel('SiteContent/SiteContentModel');
		$privacyDropdownValues = $siteModel->getDropdownValues_ProfilePrivacyType();

		//Load the profile view
		$view = $this->loadView('profile');

		//Add a variable with old userViewModel data so that it can be accessed in the view
		$view->set('userViewModel', $profileViewModel);
		$view->set('privacyDropdownValues', $privacyDropdownValues);
		
		//Render the profile view. true indicates to load the layout pages as well
		$view->render(true);
	}
}

?>
