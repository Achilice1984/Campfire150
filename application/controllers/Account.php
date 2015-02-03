<?php

class Account extends Controller {

	function __construct()
	{
		//Must be logged in to use functions
		// if(!$this->isAuth())
		// {
		// 	$this->redirect("");
		// }
	}
	
	//Main action for controller, equivelent to: www.site.com/controller/
	function index($id, $blah)
	{
		//Loads a model from corresponding model folder
		$model = $this->loadModel('AccountModel');

		//Loads a view model from corresponding viewmodel folder
		$viewModel = $this->loadViewModel('AccountViewModel');
		$viewmodel->storyList = $model->getStoyrList();

		//Loads a view from corresponding view folder
		$template = $this->loadView('index');
		//Adds a variable or object to that can be accessed in the view
		$template->set('viewModel', $viewModel);
		//Renders the view. true indicates to load the layout
		$template->render(true);

		if($this->isAdmin())
		{
			$model->getuserListAdmin();
		}
		else
		{
			$model->getRegularUserList();
		}
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

	function profile()
	{
		//Loads a model from corresponding model folder
		$model = $this->loadModel('AccountModel');
		$model->updateProfile

		$user = AutoMapper::mapPost(new User());

		$model->updateUser($user);
		//Loads a view model from corresponding viewmodel folder
		$viewModel = $this->loadViewModel('AccountViewModel');

		//Loads a view from corresponding view folder
		$template = $this->loadView('profile');
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

	function insert()
	{
		//Loads a model from corresponding model folder
		$model = $this->loadModel('AccountModel');

		//Loads a view model from corresponding viewmodel folder
		$viewModel = $this->loadViewModel('AccountViewModel');

		//Loads a view from corresponding view folder
		$template = $this->loadView('insert');
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

	function update()
	{
		//Loads a model from corresponding model folder
		$model = $this->loadModel('AccountModel');

		//Loads a view model from corresponding viewmodel folder
		$viewModel = $this->loadViewModel('AccountViewModel');

		//Loads a view from corresponding view folder
		$template = $this->loadView('update');
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

	function delete()
	{
		//Loads a model from corresponding model folder
		$model = $this->loadModel('AccountModel');

		//Loads a view model from corresponding viewmodel folder
		$viewModel = $this->loadViewModel('AccountViewModel');

		//Loads a view from corresponding view folder
		$template = $this->loadView('delete');
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
}

?>
