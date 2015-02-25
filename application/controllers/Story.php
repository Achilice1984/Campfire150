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
		//Load the profile view
		$view = $this->loadView('add');

		//Render the profile view. true indicates to load the layout pages as well
		$view->render(true);
	}

	function edit()
	{
		//Load the profile view
		$view = $this->loadView('edit');

		//Render the profile view. true indicates to load the layout pages as well
		$view->render(true);
	}

	function display()
	{
		//Load the profile view
		$view = $this->loadView('display');

		//Render the profile view. true indicates to load the layout pages as well
		$view->render(true);
	}
}

?>
