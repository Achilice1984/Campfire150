<?php
/*
 * PIP v0.5.3
 */

//Start the Session
session_start(); 

/*
*	Load plugins
*/
require_once('./application/plugins/gettext/gettext.inc');
require_once('./application/plugins/automapper/AutoMapper.php');
require_once('./application/plugins/akismet/akismet.class.php');
require_once('./application/plugins/mailchimp/Mailchimp.php');
require_once('./application/plugins/alphaid/alphaID.php');
require_once('./application/plugins/successanderror/successanderror.php');

//Need this if php version less than 5.5
require_once('./application/plugins/password/password.php');


// Defines
define('ROOT_DIR', realpath(dirname(__FILE__)) .'/');
define('APP_DIR', ROOT_DIR .'application/');

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

// Define base URL
global $config;
define('BASE_URL', $config['base_url']);


// Language Setup
$sessionManager = new SessionManager();
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



//If we are in debugMode, show errors and use custom error handler for easier to read errors
if($config["debugMode"] == true)
{
	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);	
}
else
{
	error_reporting(-1);
}

 set_error_handler("exception_error_handler");

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

		global $config;

		$_SESSION["errno"] = $errno;
		$_SESSION["errstr"] = $errstr;
		$_SESSION["errfile"] = $errfile;
		$_SESSION["errline"] = $errline;

		header('Location: '. $config['base_url'] . "error/generic");
		exit;
	}	
?>