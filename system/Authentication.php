<?php
/**
* 
*/
class Authentication
{
	public function isAuthenticated()
	{
		$sessionManger = new SessionManager();

		return $sessionManger->isAuthenticated();
	}

	public function isAdmin()
	{
		$sessionManger = new SessionManager();

		return $sessionManger->isAdmin();
	}

	public function authenticate($loginPassword, $user)
	{
		$isAuthenticated = password_verify($loginPassword, $user->Password);
		//If you are authenticated setup session variable
		if($isAuthenticated)
		{
			$sessionManger = new SessionManager();

			$sessionManger->setUserSessions($user);
		}

		return $isAuthenticated;
	}

	public function verifyPassword($loginPassword, $dbPassword)
	{
		return password_verify($loginPassword, $dbPassword);
	}

	public function getUser()
	{		
		$sessionManger = new SessionManager();

		$user = $sessionManger->setUserSessions($user);

		return $user;
	}

	public function isEng()
	{
		$sessionManger = new SessionManager();

		return $sessionManger->isEng();	
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