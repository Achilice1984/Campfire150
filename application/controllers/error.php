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
    
    function generic(Exception $ex)
	{
		echo '<h1>Generic Error</h1>';
		echo '<p>Looks like this page doesn\'t exist</p>';
	}
}

?>
