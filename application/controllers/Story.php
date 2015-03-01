<?php

class Story extends Controller {
	
	//Main action for controller, equivelent to: www.site.com/controller/
	function index()
	{
		//Loads a model from corresponding model folder
		$model = $this->loadModel('SomeModel');

		//Loads a view model from corresponding viewmodel folder
		$viewModel = $this->loadModel('SomeViewModel');

		//Loads a view from corresponding view folder
		$template = $this->loadView('index');
		//Adds a variable or object to that can be accessed in the view
		$template->set('viewModel', $viewModel);
		//Renders the view. true indicates to load the layout
		$template->render(true);

		//Execute code if a post back
		if($this->isPost())
		{
			//Can be used to redirect to another controller
			//Can add query values ?id=1
			//$this->redirect("controller/action");

			//Check if request is ajax
			//$this->isAjax()
		}
		else
		{
			//Execute this code if NOT a post back
		}
	}
	function StoryList()
	{
		$storyModel = $this->loadModel("Story/StoryModel");

		$stories  = $storyModel->getStories();

		if($this->isAjax())
		{
			echo json_encode($stories);
		}
		else
		{
			$view = $this->loadView("storyList");
			$view->set('stories', $stories);
			$view->render(true);//true = add header foot
		}
	}

	function search()
	{
		//Load the profile view
		$view = $this->loadView('search');

		//Render the profile view. true indicates to load the layout pages as well
		$view->render(true);
	}

	function add()
	{
		//Check if users is authenticated for this request
		//Will kick out if not authenticated
		$this->AuthRequest();

		//Loads a view model from corresponding viewmodel folder
		$storyViewModel = $this->loadViewModel('shared/StoryViewModel');

		//Execute code if a post back
		if($this->isPost())
		{
			//Map post values to the loginViewModel
			$loginViewModel = AutoMapper::mapPost($loginViewModel);

			//Load the AccountModel to access account functions
			$storyModel = $this->loadModel('StoryModel');
		}		

		//Load the profile view
		$view = $this->loadView('add');

		$siteModel = $this->loadModel('SiteContent/SiteContentModel');
		$view->set('privacyDropdownValues', $siteModel->getDropdownValues_StoryPrivacyType());

		//Add a variable with old login data so that it can be accessed in the view
		$view->set('storyViewModel', $storyViewModel);

		//Load up some js files
		$view->setJS(array(
			array("static/plugins/tinymce/tinymce.min.js", "intern"),
			array("static/js/tinymce.js", "intern")
		));

		//Render the profile view. true indicates to load the layout pages as well
		$view->render(true);
	}

	function edit()
	{
		//Check if users is authenticated for this request
		//Will kick out if not authenticated
		$this->AuthRequest();

		//Loads a view model from corresponding viewmodel folder
		$storyViewModel = $this->loadViewModel('shared/StoryViewModel');

		//Execute code if a post back
		if($this->isPost())
		{
			//Map post values to the loginViewModel
			$loginViewModel = AutoMapper::mapPost($loginViewModel);

			//Load the AccountModel to access account functions
			$storyModel = $this->loadModel('StoryModel');
		}		

		//Load the profile view
		$view = $this->loadView('edit');

		$siteModel = $this->loadModel('SiteContent/SiteContentModel');
		$view->set('privacyDropdownValues', $siteModel->getDropdownValues_StoryPrivacyType());

		//Add a variable with old login data so that it can be accessed in the view
		$view->set('storyViewModel', $storyViewModel);

		//Load up some js files
		$view->setJS(array(
			array("static/plugins/tinymce/tinymce.min.js", "intern"),
			array("static/js/tinymce.js", "intern")
		));

		//Render the profile view. true indicates to load the layout pages as well
		$view->render(true);
	}

	function display($storyID)
	{
		//Check if users is authenticated for this request
		//Will kick out if not authenticated
		$this->AuthRequest();


		//Load the AccountModel to access account functions
		$model = $this->loadModel('StoryModel');

		//Loads a view model from corresponding viewmodel folder
		$storyViewModel = $this->loadViewModel('shared/StoryViewModel');	

		$storyViewModel = $model->getStory($this->currentUser->UserId, $storyID);

		//Load the profile view
		$view = $this->loadView('display');

		//Add a variable with old login data so that it can be accessed in the view
		$view->set('storyViewModel', $storyViewModel);

		//Render the profile view. true indicates to load the layout pages as well
		$view->render(true);
	}
}

?>
