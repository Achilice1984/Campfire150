<?php

class Admin extends Controller {

	function __construct()
	{
		parent::__construct();

		//Will limit all these function to admin level of privlidge
		// if(!$this->isAdmin())
		// {
		// 	$this->redirect("");
		// }
	}
	
	function testAdmin()
	{
		$model = $this->loadModel('Admin/AdminModel');
	
		//$returnData = $model->addQuestionAnswer(9, "testE", "testF");
		$returnData = $model->addDropdownValue("gendertype","xxE", "xxF");

		debugit($returnData);
	}
	
	//Main action for controller, equivelent to: www.site.com/controller/
	function index()
	{
		//Loads a model from corresponding model folder
		$model = $this->loadModel('AdminModel');

		//Loads a view model from corresponding viewmodel folder
		//$viewModel = $this->loadModel('SomeViewModel');

		//Loads a view from corresponding view folder
		$template = $this->loadView('index');

		//  $template->setCSS(array(
		// 	array("static/css/style.css", "intern")
		// 	array("http://www.example.com/default.css", "extern")
		// ));
		$template->setJS(array(
			//array("static/plugins/tinymce/tinymce.min.js", "intern"),
			array("static/plugins/datatables/media/js/jquery.dataTables.js", "intern"),
			array("static/js/adminDataTables.js", "intern")//,
			//array("static/js/tinymce.js", "intern")
			//array("http://www.example.com/static.js", "extern")
		));
		 $template->setCSS(array(
			array("static/plugins/datatables/media/css/jquery.dataTables.min.css", "intern")
		));
		//Adds a variable or object to that can be accessed in the view
		//$template->set('viewModel', $viewModel);

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

	function storyeditpending($storyId)
	{

		//Loads a model from corresponding model folder
		$model = $this->loadModel('AdminModel');

		/***********************************
		*Get the story
		************************************/
		//Loads a model from corresponding model folder
		$storyModel = $this->loadModel('Story/StoryModel');
		//Load the loginViewModel
		$storyViewModel = $this->loadViewModel('shared/StoryViewModel');
		$storyViewModel = $storyModel->getStory($this->currentUser->UserId, $storyId);

		/***********************************
		*Get the useer details for the story
		************************************/
		//Loads a model from corresponding model folder
		$accountModel = $this->loadModel('Account/AccountModel');
		$userViewModel = $this->loadViewModel('shared/UserViewModel');		

		if(isset($storyViewModel[0]))
		{
			//eliminate array
			$storyViewModel = $storyViewModel[0];

			$userViewModel = $accountModel->getUserProfileByID($storyViewModel->UserId);
		}
		
		//Loads a model from corresponding model folder
		$model = $this->loadModel('AdminModel');

		//Load the approval view model
		$aprovalViewModel = $this->loadViewModel('ApprovalViewModel');

		//Map post values to the loginViewModel
		$aprovalViewModel  = AutoMapper::mapPost($aprovalViewModel );

		$aprovalViewModel->Id = $storyId;

		//addSuccessMessage("dbError", "Errror!");
		//addErrorMessage("dbError", "Errror!");

		//Execute code if a post back
		if($this->isPost())
		{
			if($aprovalViewModel ->validate())
			{
				// Save data

				//$this->redirect("admin/index");
			}

			//validate and save data
			//$_POST["filedName"]
		}

		//Loads a view from corresponding view folder
		$view = $this->loadView('storyeditpending');

		//Add a variable with old login data so that it can be accessed in the view
		$view->set('aprovalViewModel', $aprovalViewModel);

		//Add a variable with old login data so that it can be accessed in the view
		$view->set('storyViewModel', $storyViewModel);

		//Add a variable with old login data so that it can be accessed in the view
		$view->set('userViewModel', $userViewModel);

		//Renders the view. true indicates to load the layout
		$view->render(true);
	}


	/**************************************************************************************************
	*
	*						AJAX FUNCTIONS
	*
	***************************************************************************************************/

	function AjaxUserList()
	{
		$userList;
		$howMany = $_POST["length"]; //How many results to return
		$start = $_POST["start"]; //What page number in results
		$page = ($start / $howMany) + 1;
		$resultData = array();

		$adminModel = $this->loadModel('AdminModel');
		//$this->currentUser->UserId;

		if(!empty($_POST["search"]["value"]))
		{			
			//Perform a search
			$userList = $adminModel->searchForUser($userSearch, $howMany, $page);
		}
		else
		{
			$userList = $adminModel->getListUsers($howMany, $page);
		}

		$recordsNum = isset($userList[0]) ?  $userList[0]->totalUsers : 0;

		foreach ($userList as $user)
			$resultData[] = array($user->FirstName, $user->LastName,
			  $user->Email, $user->DateCreated);
			
		//Process user list into array like below:	

		$output = array(
	        "draw" => intval($_POST["draw"]),
	        "recordsTotal" => $recordsNum,
	        "recordsFiltered" => $recordsNum,
	        "data" => $resultData
	    );

		echo json_encode($output);
	}

	function AjaxUserListDisabled()
	{
		$userList;
		$howMany = $_POST["length"]; //How many results to return
		$start = $_POST["start"]; //What page number in results
		$page = ($start / $howMany) + 1;
		$resultData = array();

		$adminModel = $this->loadModel('AdminModel');

		if(!empty($_POST["search"]["value"]))
		{			
			//Perform a search
			$userList = $adminModel->searchForUser($userSearch, $howMany, $page);
		}
		else
		{
			$userList = $adminModel->getListUsersDisabled($howMany, $page);
		}

		$recordsNum = isset($userList[0]) ?  $userList[0]->totalUsers : 0;

		foreach ($userList as $user)
			$resultData[] = array($user->FirstName, $user->LastName,
			  $user->Email, $user->DateCreated);
			
		//Process user list into array like below:	

		$output = array(
	        "draw" => intval($_POST["draw"]),
	        "recordsTotal" => $recordsNum,
	        "recordsFiltered" => $recordsNum,
	        "data" => $resultData
	    );

		echo json_encode($output);
	}

	function AjaxUserListInappropriate()
	{
		$userList;
		$howMany = $_POST["length"]; //How many results to return
		$start = $_POST["start"]; 
		$page = ($start / $howMany) + 1; //What page number in results
		$adminID = isset($_SESSION["userID"]) ? $_SESSION["userID"] : '';

		$adminModel = $this->loadModel('AdminModel');

		if(!empty($_POST["search"]["value"]))
		{
			//Perform a search
			$userList = $accountModel->searchForUser($userSearch, $howMany, $page);
		}
		else
		{
			$userList = $adminModel->getCommentListFlaggedInappropriate($howMany, $page);
		}

		$resultData = array();

		foreach ($userList as $user)
			$resultData[] = array($user->FirstName, $user->LastName,
			  $user->Email, $user->DateCreated);
			
		//Process user list into array like below:	
		$output = array(
	        "draw" => intval($_POST["draw"]),
	        "recordsTotal" => 50,
	        "recordsFiltered" =>50,
	        "data" => $resultData
	    );

		echo json_encode($output);
	}

	function AjaxStoryListPending()
	{
		$storyList;
		$howMany = $_POST["length"]; //How many results to return
		$start = $_POST["start"]; 
		$page = ($start / $howMany) + 1; //What page number in results
		$adminID = isset($_SESSION["userID"]) ? $_SESSION["userID"] : '';
		$resultData = array();

		$adminModel = $this->loadModel('AdminModel');

		if(!empty($_POST["search"]["value"]))
		{			
			//Perform a search
			$storyList = $adminModel->searchForUser($userSearch, $howMany, $page);
		}
		else
		{
			$storyList = $adminModel->getStoryListPendingApproval($howMany, $page);
		}

		$recordsNum = isset($storyList[0]) ?  $storyList[0]->totalStories : 0;

		//Process story list into array like below:	
		foreach ($storyList as $story)
			$resultData[] = array($story->StoryTitle, $story->LastName.' '.$story->FirstName, $story->DatePosted);

		$output = array(
	        "draw" => intval($_POST["draw"]),
	        "recordsTotal" => $recordsNum,
	        "recordsFiltered" => $recordsNum,
	        "data" => $resultData
	    );
		echo json_encode($output);
	}

	function AjaxStoryListRejected()
	{
		$storyList;
		$howMany = $_POST["length"]; //How many results to return
		$start = $_POST["start"]; 
		$page = ($start / $howMany) + 1; //What page number in results
		$adminID = isset($_SESSION["userID"]) ? $_SESSION["userID"] : '';
		$resultData = array();

		$adminModel = $this->loadModel('AdminModel');

		if(!empty($_POST["search"]["value"]))
		{			
			//Perform a search
			$storyList = $adminModel->searchForUser($userSearch, $howMany, $page);
		}
		else
		{
			$storyList = $adminModel->getStoryListRejected($howMany, $page);
		}

		$recordsNum = isset($storyList[0]) ?  $storyList[0]->totalStories : 0;

		//Process story list into array like below:	
		foreach ($storyList as $story)
			$resultData[] = array($story->StoryTitle, $story->LastName, $story->DatePosted);

		$output = array(
	        "draw" => intval($_POST["draw"]),
	        "recordsTotal" => $recordsNum,
	        "recordsFiltered" => $recordsNum,
	        "data" => $resultData
	    );
		echo json_encode($output);
	}

	function AjaxStoryListInappropriate()
	{
		$storyList;
		$howMany = $_POST["length"]; //How many results to return
		$start = $_POST["start"]; 
		$page = ($start / $howMany) + 1; //What page number in results
		$adminID = isset($_SESSION["userID"]) ? $_SESSION["userID"] : '';
		$resultData = array();

		$adminModel = $this->loadModel('AdminModel');

		if(!empty($_POST["search"]["value"]))
		{			
			//Perform a search
			$storyList = $adminModel->searchForUser($userSearch, $howMany, $page);
		}
		else
		{
			$storyList = $adminModel->getStoryListFlaggedInappropriate($howMany, $page);
		}

		$recordsNum = isset($storyList[0]) ?  $storyList[0]->totalStories : 0;

		//Process story list into array like below:	
		foreach ($storyList as $story)
			$resultData[] = array($story->StoryTitle, $story->LastName, $story->DatePosted);

		$output = array(
	        "draw" => intval($_POST["draw"]),
	        "recordsTotal" => $recordsNum,
	        "recordsFiltered" => $recordsNum,
	        "data" => $resultData
	    );
		echo json_encode($output);
	}

	function AjaxCommentListInappropriate()
	{
		// [start] => 0
		 //    [length] => 10
		 //    [search] => Array
		 //        (
		 //            [value] => 
		 //            [regex] => false
		 //        )
		// $commentList;
		// $howMany = $_POST["length"]; //How many results to return
		// $page = $_POST["draw"]; //What page number in results
		// $adminID = isset($_SESSION["userID"]) ? $_SESSION["userID"] : '';
		$commentList;
		$howMany = 5; //How many results to return
		$page = 1; //What page number in results
		$adminID = isset($_SESSION["userID"]) ? $_SESSION["userID"] : '';

		$adminModel = $this->loadModel('AdminModel');

		if(!empty($_POST["search"]["value"]))
		{			
			//Perform a search
			$commentList = $adminModel->searchStories($userSearch, $howMany, $page);
		}
		else
		{
			$commentList = $adminModel->getCommentListFlaggedInappropriate($howMany, $page);
		}

		foreach ($commentList as $comment)
			$resultData[] = array($comment->StoryTitle,
			  $comment->FirstName,  $comment->Email, $comment->DatePosted);

		//Process comment list into array like below:	

		$output = array(
	        "draw" => intval($_POST["draw"]),
	        "recordsTotal" => 50,
	        "recordsFiltered" =>50,
	        "data" => $resultData
	    );
		echo json_encode($output);
	}

	function AjaxCommentListRejected()
	{
		// [start] => 0
		 //    [length] => 10
		 //    [search] => Array
		 //        (
		 //            [value] => 
		 //            [regex] => false
		 //        )
		$commentList;
		$howMany = $_POST["length"]; //How many results to return
		$page = $_POST["draw"]; //What page number in results
		$adminID = isset($_SESSION["userID"]) ? $_SESSION["userID"] : '';

		if(!empty($_POST["search"]["value"]))
		{
			$commentList = $this->loadModel('Story/StoryModel');
			
			//Perform a search
			$commentList = $storyModel->searchStories($userSearch, $howMany, $page);
		}
		else
		{
			$adminModel = $this->loadModel('Story/StoryModel');

			$commentList = $adminModel->getCommentListRejected($adminID, $adminID, $howMany, $page);
		}

		//Process comment list into array like below:	

		$output = array(
	        "draw" => intval($_POST["draw"]),
	        "recordsTotal" => 50,
	        "recordsFiltered" =>50,
	        "data" => array(
	        	array("Airi",
				      "Satou",
				      "Accountant",
				      "Tokyo"),array("Airi",
				      "Satou",
				      "Accountant",
				      "Tokyo"),array("Airi",
				      "Satou",
				      "Accountant",
				      "Tokyo"),array("Airi",
				      "Satou",
				      "Accountant",
				      "Tokyo"),array("Airi",
				      "Satou",
				      "Accountant",
				      "Tokyo"),array("Airi",
				      "Satou",
				      "Accountant",
				      "Tokyo"),array("Airi",
				      "Satou",
				      "Accountant",
				      "Tokyo"),array("Airi",
				      "Satou",
				      "Accountant",
				      "Tokyo"),array("Airi",
				      "Satou",
				      "Accountant",
				      "Tokyo"),array("Airi",
				      "Satou",
				      "Accountant",
				      "Tokyo")
	        	)
	    );
		echo json_encode($output);
	}

	function commenteditinappropriate()
	{
		//Loads a model from corresponding model folder
		$model = $this->loadModel('AdminModel');

		//Loads a view model from corresponding viewmodel folder
		//$viewModel = $this->loadModel('SomeViewModel');

		//Loads a view from corresponding view folder
		$template = $this->loadView('commenteditinappropriate');

		//  $template->setCSS(array(
		// 	array("static/css/style.css", "intern")
		// 	array("http://www.example.com/default.css", "extern")
		// ));
		$template->setJS(array(
			//array("static/plugins/tinymce/tinymce.min.js", "intern"),
			array("static/plugins/datatables/media/js/jquery.dataTables.js", "intern"),
			array("static/js/adminDataTables.js", "intern")//,
			//array("static/js/tinymce.js", "intern")
			//array("http://www.example.com/static.js", "extern")
		));
		 $template->setCSS(array(
			array("static/plugins/datatables/media/css/jquery.dataTables.min.css", "intern")
		));
		//Adds a variable or object to that can be accessed in the view
		//$template->set('viewModel', $viewModel);

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

	function commenteditreject()
	{
		//Loads a model from corresponding model folder
		$model = $this->loadModel('AdminModel');

		//Loads a view model from corresponding viewmodel folder
		//$viewModel = $this->loadModel('SomeViewModel');

		//Loads a view from corresponding view folder
		$template = $this->loadView('commenteditreject');

		//  $template->setCSS(array(
		// 	array("static/css/style.css", "intern")
		// 	array("http://www.example.com/default.css", "extern")
		// ));
		$template->setJS(array(
			//array("static/plugins/tinymce/tinymce.min.js", "intern"),
			array("static/plugins/datatables/media/js/jquery.dataTables.js", "intern"),
			array("static/js/adminDataTables.js", "intern")//,
			//array("static/js/tinymce.js", "intern")
			//array("http://www.example.com/static.js", "extern")
		));
		 $template->setCSS(array(
			array("static/plugins/datatables/media/css/jquery.dataTables.min.css", "intern")
		));
		//Adds a variable or object to that can be accessed in the view
		//$template->set('viewModel', $viewModel);

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

	function dropdownansweredit()
	{
		//Loads a model from corresponding model folder
		$model = $this->loadModel('AdminModel');

		//Loads a view model from corresponding viewmodel folder
		//$viewModel = $this->loadModel('SomeViewModel');

		//Loads a view from corresponding view folder
		$template = $this->loadView('dropdownansweredit');

		//  $template->setCSS(array(
		// 	array("static/css/style.css", "intern")
		// 	array("http://www.example.com/default.css", "extern")
		// ));
		$template->setJS(array(
			//array("static/plugins/tinymce/tinymce.min.js", "intern"),
			array("static/plugins/datatables/media/js/jquery.dataTables.js", "intern"),
			array("static/js/adminDataTables.js", "intern")//,
			//array("static/js/tinymce.js", "intern")
			//array("http://www.example.com/static.js", "extern")
		));
		 $template->setCSS(array(
			array("static/plugins/datatables/media/css/jquery.dataTables.min.css", "intern")
		));
		//Adds a variable or object to that can be accessed in the view
		//$template->set('viewModel', $viewModel);

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

	function dropdownedit()
	{
		//Loads a model from corresponding model folder
		$model = $this->loadModel('AdminModel');

		//Loads a view model from corresponding viewmodel folder
		//$viewModel = $this->loadModel('SomeViewModel');

		//Loads a view from corresponding view folder
		$template = $this->loadView('dropdownedit');

		//  $template->setCSS(array(
		// 	array("static/css/style.css", "intern")
		// 	array("http://www.example.com/default.css", "extern")
		// ));
		$template->setJS(array(
			//array("static/plugins/tinymce/tinymce.min.js", "intern"),
			array("static/plugins/datatables/media/js/jquery.dataTables.js", "intern"),
			array("static/js/adminDataTables.js", "intern")//,
			//array("static/js/tinymce.js", "intern")
			//array("http://www.example.com/static.js", "extern")
		));
		 $template->setCSS(array(
			array("static/plugins/datatables/media/css/jquery.dataTables.min.css", "intern")
		));
		//Adds a variable or object to that can be accessed in the view
		//$template->set('viewModel', $viewModel);

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

	function storyansweredit()
	{
		//Loads a model from corresponding model folder
		$model = $this->loadModel('AdminModel');

		//Loads a view model from corresponding viewmodel folder
		//$viewModel = $this->loadModel('SomeViewModel');

		//Loads a view from corresponding view folder
		$template = $this->loadView('storyansweredit');

		//  $template->setCSS(array(
		// 	array("static/css/style.css", "intern")
		// 	array("http://www.example.com/default.css", "extern")
		// ));
		$template->setJS(array(
			//array("static/plugins/tinymce/tinymce.min.js", "intern"),
			array("static/plugins/datatables/media/js/jquery.dataTables.js", "intern"),
			array("static/js/adminDataTables.js", "intern")//,
			//array("static/js/tinymce.js", "intern")
			//array("http://www.example.com/static.js", "extern")
		));
		 $template->setCSS(array(
			array("static/plugins/datatables/media/css/jquery.dataTables.min.css", "intern")
		));
		//Adds a variable or object to that can be accessed in the view
		//$template->set('viewModel', $viewModel);

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

	function storyeditinappropriate()
	{
		//Loads a model from corresponding model folder
		$model = $this->loadModel('AdminModel');

		//Loads a view model from corresponding viewmodel folder
		//$viewModel = $this->loadModel('SomeViewModel');

		//Loads a view from corresponding view folder
		$template = $this->loadView('storyeditinappropriate');

		//  $template->setCSS(array(
		// 	array("static/css/style.css", "intern")
		// 	array("http://www.example.com/default.css", "extern")
		// ));
		$template->setJS(array(
			//array("static/plugins/tinymce/tinymce.min.js", "intern"),
			array("static/plugins/datatables/media/js/jquery.dataTables.js", "intern"),
			array("static/js/adminDataTables.js", "intern")//,
			//array("static/js/tinymce.js", "intern")
			//array("http://www.example.com/static.js", "extern")
		));
		 $template->setCSS(array(
			array("static/plugins/datatables/media/css/jquery.dataTables.min.css", "intern")
		));
		//Adds a variable or object to that can be accessed in the view
		//$template->set('viewModel', $viewModel);

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

	// function storyeditpending()
	// {
	// 	//Loads a model from corresponding model folder
	// 	$model = $this->loadModel('AdminModel');

	// 	//Loads a view model from corresponding viewmodel folder
	// 	//$viewModel = $this->loadModel('SomeViewModel');

	// 	//Loads a view from corresponding view folder
	// 	$template = $this->loadView('storyeditpending');

	// 	//  $template->setCSS(array(
	// 	// 	array("static/css/style.css", "intern")
	// 	// 	array("http://www.example.com/default.css", "extern")
	// 	// ));
	// 	$template->setJS(array(
	// 		//array("static/plugins/tinymce/tinymce.min.js", "intern"),
	// 		array("static/plugins/datatables/media/js/jquery.dataTables.js", "intern"),
	// 		array("static/js/adminDataTables.js", "intern")//,
	// 		//array("static/js/tinymce.js", "intern")
	// 		//array("http://www.example.com/static.js", "extern")
	// 	));
	// 	 $template->setCSS(array(
	// 		array("static/plugins/datatables/media/css/jquery.dataTables.min.css", "intern")
	// 	));
	// 	//Adds a variable or object to that can be accessed in the view
	// 	//$template->set('viewModel', $viewModel);

	// 	//Renders the view. true indicates to load the layout
	// 	$template->render(true);

	// 	//Execute code if a post back
	// 	if($this->isPost())
	// 	{
	// 		//Can be used to redirect to another controller
	// 		//Can add query values ?id=1
	// 		//$this->redirect("controller/action");

	// 		//Check if request is ajax
	// 		//$this->isAjax()
	// 	}
	// 	else
	// 	{
	// 		//Execute this code if NOT a post back
	// 	}
	// } 

	function storyeditreject()
	{
		//Loads a model from corresponding model folder
		$model = $this->loadModel('AdminModel');

		//Loads a view model from corresponding viewmodel folder
		//$viewModel = $this->loadModel('SomeViewModel');

		//Loads a view from corresponding view folder
		$template = $this->loadView('storyeditreject');

		//  $template->setCSS(array(
		// 	array("static/css/style.css", "intern")
		// 	array("http://www.example.com/default.css", "extern")
		// ));
		$template->setJS(array(
			//array("static/plugins/tinymce/tinymce.min.js", "intern"),
			array("static/plugins/datatables/media/js/jquery.dataTables.js", "intern"),
			array("static/js/adminDataTables.js", "intern")//,
			//array("static/js/tinymce.js", "intern")
			//array("http://www.example.com/static.js", "extern")
		));
		 $template->setCSS(array(
			array("static/plugins/datatables/media/css/jquery.dataTables.min.css", "intern")
		));
		//Adds a variable or object to that can be accessed in the view
		//$template->set('viewModel', $viewModel);

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

	function storyquestionedit()
	{
		//Loads a model from corresponding model folder
		$model = $this->loadModel('AdminModel');

		//Loads a view model from corresponding viewmodel folder
		//$viewModel = $this->loadModel('SomeViewModel');

		//Loads a view from corresponding view folder
		$template = $this->loadView('storyquestionedit');

		//  $template->setCSS(array(
		// 	array("static/css/style.css", "intern")
		// 	array("http://www.example.com/default.css", "extern")
		// ));
		$template->setJS(array(
			//array("static/plugins/tinymce/tinymce.min.js", "intern"),
			array("static/plugins/datatables/media/js/jquery.dataTables.js", "intern"),
			array("static/js/adminDataTables.js", "intern")//,
			//array("static/js/tinymce.js", "intern")
			//array("http://www.example.com/static.js", "extern")
		));
		 $template->setCSS(array(
			array("static/plugins/datatables/media/css/jquery.dataTables.min.css", "intern")
		));
		//Adds a variable or object to that can be accessed in the view
		//$template->set('viewModel', $viewModel);

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

	function yougen()
	{
		$model = $this->loadModel('AdminModel');

		//Loads a view model from corresponding viewmodel folder
		//$viewModel = $this->loadModel('SomeViewModel');

		//Loads a view from corresponding view folder
		$template = $this->loadView('yougen');

		//  $template->setCSS(array(
		// 	array("static/css/style.css", "intern")
		// 	array("http://www.example.com/default.css", "extern")
		// ));
		$template->setJS(array(
			//array("static/plugins/tinymce/tinymce.min.js", "intern"),
			array("static/plugins/datatables/media/js/jquery.dataTables.js", "intern"),
			array("static/js/adminDataTables.js", "intern")//,
			//array("static/js/tinymce.js", "intern")
			//array("http://www.example.com/static.js", "extern")
		));
		 $template->setCSS(array(
			array("static/plugins/datatables/media/css/jquery.dataTables.min.css", "intern")
		));
		//Adds a variable or object to that can be accessed in the view
		//$template->set('viewModel', $viewModel);

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
