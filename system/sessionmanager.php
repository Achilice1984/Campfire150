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

	public function IsTimedOut()
	{
		if(isset($_SESSION['timeout']))
		{
			if ($_SESSION['timeout'] < time()) {
				//Timed out, kick them out.
		     	session_destroy();

		     	ob_start();
				header('Location: '. BASE_URL . "account/login");
				exit;
		  	} 
		  	else {
			     // session ok

		  		if(!isset($_SESSION['remember']) || $_SESSION['remember'] != TRUE)
		  		{
		  			$_SESSION['timeout'] = time() + (SESSION_EXP_MINUTES * 60);
		  		}

		  		return TRUE;
		  	}
	  	}
	}

	public function setUserSessions($user, $rememberMe)
	{
		$_SESSION['lastAccess'] = time();

		if(isset($rememberMe))
		{
			$_SESSION['timeout'] = time()+ (24*60*60 * REMEMBER_ME_DAYS);
			$_SESSION['remember'] = TRUE;
		}
		else
		{
			$_SESSION['timeout'] = time() + (SESSION_EXP_MINUTES * 60);
		}

		//Authentication
		$_SESSION["isAuth"]  	= true;
		$_SESSION["isAdmin"] 	= $user->AdminFlag;

		//User Details
		$_SESSION["UserId"] 	= $user->UserId;
		$_SESSION["Email"] 		= $user->Email;
		$_SESSION["FirstName"] 	= $user->FirstName;
		$_SESSION["LastName"] 	= $user->LastName;
		$_SESSION["MidName"] 	= $user->MidName;
		$_SESSION["Address"]    = $user->Address;
		$_SESSION["PostalCode"] = $user->PostalCode;

		$_SESSION["LanguageType_LanguageId"] = $user->LanguageType_LanguageId;

		$this->setLanguageSession($user->LanguageType_LanguageId);
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

	public function setLanguagePrefernece()
	{
		if(!isset($_SESSION["languagePreference"]))
		{
			$language = $_SESSION["languagePreference"] = "en_CA";
		}
		else
		{
			$language = $_SESSION["languagePreference"];
		}

		return $language;
	}

	public function getUserSession()
	{
		require_once(APP_DIR .'viewmodels/shared/UserViewModel.php');

		$user = new UserViewModel();

		try
		{
			//If you are authenticated setup session variable
			if(isset($_SESSION["isAuth"]))
			{	
				//User Details
				$user->UserId 	  = $_SESSION["UserId"];
				$user->Email 	  = $_SESSION["Email"];
				$user->FirstName  = $_SESSION["FirstName"];
				$user->LastName   = $_SESSION["LastName"];
				$user->MidName    = $_SESSION["MidName"];
				$user->Address    = $_SESSION["Address"];
				$user->PostalCode = $_SESSION["PostalCode"];
				$user->IsAdmin = $_SESSION["isAdmin"];
				$user->IsAuth = $_SESSION["isAuth"];
			}

			//This must be accessible even if user is not logged in
			$user->LanguagePreference = $_SESSION["languagePreference"];
		}
		catch (Exception $e)
		{
			session_destroy();
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

	public function setErrorMessages($validationMessages)
	{
		if(!isset($_SESSION["errorMessages"]))
		{
			$_SESSION["errorMessages"] = array();			
		}

		$_SESSION["errorMessages"] = $validationMessages;
	}

	public function addErrorMessages($key, $errorMessage, $persistCount)
	{
		if(!isset($_SESSION["errorMessages"]))
		{
			$_SESSION["errorMessages"] = array();			
		}
		
		$_SESSION["errorMessages"]["other"][$key] = $errorMessage;	

		$_SESSION["errorMessages_persistCount"] = $persistCount;
	}

	public function setPersistCount_Errors($persistCount)
	{
		$_SESSION["errorMessages_persistCount"] = $persistCount;
	}

	public function addSuccessMessages($key, $successMessage, $persistCount)
	{
		if(!isset($_SESSION["successMessages"]))
		{
			$_SESSION["successMessages"] = array();			
		}
		
		$_SESSION["successMessages"]["other"][$key] = $successMessage;	

		$_SESSION["successMessages_persistCount"] = $persistCount;
	}

	public function addInfoMessages($key, $successMessage, $persistCount)
	{
		if(!isset($_SESSION["infoMessages"]))
		{
			$_SESSION["infoMessages"] = array();			
		}
		
		$_SESSION["infoMessages"]["other"][$key] = $successMessage;	

		$_SESSION["infoMessages_persistCount"] = $persistCount;
	}
}
?>