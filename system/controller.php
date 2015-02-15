<?php

/***************************************************************************
*
* The controller in the model, view, controller design patter.
*
* The controller is what the user interacts with, a collecter of information
*
*****************************************************************************/


class Controller {

	public $currentUser;

	function __construct()
	{
		$sessionManager = new SessionManager();

		$this->currentUser = $sessionManager->getUserSession();

		if($this->currentUser == null)
		{
			$this->currentUser = new UserViewModel();
		}
	}

	public function isAuth()
	{
		try
		{
			$auth = new Authentication();

			return $auth->isAuthenticated();
		}
		catch(Exception $ex)
		{
			// Worst case, exit everything to prevent intrusion
			exit;
		}
	}

	public function isAdmin()
	{
		try
		{
			$auth = new Authentication();

			return $auth->isAdmin();
		}
		catch(Exception $ex)
		{
			// Worst case, exit everything to prevent intrusion
			exit;
		}
	}

	public function AuthRequest()
	{
		try
		{
			$auth = new Authentication();

			if(!$auth->isAuthenticated())
			{
				$this->redirect("");
			}
		}
		catch(Exception $ex)
		{
			// Worst case, exit everything to prevent intrusion
			exit;
		}
	}

	public function AdminRequest()
	{
		try
		{
			$auth = new Authentication();

			if(!$auth->isAdmin())
			{
				$this->redirect("");
			}
		}
		catch(Exception $ex)
		{
			// Worst case, exit everything to prevent intrusion
			exit;
		}
	}
	
	/***************************************************
	*
	*		The next 4 functions are used load additional code.
	*
	****************************************************/
	public function loadModel($name)
	{
		$urlArray = explode("/", $name);

		if(count($urlArray) > 1)
		{
			require_once(APP_DIR .'models/' . $name .'.php');

			$name = $urlArray[count($urlArray) - 1];
		}
		else
		{
			require_once(APP_DIR .'models/'. get_class($this) . "/" .  $name .'.php');
		}

		$model = new $name;
		return $model;
	}

	public function loadViewModel($name)
	{
		$urlArray = explode("/", $name);

		if(count($urlArray) > 1)
		{
			require_once(APP_DIR .'viewmodels/' . $name .'.php');

			$name = $urlArray[count($urlArray) - 1];
		}
		else
		{
			require_once(APP_DIR .'viewmodels/'. get_class($this) . "/" .  $name .'.php');
		}

		$model = new $name;
		
		return $model;
	}
	
	public function loadView($name)
	{
		$view = new View(get_class($this) . "/" . $name);
		$view->set("currentUser", $this->currentUser);

		return $view;
	}
	
	public function loadPlugin($name)
	{
		require_once(APP_DIR .'plugins/'. $name .'.php');
	}
	
	public function loadHelper($name)
	{
		require_once(APP_DIR .'helpers/'. $name .'.php');
		$helper = new $name;
		return $helper;
	}
	
	//By placing a location (example, home/index) you can redirect to another url.
	public function redirect($loc)
	{		
		header('Location: '. BASE_URL . $loc);
		exit;
	}

	//This will do a check to verify if a request was initialized via ajax
	public function isAjax()
	{
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function isPost()
	{
		if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
		{
			return true;
		}
		else
		{
			return false;
		}
	}
    
}

?>