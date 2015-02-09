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
		$accountHomeViewModel->$recommendedStoryList = $model->getStoriesRecommendedByFriends($currentUser->UserId);
		$accountHomeViewModel->$usersStoryList = $model->getStoriesWrittenByCurrentUser($currentUser->UserId);
		$accountHomeViewModel->$followingList = $model->getFollowing($currentUser->UserId);

		//How many people are they following
		$accountHomeViewModel->$totalFollowing = $model->getTotalFollowing($currentUser->UserId);

		// How many people are following the user
		$accountHomeViewModel->$totalFollowers = $model->totalFollowers($currentUser->UserId);

		//How many approved stories
		$accountHomeViewModel->$totalApprovedStories = $model->getTotalStoriesApproved($currentUser->UserId);

		//How many pending stories
		$accountHomeViewModel->$totalPendingStories = $model->getTotalStoriesPending($currentUser->UserId);

		//How many denied stories
		$accountHomeViewModel->$totalDeniedStories = $model->getTotalStoriesDenied($currentUser->UserId);

		//How many approved comments
		$accountHomeViewModel->$totalApprovedComments = $model->getTotalCommentsApproved($currentUser->UserId);

		//How many penfing comments
		$accountHomeViewModel->$totalPendingComments = $model->getTotalCommentsPending($currentUser->UserId);



		//Load the home view
		$view = $this->loadView('home');

		//Add a variable with data so that it can be accessed in the view
		$view->set('accountHomeViewModel', $accountHomeViewModel);

		//Render the home view. true indicates to load the layout pages as well
		$view->render(true);
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
					$loginViewModel->addErrorMessage("dbError", gettext("Opps, it looks like your attempt to login faild."));
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
					$user->addErrorMessage("dbError", gettext("Opps, it looks like something went wrong while trying to register your profile."));
				}					
			}			
		}

		//Load the register view
		$view = $this->loadView('register');

		//Add a variable with old userViewModel data so that it can be accessed in the view
		$view->set('userViewModel', $userViewModel);
		
		//Render the register view. true indicates to load the layout pages as well
		$view->render(true);
	}


	function profile()
	{
		//Check if users is authenticated for this request
		//Will kick out if not authenticated
		$this->AuthRequest();

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
				if($model->updateUserProfile($userViewModel))
				{
					//If success, send user to the home page
					$this->redirect("account/home");	
				}
				else
				{
					$user->addErrorMessage("dbError", gettext("Opps, it looks like something went wrong while trying to update your profile."));
				}					
			}			
		}

		//Load the profile view
		$view = $this->loadView('profile');

		//Add a variable with old userViewModel data so that it can be accessed in the view
		$view->set('userViewModel', $userViewModel);
		
		//Render the profile view. true indicates to load the layout pages as well
		$view->render(true);
	}
}

?>
