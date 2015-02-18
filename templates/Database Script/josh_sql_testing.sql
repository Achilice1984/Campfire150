SELECT count(*) FROM story, admin_approve_story WHERE story.User_UserId = 1 AND admin_approve_story.Approved = TRUE
SELECT count(*) FROM story, admin_approve_story WHERE story.User_UserId = 1 AND admin_approve_story.Approved = FALSE
SELECT admin_approve_story.Approved, story.StoryId FROM story, admin_approve_story WHERE story.User_UserId = 1 AND admin_approve_story.Approved = TRUE

SELECT user.UserId FROM user,following WHERE following.User_UserId = 1


SELECT DISTINCT following.User_FollowerId 
FROM following 
WHERE following.User_UserId = 1 AND following.Active = TRUE

SELECT * FROM story WHERE story.User_UserId IN (SELECT DISTINCT following.User_FollowerId 
FROM following 
WHERE following.User_UserId = 1 AND following.Active = TRUE)


SELECT story.*, COUNT(user_recommend_story.Opinion) AS recommendation_count
FROM story LEFT JOIN user_recommend_story 
ON story.User_UserId = user_recommend_story.User_UserId
WHERE story.User_UserId IN 
(SELECT DISTINCT following.User_FollowerId 
FROM following 
WHERE following.User_UserId = 1 AND following.Active = TRUE)
GROUP BY story.User_UserId
ORDER BY recommendation_count


-- Query to get all stories recommended by friends in order of popularity

SELECT story.*, COUNT(user_recommend_story.Opinion) AS recommendation_count
FROM story LEFT JOIN user_recommend_story 
ON story.StoryId = user_recommend_story.Story_StoryId

WHERE story.User_UserId IN 
(SELECT DISTINCT following.User_FollowerId 
FROM following 
WHERE following.User_UserId = 1 AND following.Active = TRUE)
AND user_recommend_story.Opinion = TRUE
--AND story.Published = TRUE

GROUP BY story.StoryId
ORDER BY recommendation_count DESC

-- Query to get all stories recommended by friends in order of date

SELECT story.*, user_recommend_story.LatestChange
FROM story LEFT JOIN user_recommend_story 
ON story.StoryId = user_recommend_story.Story_StoryId

WHERE story.User_UserId IN 
(SELECT DISTINCT following.User_FollowerId 
FROM following 
WHERE following.User_UserId = 1 AND following.Active = TRUE)
AND user_recommend_story.Opinion = TRUE
--AND story.Published = TRUE

GROUP BY story.StoryId
ORDER BY user_recommend_story.LatestChange DESC


-- Query to get all stories recommended by current user in order of date recommended

SELECT story.*
FROM story LEFT JOIN user_recommend_story 
ON story.StoryId = user_recommend_story.Story_StoryId

WHERE user_recommend_story.User_UserId = 1
AND user_recommend_story.Opinion = TRUE

GROUP BY story.StoryId
ORDER BY user_recommend_story.LatestChange DESC

