<?php
/**
* 
*/
class HomeModel extends Model
{
	function totalPublishedStories()
	{
		try
		{

			$statement = "SELECT COUNT(1)

						FROM story s

						INNER JOIN user u
						ON (u.UserId = s.User_UserId) AND (u.Active = TRUE)
						LEFT JOIN admin_approve_story aps
						ON (aps.Story_StoryId = s.StoryId) AND (aps.Active = TRUE)

						WHERE StoryPrivacyType_StoryPrivacyTypeId = 1
						AND s.Active = TRUE
						AND u.ProfilePrivacyType_PrivacyTypeId = 1
						AND aps.Active = TRUE
						AND aps.Approved = TRUE
						AND u.Active = TRUE
						AND u.VerifiedEmail = TRUE";

			return $this->fetchNum($statement, array());		
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	function totalActiveUsers()
	{
		try
		{

			$statement = "SELECT COUNT(1)
							FROM user u
							WHERE u.ProfilePrivacyType_PrivacyTypeId = 1
							AND u.Active = TRUE
							AND u.VerifiedEmail = TRUE";

			return $this->fetchNum($statement, array());		
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	function totalPublishedComments()
	{
		try
		{

			$statement = "SELECT COUNT(1)
							FROM comment c
							WHERE c.PublishFlag = TRUE
							AND c.Active = TRUE";

			return $this->fetchNum($statement, array());		
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	function totalRecommendations()
	{
		try
		{

			$statement = "SELECT COUNT(1)
							FROM user_recommend_story urs
							WHERE urs.Opinion = TRUE
							AND urs.Active = TRUE";

			return $this->fetchNum($statement, array());		
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}
}
?>