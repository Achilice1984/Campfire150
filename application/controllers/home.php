<?php

	// $comment = array(
	 //            'author'    => 'joshdvrs',
	 //            'email'     => 'josh.dvrs@gmail.com',
	 //            'website'   => 'http://www.example.com/',
	 //            'body'      => 'I really enjoyed your story!',
	 //            'permalink' => 'http://redfishgraphics.com/campfire',
	 //            'referrer'  => 'http://redfishgraphics.com/campfire'
	 //         );
	 
	 //     $akismet = new Akismet('http://www.yourdomain.com/', '00092d26de0e', $comment);
	 
	 //     if($akismet->errorsExist()) {
	 //         echo"Couldn't connected to Akismet server!";
	 //     } else {
	 //         if($akismet->isSpam()) {
	 //             echo"Spam detected";
	 //         } else {
	 //             echo"yay, no spam!";
	 //         }
	 //     }


		// $MailChimp = new Mailchimp('4532c26dcf56308f605aaacb28f6b77b-us10');
		// $result = $MailChimp->call('lists/subscribe', array(
		//                 'id'                => '72b72d0de5',
		//                 'email'             => array('email'=>'josh.dvrs@gmail.com'),
		//                 'merge_vars'        => array('FNAME'=>'Josh', 'LNAME'=>'de Vries'),
		//                 'double_optin'      => false,
		//                 'update_existing'   => true,
		//                 'replace_interests' => false,
		//                 'send_welcome'      => false,
		//             ));
		// print_r($result);

class Home extends Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		try
		{	
			$storyModel = $this->loadModel('Story/StoryModel');		

			$homeViewModel = $this->loadViewModel('HomeViewModel');
			
			$homeViewModel->WordCloud = json_encode($storyModel->getTagsForWordCloud());

			$homeViewModel->LatestStories = $storyModel->getStoryListNewest($this->currentUser->UserId, MAX_HOME_STORIES, 1);	

			$homeViewModel->ChallengesList = $storyModel->getTopChallenges(MAX_HOME_CATEGORIES);


			/***************************
			*
			*	STATS
			*
			***************************/
			$homeModel = $this->loadModel('HomeModel');

			$homeViewModel->totalPublishedStories = $homeModel->totalPublishedStories();
			$homeViewModel->totalActiveUsers = $homeModel->totalActiveUsers();
			$homeViewModel->totalPublishedComments = $homeModel->totalPublishedComments();
			$homeViewModel->totalRecommendations = $homeModel->totalRecommendations();

			$view = $this->loadView('index');

			//Load up some js files
			$view->setJS(array(
				array("static/plugins/wordcloud/wordcloud2.js", "intern"),
				array("static/js/wordcloud.js", "intern"),
				array("static/js/home.js", "intern"),
				array("static/js/storyThumbs.js", "intern"),
				array("static/plugins/coutdown/jquery.final-countdown.min.js", "intern"),
				array("static/plugins/coutdown/kinetic.js", "intern")
			));


			$view->set('homeViewModel', $homeViewModel);

			$view->render(true);
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}  

	function mission()
	{
		//Load the profile view
		$view = $this->loadView('mission');

		//Render the profile view. true indicates to load the layout pages as well
		$view->render(true);
	}

	function partners()
	{
		//Load the profile view
		$view = $this->loadView('partners');

		//Render the profile view. true indicates to load the layout pages as well
		$view->render(true);
	}

	function domore()
	{
		//Load the profile view
		$view = $this->loadView('domore');

		//Render the profile view. true indicates to load the layout pages as well
		$view->render(true);
	}

	function contact()
	{
		if($this->isPost())
		{
			if(isset($_POST["Email"]) && isset($_POST["Subject"]) && isset($_POST["Message"])
				&& $_POST["Email"] != "" && $_POST["Subject"] != "" && $_POST["Message"] != ""
				&& filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL))
			{
				$headers = "From: <" . $_POST['Email'] . ">\r\nReturn-path: " . $_POST['Email'] . "" .
				   // 'Reply-To: ' . $_POST["Email"] . '' . "\r\n" .
				    'Content-Type: text/html; charset=ISO-8859-1' . "\r\n" .
				    'X-Mailer: PHP/' . phpversion();

				   $_POST["Email"] = "";
				   $_POST["Subject"] = "";
				   $_POST["Message"] = "";

				mail(CONTACT_EMAIL, $_POST["Subject"], $_POST["Message"], $headers);

				addSuccessMessage("dbSuccess", gettext("Your message has been seent!"));
			}
			else
			{
				addErrorMessage("dbError", gettext("Something went wrong while sending your message."));
			}
		}

		//Load the profile view
		$view = $this->loadView('contact');

		//Render the profile view. true indicates to load the layout pages as well
		$view->render(true);
	}

	function terms()
	{
		$template = $this->loadView('terms');
		$template->render(true);
	}  


	function latestStoryHome()
	{
		try
		{
			$storyModel = $this->loadModel('Story/StoryModel');

			$stories = $storyModel->getStoryListNewest($this->currentUser->UserId, MAX_HOME_STORIES, 1);

			if(isset($stories))
			{
				foreach ($stories as $story) {
					include(APP_DIR . 'views/shared/_storyList.php');
				}
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}
	function recommendedStoryHome()
	{
		try
		{
			$storyModel = $this->loadModel('Story/StoryModel');

			$stories = $storyModel->getStoryListMostRecommended($this->currentUser->UserId, MAX_HOME_STORIES, 1);

			if(isset($stories))
			{
				foreach ($stories as $story) {
					include(APP_DIR . 'views/shared/_storyList.php');
				}
			}
		}
		catch(Exception $ex)
		{
			throw $ex;
		}
	}
	function storiesByCategory()
	{
		try
		{
			$storyModel = $this->loadModel('Story/StoryModel');

			$stories = $storyModel->getStoryListByChallengesID($this->currentUser->UserId, isset($_POST["ChallengeId"]) ? $_POST["ChallengeId"] : 1, MAX_HOME_STORIES, 1);

			if(isset($stories))
			{
				foreach ($stories as $story) {
					include(APP_DIR . 'views/shared/_storyList.php');
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
