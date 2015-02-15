<?php

// Defines
define('ROOT_DIR', realpath(dirname(__FILE__)) .'/');
define('APP_DIR', ROOT_DIR .'application/');

require(APP_DIR .'config/config.php');
// Define base URL
global $config;

//Check if the requested url is included in the array of valid urls
//and asign the proper url

$baseURL;

if(in_array($config['request_url'], $config['base_url'], true))
{
	$baseURL = $config['request_url'];
}
else
{
	$baseURL = $config['base_url'][0];
}
		
header('Location: '. $baseURL . "error/error404");
exit;

?>