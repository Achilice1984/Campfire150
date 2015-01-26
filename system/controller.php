<?php

/***************************************************************************
*
* The controller in the model, view, controller design patter.
*
* The controller is what the user interacts with, a collecter of information
*
*****************************************************************************/


class Controller {
	
	/***************************************************
	*
	*		The next 4 functions are used load additional code.
	*
	****************************************************/
	public function loadModel($name)
	{
		require(APP_DIR .'models/'. get_class($this) . "/" .  $name .'.php');

		$model = new $name;
		return $model;
	}
	
	public function loadView($name)
	{
		$view = new View(get_class($this) . "/" . $name);
		return $view;
	}
	
	public function loadPlugin($name)
	{
		require(APP_DIR .'plugins/'. $name .'.php');
	}
	
	public function loadHelper($name)
	{
		require(APP_DIR .'helpers/'. $name .'.php');
		$helper = new $name;
		return $helper;
	}
	
	//By placing a location (example, home/index) you can redirect to another url.
	public function redirect($loc)
	{
		global $config;
		
		header('Location: '. $config['base_url'] . $loc);
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