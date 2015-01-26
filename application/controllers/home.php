<?php

class Home extends Controller {
	
	function index()
	{
		$testViewModel = $this->loadModel('TestViewModel');

		if($this->isPost())
		{
			if($testViewModel->getValidationResult()->isValid())
			{
				$this->redirect("home/index");
			}
			else
			{
				$template = $this->loadView('home_view');
				$template->set('testViewModel', $testViewModel);
				$template->render();
			}
		}
		else
		{
			$template = $this->loadView('home_view');
			$template->set('testViewModel', $testViewModel);
			$template->render(true);
		}
	}

	function homeformsubmit()
	{

		//$testViewModel = $this->loadModel('TestViewModel');
		$testViewModel = AutoMapper::mapPost($testViewModel);

		$testViewModel->validate();

		if($testViewModel->getValidationResult()->isValid())
		{
			$this->redirect("home/index");
		}
		else
		{
			$template = $this->loadView('home_view');
			$template->set('testViewModel', $testViewModel);
			$template->render();
		}
	}
    
}

?>
