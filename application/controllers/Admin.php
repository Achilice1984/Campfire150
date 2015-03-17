<?php

class Admin extends Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	function testAdmin()
	{
		echo "string";
		$model = $this->loadModel('Admin/AdminModel');
	
		$storyQuestionViewModel = $this->loadViewModel('shared/StoryQuestionViewModel');
		$storyQuestionViewModel = $model->getQuestionById(1);
		//$returnData = $model->addQuestionAnswer(9, "testE", "testF");
		//$returnData = $model->getDropdownListItem('gendertype', 1);
		$returnData = $model->updateQuestion(1, "E", "F");

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

	// function storyeditpending($storyId)
	// {

	// 	//Loads a model from corresponding model folder
	// 	$model = $this->loadModel('AdminModel');

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

	// 	/***********************************
	// 	*Get the story
	// 	************************************/
	// 	//Loads a model from corresponding model folder
	// 	$storyModel = $this->loadModel('Story/StoryModel');
	// 	//Load the loginViewModel
	// 	$storyViewModel = $this->loadViewModel('shared/StoryViewModel');
	// 	$storyViewModel = $storyModel->getStory($this->currentUser->UserId, $storyId);

	// 	/***********************************
	// 	*Get the useer details for the story
	// 	************************************/
	// 	//Loads a model from corresponding model folder
	// 	$accountModel = $this->loadModel('Account/AccountModel');
	// 	$userViewModel = $this->loadViewModel('shared/UserViewModel');		

	// 	if(isset($storyViewModel[0]))
	// 	{
	// 		//eliminate array
	// 		$storyViewModel = $storyViewModel[0];

	// 		$userViewModel = $accountModel->getUserProfileByID($storyViewModel->UserId);
	// 	}
		
	// 	//Loads a model from corresponding model folder
	// 	$model = $this->loadModel('AdminModel');

	// 	//Load the approval view model
	// 	$aprovalViewModel = $this->loadViewModel('ApprovalViewModel');

	// 	//Map post values to the loginViewModel
	// 	$aprovalViewModel  = AutoMapper::mapPost($aprovalViewModel );

	// 	$aprovalViewModel->Id = $storyId;

	// 	//addSuccessMessage("dbError", "Errror!");
	// 	//addErrorMessage("dbError", "Errror!");

	// 	//Execute code if a post back
	// 	if($this->isPost())
	// 	{
	// 		if($aprovalViewModel ->validate())
	// 		{
	// 			// Save data

	// 			$this->redirect("admin/index");
	// 		}

	// 		//validate and save data
	// 		//$_POST["filedName"]
	// 	}

	// 	//Loads a view from corresponding view folder
	// 	$view = $this->loadView('storyeditpending');

	// 	//Add a variable with old login data so that it can be accessed in the view
	// 	$view->set('aprovalViewModel', $aprovalViewModel);

	// 	//Add a variable with old login data so that it can be accessed in the view
	// 	$view->set('storyViewModel', $storyViewModel);

	// 	//Add a variable with old login data so that it can be accessed in the view
	// 	$view->set('userViewModel', $userViewModel);

	// 	//Renders the view. true indicates to load the layout
	// 	$view->render(true);
	// }


	/**************************************************************************************************
	*
	*						AJAX FUNCTIONS
	*
	***************************************************************************************************/

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
		{
			$url = '<a href='. BASE_URL . 'admin/storyeditpending/' . $story->StoryId . '>Edit Approval</a>';
			
			//$url = BASE_URL."Admin/AjaxStoryListPending/".$story->StoryId;
			$resultData[] = array($story->StoryTitle, $story->LastName.' '.$story->FirstName, $story->DatePosted, $url);
		}

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
		{
			$url = '<a href='. BASE_URL . 'admin/storyeditreject/' . $story->StoryId . '>Edit Approval</a>';
			$resultData[] = array($story->StoryTitle, $story->LastName.' '.$story->FirstName, $story->DatePosted, $url);
		}

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
		{
			$url = '<a href=' . BASE_URL . 'admin/storyeditinappropriate/' . $story->StoryId . '>Edit Approval</a>';

			$resultData[] = array($story->StoryTitle, $story->LastName.' '.$story->FirstName, $story->DatePosted, $url);
		}

		$output = array(
	        "draw" => intval($_POST["draw"]),
	        "recordsTotal" => $recordsNum,
	        "recordsFiltered" => $recordsNum,
	        "data" => $resultData
	    );
		echo json_encode($output);
	}

	function AjaxCommentListRejected()
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
			$commentList = $adminModel->searchForUser($userSearch, $howMany, $page);
		}
		else
		{
			$commentList = $adminModel->getCommentListRejected($howMany, $page);
		}

		$recordsNum = isset($commentList[0]) ?  $commentList[0]->TotalComments : 0;

		//Process story list into array like below:	
		foreach ($commentList as $comment)
		{
			$url = '<a href='. BASE_URL . 'admin/commenteditreject/' . $comment->CommentId . '>Edit Approval</a>';
			$resultData[] = array($comment->StoryTitle, $comment->Content, $comment->DateUpdated, $url);
		}
			
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
			$commentList = $adminModel->searchForUser($userSearch, $howMany, $page);
		}
		else
		{
			$commentList = $adminModel->getCommentListFlaggedInappropriate($howMany, $page);
		}

		$recordsNum = isset($commentList[0]) ?  $commentList[0]->TotalComments : 0;

		//Process story list into array like below:	
		foreach ($commentList as $comment)
		{
			$url = '<a href=' . BASE_URL . 'admin/commenteditinappropriate/' . $comment->CommentId . '>Edit Approval</a>';
			$resultData[] = array($comment->StoryTitle, $comment->Content, $comment->DateUpdated, $url);
		}
			
		$output = array(
	        "draw" => intval($_POST["draw"]),
	        "recordsTotal" => $recordsNum,
	        "recordsFiltered" => $recordsNum,
	        "data" => $resultData
	    );
		echo json_encode($output);
	}

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

	function AjaxStoryQuestionList()
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
			$questionList = $adminModel->searchForUser($userSearch, $howMany, $page);
		}
		else
		{
			$questionList = $adminModel->getListQuestionaireQuestions($howMany, $page);
		}

		$recordsNum = isset($questionList[0]) ?  $questionList[0]->TotalQuestions : 0;

		//Process story list into array like below:	
		foreach ($questionList as $question)
		{
			$url = '<a href=' . BASE_URL . 'admin/storyquestionedit/' . $question->QuestionId . '>Update</a>'; //Add link for edit the record
			$resultData[] = array($question->QuestionId, $question->NameE, $question->NameF, $question->DateUpdated, $url);
		}
			
		$output = array(
	        "draw" => intval($_POST["draw"]),
	        "recordsTotal" => $recordsNum,
	        "recordsFiltered" => $recordsNum,
	        "data" => $resultData
	    );
		echo json_encode($output);
	}

	function AjaxStoryAnswerList()
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
			$answerList = $adminModel->searchForUser($userSearch, $howMany, $page);
		}
		else
		{
			$answerList = $adminModel->getListQuestionaireAnswers($howMany, $page);
		}

		$recordsNum = isset($answerList[0]) ?  $answerList[0]->TotalAnswers : 0;

		//Process story list into array like below:	
		foreach ($answerList as $answer)
		{
			$url = '<a href=' . BASE_URL . 'admin/storyansweredit/' . $answer->AnswerId . '>Update</a>'; //Add link for edit the record
			$resultData[] = array($answer->QuestionId, $answer->AnswerE, $answer->AnswerF, $answer->DateUpdated, $url);
		}
			
		$output = array(
	        "draw" => intval($_POST["draw"]),
	        "recordsTotal" => $recordsNum,
	        "recordsFiltered" => $recordsNum,
	        "data" => $resultData
	    );
		echo json_encode($output);
	}

	function AjaxUserSecurityQuestionList()
	{
		$output = $this->dropdownList("securityquestion");
		echo json_encode($output);
	}

	function AjaxLanguageList()
	{
		$output = $this->dropdownList("languagetype");
		echo json_encode($output);
	}

	function AjaxGenderList()
	{
		$output = $this->dropdownList("gendertype");
		echo json_encode($output);
	}

	function AjaxAchievementLevelList()
	{
		$output = $this->dropdownList("achievementleveltype");
		echo json_encode($output);
	}

	function AjaxPictureTypeList()
	{
		$output = $this->dropdownList("picturetype");
		echo json_encode($output);
	}

	function AjaxProfilePrivacyTypeList()
	{
		$output = $this->dropdownList("profileprivacytype");
		echo json_encode($output);
	}

	function AjaxStoryPrivacyTypeList()
	{
		$output = $this->dropdownList("storyprivacytype");
		echo json_encode($output);
	}

	function dropdownList($tableName)
	{
		$list = array();
		$adminID = isset($_SESSION["userID"]) ? $_SESSION["userID"] : '';
		$resultData = array();

		$adminModel = $this->loadModel('AdminModel');

		if(!empty($_POST["search"]["value"]))
		{			
			//Perform a search
			$list = $adminModel->searchForUser($userSearch, $howMany, $page);
		}
		else
		{
			$list = $adminModel->getListDropdowns($tableName);
		}

		$recordsNum = isset($list[0]) ?  $list[0]->TotalNumber : 0;

		//Process story list into array like below:	
		foreach ($list as $item){
			$url = '<a href=' . BASE_URL . 'admin/dropdownitemedit/'.$tableName.'/'.$item->Id.'>Edit</a>';
			$resultData[] = array($item->NameE, $item->NameF, $item->DateUpdated, $url);			
		}
			
		$output = array(
	        "draw" => intval($_POST["draw"]),
	        "recordsTotal" => $recordsNum,
	        "recordsFiltered" => $recordsNum,
	        "data" => $resultData
	    );

	    return $output;
	}

	/**************************************************************************************************
	*
	*						Display FUNCTIONS
	*
	***************************************************************************************************/
	function storyeditpending($storyId)
	{
		//$this->AdminRequest();

		$model = $this->loadModel('AdminModel');

		//Loads a model from corresponding model folder
		$storyViewModel = $this->loadViewModel('shared/StoryViewModel');
		$storyViewModel = $model->getStoryById($storyId);

		//Loads a model from corresponding model folder
		$accountModel = $this->loadModel('Account/AccountModel');
		$userViewModel = $this->loadViewModel('shared/UserViewModel');	

		$userViewModel = $accountModel->getUserProfileByID($storyViewModel->UserId);
		
		//Load the approval view model
		$approvalViewModel = $this->loadViewModel('ApprovalViewModel');

		$approvalViewModel->Id = $storyId;

		//Execute code if a post back
		if($this->isPost())
		{
			$approvalViewModel->Approval = $_POST["Approval"];

			//Map post values to the loginViewModel
			$approvalViewModel  = AutoMapper::mapPost($approvalViewModel );

			if($approvalViewModel->validate())
			{
				// Save data
				if($approvalViewModel->Approval == 'TRUE')
					$model->approveStory($this->currentUser->UserId, $approvalViewModel->Id, $approvalViewModel->Content);

				elseif($approvalViewModel->Approval == 'FALSE')
					$model->rejectStory($this->currentUser->UserId, $approvalViewModel->Id, $approvalViewModel->Content);

				$this->redirect("admin/index");
			}
			else
			{
				//$this->redirect("");
			}
		}
		//Loads a view from corresponding view folder
		$view = $this->loadView('storyeditpending');

		//Add a variable with old login data so that it can be accessed in the view
		$view->set('approvalViewModel', $approvalViewModel);

		//Add a variable with old login data so that it can be accessed in the view
		$view->set('storyViewModel', $storyViewModel);

		//Add a variable with old login data so that it can be accessed in the view
		$view->set('userViewModel', $userViewModel);

		//Renders the view. true indicates to load the layout
		$view->render(true);
	}

	function storyeditreject($storyId)
	{
		//$this->AdminRequest();

		
		$model = $this->loadModel('AdminModel');

		//Loads a model from corresponding model folder
		$storyViewModel = $this->loadViewModel('shared/StoryViewModel');
		$storyViewModel = $model->getStoryById($storyId);

		//Loads a model from corresponding model folder
		$accountModel = $this->loadModel('Account/AccountModel');
		$userViewModel = $this->loadViewModel('shared/UserViewModel');

		$userViewModel = $accountModel->getUserProfileByID($storyViewModel->UserId);
		
		//Load the approval view model
		$approvalViewModel = $this->loadViewModel('ApprovalViewModel');

		$approvalViewModel->Id = $storyId;

		//Execute code if a post back
		if($this->isPost())
		{
			$approvalViewModel->Approval = $_POST["Approval"];

			//Map post values to the loginViewModel
			$approvalViewModel  = AutoMapper::mapPost($approvalViewModel );

			if($approvalViewModel->validate())
			{
				// Save data				
				$model->approveStory($this->currentUser->UserId, $approvalViewModel->Id, $approvalViewModel->Content);

				$this->redirect("admin/index");
			}
			else
			{
				//$this->redirect("");
			}
		}
		//Loads a view from corresponding view folder
		$view = $this->loadView('storyeditreject');

		//Add a variable with old login data so that it can be accessed in the view
		$view->set('approvalViewModel', $approvalViewModel);

		$view->set('storyViewModel', $storyViewModel);

		$view->set('userViewModel', $userViewModel);

		//Renders the view. true indicates to load the layout
		$view->render(true);
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

	function commenteditreject($commentId)
	{
		//Loads a model from corresponding model folder
		$model = $this->loadModel('AdminModel');
		//Loads a view from corresponding view folder
		$view = $this->loadView('commenteditreject');

		$accountModel = $this->loadModel('Account/AccountModel');
		$commentViewModel = $this->loadViewModel('shared/CommentViewModel');
		$userViewModel = $this->loadViewModel('shared/UserViewModel');
		$storyViewModel = $this->loadViewModel('shared/StoryViewModel');
		//Load the approval view model
		$approvalViewModel = $this->loadViewModel('ApprovalViewModel');
		$approvalViewModel->Id = $commentId;

		//Adds variables or objects to that can be accessed in the view
		$commentViewModel = $model->getCommentById($commentId);

		$storyViewModel = $model->getStoryById($commentViewModel->Story_StoryId);
		$userViewModel = $accountModel->getUserProfileByID($commentViewModel->User_UserId);

		$view->set('approvalViewModel', $approvalViewModel);

		$view->set('commentViewModel', $commentViewModel);

		$view->set('storyViewModel', $storyViewModel);

		$view->set('userViewModel', $userViewModel);

		//Renders the view. true indicates to load the layout
		$view->render(true);

		//Execute code if a post back
		if($this->isPost())
		{			
			$approvalViewModel->Approval = $_POST["Approval"];

			//Map post values to the loginViewModel
			$approvalViewModel  = AutoMapper::mapPost($approvalViewModel );

			if($approvalViewModel->validate())
			{
				// Save data
				$model->approveCommentAsAdmin($this->currentUser->UserId, $approvalViewModel->Id, $approvalViewModel->Content);

				$this->redirect("admin/index");
			}
			else
			{
				echo "Failed to save the change";
			}
		}
		else
		{
			//Execute this code if NOT a post back
		}
	}

	function commenteditinappropriate($commentId)
	{
		//Loads a model from corresponding model folder
		$model = $this->loadModel('AdminModel');
		//Loads a view from corresponding view folder
		$view = $this->loadView('commenteditinappropriate');

		$accountModel = $this->loadModel('Account/AccountModel');
		$commentViewModel = $this->loadViewModel('shared/CommentViewModel');
		$userViewModel = $this->loadViewModel('shared/UserViewModel');
		$storyViewModel = $this->loadViewModel('shared/StoryViewModel');
		//Load the approval view model
		$approvalViewModel = $this->loadViewModel('ApprovalViewModel');
		$approvalViewModel->Id = $commentId;

		//Adds variables or objects to that can be accessed in the view
		$commentViewModel = $model->getCommentById($commentId);

		$storyViewModel = $model->getStoryById($commentViewModel->Story_StoryId);
		$userViewModel = $accountModel->getUserProfileByID($commentViewModel->UserId);

		$view->set('approvalViewModel', $approvalViewModel);

		$view->set('commentViewModel', $commentViewModel);

		$view->set('storyViewModel', $storyViewModel);

		$view->set('userViewModel', $userViewModel);

		//Renders the view. true indicates to load the layout
		$view->render(true);

		//Execute code if a post back
		if($this->isPost())
		{
			$approvalViewModel->Approval = $_POST["Approval"];

			//Map post values to the loginViewModel
			$approvalViewModel  = AutoMapper::mapPost($approvalViewModel );

			if($approvalViewModel->validate())
			{
				// Save data
				if($approvalViewModel->Approval == 'TRUE')
					$model->approveCommentAsAdmin($this->currentUser->UserId, $approvalViewModel->Id, $approvalViewModel->Content);

				elseif($approvalViewModel->Approval == 'FALSE')
					$model->rejectCommentAsAdmin($this->currentUser->UserId, $approvalViewModel->Id, $approvalViewModel->Content);

				$this->redirect("admin/index");
			}
			else
			{
				echo "Failed to save the change";
			}
		}
		else
		{
			//Execute this code if NOT a post back
		}
	}  

	function dropdownitemedit($tableName, $Id)
	{
		//Loads a model from corresponding model folder
		$model = $this->loadModel('AdminModel');

		//Loads a view from corresponding view folder
		$view = $this->loadView('dropdownitemedit');

		$dropdownListItemViewModel = $this->loadViewModel('shared/DropdownItemViewModel');

		//Load the approval view model

		//Adds variables or objects to that can be accessed in the view
		$dropdownListItemViewModel = $model->getDropdownListItem($tableName, $Id);
		$dropdownListItemViewModel->TableName = $tableName;

		$view->set('dropdownListItemViewModel', $dropdownListItemViewModel);


		//Renders the view. true indicates to load the layout
		$view->render(true);

		//Execute code if a post back
		if($this->isPost())
		{
			$dropdownListItemViewModel->NameE = $_POST["NameE"];
			$dropdownListItemViewModel->NameF = $_POST["NameF"];

			//Map post values to the loginViewModel
			$dropdownListItemViewModel  = AutoMapper::mapPost($dropdownListItemViewModel );

			if($dropdownListItemViewModel->validate())
			{
				// Save data
				$model->updateDropdownValue($dropdownListItemViewModel->TableName, $dropdownListItemViewModel->Id, $dropdownListItemViewModel->NameE, $dropdownListItemViewModel->NameF);

				$this->redirect("admin/index");
			}
			else
			{
				echo "Failed to save the change";
			}
		}
		else
		{
			//Execute this code if NOT a post back
		}
	}

	function dropdownitemadd($tableName)
	{
		//Loads a model from corresponding model folder
		$model = $this->loadModel('AdminModel');

		//Loads a view from corresponding view folder
		$view = $this->loadView('dropdownitemadd');

		$dropdownListItemViewModel = $this->loadViewModel('shared/DropdownItemViewModel');
		$dropdownListItemViewModel->TableName = $tableName;

		$view->set('dropdownListItemViewModel', $dropdownListItemViewModel);

		//Renders the view. true indicates to load the layout
		$view->render(true);

		//Execute code if a post back
		if($this->isPost())
		{

			//Map post values to the loginViewModel
			$dropdownListItemViewModel  = AutoMapper::mapPost($dropdownListItemViewModel );
			
			if($dropdownListItemViewModel->validate())
			{
				$model->addDropdownItem($dropdownListItemViewModel->TableName,
				$dropdownListItemViewModel->NameE, $dropdownListItemViewModel->NameF);

				$this->redirect("admin/index");
			}
			else
			{
				echo "Failed to save the change";
			}
		}
		else
		{
			//Execute this code if NOT a post back
		}
	}

	function storyansweredit($answerId)
	{
		//Loads a model from corresponding model folder
		$model = $this->loadModel('AdminModel');

		//Loads a view from corresponding view folder
		$view = $this->loadView('storyansweredit');

		$storyAnswerViewModel = $this->loadViewModel('shared/StoryAnswerViewModel');
		$storyAnswerViewModel = $model->getAnswerById($answerId);

		$view->set('storyAnswerViewModel', $storyAnswerViewModel);

		//Renders the view. true indicates to load the layout
		$view->render(true);

		//Execute code if a post back
		if($this->isPost())
		{
			$storyAnswerViewModel->NameE = $_POST["NameE"];
			$storyAnswerViewModel->NameF = $_POST["NameF"];

			//Map post values to the loginViewModel
			$storyAnswerViewModel  = AutoMapper::mapPost($storyAnswerViewModel );
			
			if($storyAnswerViewModel->validate())
			{
				$model->updateAnswer($storyAnswerViewModel->AnswerId, $storyAnswerViewModel->NameE, $storyAnswerViewModel->NameF);

				$this->redirect("admin/index");
			}
			else
			{
				echo "Failed to save the change";
			}
		}
		else
		{
			//Execute this code if NOT a post back
		}
	}

	function storyansweradd()
	{
		//Loads a model from corresponding model folder
		$model = $this->loadModel('AdminModel');

		//Loads a view from corresponding view folder
		$view = $this->loadView('storyansweradd');

		$storyAnswerViewModel = $this->loadViewModel('shared/StoryAnswerViewModel');

		$view->set('storyAnswerViewModel', $storyAnswerViewModel);

		//Renders the view. true indicates to load the layout
		$view->render(true);

		//Execute code if a post back
		if($this->isPost())
		{
			$storyAnswerViewModel->NameE = $_POST["NameE"];
			$storyAnswerViewModel->NameF = $_POST["NameF"];

			//Map post values to the loginViewModel
			$storyAnswerViewModel  = AutoMapper::mapPost($storyAnswerViewModel );
			
			if($storyAnswerViewModel->validate())
			{
				$model->addAnswer($storyAnswerViewModel->NameE, $storyAnswerViewModel->NameF);

				$this->redirect("admin/index");
			}
			else
			{
				echo "Failed to save the change";
			}
		}
		else
		{
			//Execute this code if NOT a post back
		}
	}
 
	function storyquestionedit($questionId)
	{
		//Loads a model from corresponding model folder
		$model = $this->loadModel('AdminModel');

		//Loads a view from corresponding view folder
		$view = $this->loadView('storyquestionedit');

		$storyQuestionViewModel = $this->loadViewModel('shared/StoryQuestionViewModel');
		$storyQuestionViewModel = $model->getQuestionById($questionId);

		$view->set('storyQuestionViewModel', $storyQuestionViewModel);

		//Renders the view. true indicates to load the layout
		$view->render(true);

		//Execute code if a post back
		if($this->isPost())
		{
			$storyQuestionViewModel->NameE = $_POST["NameE"];
			$storyQuestionViewModel->NameF = $_POST["NameF"];
			
			//Map post values to the loginViewModel
			$storyQuestionViewModel  = AutoMapper::mapPost($storyQuestionViewModel );
			
			if($storyQuestionViewModel->validate())
			{
				$model->updateQuestion($storyQuestionViewModel->QuestionId,
				$storyQuestionViewModel->NameE, $storyQuestionViewModel->NameF);

				$this->redirect("admin/index");
			}
			else
			{
				echo "Failed to save the change";
			}
		}
		else
		{
			//Execute this code if NOT a post back
		}
	}

	function storyquestionadd()
	{
		//Loads a model from corresponding model folder
		$model = $this->loadModel('AdminModel');

		//Loads a view from corresponding view folder
		$view = $this->loadView('storyquestionadd');

		$storyQuestionViewModel = $this->loadViewModel('shared/StoryQuestionViewModel');

		$view->set('storyQuestionViewModel', $storyQuestionViewModel);

		//Renders the view. true indicates to load the layout
		$view->render(true);

		//Execute code if a post back
		if($this->isPost())
		{
			$storyQuestionViewModel->NameE = $_POST["NameE"];
			$storyQuestionViewModel->NameF = $_POST["NameF"];
			debugit($storyQuestionViewModel);

			//Map post values to the loginViewModel
			$storyQuestionViewModel  = AutoMapper::mapPost($storyQuestionViewModel );
			
			if($storyQuestionViewModel->validate())
			{
				$model->addQuestion($storyQuestionViewModel->NameE, $storyQuestionViewModel->NameF);

				$this->redirect("admin/index");
			}
			else
			{
				echo "Failed to save the change";
			}
		}
		else
		{
			//Execute this code if NOT a post back
		}
	}

	/**********************
	* Test Form 
	***********************/
	function testForm()
	{
		//Loads a model from corresponding model folder
		$model = $this->loadModel('AdminModel');

		//Loads a view model from corresponding viewmodel folder
		//$viewModel = $this->loadModel('SomeViewModel');

		//Loads a view from corresponding view folder
		$template = $this->loadView('testform');

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
