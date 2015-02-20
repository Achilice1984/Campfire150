<?php 

$config["debugMode"] = true;

$config['base_url'] = array("http://localhost:8084/CampFire150/"); // Base URL including trailing slash (e.g. http://localhost/)
$config['request_url'] = sprintf(
					    "%s://%s:8084%s/",
					    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
					    $_SERVER['SERVER_NAME'],
					    $_SERVER['REQUEST_URI']
					  );


$config['default_controller'] = 'home'; // Default controller to load
$config['error_controller'] = 'error'; // Controller used for errors (e.g. 404, 500 etc)

/* Connect to an ODBC database using driver invocation */
$config['db_dsn'] = 'mysql:dbname=wwwcoiox_campfire;localhost';
$config['db_username'] = 'wwwcoiox_campfir'; // Database username
$config['db_password'] = 'Ep8qNRvHWUV4NXSu'; // Database password

?>