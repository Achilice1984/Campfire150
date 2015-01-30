<?php
/**
* 
*/
class Story extends Model
{
	public $PictureId;
	public $User_UserId;
	public $Title;
	public $Description;
	public $FileName;

	function __construct()
	{
		parent::__construct(array());
	}

	function pictureUpdate($pictureId, $user_UserId, $title, $description, $fileName)
	{

		$stmt = $this->connection->prepare("UPDATE Picture SET User_UserId=:user_UserId,Title=:title,
		Description=$description,FileName=$fileName	WHERE PictureId=:pictureId");

		$stmt->bindParam(':user_UserId', $user_UserId, PDO::INT);
		$stmt->bindParam(':title', $title, PDO::INT);
		$stmt->bindParam(':description', $description, PDO::PARAM_STR);
		$stmt->bindParam(':fileName', $fileName, PDO::PARAM_STR);
		$stmt->bindParam(':pictureId', $pictureId, PDO::PARAM_INT);

		$this->execute($stmt);
	}

	// may be it is not proper to define this function here

	function pictureSelectById($pictureId)
	{
		$stmt = "SELECT * FROM Picture WHERE PictureId=:pictureId"

		$stmt->bindParam(':pictureId', $pictureId, PDO::PARAM_INT);

		$picture = parent::query($stmt);

		return $story[0];
	}

	function pictureDeleteById($pictureId)
	{
		$stmt = "DELETE FROM Story WHERE PictureId=:pictureId";

		$stmt->bindParam(':pictureId', $pictureId, PDO::PARAM_INT);

		$this->execute($stmt);
	}
}
?>