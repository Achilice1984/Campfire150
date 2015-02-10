<?php

class Error extends Controller {
	
	function index()
	{
		$this->error404();
	}
	
	function error404()
	{
		echo '<h1>404 Error</h1>';
		echo '<p>Looks like this page doesn\'t exist</p>';
	}
    
    function generic()
	{
		if(isset($_SESSION["errno"]))
		{
			//Load the register view
			$view = $this->loadView('generic');
			
			//Render the register view. true indicates to load the layout pages as well
			$view->render(true);

			unset($_SESSION["errno"]);
			unset($_SESSION["errstr"]);
			unset($_SESSION["errfile"]);
			unset($_SESSION["errline"]);
		}
		else
		{
			$this->redirect("");
		}
	}
}

?>
