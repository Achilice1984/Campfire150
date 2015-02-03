<?php
/**
* 
*/
class Authentication
{
	public function isAuthenticated()
	{
		if(isset($_SESSION["isAuth"]))
		{
			return $_SESSION["isAuth"];
		}
		else
		{
			return false;
		}
	}

	public function isAdmin()
	{
		if(isset($_SESSION["isAdmin"]))
		{
			return $_SESSION["isAdmin"];
		}
		else
		{
			return false;
		}
	}

	public function authenticate($password, $hashedPasswordFromDatabase, $isAdmin)
	{
		$isAuthenticated = password_verify($password, $hash);

		$_SESSION["isAuth"]  = $isAuthenticated;
		$_SESSION["isAdmin"] = $isAdmin;

		return $isAuthenticated;
	}

	public function hashPassword($password)
	{
		/**
		 * We just want to hash our password using the current DEFAULT algorithm.
		 * This is presently BCRYPT, and will produce a 60 character result.
		 *
		 * Beware that DEFAULT may change over time, so you would want to prepare
		 * By allowing your storage to expand past 60 characters (255 would be good)
		 */
		return password_hash($password, PASSWORD_DEFAULT);
	}

}
?>