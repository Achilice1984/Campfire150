<?php

/***************************************************************************
*
* The view in the model, view, controller design patter.
*
* The view is what displays information to the user.
*
*****************************************************************************/

class View {

	private $pageVars = array();
	private $template;

	public function __construct($template)
	{
		$this->template = APP_DIR .'views/'. $template .'.php';
	}

	public function set($var, $val)
	{
		$this->pageVars[$var] = $val;
	}

	public function loadPlugin($name)
	{
		$this->pageVars[$name] = true;
	}

	public function render($useLayout = false)
	{
		extract($this->pageVars);

		ob_start();

		if($useLayout)
		{
			require(APP_DIR .'views/header.php');
			require($this->template);
			require(APP_DIR .'views/footer.php');
		}
		else
		{			
			require($this->template);			
		}

		echo ob_get_clean();
	}

	public function render_layout()
	{
		extract($this->pageVars);

		ob_start();
		require(APP_DIR .'views/header.php');
		require($this->template);
		require(APP_DIR .'views/footer.php');
		echo ob_get_clean();
	}
    
}

?>