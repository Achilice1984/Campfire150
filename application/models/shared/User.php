<?php
/**
* 
*/
class User extends Model
{
	


	function __construct()
	{
		parent::__construct(array());
	}

	

	// may be it is not proper to define this function here

	function userSelectById($userId)
	{
		$stmt = "SELECT * FROM User WHERE UserId=:userId";

		$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

		$user = parent::query($stmt);

		return $user[0];
	}

	function userDeleteById($userId)
	{
		$stmt = "DELETE FROM User WHERE UserId=:userId";

		$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

		$this->execute($stmt);
	}
}
?>