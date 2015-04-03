<?php

class Story extends Controller {
	
	//Main action for controller, equivelent to: www.site.com/controller/
	function index()
	{
		try
		{
			$this->redirect("story/search");
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}
	function StoryList()
	{
		try
		{
			$storyModel = $this->loadModel("Story/StoryModel");

			$stories  = $storyModel->getStories();

			if($this->isAjax())
			{
				echo json_encode($stories);
			}
			else
			{
				$view = $this->loadView("storyList");
				$view->set('stories', $stories);
				$view->render(true);//true = add header foot
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}	

	function search()
	{
		try
		{
			$storyModel = $this->loadModel("Story/StoryModel");
			$searchResults = array();

			if($this->isPost())
			{
				if(isset($_POST["StorySearch"]))
				{
					$_GET["search"] = true;
					
					$searchResults = $storyModel->searchStories($_POST["StorySearch"], $this->currentUser->UserId);
				}			
			}
			else
			{
				if(isset($_GET["q"]))
				{
					$searchResults = $storyModel->searchStories($_GET["q"], $this->currentUser->UserId);

					$_POST["StorySearch"] = $_GET["q"];
				}
			}

			$mostRecommendedResults = $storyModel->getStoryListMostRecommended($this->currentUser->UserId);

			$latestResults = $storyModel->getStoryListNewest($this->currentUser->UserId);

			//Load the profile view
			$view = $this->loadView('search');

			$view->set('searchResults', $searchResults);
			$view->set('mostRecommendedResults', $mostRecommendedResults);
			$view->set('latestResults', $latestResults);

			//Load up some js files
			$view->setJS(array(
				array("static/js/storysearch.js", "intern"),
				array("static/js/storyButtons.js", "intern")
			));
			$view->setCSS(array(
				array("static/css/storysearch.css", "intern")
			));

			//Render the profile view. true indicates to load the layout pages as well
			$view->render(true);
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function ajaxSearch()
	{
		try
		{
			$storyModel = $this->loadModel("Story/StoryModel");
			$searchResults = array();

			if(isset($_POST["StorySearch"]))
			{
				$searchResults = $storyModel->searchStories($_POST["StorySearch"], $this->currentUser->UserId, MAX_STORIES_LISTS, isset($_POST["StorySearchPage"]) ? $_POST["StorySearchPage"] : 1);
			}

			if (isset($searchResults)) {
				foreach ($searchResults as $story)
				{
					include(APP_DIR . "views/Story/_searchPanel.php");
				}
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function recommendedstories()
	{
		try
		{
			$storyModel = $this->loadModel("Story/StoryModel");
			$searchResults = array();

			$searchResults = $storyModel->getStoryListMostRecommended($this->currentUser->UserId, MAX_STORIES_LISTS, isset($_POST["RecommendedStoryPage"]) ? $_POST["RecommendedStoryPage"] : 1);

			if (isset($searchResults)) {
				foreach ($searchResults as $story)
				{
					include(APP_DIR . "views/Story/_searchPanel.php");
				}
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}	

	function lateststories()
	{
		try
		{
			$storyModel = $this->loadModel("Story/StoryModel");
			$searchResults = array();

			$searchResults = $storyModel->getStoryListNewest($this->currentUser->UserId, MAX_STORIES_LISTS, isset($_POST["LatestStoryPage"]) ? $_POST["LatestStoryPage"] : 1);

			if (isset($searchResults)) {
				foreach ($searchResults as $story)
				{
					include(APP_DIR . "views/Story/_searchPanel.php");
				}
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function publish($storyId)
	{
		try
		{
			//Check if users is authenticated for this request
			//Will kick out if not authenticated
			$this->AuthRequest();

			//Load the AccountModel to access account functions
			$storyModel = $this->loadModel('StoryModel');

			$storyViewModel = $storyModel->getStory_unpublished($this->currentUser->UserId, $storyId, FALSE);

			if(isset($storyViewModel[0]) 
				&& $storyViewModel[0]->UserId == $this->currentUser->UserId
				&& $storyViewModel[0]->Published == FALSE)
			{
				//Execute code if a post back
				if($this->isPost())
				{
					
					if($this->validateDynamicContent($storyModel))
					{
						$this->saveQuestionAnswers($storyModel, $storyId);

						$storyModel->setPublishFlag($storyId, $this->currentUser->UserId, true);

						$_SESSION["Story_Pending"] = TRUE;
						$this->redirect("account/home");
					}
				}
			}
			else
			{
				$this->redirect("home");
			}

			//Load the profile view
			$view = $this->loadView('publish');

			$view->set('storyViewModel', $storyViewModel[0]);

			$siteModel = $this->loadModel('SiteContent/SiteContentModel');
			
			$view->set('storyQuestions', $siteModel->getStoryQuestions());


			//Load up some js files
			$view->setJS(array(
				array("static/js/select2.js", "intern"),
				array("static/plugins/validation/js/formValidation.min.js", "intern"),
				array("static/plugins/validation/js/framework/bootstrap.min.js", "intern"),
				array("static/plugins/select2/js/select2.min.js", "intern"),
				array("static/plugins/validation/js/language/en_US.js", "intern"),
				array("static/plugins/validation/js/language/fr_FR.js", "intern"),
				array("static/js/validation.js", "intern")
			));

			$view->setCSS(array(
				array("static/plugins/validation/css/formValidation.min.css", "intern"),
				array("static/plugins/select2/css/select2.min.css", "intern")
			));		

			//Render the profile view. true indicates to load the layout pages as well
			$view->render(true);
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function edit($storyID)
	{
		try
		{
			require_once(APP_DIR .'viewmodels/shared/TagViewModel.php');
			require_once(APP_DIR.'helpers/image_save.php');

			//Check if users is authenticated for this request
			//Will kick out if not authenticated
			if($this->isAuth())
			{
				//Loads a view model from corresponding viewmodel folder
				$storyViewModel = $this->loadViewModel('shared/StoryViewModel');

				//Load the AccountModel to access account functions
			 	$storyModel = $this->loadModel('StoryModel');

				//Execute code if a post back
				if($this->isPost())
				{
					//Map post values to the loginViewModel
					$storyViewModel = AutoMapper::mapPost($storyViewModel);					

					if($this->CheckTags())
					{
						if($storyViewModel->validate())
						{
							$storyViewModel->Published = FALSE;

							//UPDATE STORY
							$storyModel->updateDraft($storyViewModel, $this->currentUser->UserId);

							//$this->saveQuestionAnswers($storyModel, $storyId);
							$this->saveTags($storyModel, $storyViewModel->StoryId);
							
							$imageId = 0;

							if(isset($storyViewModel->Images) && $storyViewModel->Images["size"] > 0)
							{
								$imageId = $storyModel->saveStoryImageMetadata($this->currentUser->UserId, $storyViewModel->Images, $storyViewModel->StoryId);

								//debugit($imageId);

								if(isset($imageId) && $imageId > 0)
								{
									//debugit($_POST);
									image_save($storyViewModel->Images, $this->currentUser->UserId, $imageId, IMG_STORY_URL, 
													 $_POST["image_height"], $_POST["image_width"], $_POST["image_x"], $_POST["image_y"]); 
								}
							}					

							if(isset($_POST["publish"]))
							{
								$this->redirect("story/publish", array($storyViewModel->StoryId));
							}
							else
							{
								$_SESSION["Story_Draft"] = TRUE;
								$this->redirect("account/home");
							}
						}
					}
					else
					{
						addErrorMessage("dbError", gettext("Swearwords are not allowed in tags."));
					}

					$storyViewModel->Tags = $this->getTags($storyModel);	

					$storyViewModelOld = $storyModel->getStory_unpublished($this->currentUser->UserId, $storyID);

					if(isset($storyViewModelOld[0]))
					{
						$storyViewModel->PictureId 	= $storyViewModelOld[0]->PictureId;
						$storyViewModel->UserId 	= $storyViewModelOld[0]->UserId;
					}
				}	
				else
				{
					if(isset($storyID))
					{
						$storyViewModel = $storyModel->getStory_unpublished($this->currentUser->UserId, $storyID);
					}

					//An error occured
					if(!isset($storyViewModel[0]))
					{
						$this->redirect("account/home");
					}
					else
					{
						$storyViewModel = $storyViewModel[0];
						$storyViewModel->Tags = $storyModel->getTagsForStory($storyID);
					}
				}	

				//Load the profile view
				$view = $this->loadView('add');

				$siteModel = $this->loadModel('SiteContent/SiteContentModel');
				$view->set('privacyDropdownValues', $siteModel->getDropdownValues_StoryPrivacyType());

				//Add a variable with old login data so that it can be accessed in the view
				$view->set('storyViewModel', $storyViewModel);

				//Load up some js files
				$view->setJS(array(
					array("static/plugins/tinymce/tinymce.min.js", "intern"),
					array("static/js/tinymce.js", "intern"),
					array("static/js/select2.js", "intern"),
					array("static/js/addstory.js", "intern"),
					array("static/plugins/cropper/cropper.min.js", "intern"),
					array("static/plugins/validation/js/formValidation.min.js", "intern"),
					array("static/plugins/validation/js/framework/bootstrap.min.js", "intern"),
					array("static/plugins/select2/js/select2.min.js", "intern"),
					array("static/plugins/validation/js/language/en_US.js", "intern"),
					array("static/plugins/validation/js/language/fr_FR.js", "intern"),
					array("static/js/validation.js", "intern")
				));

				$view->setCSS(array(
					array("static/css/addstory.css", "intern"),
					array("static/plugins/cropper/cropper.min.css", "intern"),
					array("static/plugins/validation/css/formValidation.min.css", "intern"),
					array("static/plugins/select2/css/select2.min.css", "intern")
				));			

				//Render the profile view. true indicates to load the layout pages as well
				$view->render(true);
			}
			else
			{
				addInfoMessage("notReg", gettext("Want to share your story? Register now!"), 1);
				$this->redirect("account/register");
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function add()
	{
		try
		{
			require_once(APP_DIR .'viewmodels/shared/TagViewModel.php');
			require_once(APP_DIR.'helpers/image_save.php');

			//Check if users is authenticated for this request
			//Will kick out if not authenticated
			if($this->isAuth())
			{
				//Loads a view model from corresponding viewmodel folder
				$storyViewModel = $this->loadViewModel('shared/StoryViewModel');

				//Execute code if a post back
				if($this->isPost())
				{
					
					//Map post values to the loginViewModel
					$storyViewModel = AutoMapper::mapPost($storyViewModel);			

					// //Load the AccountModel to access account functions
				 	$storyModel = $this->loadModel('StoryModel');

					$storyId;

					if($this->CheckTags())
					{
						if($storyViewModel->validate())
						{
							$storyViewModel->Published = FALSE;

							$storyModel->publishNewStory($storyViewModel, $this->currentUser->UserId);
							$storyId = $storyModel->lastInsertId();

							//$this->saveQuestionAnswers($storyModel, $storyId);
							$this->saveTags($storyModel, $storyId);

							if($storyViewModel->Images['size'] > 0)
							{
								$imageId = $storyModel->saveStoryImageMetadata($this->currentUser->UserId, $storyViewModel->Images, $storyId);

								if(isset($imageId) && $imageId > 0)
								{
									image_save($storyViewModel->Images, $this->currentUser->UserId, $imageId, IMG_STORY_URL, 
													 $_POST["image_height"], $_POST["image_width"], $_POST["image_x"], $_POST["image_y"]); 
								}
							}

							if(isset($_POST["publish"]))
							{
								$this->redirect("story/publish", array($storyId));
							}
							else
							{
								$_SESSION["Story_Draft"] = TRUE;
								$this->redirect("account/home");
							}
						}
					}
					else
					{
						addErrorMessage("dbError", gettext("Swearwords are not allowed in tags."));
					}

					$storyViewModel->Tags = $this->getTags($storyModel);	
							
				}		

				//Load the profile view
				$view = $this->loadView('add');

				$siteModel = $this->loadModel('SiteContent/SiteContentModel');
				$view->set('privacyDropdownValues', $siteModel->getDropdownValues_StoryPrivacyType());

				//Add a variable with old login data so that it can be accessed in the view
				$view->set('storyViewModel', $storyViewModel);

				//Load up some js files
				$view->setJS(array(
					array("static/plugins/tinymce/tinymce.min.js", "intern"),
					array("static/js/tinymce.js", "intern"),
					array("static/js/select2.js", "intern"),
					array("static/js/addstory.js", "intern"),
					array("static/plugins/cropper/cropper.min.js", "intern"),
					array("static/plugins/validation/js/formValidation.min.js", "intern"),
					array("static/plugins/validation/js/framework/bootstrap.min.js", "intern"),
					array("static/plugins/select2/js/select2.min.js", "intern"),
					array("static/plugins/validation/js/language/en_US.js", "intern"),
					array("static/plugins/validation/js/language/fr_FR.js", "intern"),
					array("static/js/validation.js", "intern")
				));

				$view->setCSS(array(
					array("static/css/addstory.css", "intern"),
					array("static/plugins/cropper/cropper.min.css", "intern"),
					array("static/plugins/validation/css/formValidation.min.css", "intern"),
					array("static/plugins/select2/css/select2.min.css", "intern")
				));			

				//Render the profile view. true indicates to load the layout pages as well
				$view->render(true);
			}
			else
			{
				addInfoMessage("notReg", gettext("Want to share your story? Register now!"), 1);
				$this->redirect("account/register");
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	private function saveQuestionAnswers($storyModel, $storyID)
	{
		try
		{
			foreach ($_POST["QuestionAnswers"] as $questionID => $answers) {

				foreach ($answers as $answerID) {
					$storyModel->addAnswerToStoryQuestion($storyID, $questionID, $answerID);
				}			
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	private function CheckTags()
	{
		require_once('./application/plugins/censor/CensorWords.php');
		//use Snipe\BanBuilder\CensorWords;

		$censor = new Snipe\BanBuilder\CensorWords;

    	foreach ($_POST["Tags"] as $tagID) {
    		$string = $censor->censorString($tagID);

    		if (isset($string) && is_array($string) && $string["orig"] != $string["clean"]) {
    			return FALSE;
    		}
    	}

    	return TRUE;
	}

	private function saveTags($storyModel, $storyID)
	{
		try
		{
			if(isset($_POST["Tags"]))
			{
				foreach ($_POST["Tags"] as $tagID) {
					
					if(!is_numeric($tagID))
					{
						$tagID = $storyModel->checkTagExists($tagID);
						
						if(!is_numeric($tagID))
						{
							if($storyModel->addNewTag($tagID))
							{
								$tagID = $storyModel->lastInsertId();
							}
						}
					}	

					if(is_numeric($tagID))
					{
						$storyModel->addTagToStory($storyID, $tagID);						
					}		
				}
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	private function validateDynamicContent($storyModel)
	{
		try
		{
			if(count($_POST["QuestionAnswers"]) != $storyModel->getActiveQuestionCount())
			{
				addErrorMessage("dbError", gettext("Please answer all questions on the form."));

				return FALSE;
			}			

			foreach ($_POST["QuestionAnswers"] as $questionID => $answers) {

				if($questionID == 1 || $questionID == 2 || $questionID == 5)
				{ 
					if(count($answers) > 5)
					{
						addErrorMessage("dbError", gettext("Some fields contain too many answers."));

						return FALSE;
					}
				}
				elseif (count($answers) > 1) {
					addErrorMessage("dbError", gettext("Some fields contain too many answers."));

					return FALSE;
				}

				foreach ($answers as $answerID) {
					if($storyModel->isValidAnswer($questionID, $answerID) == FALSE)
					{
						addErrorMessage("dbError", gettext("Some fields contain invalid choices."));

						return FALSE;
					}
				}			
			}

			return TRUE;
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	private function getTags($storyModel)
	{
		try
		{
			$tags = array();

			if(isset($_POST["Tags"]))
			{
				foreach ($_POST["Tags"] as $tagId) {

					if(is_numeric($tagId))
					{
						$tag = $storyModel->getTagByID($tagId);
						
						if(isset($tag[0]) && is_object($tag[0]) && is_a($tag[0], "TagViewModel"))
						{
							$tags[] = $tag[0];
						}
					}
				}
			}

			return $tags;
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}	

	function display($storyID)
	{
		try
		{
			require_once(APP_DIR.'helpers/image_get_path.php');		

			//Load the profile view
			$view = $this->loadView('display');

			//Load the AccountModel to access account functions
			$model = $this->loadModel('StoryModel');

			//Loads a view model from corresponding viewmodel folder
			$storyViewModel = $this->loadViewModel('shared/StoryViewModel');	

			$storyViewModel = $model->getStory($this->currentUser->UserId, $storyID);
			
			if(isset($storyViewModel[0]))
			{
				$storyViewModel = $storyViewModel[0];
				$storyViewModel->Tags = $model->getTagsForStory($storyID);
				$storyViewModel->QuestionAnswers = $model->getQuestionAnswersForStory($storyID);			
				$storyViewModel->Comments = $model->getCommentsForStory($this->currentUser->UserId, $storyID);

				$accountModel = $this->loadModel('Account/AccountModel');
				$storyViewModel->UserProfile = $accountModel->getProfileByID($storyViewModel->UserId);

				$relatedStories = $this->getRelatedStories($storyViewModel, $model);
				$view->set('relatedStories', $relatedStories);
			}	
			else
			{
				$this->redirect("");
				//addErrorMessage("dbError", gettext("There was an error loading the selected story."));
			}		


			$view->setCSS(array(
				array("static/css/displaystory.css", "intern")
			));

			//Load up some js files
			$view->setJS(array(
				array("static/js/displaystory.js", "intern"),
				array("static/js/storyThumbs.js", "intern"),
				array("static/js/followUser.js", "intern"),
			));

			$siteModel = $this->loadModel('SiteContent/SiteContentModel');
			$view->set('storyQuestions', $siteModel->getStoryQuestions());

			//Add a variable with old login data so that it can be accessed in the view
			$view->set('storyViewModel', $storyViewModel);

			//Render the profile view. true indicates to load the layout pages as well
			$view->render(true);
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	private function getRelatedStories($storyViewModel, $model)
	{
		try
		{
			$totalPerTag = floor(10 / (count($storyViewModel->Tags) > 0 ? count($storyViewModel->Tags) : 1));
			$relatedStories = array();

			if(isset($storyViewModel->Tags))
			{
				for ($i=0; $i < count($storyViewModel->Tags); $i++) { 
					$tmp = null;
					$tmp = $model->getStoryListByTag($this->currentUser->UserId, $storyViewModel->Tags[$i]->Tag);

					if(isset($tmp) && count($tmp) > 0)
					{
						foreach ($tmp as $story) {
							$relatedStories[] = $story;
						}
					}
				}			
			}		

			if(!(count($relatedStories) >= 10))
			{
				$tmp = null;
				$tmp = $model->searchStories($storyViewModel->StoryTitle, 10 - count($relatedStories));

				if(isset($tmp) && count($tmp) > 0)
				{
					foreach ($tmp as $story) {
						$relatedStories[] = $story;
					}				
				}
			}

			try
			{
				$relatedStories = array_map("unserialize", array_unique(array_map("serialize", $relatedStories)));
			}
			catch (Exception $ex)
			{
				return $relatedStories;
			}

			foreach ($relatedStories as $story) {
				if($storyViewModel->StoryId == $story->StoryId)
				{
					unset($story);
					break;
				}
			}
			
			return $relatedStories;
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function recommendStory($storyID, $recommend)
	{
		try
		{
			//Check if users is authenticated for this request
			//Will kick out if not authenticated
			
			if($this->isAuth())
			{
				$result;

				//Load the AccountModel to access account functions
				$storyModel = $this->loadModel('StoryModel');

				if($recommend)
				{
					$result = $storyModel->recommendStory($storyID, $this->currentUser->UserId);
				}
				else
				{
					$result = $storyModel->unRecommendStory($storyID, $this->currentUser->UserId);
				}

				if ($this->isAjax()) {
					return $result;			
				}
				else
				{
					$this->redirect("account/home");
				}
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function flagInappropriate($storyID, $flag)
	{
		try
		{
			//Check if users is authenticated for this request
			//Will kick out if not authenticated
			if($this->isAuth())
			{			
				$result;

				//Load the AccountModel to access account functions
				$storyModel = $this->loadModel('StoryModel');

				if($flag)
				{
					$result = $storyModel->flagStoryAsInapropriate($storyID, $this->currentUser->UserId);
				}
				else
				{
					$result = $storyModel->unFlagStoryAsInapropriate($storyID, $this->currentUser->UserId);
				}

				if ($this->isAjax()) {
					return $result;			
				}
				else
				{
					$this->redirect("account/home");
				}
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function searchtag()
	{
		try
		{
			//Check if users is authenticated for this request
			//Will kick out if not authenticated

			if($this->isAuth())
			{
				
				$tags;

				//Loads a view model from corresponding viewmodel folder
				$storyViewModel = $this->loadViewModel('shared/TagViewModel');

				//Load the AccountModel to access account functions
				$storyModel = $this->loadModel('StoryModel');

				$tags = $storyModel->searchTags(isset($_GET["q"]) ? $_GET["q"] : "");

				return json_encode($tags);
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function addComment()
	{
		try
		{
			//Check if users is authenticated for this request
			//Will kick out if not authenticated
			if($this->isAuth())
			{
				
				//Loads a view model from corresponding viewmodel folder
				$commentViewModel = $this->loadViewModel('shared/CommentViewModel');

				//Execute code if a post back
				if($this->isPost())
				{
					//Map post values to the loginViewModel
					$commentViewModel = AutoMapper::mapPost($commentViewModel);

					//Load the AccountModel to access account functions
					$storyModel = $this->loadModel('StoryModel');

					if($commentViewModel->validate())
					{
						echo json_encode($storyModel->addCommentToStory($commentViewModel->Content, $commentViewModel->Story_StoryId, $this->currentUser->UserId));
						
						if($this->isAjax() == FALSE)
						{
							if(isset($commentViewModel->Story_StoryId))
							{
								$this->redirect("story/display", array($commentViewModel->Story_StoryId . "#comments"));
							}
							else
							{
								$this->redirect("");
							}
						}
					}			
				}	
			}
			//$this->redirect("account/display", array($commentViewModel->Story_StoryId));
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function getStoryComments()
	{
		try
		{
			require_once(APP_DIR.'helpers/image_get_path.php');

			$storyModel = $this->loadModel("Story/StoryModel");
			$commentResults = array();

			if(isset($_POST["Comment_StoryId"]))
			{
				$commentResults = $storyModel->getCommentsForStory($this->currentUser->UserId, $_POST["Comment_StoryId"], MAX_COMMENTS_LISTS, isset($_POST["CommentPage"]) ? $_POST["CommentPage"] : 1);

				if (isset($commentResults)) {
					foreach ($commentResults as $comment)
					{
						include(APP_DIR . "views/Story/_comments.php");
					}
				}
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}

	function flagCommentInappropriate($commentID, $flag)
	{
		try
		{
			//Check if users is authenticated for this request
			//Will kick out if not authenticated
			if($this->isAuth())
			{			
				$result;

				//Load the AccountModel to access account functions
				$storyModel = $this->loadModel('StoryModel');

				$result = $storyModel->flagCommentAsInapropriate($commentID, $this->currentUser->UserId, $flag);

				if ($this->isAjax()) {
					return $result;			
				}
				else
				{
					$this->redirect("account/home");
				}
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}
}

?>
