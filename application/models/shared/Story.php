<?php
/**
* 
*/
class Story extends Model
{
	public $StoryId;
	public $DatePosted;
	public $User_UserId;
	public $StoryTitle;
	public $Content;
	public $PrivacyType_PrivacyTypeId;
	public $Active;
	public $LatestChange;


	function __construct()
	{
		parent::__construct(array());
	}

	function storyUpdate($storyId, $user_UserId, $picture_PictureId, $datePosted, $storyTitle, $content, $inappropiateFlag_IsAppropriateFlag, $privacyType_PrivacyTypeId)
	{

		$stmt = $this->connection->prepare("UPDATE Story SET UserId=:userId,Picture_PictureId=:picture_PictureId,DatePosted=:datePosted,
		StoryTitle=$storyTitle,Content=$content,InappropiateFlag_IsAppropriateFlag=$inappropiateFlag_IsAppropriateFlag,PrivacyType_PrivacyTypeId=:privacyType_PrivacyTypeId
		WHERE StoryId=:storyId");

		$stmt->bindParam(':userId', $userId, PDO::INT);
		$stmt->bindParam(':picture_PictureId', $picture_PictureId, PDO::INT);
		$stmt->bindParam(':datePosted', $datePosted, PDO::PARAM_STR);
		$stmt->bindParam(':storyTitle', $storyTitle, PDO::PARAM_STR);
		$stmt->bindParam(':content', $content, PDO::PARAM_STR);
		$stmt->bindParam(':inappropiateFlag_IsAppropriateFlag', $inappropiateFlag_IsAppropriateFlag, PDO::PARAM_STR);
		$stmt->bindParam(':privacyType_PrivacyTypeId', $privacyType_PrivacyTypeId, PDO::PARAM_INT);
		$stmt->bindParam(':storyId', $storyId, PDO::PARAM_INT);


		parent::execute($stmt);
	}

	// may be it is not proper to define this function here

	function storySelectById($storyId)
	{
		$stmt = "SELECT * FROM User WHERE StoryId=:storyId"

		$stmt->bindParam(':storyId', $storyId, PDO::PARAM_INT);

		$story = $this->query($stmt);

		return $story[0];
	}

	function storyDeleteById($userId)
	{
		$stmt = "DELETE FROM Story WHERE StoryId=:storyId";

		$stmt->bindParam(':storyId', $storyId, PDO::PARAM_INT);

		$this->execute($stmt);
	}
}
?>