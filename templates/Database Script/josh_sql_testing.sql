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

LIMIT 0, 50 
WHERE MATCH(FirstName, LastName, Email, MidName) AGAINST('josh') 



SELECT *,((Lower(StoryTitle) LIKE '%:sTitle%')) AS hits
FROM story s
INNER JOIN story_has_tag sht
ON sht.Story_StoryId = s.StoryId
INNER JOIN tag t
ON t.TagId = sht.Tag_TagId
HAVING hits > 0
ORDER BY hits DESC



SELECT *,
((Lower(s.StoryTitle) LIKE '%art%') + 
 (Lower(t.Tag) LIKE '%art%')) AS hits
FROM story s

INNER JOIN story_has_tag sht
ON (sht.Story_StoryId = s.StoryId) AND (sht.Active = TRUE)
INNER JOIN tag t
ON (t.TagId = sht.Tag_TagId) AND (t.Active = TRUE)
INNER JOIN user u
ON (u.UserId = s.User_UserId) AND (u.Active = TRUE)
INNER JOIN admin_approve_story aps
ON (aps.Story_StoryId = s.StoryId) AND (aps.Active = TRUE)

LEFT JOIN user_recommend_story urs
ON (urs.Story_StoryId = s.StoryId) AND (urs.User_UserId = 1) AND (urs.Active = TRUE)

INNER JOIN story_has_picture shp
ON (shp.Story_StoryId = s.StoryId) AND (shp.Active = TRUE)
INNER JOIN picture p
ON (p.PictureId = shp.PictureId) AND (p.Active = TRUE)

WHERE StoryPrivacyType_StoryPrivacyTypeId = 1
HAVING hits > 0
ORDER BY hits DESC
LIMIT 0,10









SELECT 

s.StoryId, s.User_UserId, s.StoryPrivacyType_StoryPrivacyTypeId, s.StoryTitle, s.Content, s.Active, s.DatePosted, 

sht.Story_StoryId, sht.Tag_TagId, sht.Active,

t.TagId, t.Tag, t.Active,

urs.User_UserId, urs.Story_StoryId, urs.Active, urs.Opinion,

aps.User_UserId, aps.Story_StoryId, aps.Active, aps.Approved,

shp.Story_StoryId, shp.PictureId, shp.Active,

p.PictureId, p.User_UserId, p.FileName, p.PictureExtension, p.Active,

u.UserId, u.Active, u.FirstName, u.LastName, u.ProfilePrivacyType_PrivacyTypeId,

(SELECT COUNT(1)
	FROM story_has_tag sht
	INNER JOIN tag t
	ON t.TagId = sht.Tag_TagId
	WHERE Lower(t.Tag) LIKE '%tec%'
	AND sht.Story_StoryId = s.StoryId
	) AS hits

((Lower(s.StoryTitle) LIKE '%tec%') + 
 (Lower(t.Tag) LIKE '%tec%')) AS hits
 
FROM story s

INNER JOIN story_has_tag sht
ON (sht.Story_StoryId = s.StoryId) AND (sht.Active = TRUE)
INNER JOIN tag t
ON (t.TagId = sht.Tag_TagId) AND (t.Active = TRUE)
INNER JOIN user u
ON (u.UserId = s.User_UserId) AND (u.Active = TRUE)
INNER JOIN admin_approve_story aps
ON (aps.Story_StoryId = s.StoryId) AND (aps.Active = TRUE)

LEFT JOIN user_recommend_story urs
ON (urs.Story_StoryId = s.StoryId) AND (urs.User_UserId = 1) AND (urs.Active = TRUE)

INNER JOIN story_has_picture shp
ON (shp.Story_StoryId = s.StoryId) AND (shp.Active = TRUE)
INNER JOIN picture p
ON (p.PictureId = shp.PictureId) AND (p.Active = TRUE)

WHERE StoryPrivacyType_StoryPrivacyTypeId = 1
AND s.Active = TRUE
AND aps.Active = TRUE
AND aps.Approved = TRUE
HAVING hits > 0
ORDER BY hits DESC
LIMIT 0,10




SELECT 

s.StoryId, s.User_UserId, s.StoryPrivacyType_StoryPrivacyTypeId, s.StoryTitle, s.Content, s.Active, s.DatePosted, 

urs.User_UserId, urs.Story_StoryId, urs.Active, urs.Opinion,

aps.User_UserId, aps.Story_StoryId, aps.Active, aps.Approved,

shp.Story_StoryId, shp.PictureId, shp.Active,

p.PictureId, p.User_UserId, p.FileName, p.PictureExtension, p.Active,

u.UserId, u.Active, u.FirstName, u.LastName, u.ProfilePrivacyType_PrivacyTypeId,

(SELECT COUNT(1)
	FROM story_has_tag sht
	INNER JOIN tag t
	ON t.TagId = sht.Tag_TagId
	WHERE Lower(t.Tag) LIKE '%t%'
	AND sht.Story_StoryId = s.StoryId
	) AS hits
 
FROM story s


INNER JOIN user u
ON (u.UserId = s.User_UserId) AND (u.Active = TRUE)
INNER JOIN admin_approve_story aps
ON (aps.Story_StoryId = s.StoryId) AND (aps.Active = TRUE)

LEFT JOIN user_recommend_story urs
ON (urs.Story_StoryId = s.StoryId) AND (urs.User_UserId = 1) AND (urs.Active = TRUE)

INNER JOIN story_has_picture shp
ON (shp.Story_StoryId = s.StoryId) AND (shp.Active = TRUE)
INNER JOIN picture p
ON (p.PictureId = shp.PictureId) AND (p.Active = TRUE)

WHERE StoryPrivacyType_StoryPrivacyTypeId = 1
AND s.Active = TRUE
AND aps.Active = TRUE
AND aps.Approved = TRUE
HAVING hits > 0
ORDER BY hits DESC
LIMIT 0,10





SELECT 

s.StoryId, s.User_UserId, s.StoryPrivacyType_StoryPrivacyTypeId, s.StoryTitle, s.Content, s.Active, s.DatePosted, 

urs.User_UserId, urs.Story_StoryId, urs.Active, urs.Opinion,

aps.User_UserId, aps.Story_StoryId, aps.Active, aps.Approved,

shp.Story_StoryId, shp.PictureId, shp.Active,

p.PictureId, p.User_UserId, p.FileName, p.PictureExtension, p.Active,

u.UserId, u.Active, u.FirstName, u.LastName, u.ProfilePrivacyType_PrivacyTypeId,

(
    (SELECT COUNT(1)
        FROM story_has_tag sht
        INNER JOIN tag t
        ON t.TagId = sht.Tag_TagId
        WHERE Lower(t.Tag) LIKE '%technolog%'
        AND sht.Story_StoryId = s.StoryId
        )
    +
    ((SELECT COUNT(1)
        FROM story_has_tag sht
        INNER JOIN tag t
        ON t.TagId = sht.Tag_TagId
        WHERE Lower(t.Tag) LIKE 'technolog'
        AND sht.Story_StoryId = s.StoryId
	) * 2)
    +
    (Lower(s.StoryTitle) LIKE '%d%')
)
    
AS hits
 
FROM story s


INNER JOIN user u
ON (u.UserId = s.User_UserId) AND (u.Active = TRUE)
INNER JOIN admin_approve_story aps
ON (aps.Story_StoryId = s.StoryId) AND (aps.Active = TRUE)

LEFT JOIN user_recommend_story urs
ON (urs.Story_StoryId = s.StoryId) AND (urs.User_UserId = 1) AND (urs.Active = TRUE)

INNER JOIN story_has_picture shp
ON (shp.Story_StoryId = s.StoryId) AND (shp.Active = TRUE)
INNER JOIN picture p
ON (p.PictureId = shp.PictureId) AND (p.Active = TRUE)

WHERE StoryPrivacyType_StoryPrivacyTypeId = 1
AND s.Active = TRUE
AND aps.Active = TRUE
AND aps.Approved = TRUE
HAVING hits > 0
ORDER BY hits DESC
LIMIT 0,10











SELECT 

s.StoryId, s.User_UserId, s.StoryPrivacyType_StoryPrivacyTypeId, s.StoryTitle, s.Content, s.Active, s.DatePosted, 

urs.User_UserId, urs.Story_StoryId, urs.Active, urs.Opinion,

aps.User_UserId, aps.Story_StoryId, aps.Active, aps.Approved,

shp.Story_StoryId, shp.PictureId, shp.Active,

p.PictureId, p.User_UserId, p.FileName, p.PictureExtension, p.Active,

u.UserId, u.Active, u.FirstName, u.LastName, u.ProfilePrivacyType_PrivacyTypeId,

(
    (SELECT COUNT(1)
        FROM story_has_tag sht
        INNER JOIN tag t
        ON t.TagId = sht.Tag_TagId
        WHERE Lower(t.Tag) LIKE '%t%'
        AND sht.Story_StoryId = s.StoryId
        )
    +
    ((SELECT COUNT(1)
        FROM story_has_tag sht
        INNER JOIN tag t
        ON t.TagId = sht.Tag_TagId
        WHERE Lower(t.Tag) LIKE 't'
        AND sht.Story_StoryId = s.StoryId
	) * 2)
    +
    (Lower(s.StoryTitle) LIKE '%t%')
)
    
AS hits
 
FROM story s


INNER JOIN user u
ON (u.UserId = s.User_UserId) AND (u.Active = TRUE)
INNER JOIN admin_approve_story aps
ON (aps.Story_StoryId = s.StoryId) AND (aps.Active = TRUE)

LEFT JOIN user_recommend_story urs
ON (urs.Story_StoryId = s.StoryId) AND (urs.User_UserId = 1) AND (urs.Active = TRUE)

INNER JOIN story_has_picture shp
ON (shp.Story_StoryId = s.StoryId) AND (shp.Active = TRUE)
INNER JOIN picture p
ON (p.PictureId = shp.PictureId) AND (p.Active = TRUE)

WHERE StoryPrivacyType_StoryPrivacyTypeId = 1
AND s.Active = TRUE
AND aps.Active = TRUE
AND aps.Approved = TRUE
HAVING hits > 0
ORDER BY hits DESC
LIMIT 0,10




SELECT 

s.StoryId, s.User_UserId, s.StoryPrivacyType_StoryPrivacyTypeId, s.StoryTitle, s.Content, s.Active, s.DatePosted, 

urs.User_UserId, urs.Story_StoryId, urs.Active, urs.Opinion,

aps.User_UserId, aps.Story_StoryId, aps.Active, aps.Approved,

shp.Story_StoryId, shp.PictureId, shp.Active,

p.PictureId, p.User_UserId, p.FileName, p.PictureExtension, p.Active,

u.UserId, u.Active, u.FirstName, u.LastName, u.ProfilePrivacyType_PrivacyTypeId,

(
    (SELECT COUNT(1)
        FROM story_has_tag sht
        INNER JOIN tag t
        ON t.TagId = sht.Tag_TagId
        WHERE Lower(t.Tag) LIKE '%egestas%'
        AND sht.Story_StoryId = s.StoryId
        )
    +
    ((SELECT COUNT(1)
        FROM story_has_tag sht
        INNER JOIN tag t
        ON t.TagId = sht.Tag_TagId
        WHERE Lower(t.Tag) LIKE 'egestas'
        AND sht.Story_StoryId = s.StoryId
	) * 2)
    +
    (Lower(s.StoryTitle) LIKE '%egestas%')
)
    
AS hits
 
FROM story s


INNER JOIN user u
ON (u.UserId = s.User_UserId) AND (u.Active = TRUE)
INNER JOIN admin_approve_story aps
ON (aps.Story_StoryId = s.StoryId) AND (aps.Active = TRUE)

LEFT JOIN user_recommend_story urs
ON (urs.Story_StoryId = s.StoryId) AND (urs.User_UserId = 1) AND (urs.Active = TRUE)

LEFT JOIN story_has_picture shp
ON (shp.Story_StoryId = s.StoryId) AND (shp.Active = TRUE)
LEFT JOIN picture p
ON (p.PictureId = shp.PictureId) AND (p.Active = TRUE)

WHERE StoryPrivacyType_StoryPrivacyTypeId = 1
AND s.Active = TRUE
AND aps.Active = TRUE
AND aps.Approved = TRUE
HAVING hits > 0
ORDER BY hits DESC
LIMIT 0,10