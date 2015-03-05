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
		// [start] => 0
		 //    [length] => 10
		 //    [search] => Array
		 //        (
		 //            [value] => 
		 //            [regex] => false
		 //        )
		$userList;
		$howMany = $_POST["length"]; //How many results to return
		$start = $_POST["start"]; //What page number in results
		$page = ($start / $howMany) + 1;

		//$this->currentUser->UserId;

		if(!empty($_POST["search"]["value"]))
		{
			$accountModel = $this->loadModel('Account/AccountModel');
			
			//Perform a search
			$userList = $accountModel->searchForUser($userSearch, $howMany, $page);
		}
		else
		{
			$adminModel = $this->loadModel('AdminModel');

			$userList = $adminModel->getListUsers($howMany, $page);
		}

		$resultData = array();
		$recordsNum = isset($userList[0]) ?  $userList[0]->totalUsers : 0;

		foreach ($userList as $user)
			$resultData[] = array($user->FirstName, $user->LastName,
			  $user->AdminFlag,  $user->Email, $user->Address);
			
		//Process user list into array like below:	

		$output = array(
	        "draw" => intval($_POST["draw"]),
	        "recordsTotal" => 50,
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

		if(!empty($_POST["search"]["value"]))
		{
			$accountModel = $this->loadModel('Account/AccountModel');
			
			//Perform a search
			$userList = $accountModel->searchForUser($userSearch, $howMany, $page);
		}
		else
		{
			$adminModel = $this->loadModel('AdminModel');

			$userList = $adminModel->getListUsersDisabled($howMany, $page);
		}

		$resultData = array();

		foreach ($userList as $user)
			$resultData[] = array($user->FirstName, $user->LastName,
			  $user->AdminFlag,  $user->Email, $user->Address);
			
		//Process user list into array like below:	

		$output = array(
	        "draw" => intval($_POST["draw"]),
	        "recordsTotal" => 50,
	        "recordsFiltered" =>50,
	        "data" => $resultData
	    );

		echo json_encode($output);
	}

	function AjaxUserListInappropriate()
	{
		// [start] => 0
		 //    [length] => 10
		 //    [search] => Array
		 //        (
		 //            [value] => 
		 //            [regex] => false
		 //        )
		$userList;
		$howMany = $_POST["length"]; //How many results to return
		$page = $_POST["draw"]; //What page number in results
		$adminID = isset($_SESSION["userID"]) ? $_SESSION["userID"] : '';

		if(!empty($_POST["search"]["value"]))
		{
			$accountModel = $this->loadModel('Account/AccountModel');
			
			//Perform a search
			$userList = $accountModel->searchForUser($userSearch, $howMany, $page);
		}
		else
		{
			$adminModel = $this->loadModel('AdminModel');

			$userList = $adminModel->getCommentListFlaggedInappropriate($howMany, $page);
		}

		$resultData = array();

		foreach ($userList as $user)
			$resultData[] = array($user->FirstName, $user->LastName,
			  $user->AdminFlag,  $user->Email, $user->Address);
			
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
		// [start] => 0
		 //    [length] => 10
		 //    [search] => Array
		 //        (
		 //            [value] => 
		 //            [regex] => false
		 //        )
		$storyList;
		$howMany = $_POST["length"]; //How many results to return
		$page = $_POST["draw"]; //What page number in results
		$adminID = isset($_SESSION["userID"]) ? $_SESSION["userID"] : '';

		if(!empty($_POST["search"]["value"]))
		{
			$adminModel = $this->loadModel('AdminModel');
			
			//Perform a search
			$storyList = $adminModel->searchStoriesPendingApproval($userSearch, $howMany, $page);
		}
		else
		{
			$adminModel = $this->loadModel('AdminModel');

			$storyList = $adminModel->getStoryListPendingApproval($adminID, $howMany, $page);
		}

		//Process story list into array like below:	

		$output = $adminModel->getStoryListPendingApproval($adminID, $howMany, $page);

		$output = array(
	        "draw" => intval($_POST["draw"]),
	        "recordsTotal" => 50,
	        "recordsFiltered" =>50,
	        "data" => array(
	        	array("Airi",
				      "Satou",
				      "Accountant",
				      "Tokyo"),
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
				      "Tokyo")
	        	)
	    );
		echo json_encode($output);
	}

	function AjaxStoryListRejected()
	{
		// [start] => 0
		 //    [length] => 10
		 //    [search] => Array
		 //        (
		 //            [value] => 
		 //            [regex] => false
		 //        )
		$storyList;
		$howMany = $_POST["length"]; //How many results to return
		$page = $_POST["draw"]; //What page number in results
		$adminID = isset($_SESSION["userID"]) ? $_SESSION["userID"] : '';

		if(!empty($_POST["search"]["value"]))
		{
			$adminModel = $this->loadModel('AdminModel');
			
			//Perform a search
			$storyList = $adminModel->searchStoriesRejected($adminID, $userSearch, $howMany, $page);
		}
		else
		{
			$adminModel = $this->loadModel('AdminModel');

			$storyList = $adminModel->getStoryListRejected($howMany, $page);
		}

		foreach ($storyList as $story)
			$resultData[] = array($story->StoryTitle,
			  $story->FirstName,  $story->Email, $story->DatePosted);
			
		//Process story list into array like below:	

		$output = array(
	        "draw" => intval($_POST["draw"]),
	        "recordsTotal" => 50,
	        "recordsFiltered" =>50,
	        "data" => $resultData
	    );

		echo json_encode($output);
	}

	function AjaxStoryListInappropriate()
	{
		// [start] => 0
		 //    [length] => 10
		 //    [search] => Array
		 //        (
		 //            [value] => 
		 //            [regex] => false
		 //        )
		$storyList;
		$howMany = $_POST["length"]; //How many results to return
		$page = $_POST["draw"]; //What page number in results
		$adminID = isset($_SESSION["userID"]) ? $_SESSION["userID"] : '';

		$adminModel = $this->loadModel('AdminModel');

		if(!empty($_POST["search"]["value"]))
		{
			//Perform a search
			$storyList = $adminModel->searchStories($userSearch, $howMany, $page);
		}
		else
		{
			$storyList = $adminModel->getStoryListFlaggedInappropriate($howMany, $page);
		}

		//Process story list into array like below:	
		foreach ($storyList as $story)
			$resultData[] = array($story->StoryTitle,
			  $story->FirstName,  $story->Email, $story->DatePosted);
			
		//Process story list into array like below:	

		$output = array(
	        "draw" => intval($_POST["draw"]),
	        "recordsTotal" => 50,
	        "recordsFiltered" =>50,
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
		//Loads a view from corresponding view folder
		$template = $this->loadView('Admin/commenteditinappropriate');
		//Renders the view. true indicates to load the layout
		$template->render(true);

	}  
	function commenteditreject()
	{
		//Loads a view from corresponding view folder
		$template = $this->loadView('commenteditreject');

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
		//Loads a view from corresponding view folder
		$template = $this->loadView('dropdownansweredit');
		//Renders the view. true indicates to load the layout
//		$template->render(true);

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
		//Loads a view from corresponding view folder
		$template = $this->loadView('dropdownedit');
		//Renders the view. true indicates to load the layout
//		$template->render(true);

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
		//Loads a view from corresponding view folder
		$template = $this->loadView('storyansweredit');
		//Renders the view. true indicates to load the layout
//		$template->render(true);

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
		//Loads a view from corresponding view folder
		$template = $this->loadView('storyeditinappropriate');
		//Renders the view. true indicates to load the layout
	//	$template->render(true);

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

	function storyeditpending()
	{
		//Loads a view from corresponding view folder
		$template = $this->loadView('storyeditpending');
		//Renders the view. true indicates to load the layout
	//	$template->render(true);

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
	function storyeditreject()
	{
		//Loads a view from corresponding view folder
		$template = $this->loadView('storyeditreject');
		//Renders the view. true indicates to load the layout
	//	$template->render(true);

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
		//Loads a view from corresponding view folder
		$template = $this->loadView('storyquestionedit');
		//Renders the view. true indicates to load the layout
		$template->render(true);

		// $template->setJS(array(
		// 	//array("static/plugins/tinymce/tinymce.min.js", "intern"),
		// 	array("static/plugins/datatables/media/js/jquery.dataTables.js", "intern"),
		// 	array("static/js/adminDataTables.js", "intern")//,
		// 	//array("static/js/tinymce.js", "intern")
		// 	//array("http://www.example.com/static.js", "extern")
		// ));
		//  $template->setCSS(array(
		// 	array("static/plugins/datatables/media/css/jquery.dataTables.min.css", "intern")
		// ));
		// //Adds a variable or object to that can be accessed in the view
		// //$template->set('viewModel', $viewModel);

		// //Renders the view. true indicates to load the layout
		// $template->render(true);

		// //Execute code if a post back
		// if($this->isPost())
		// {
		// 	//Can be used to redirect to another controller
		// 	//Can add query values ?id=1
		// 	//$this->redirect("controller/action");

		// 	//Check if request is ajax
		// 	//$this->isAjax()
		// }
		// else
		// {
		// 	//Execute this code if NOT a post back
		// }
	}  
	function yougen()
	{
		//Loads a view from corresponding view folder
		$template = $this->loadView('yougen');
		//Renders the view. true indicates to load the layout
		$template->render(true);

	} 
}

?>
