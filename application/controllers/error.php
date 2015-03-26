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
		if(isset($_SESSION["errno"]) || isset($_SESSION["exception"]))
		{
			$file;
			$errorString;

			if(isset($_SESSION["errno"]))
			{
				$file = ROOT_DIR . "static/errorlogs/errors.html";

				//$fileContents = file_get_contents($file);

				$errorString = '<div class="error">
	<div class="errorType">
		<h2>Date</h2>
		<div class="errorDateContent">' . date("Y-m-d H:i:s") . '</div>
		<h2>Type</h2>
		<div class="errorTypeContent">' . $_SESSION["errstr"] . '</div>
	</div>
	<div class="errorType">
		<h2>Number</h2>
		<div class="errorTypeContent">' . $_SESSION["errno"] . '</div>
	</div>
	<div class="errorType">
		<h2>Location</h2>
		<div class="errorTypeContent">' . $_SESSION["errfile"] . '</div>
	</div>
	<div class="errorType">
		<h2>Line</h2>
		<div class="errorTypeContent">' . $_SESSION["errline"] . '</div>
	</div>	
	<hr />
</div>';

				file_put_contents($file, $errorString, FILE_APPEND | LOCK_EX);
			}
			else
			{
				$ex = $_SESSION["exception"];

				$file = ROOT_DIR . "static/errorlogs/exceptions.html";

				//$fileContents = file_get_contents($file);

				$errorString = '<div class="error">
	<div class="exceptionDiv">
		<h2>Exception Print ' . date("Y-m-d H:i:s") . '</h2>
		<div class="exceptionContent"><pre>' . print_r($ex, true) . '</pre></div>
	</div>	
	<hr />
</div>';
				file_put_contents($file, $errorString, FILE_APPEND | LOCK_EX);
			}
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
