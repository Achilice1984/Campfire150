<?php

class ControllerExample extends Controller {
	
	//Main action for controller, equivelent to: www.site.com/controller/
	function index()
	{
		//Loads a model from corresponding model folder
		$model = $this->loadModel('ModelName');

		//Loads a view from corresponding view folder
		$template = $this->loadView('ViewName');
		//Adds a variable or object to that can be accessed in the view
		$template->set('model', $model);
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
		$model = $this->loadModel('ModelName');

		//Loads a view from corresponding view folder
		$template = $this->loadView('ViewName');
		//Adds a variable or object to that can be accessed in the view
		$template->set('model', $model);
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
		$model = $this->loadModel('ModelName');

		//Loads a view from corresponding view folder
		$template = $this->loadView('ViewName');
		//Adds a variable or object to that can be accessed in the view
		$template->set('model', $model);
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
		$model = $this->loadModel('ModelName');

		//Loads a view from corresponding view folder
		$template = $this->loadView('ViewName');
		//Adds a variable or object to that can be accessed in the view
		$template->set('model', $model);
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

	function get()
	{
		//Loads a model from corresponding model folder
		$model = $this->loadModel('ModelName');

		//Loads a view from corresponding view folder
		$template = $this->loadView('ViewName');
		//Adds a variable or object to that can be accessed in the view
		$template->set('model', $model);
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
