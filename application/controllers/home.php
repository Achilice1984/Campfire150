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
		$storyModel = $this->loadModel('Story/StoryModel');
		$homeViewModel = $this->loadViewModel('HomeViewModel');
		
		$homeViewModel->WordCloud = json_encode($storyModel->getTagsForWordCloud());	


		$view = $this->loadView('index');

		//Load up some js files
		$view->setJS(array(
			array("static/plugins/wordcloud/wordcloud2.js", "intern"),
			array("static/js/wordcloud.js", "intern")
		));


		$view->set('homeViewModel', $homeViewModel);
		$view->render(true);
	}  

	function mission()
	{
		//Load the profile view
		$view = $this->loadView('mission');

		//Render the profile view. true indicates to load the layout pages as well
		$view->render(true);
	}
	function team()
	{
		//Load the profile view
		$view = $this->loadView('team');

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
	function research()
	{
		//Load the profile view
		$view = $this->loadView('research');

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

	function terms()
	{
		$template = $this->loadView('terms');
		$template->render(true);
	}  
}

?>
