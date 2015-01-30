<?php
/**
* 
*/
class User extends Model
{
	public $UserId;
	public $Email;
	public $Password;
	public $RegisterDate;
	public $Address;
	public $PostalCode;
	public $Notes;
	public $AchievementLevelType_LevelId;
	public $FirstName;
	public $MidName;
	public $LastName;
	public $LanguageType_LanguageId;


	function __construct()
	{
		parent::__construct(array());
	}

	function userUpdate($userId, $email, $password, $registerDate, $address, $postalCode, $notes, 
		$achievementLevelType_LevelId, $firstName, $midName, $lastName, $languageType_LanguageId)
	{

		$stmt = $this->connection->prepare("UPDATE User SET Email=:email,Password=:password,RegisterDate=:registerDate,Address=:address,
		PostalCode=$postalCode,Notes=$notes,AchievementLevelType_LevelId=$achievementLevelType_LevelId,
		FirstName=:firstName,MidName=:midName,LastName=:lastName,LanguageType_LanguageId=:languageType_LanguageId
		WHERE UserId=:userId");

		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->bindParam(':password', $password, PDO::PARAM_STR);
		$stmt->bindParam(':registerDate', $registerDate, PDO::PARAM_STR);
		$stmt->bindParam(':address', $address, PDO::PARAM_STR);
		$stmt->bindParam(':postalCode', $postalCode, PDO::PARAM_STR);
		$stmt->bindParam(':notes', $notes, PDO::PARAM_STR);
		$stmt->bindParam(':achievementLevelType_LevelId', $achievementLevelType_LevelId, PDO::PARAM_INT);
		$stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
		$stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
		$stmt->bindParam(':midName', $midName, PDO::PARAM_STR);
		$stmt->bindParam(':languageType_LanguageId', $languageType_LanguageId, PDO::PARAM_STR);
		$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);


		$this->execute($stmt);
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