<?php

class Development extends Controller {
	
	function index()
	{
		$template = $this->loadView('index');
		$template->render(true);
	}

	function newmodule()
	{
		$module = $this->loadModel('Module');
		$module = AutoMapper::mapPost($module);

		$module->models = split(",", $module->models);

		if (!file_exists(APP_DIR . 'views/' . $module->module)) 
		{
		    mkdir(APP_DIR . 'views/' . $module->module, 0777, true);
		}
		if (!file_exists(APP_DIR . 'models/' . $module->module)) 
		{
		    mkdir(APP_DIR . 'models/' . $module->module, 0777, true);
		}


		foreach ($module->models as $model) {

			$model = trim($model);
			
			$modelUrl = APP_DIR . 'models/' . $module->module . "/" . $model . ".php";

			if (!file_exists($modelUrl)) 
			{
				copy(APP_DIR . '../templates/model.php', $modelUrl);

				$modelFileContents = file_get_contents($modelUrl);	
	
				$modelFileContents = str_replace("ExampleModel", $model, $modelFileContents);	

				file_put_contents($modelUrl, $modelFileContents);				    
			}
		}

		$controllerUrl = APP_DIR . 'controllers/' . $module->module . ".php";

		if (!file_exists($controllerUrl)) 
		{
			copy(APP_DIR . '../templates/controller.php', $controllerUrl);		

			$controllerFileContents = file_get_contents($controllerUrl);	
	
			$controllerFileContents = str_replace("ControllerExample", $module->module, $controllerFileContents);	

			file_put_contents($controllerUrl, $controllerFileContents);		    
		}

		if($module->crud)
		{
			$crudArray = array('insert', 'update', 'delete', 'index');
			$viewUrl = APP_DIR . 'views/';

			foreach ($crudArray as $viewName) {

				if (!file_exists($viewUrl . $viewName . ".php")) 
				{
					$viewFileUrl = $viewUrl . $module->module . "/" . $viewName . ".php";

					copy(APP_DIR . '../templates/view.php', $viewFileUrl);

					$viewFileContents = file_get_contents($viewFileUrl);	
		
					$viewFileContents = str_replace("ControllerExample", $module->module, $viewFileContents);	
					$viewFileContents = str_replace("ActionExample", $viewName, $viewFileContents);

					file_put_contents($viewFileUrl, $viewFileContents);
				}
			}

		}

		$_SESSION["NewModuleMessage"] = "Your module was created successfuly!";

		$this->redirect("development/index");		
	}    
}

?>
