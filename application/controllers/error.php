<?php

class Error extends Controller {
	
	function index()
	{
		$this->error404();
	}
	
	function error401()
	{
		$view = $this->loadView('401');
		$view->render(true);
	}
	function error403()
	{
		$view = $this->loadView('403');
		$view->render(true);
	}
	function error404()
	{
		$view = $this->loadView('404');
		$view->render(true);
	}
	function error500()
	{
		$view = $this->loadView('500');
		$view->render(true);
	}
	function error502()
	{
		$view = $this->loadView('502');
		$view->render(true);
	}
	function error504()
	{
		$view = $this->loadView('504');
		$view->render(true);
	}
	function error508()
	{
		$view = $this->loadView('508');
		$view->render(true);
	}

    
    function generic()
	{
		if(isset($_SESSION["errno"]))
		{
			//Load the register view
			$view = $this->loadView('generic');
			
			//Render the register view. true indicates to load the layout pages as well
			$view->render(true);	

			$this->unsetErrors();		
		}	
		else
		{
			$this->unsetErrors();
			$this->redirect("");
		}		
	}

	private function unsetErrors()
	{
		unset($_SESSION["errno"]);
		unset($_SESSION["errstr"]);
		unset($_SESSION["errfile"]);
		unset($_SESSION["errline"]);
	}
}

?>
