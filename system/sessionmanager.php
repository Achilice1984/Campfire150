<?php
/**
* 
*/
class SessionManager
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

	public function setUserSessions($user)
	{
		//Authentication
		$_SESSION["isAuth"]  	= $isAuthenticated;
		$_SESSION["isAdmin"] 	= $user->IsAdmin;

		//User Details
		$_SESSION["UserId"] 	= $user->UserId;
		$_SESSION["Email"] 		= $user->Email;
		$_SESSION["FirstName"] 	= $user->FirstName;
		$_SESSION["LastName"] 	= $user->LastName;
		$_SESSION["MidName"] 	= $user->MidName;
		$_SESSION["Address"]    = $user->Address;
		$_SESSION["PostalCode"] = $user->PostalCode;		
	}

	public function setLanguageSession($languageId)
	{
		if($languageId == 1)
		{
			$language = "en_CA";
		}
		else
		{
			$language = "fr_CA";
		}

		$_SESSION["languagePreference"] = $language;
		T_setlocale(LC_MESSAGES, $language);
	}

	public function getUserSession()
	{
		require_once(APP_DIR .'viewmodels/User.php');

		$user = null;

		//If you are authenticated setup session variable
		if(isset($_SESSION["isAuth"]))
		{
			$user = new User();

			//User Details
			$user->UserId 	  = $_SESSION["UserId"];
			$user->Email 	  = $_SESSION["Email"];
			$user->FirstName  = $_SESSION["FirstName"];
			$user->LastName   = $_SESSION["LastName"];
			$user->MidName    = $_SESSION["MidName"];
			$user->Address    = $_SESSION["Address"];
			$user->PostalCode = $_SESSION["PostalCode"];

			$user->LanguagePreference = $_SESSION["languagePreference"];
		}

		return $user;
	}

	public function isEng()
	{
		if(isset($_SESSION["languagePreference"]))
		{
			if($_SESSION["languagePreference"] == "fr_CA")
			{
				return false;
			}
		}

		return true;
	}
}
?>