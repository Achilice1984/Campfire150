<?php

header('Content-Type:text/html; charset=UTF-8');

/*
 * PIP v0.5.3
 */

//Start the Session
session_start(); 


/*
*	Load plugins
*/
require_once('./application/plugins/gettext/gettext.inc');
require_once('./application/plugins/akismet/akismet.class.php');
require_once('./application/plugins/mailchimp/Mailchimp.php');
require_once('./application/plugins/html_sanitizer/html_sanitizer.php');
require_once('./application/plugins/alphaid/alphaID.php');
require_once('./application/plugins/censor/CensorWords.php');
require_once('./application/plugins/mobile-detect/Mobile_Detect.php');

//Need this if php version less than 5.5
require_once('./application/plugins/password/password.php');

//Custom plugins
require_once('./application/plugins/automapper/AutoMapper.php');
require_once('./application/plugins/successanderror/successanderror.php');


// Defines
define('ROOT_DIR', realpath(dirname(__FILE__)) .'/');
define('APP_DIR', ROOT_DIR .'application/');

define('IMG_LARGE', 'large');
define('IMG_MEDIUM', 'medium');
define('IMG_SMALL', 'small');
define('IMG_XSMALL', 'xsmall');

define('IMG_PROFILE', 1);
define('IMG_BACKGROUND', 2);
define('IMG_STORY', 3);

define('IMG_PROFILE_URL', 'profile');
define('IMG_BACKGROUND_URL', 'background');
define('IMG_STORY_URL', 'story');

// Includes
require(APP_DIR .'config/config.php');
require(ROOT_DIR .'system/model.php');
require(ROOT_DIR .'system/viewmodel.php');
require(ROOT_DIR .'system/view.php');
require(ROOT_DIR .'system/controller.php');
require(ROOT_DIR .'system/pip.php');

//Custom System
require(ROOT_DIR .'system/validator.php');
require(ROOT_DIR .'system/authentication.php');
require(ROOT_DIR .'system/sessionmanager.php');

$detect = new Mobile_Detect;

// Define base URL
global $config;

/*****************
*
*	Results returns
*
******************/
define('IS_MOBILE', ($detect->isMobile() && !$detect->isTablet()));

define('IS_DEBUG', $config['debugMode']);

define('MAX_HOME_STORIES', (IS_MOBILE ? $config["MAX_HOME_STORIES_MOBILE"] : $config["MAX_HOME_STORIES"]));
define('MAX_STORIES_LISTS', (IS_MOBILE ? $config["MAX_STORIES_LISTS_MOBILE"] : $config["MAX_STORIES_LISTS"]));
define('MAX_RELATED_STORIES', (IS_MOBILE ? $config["MAX_RELATED_STORIES_MOBILE"] : $config["MAX_RELATED_STORIES"]));
define('MAX_USERS_LISTS', (IS_MOBILE ? $config["MAX_USERS"] : $config["MAX_USERS_MOBILE"]));
define('MAX_COMMENTS_LISTS', (IS_MOBILE ? $config["MAX_COMMENTS"] : $config["MAX_COMMENTS_MOBILE"]));
define('MAX_ADMIN_LISTS', (IS_MOBILE ? $config["MAX_ADMIN_LISTS"] : $config["MAX_ADMIN_LISTS_MOBILE"]));
define('MAX_HOME_CATEGORIES', $config['MAX_HOME_CATEGORIES']);

define('REMEMBER_ME_DAYS', $config['REMEMBER_ME_DAYS']);
define('SESSION_EXP_MINUTES', $config['SESSION_EXP_MINUTES']);
define('MAX_LOGIN_ATTEMPTS', $config['MAX_LOGIN_ATTEMPTS']);
define('ACCOUNT_LOCKOUT_TIME_MIN', $config['ACCOUNT_LOCKOUT_TIME_MIN']);

define('base_url_https', $config['base_url_https']);

define('SITE_EMAIL', $config['SITE_EMAIL']);
define('CONTACT_EMAIL', $config['CONTACT_EMAIL']);

define('COUNTDOWN_END', $config['COUNTDOWN_END']);

$request_url = sprintf(
					    "%s://%s:8084/",
					    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
					    $_SERVER['SERVER_NAME']
					  );
// $request_url = sprintf(
// 					    "%s://%s/",
// 					    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
// 					    $_SERVER['SERVER_NAME']
// 					  );

//Check if the requested url is included in the array of valid urls
//and asign the proper url
if(in_array($request_url, $config['base_url'], true))
{
	define('BASE_URL', $request_url);
}
else
{
	define('BASE_URL', $config['base_url'][0]);
}

define('FULL_URL', 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'] . ($config["debugMode"] == true ? ":8084" : "") . $_SERVER['REQUEST_URI']);
//define('FULL_URL', 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);
// Language Setup

$sessionManager = new SessionManager;
$sessionManager->IsTimedOut();
$language = $sessionManager->setLanguagePrefernece();

putenv("LC_ALL={$language}");
T_setlocale(LC_MESSAGES, $language);
 
// Set the text domain as "messages"
$domain = "messages";
bindtextdomain($domain, "locale"); 
textdomain($domain);


//Remove old success and error messages from sessions
unsetErrors();
unsetSuccess();
unsetInfo();


//If we are in debugMode, show errors and use custom error handler for easier to read errors
if($config["debugMode"] == true)
{
	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);	
}
else
{
	error_reporting(0);
}

require_once(APP_DIR . 'helpers/image_get_path.php');

set_error_handler("exception_error_handler");
set_exception_handler("exception_handler");

pip();

?>

<?php

	function debugit($object)
	{
		echo "<div style='margin-top:100px;'></div>";
		echo "<h2>Debugit</h2>";
		echo "<pre>"; 
			echo "<h3>Object Print Out:</h3>";
			print_r($object);
		echo "</pre>";
	}	

	function exception_error_handler($errno, $errstr, $errfile, $errline ) {
		

		$_SESSION["errno"] = $errno;
		$_SESSION["errstr"] = $errstr;
		$_SESSION["errfile"] = $errfile;
		$_SESSION["errline"] = $errline;
		ob_start();
		header('Location: '. BASE_URL . "error/generic");
		exit;
	}

	function exception_handler($ex) {
		

		$_SESSION["exception"] = $ex;
		ob_start();
		header('Location: '. BASE_URL . "error/generic");
		exit;
	}

	function getSubText($text)
	{
		return strip_tags(substr(substr($text, 0, 500), 0, 255) . " ...");
	}	
?>