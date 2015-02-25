<?php

class Home extends Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$model = $this->loadModel('HomeModel');
		$models = $this->loadModel('SiteContent/SiteContentModel');

		$homeViewModel = $this->loadViewModel('HomeViewModel');

		if($this->isPost())
		{
			$homeViewModel = AutoMapper::mapPost($homeViewModel);

			$homeViewModel->validate();

			if($homeViewModel->getValidationResult()->isValid())
			{
				$this->redirect("");
			}
		}


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


		$template = $this->loadView('index');
		$template->set('viewModel', $homeViewModel);
		$template->render(true);
	}  

	function about()
	{
		//Load the profile view
		$view = $this->loadView('about');

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
