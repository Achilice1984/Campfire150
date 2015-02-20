<?php

/***************************************************************************
*
* The model in the model, view, controller design patter.
*
* The model is what deals directly with the applications data, the database.
*
*****************************************************************************/

class Model {

	//Use static connection to have one connection per request
	private static $connection;
	
	public function __construct()
	{
		global $config;

		try 
		{
			//Check if a connection exists
			if(!isset(self::$connection))
			{
		    	self::$connection = new PDO($config['db_dsn'], $config['db_username'], $config['db_password']);

		    	if($config["debugMode"] == true)
				{
		    		self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    		}
		    }
		} 
		catch (PDOException $e) 
		{
		    echo 'Connection failed: ' . $e->getMessage();
		}
	}

 	// This function allows you to retrieve the last inserted id in the database
 	// Example:
 	//		You insert a new user into the database but need the new id to insert some more data
 	//		You can call this function after you insert that user to get the new id for this new user
	public function lastInsertId()
	{
		return self::$connection->lastInsertId();
	}

	// Returns an array of the specified class 
	// These objects will be filled with data from the database
	// PDO maps this data based on the name of the classes properties
	// Example: 
	//      User table in the database contains UserID
	//		UserViewModel contains UserID as a property
	// PDO will map this to the class because the names match
	public function fetchIntoClass($qry, $params=array(), $className)
	{		
		//Example array: array(':calories' => $calories, ':colour' => $colour)
		//Or by order array($calories, $colour)
		try 
		{
			require_once(APP_DIR .'viewmodels/' . $className .'.php');			 

			 $pdo = self::$connection->prepare($qry);
			 $pdo->execute($params);

			 $urlArray = explode("/", $className);

			if(count($urlArray) > 1)
			{
				$className = $urlArray[count($urlArray) - 1];
			}

			//Fetches data and adds it to the specified class
			return $pdo->fetchAll(PDO::FETCH_CLASS, $className);
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	// This function will return a generic object with the data selected from the database
	public function fetchIntoObject($qry, $params=array())
	{
		//Example array: array(':calories' => $calories, ':colour' => $colour)
		//Or by order array($calories, $colour)
		try 
		{
			$pdo = self::$connection->prepare($qry);
			$pdo->execute($params);

			//Fetches data and puts it into object form
			return $pdo->fetchAll(PDO::FETCH_OBJ);
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	// This function will return the number of rows affected by the query
	// Example:
	//		If you execute an update statment that changes two users in the database,
	//		The rows affected will be ( 2 ) 
	public function fetchRowCount($qry, $params=array()){
		//Example array: array(':calories' => $calories, ':colour' => $colour)
		//Or by order array($calories, $colour)
		try 
		{
			$pdo = self::$connection->prepare($qry);
			$pdo->execute($params);

			return $pdo->rowCount();
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	// This function will return columns of data from the database
	public function fetchColumn($qry, $params=array()){
		//Example array: array(':calories' => $calories, ':colour' => $colour)
		//Or by order array($calories, $colour)
		try 
		{
			$pdo = self::$connection->prepare($qry);
			$pdo->execute($params);

			return $pdo->fetchColumn();
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	// This function will return a number
	// Example:
	//		SELECT count(*) FROM story
	//		This will return the count of how many stories there are in the database
	public function fetchNum($qry, $params=array())
	{
		//Example array: array(':calories' => $calories, ':colour' => $colour)
		//Or by order array($calories, $colour)
		try 
		{
			$pdo = self::$connection->prepare($qry);
			$pdo->execute($params);

			//Fetches data and puts it into object form
			$row = $pdo->fetch(PDO::FETCH_NUM);

			if(isset($row[0]))
			{
				return $row[0];
			}

			return 0;
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	// This function will return a bool based on whether the query was executed successfuly or not
	public function fetch($qry, $params=array()){
		//Example array: array(':calories' => $calories, ':colour' => $colour)
		//Or by order array($calories, $colour)
		try 
		{
			$pdo = self::$connection->prepare($qry);		

			return $pdo->execute($params);
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	public function getStartValue($howMany, $page)
	{
		if (!isset($howMany)) {
			$howMany = 1;
		}
		if (!isset($page)) {
			$page = 1;
		}

		return $howMany * (($page == 0 ? 1 : $page) - 1);
	}

	public function escapeString($string)
	{
		return mysql_real_escape_string($string);
	}

	public function escapeArray($array)
	{
	    array_walk_recursive($array, create_function('&$v', '$v = mysql_real_escape_string($v);'));
		return $array;
	}
	
	public function to_bool($val)
	{
	    return !!$val;
	}
	
	public function to_date($val)
	{
	    return date('Y-m-d', $val);
	}
	
	public function to_time($val)
	{
	    return date('H:i:s', $val);
	}
	
	public function to_datetime($val)
	{
	    return date('Y-m-d H:i:s', $val);
	}

}
?>
