<?php 

/*********************************************
*
*				DEBUG MODE
*
**********************************************/
//
// By setting this to FALSE, you will no longer see errors in the browser
// This should always be set to false unless you are using the application in a testing environment.
//
$config["debugMode"] = true;

/*********************************************
*
*				BASE URLS (KNOWN URLS)
*
**********************************************/
//
// These are the urls that you intend to allow users to access your site by.
// Because we are forcing the https connection this is almost not necessary
//

 $config['base_url'] = "http://localhost:8084/CampFire150/"; // Base URL including trailing slash (e.g. http://localhost/)
 $config['base_url_https'] = "http://localhost:8084/CampFire150/";

//$config['base_url'] = "https://campfire150.com/"; // Base URL including trailing slash (e.g. http://localhost/)
//$config['base_url_https'] = "https://campfire150.com/";

/*********************************************
*
*				DEFAULT PAGES
*
**********************************************/
//
// These are default locations that users will be redirected to
//

// Default controller to load
// This means that when someone requests https://campfire150.com/
// They are getting the home controller and the index action
$config['default_controller'] = 'home'; 

// Controller used for errors (e.g. 404, 500 etc)
$config['error_controller'] = 'error'; 

/*********************************************
*
*				DATABASE DETAILS
*
**********************************************/
/* Connect to an ODBC database using driver invocation */
//
// These are the database credentials
//

$config['db_dsn'] = 'mysql:dbname=wwwcoiox_campfire;localhost';
$config['db_username'] = 'wwwcoiox_campfir'; // Database username
$config['db_password'] = 'Ep8qNRvHWUV4NXSu'; // Database password


/*********************************************
*
*				SITE EMAIL
*
**********************************************/
//
// These are the emails that are used by Campfire150
//

//Used for welcome emails and password resets
$config["SITE_EMAIL"] 	 = "admin@campfire150.com";

//Used for the contact form
$config["CONTACT_EMAIL"] = "info@campfire150.com"; //Password h4qtXcrU5Bh{


/*********************************************
*
*				LIST LENGTHS
*
**********************************************/
//
// These set the length limits for various lists in the website, some have mobile options
//

$config['MAX_HOME_STORIES'] 			= 6;
$config['MAX_HOME_STORIES_MOBILE']		= 3;

$config['MAX_STORIES_LISTS']			= 10;
$config['MAX_STORIES_LISTS_MOBILE'] 	= 10;

$config['MAX_RELATED_STORIES']			= 6;
$config['MAX_RELATED_STORIES_MOBILE'] 	= 3;

$config['MAX_USERS']					= 10;
$config['MAX_USERS_MOBILE']				= 10;

$config['MAX_COMMENTS']					= 10;
$config['MAX_COMMENTS_MOBILE']			= 10;

$config['MAX_ADMIN_LISTS']				= 10;
$config['MAX_ADMIN_LISTS_MOBILE']		= 10;

$config['MAX_HOME_CATEGORIES'] 			= 5;


/*********************************************
*
*				SESSIONS
*
**********************************************/
//
// These are differenent session settings
//

// When remember me is set, this is how many days the session will remain active
$config['REMEMBER_ME_DAYS'] 			= 365;

// If remember me is NOT set, this how many minutes the session will remain active for inbetween requests
$config['SESSION_EXP_MINUTES'] 			= 30;

//This is the maximum allowable login attempts
$config['MAX_LOGIN_ATTEMPTS'] 			= 10;

//This is how long an account will be locked for if the maximum login attemps exceeds the maximum limit
$config['ACCOUNT_LOCKOUT_TIME_MIN']		= 10;



/*********************************************
*
*				EXAMPLE OF MAILCHIMP AND ASKIMET
*
**********************************************/
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

?>