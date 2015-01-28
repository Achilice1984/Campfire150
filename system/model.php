<?php

/***************************************************************************
*
* The model in the model, view, controller design patter.
*
* The model is what deals directly with the applications data, the database.
*
*****************************************************************************/

class Model {

	private $connection;//This is more of a handler now
	private $validationResult;
	private $validationDecorators;

	public function __construct($validationDecorators)
	{
		global $config;

		$this->validationDecorators = $validationDecorators;

		/************
		*	Hey yougen, this is an example of how to change this to work for PDO
		*************/
		// $this->connection = mysql_pconnect($config['db_host'], $config['db_username'], $config['db_password']) or die('MySQL Error: '. mysql_error());
		// mysql_select_db($config['db_name'], $this->connection);


		try {
		    $this->connection = new PDO($config['db_dsn'], $config['db_username'], $config['db_password']);
		} catch (PDOException $e) {
		    echo 'Connection failed: ' . $e->getMessage();
		}
	}

	public function validate()
	{
		$validator = new Validator();
		$this->validationResult = $validator->validate($this);
	}

	public function getValidationResult()
	{
		return $this->validationResult;
	}

	public function getValidationDecorators()
	{
		return $this->validationDecorators;
	}

	public function getValidationAttribute($propertyName)
	{
		$dataAttributes = " ";

		if(isset($this->validationDecorators[$propertyName]))
		{
			foreach ($this->validationDecorators[$propertyName] as $validationType => $errorMessage) {
				$dataAttributes .= "data-validate-" . $validationType . "=\"" . $errorMessage . "\" ";
			}
		}

		return $dataAttributes;
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
/*	
	public function query($qry)
	{
		$result = mysql_query($qry) or die('MySQL Error: '. mysql_error());
		$resultObjects = array();

		while($row = mysql_fetch_object($result)) $resultObjects[] = $row;

		return $resultObjects;
	}

	public function execute($qry)
	{
		$exec = mysql_query($qry) or die('MySQL Error: '. mysql_error());
		return $exec;
	}

	public function dblink()
	{
		try {
		    $this->connection = new PDO($config['db_dsn'], $config['db_username'], $config['db_password']);
		} catch (PDOException $e) {
		    echo 'Connection failed: ' . $e->getMessage();
		}
	}
 */

	public function query($qry)
	{
//		dblink();

		try
		{
			$result = $this->connection->query($qry) or die('MySQL Error: '. mysql_error());
			$resultObjects = array();
			$rowNum = 0;

			while($row = $result->fetchObject($this))
			{
				$resultObjects[$rowNum] = $row;
				$rowNum++;
			}

			return $resultObjects;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function execute($qry)
	{
		try
		{
			$result = $this->connection->exec($qry) or die('MySQL Error: '. mysql_error());

			return $result;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

}
?>
