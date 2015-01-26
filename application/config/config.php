<?php 

$config['base_url'] = 'http://localhost:8084/CampFire150/'; // Base URL including trailing slash (e.g. http://localhost/)

$config['default_controller'] = 'home'; // Default controller to load
$config['error_controller'] = 'error'; // Controller used for errors (e.g. 404, 500 etc)

/* Connect to an ODBC database using driver invocation */
$config['db_dsn'] = 'mysql:dbname=CampFire;localhost';
$config['db_username'] = 'CampFire'; // Database username
$config['db_password'] = 'CampFire150'; // Database password


/*
*	Kept for historical purposes, to connect to mysql
*/
// $config['db_host'] = 'localhost'; // Database host (e.g. localhost)
// $config['db_name'] = 'CampFire'; // Database name
// $config['db_username'] = 'CampFire'; // Database username
// $config['db_password'] = 'CampFire150'; // Database password

?>