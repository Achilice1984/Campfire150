<?php 

/*********************************************
*
*				DEBUG MODE
*
**********************************************/
$config["debugMode"] = true;

/*********************************************
*
*				BASE URLS (KNOWN URLS)
*
**********************************************/
//$config['base_url'] = array("http://localhost:8084/CampFire150/"); // Base URL including trailing slash (e.g. http://localhost/)
//$config['base_url_https'] = "http://localhost:8084/CampFire150/";

$config['base_url'] = array("http://www.campfire150.com/", "http://campfire150.com/", "https://www.campfire150.com/", "https://campfire150.com/"); // Base URL including trailing slash (e.g. http://localhost/)
$config['base_url_https'] ="https://www.campfire150.com/";

/*********************************************
*
*				DEFAULT PAGES
*
**********************************************/
$config['default_controller'] = 'home'; // Default controller to load
$config['error_controller'] = 'error'; // Controller used for errors (e.g. 404, 500 etc)

/*********************************************
*
*				DATABASE DETAILS
*
**********************************************/
/* Connect to an ODBC database using driver invocation */
$config['db_dsn'] = 'mysql:dbname=wwwcoiox_campfire;localhost';
$config['db_username'] = 'wwwcoiox_campfir'; // Database username
$config['db_password'] = 'Ep8qNRvHWUV4NXSu'; // Database password



/*********************************************
*
*				LIST LENGTHS
*
**********************************************/
$config['MAX_HOME_STORIES'] 			= 9;
$config['MAX_HOME_STORIES_MOBILE']		= 6;

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

$config['REMEMBER_ME_DAYS'] 			= 365;

$config['SESSION_EXP_MINUTES'] 			= 30;

$config['MAX_LOGIN_ATTEMPTS'] 			= 10;

$config['ACCOUNT_LOCKOUT_TIME_MIN']		= 10;

?>