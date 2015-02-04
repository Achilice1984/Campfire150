--
-- Insert into Tag table
--

INSERT INTO Tag (TagNameE, TagNameF)
VALUES ("Art", "Art");
INSERT INTO Tag (TagNameE, TagNameF)
VALUES ("Challenges", "Défis");
INSERT INTO Tag (TagNameE, TagNameF)
VALUES ("Climate/Weather", "Climat/Temps");
INSERT INTO Tag (TagNameE, TagNameF)
VALUES ("Environment", "Environnement");
INSERT INTO Tag (TagNameE, TagNameF)
VALUES ("Family", "Famille");
INSERT INTO Tag (TagNameE, TagNameF)
VALUES ("Leadership", "Leadership");
INSERT INTO Tag (TagNameE, TagNameF)
VALUES ("Technology", "Technologie");
INSERT INTO Tag (TagNameE, TagNameF)
VALUES ("Uncategorized", "Non classé");

--
-- Insert into LanguageType table
--

INSERT INTO LanguageType (LanguageNameE, LanguageNameF)
VALUES ("English", "Anglais");
INSERT INTO LanguageType (LanguageNameE, LanguageNameF)
VALUES ("French", "Français");

--
-- Insert into PrivacyType table
--

INSERT INTO PrivacyType (DescriptionE, DescriptionF)
VALUES ("Public", "Public");
INSERT INTO PrivacyType (DescriptionE, DescriptionF)
VALUES ("Private", "Privé");
INSERT INTO PrivacyType (DescriptionE, DescriptionF)
VALUES ("Friends", "Amis");

--
-- Insert into AchievementLevelType table
--

INSERT INTO AchievementLevelType (NameE, NameF, DescriptionE, DescriptionF)
VALUES ("Tier 1", "F-Tier 1", "Some Achievement Description", "F-Some Achievement Description");

INSERT INTO `campfire`.`achievementleveltype` (`LevelId`, `DescriptionE`, `DescriptionF`, `NameE`, `NameF`) VALUES (NULL, 'master', 'master in French', 'M', 'M');

--
-- Insert into PictureType table
--

INSERT INTO PictureType (PictureTypeNameE, PictureTypeNameF)
VALUES ("Profile", "Profil");
INSERT INTO PictureType (PictureTypeNameE, PictureTypeNameF)
VALUES ("Background", "Fond");
INSERT INTO PictureType (PictureTypeNameE, PictureTypeNameF)
VALUES ("Story", "histoire");

--
-- Insert into User table
--
-- All passwords == 123456
--

INSERT INTO User (Email, Password, Address, PostalCode, PhoneNumber, FirstName, LastName, MidName, Active, AdminFlag, VerifiedEmail)
VALUES ("josh@campfire.com", "$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2", "123 Fake Street", "K2J4B8", "6132551111", "Josh", "de Vries", "", TRUE, TRUE, TRUE);
INSERT INTO User (Email, Password, Address, PostalCode, PhoneNumber, FirstName, LastName, MidName, Active, AdminFlag, VerifiedEmail)
VALUES ("chenda@campfire.com", "$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2", "123 Fake Street", "K2J4B8", "6132551111", "Chenda", "Houeng", "", TRUE, TRUE, TRUE);
INSERT INTO User (Email, Password, Address, PostalCode, PhoneNumber, FirstName, LastName, MidName, Active, AdminFlag, VerifiedEmail)
VALUES ("yougen@campfire.com", "$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2", "123 Fake Street", "K2J4B8", "6132551111", "Yougen", "Xue", "", TRUE, TRUE, TRUE);
INSERT INTO User (Email, Password, Address, PostalCode, PhoneNumber, FirstName, LastName, MidName, Active, AdminFlag, VerifiedEmail)
VALUES ("jacob@campfire.com", "$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2", "123 Fake Street", "K2J4B8", "6132551111", "Jacob", "Trembletski", "", TRUE, TRUE, TRUE);
INSERT INTO User (Email, Password, Address, PostalCode, PhoneNumber, FirstName, LastName, MidName, Active, AdminFlag, VerifiedEmail)
VALUES ("brian@campfire.com", "$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2", "123 Fake Street", "K2J4B8", "6132551111", "Brain", "Meagher", "", TRUE, TRUE, TRUE);
INSERT INTO User (Email, Password, Address, PostalCode, PhoneNumber, FirstName, LastName, MidName, Active, AdminFlag, VerifiedEmail)
VALUES ("darren@campfire.com", "$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2", "123 Fake Street", "K2J4B8", "6132551111", "Darren", "Caldwell", "", TRUE, TRUE, TRUE);

INSERT INTO User (Email, Password, Address, PostalCode, PhoneNumber, FirstName, LastName, MidName, Active, AdminFlag, VerifiedEmail)
VALUES ("jeff@campfire.com", "$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2", "123 Fake Street", "K2J4B8", "6132551111", "Jeff", "Johnson", "", TRUE, FALSE, TRUE);
INSERT INTO User (Email, Password, Address, PostalCode, PhoneNumber, FirstName, LastName, MidName, Active, AdminFlag, VerifiedEmail)
VALUES ("brad@campfire.com", "$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2", "123 Fake Street", "K2J4B8", "6132551111", "Brad", "Bradly", "", TRUE, FALSE, TRUE);
INSERT INTO User (Email, Password, Address, PostalCode, PhoneNumber, FirstName, LastName, MidName, Active, AdminFlag, VerifiedEmail)
VALUES ("alana@campfire.com", "$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2", "123 Fake Street", "K2J4B8", "6132551111", "Alana", "Bauer", "", TRUE, FALSE, TRUE);
INSERT INTO User (Email, Password, Address, PostalCode, PhoneNumber, FirstName, LastName, MidName, Active, AdminFlag, VerifiedEmail)
VALUES ("kelsey@campfire.com", "$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2", "123 Fake Street", "K2J4B8", "6132551111", "Kelsey", "Smith", "", TRUE, FALSE, TRUE);

INSERT INTO User (Email, Password, Address, PostalCode, PhoneNumber, FirstName, LastName, MidName, Active, AdminFlag, VerifiedEmail)
VALUES ("blane@campfire.com", "$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2", "123 Fake Street", "K2J4B8", "6132551111", "Blane", "Black", "", FALSE, FALSE, TRUE);
INSERT INTO User (Email, Password, Address, PostalCode, PhoneNumber, FirstName, LastName, MidName, Active, AdminFlag, VerifiedEmail)
VALUES ("barney@campfire.com", "$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2", "123 Fake Street", "K2J4B8", "6132551111", "Barney", "Smojic", "", FALSE, FALSE, TRUE);
INSERT INTO User (Email, Password, Address, PostalCode, PhoneNumber, FirstName, LastName, MidName, Active, AdminFlag, VerifiedEmail)
VALUES ("jenkins@campfire.com", "$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2", "123 Fake Street", "K2J4B8", "6132551111", "Jenkins", "Tremblay", "", TRUE, FALSE, FALSE);
INSERT INTO User (Email, Password, Address, PostalCode, PhoneNumber, FirstName, LastName, MidName, Active, AdminFlag, VerifiedEmail)
VALUES ("olga@campfire.com", "$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2", "123 Fake Street", "K2J4B8", "6132551111", "Olga", "Ralph", "", TRUE, FALSE, FALSE);

<<<<<<< HEAD
--
-- Insert into question table
--
 
INSERT INTO `question` (`QuestionId`, `QuestionE`, `QuestionF`) VALUES
(1, 'What are the most important themes discussed in your story? ', 'Quels sont les thèmes les plus importants abordés dans votre histoire ?'),
(2, 'What are the challenges in your story?', 'Quels sont les défis dans votre histoire ?'),
(3, 'How does your story view Canada''s future?', 'Comment votre histoire voir l''avenir du Canada ?');

--
-- Insert into answer table
--

INSERT INTO `campfire`.`answer` (`AnswerId`, `AnswerE`, `AnswerF`) VALUES (NULL, 'environment changes', 'modifications de l''environnement'), (NULL, 'Elementary school education', 'L''enseignement primaire');
INSERT INTO `campfire`.`answer` (`AnswerId`, `AnswerE`, `AnswerF`) VALUES (NULL, 'earthquake and warter pollution', 'la pollution de tremblement de terre et warter'), (NULL, 'School safety and food quality', 'Sécurité à l''école et la qualité alimentaire');
INSERT INTO `campfire`.`answer` (`AnswerId`, `AnswerE`, `AnswerF`) VALUES (NULL, 'things are going to change better', 'les choses vont changer meilleure'), (NULL, 'things are going to change better', 'les choses vont changer meilleure');

--
-- Insert into answer_for_question table
--

INSERT INTO `campfire`.`answer_for_question` (`Answer_AnswerId`, `Question_QuestionId`) VALUES ('1', '1'), ('2', '1'), ('3', '2'), ('4', '2'), ('5', '3'), ('6', '3'), ('1', '2'), ('1', '3'), ('2', '2'), ('2', '3');

--
-- Insert into Following table
--

INSERT INTO `campfire`.`following` (`User_UserId`, `User_FollowerId`, `Active`, `TimeStamp`) VALUES ('1', '3', '1', CURRENT_TIMESTAMP), ('6', '12', '1', CURRENT_TIMESTAMP), ('1', '6', '1', CURRENT_TIMESTAMP), ('9', '10', '1', CURRENT_TIMESTAMP), ('13', '9', '1', CURRENT_TIMESTAMP);

--
-- Insert into Picture table
--

INSERT INTO `campfire`.`picture` (`PictureId`, `Title`, `Description`, `FileName`, `Active`, `InppropriateFlag`, `User_UserId`, `TimeStamp`, `picturetype_PictureTypeId`) VALUES (NULL, 'hello kitty', 'Story about manga', 'haha , kitty , how are u', '1', '0', '8', CURRENT_TIMESTAMP, '1'), (NULL, 'what'' uo', 'sdfgtfvc', 'hello world', '0', '3', '11', CURRENT_TIMESTAMP, '2');

--
-- Dumping data for table `story`
--

INSERT INTO `story` (`StoryId`, `DatePosted`, `User_UserId`, `StoryTitle`, `Content`, `PrivacyType_PrivacyTypeId`, `Active`, `LatestChange`) VALUES
(6, '2015-02-04 00:40:38', 3, 'dhfdg', 'vsjnhdtrewsdbdf', 1, 1, '2015-02-04 00:40:38'),
(7, '2015-02-04 00:40:38', 8, 'tyrfaw', 'hello chende', 1, 1, '2015-02-04 00:40:38'),
(8, '2015-02-04 00:41:29', 3, 'sdf', 'hahahhaha', 1, 1, '2015-02-04 00:41:29'),
(9, '2015-02-04 00:41:29', 13, 'kkskdjfoiw', 'hahah chende', 3, 1, '2015-02-04 00:41:29');

--
-- Insert into storylink table
--

INSERT INTO `campfire`.`storylink` (`Story_ParentStoryId`, `Story_StoryId`) VALUES ('7', '8'), ('6', '9'), ('6', '7'), ('8', '9'), ('9', '6');

--
-- Dumping data for table `user_recommend_story`
--
INSERT INTO  `user_recommend_story` (  `User_UserId` ,  `Story_StoryId` ,  `LatestChange` ,  `Opinion` ) 
VALUES ( 4, 6,  '2015-02-03 21:50:12', 1 ) , ( 7, 9,  '2015-02-03 21:50:12', 1 ) , ( 10, 8,  '2015-02-03 21:50:12', 1 ) , ( 12, 7,  '2015-02-03 21:50:12', 1 ) , ( 13, 6,  '2015-02-03 21:50:12', 0 )

--
-- Dumping data for table `admin_approve_story`
--
INSERT INTO `campfire`.`admin_approve_story` (`User_UserId`, `Story_StoryId`, `ApprovalCommentE`, `ApprovalCommentF`, `ApprovedDate`, `Approved`) VALUES ('5', '6', 'good', NULL, CURRENT_TIMESTAMP, '1'), ('2', '8', 'sfas', 'as', CURRENT_TIMESTAMP, '0');

--
-- Dumping data for table `comment`
--
INSERT INTO `campfire`.`comment` (`CommentId`, `Story_StoryId`, `User_UserId`, `Content`, `PublishFlag`, `TimeStamp`) VALUES (NULL, '6', '4', 'WONDERFUL, GOOD .', '1', CURRENT_TIMESTAMP), (NULL, '8', '12', 'PERFECT, i LIKE IT', '0', CURRENT_TIMESTAMP);

--
-- Dumping data for table `user_inappropriateflag_comment`
--
INSERT INTO `campfire`.`user_inappropriateflag_comment` (`User_UserId`, `Comment_CommentId`, `TimeStamp`) VALUES ('2', '1', CURRENT_TIMESTAMP), ('5', '1', CURRENT_TIMESTAMP), ('10', '2', CURRENT_TIMESTAMP), ('11', '2', CURRENT_TIMESTAMP), ('14', '2', CURRENT_TIMESTAMP), ('14', '1', CURRENT_TIMESTAMP), ('10', '1', CURRENT_TIMESTAMP), ('4', '2', CURRENT_TIMESTAMP), ('8', '2', CURRENT_TIMESTAMP), ('9', '2', CURRENT_TIMESTAMP);

--
-- Dumping data for table `user_inappropriateflag_comment`
--
INSERT INTO `campfire`.`story_has_answer_for_question` (`Story_StoryId`, `Answer_for_Question_Answer_AnswerId`, `Answer_for_Question_Question_QuestionId`, `TimeStamp`) VALUES ('6', '1', '1', CURRENT_TIMESTAMP), ('6', '2', '1', CURRENT_TIMESTAMP), ('6', '3', '2', CURRENT_TIMESTAMP), ('7', '1', '1', CURRENT_TIMESTAMP), ('7', '3', '2', CURRENT_TIMESTAMP);

--
-- Dumping data for table `story_has_picture`
--
INSERT INTO `campfire`.`story_has_picture` (`story_StoryId`, `picture_PictureId`) VALUES ('6', '1'), ('6', '2');
INSERT INTO `campfire`.`story_has_picture` (`story_StoryId`, `picture_PictureId`) VALUES ('7', '2'), ('8', '2')

--
-- Dumping data for table `story_tag`
--
INSERT INTO `campfire`.`story_tag` (`Story_StoryId`, `Tag_TagId`, `TimeStamp`) VALUES ('6', '1', CURRENT_TIMESTAMP), ('7', '2', CURRENT_TIMESTAMP), ('6', '7', CURRENT_TIMESTAMP), ('8', '4', CURRENT_TIMESTAMP), ('9', '7', CURRENT_TIMESTAMP);
=======

--
-- Insert into Story table
--

INSERT INTO Story (User_UserId, StoryTitle, Content, PrivacyType_PrivacyTypeId, Active)
VALUES ("1", "The Old Dude", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ", "1", TRUE);
INSERT INTO Story (User_UserId, StoryTitle, Content, PrivacyType_PrivacyTypeId, Active)
VALUES ("2", "The Big Bannana", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ", "1", TRUE);
INSERT INTO Story (User_UserId, StoryTitle, Content, PrivacyType_PrivacyTypeId, Active)
VALUES ("3", "Why Am I Here?", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ", "1", TRUE);
INSERT INTO Story (User_UserId, StoryTitle, Content, PrivacyType_PrivacyTypeId, Active)
VALUES ("4", "Is There Really a Point", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ", "1", TRUE);

INSERT INTO Story (User_UserId, StoryTitle, Content, PrivacyType_PrivacyTypeId, Active)
VALUES ("5", "No Reason To Stay Home", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. .", "1", TRUE);
INSERT INTO Story (User_UserId, StoryTitle, Content, PrivacyType_PrivacyTypeId, Active)
VALUES ("6", "Falling Through The Cracks", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ", "1", TRUE);
INSERT INTO Story (User_UserId, StoryTitle, Content, PrivacyType_PrivacyTypeId, Active)
VALUES ("7", "Is There Anyone Out There", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ", "1", TRUE);
INSERT INTO Story (User_UserId, StoryTitle, Content, PrivacyType_PrivacyTypeId, Active)
VALUES ("8", "Canada Is My Home", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ", "1", TRUE);

INSERT INTO Story (User_UserId, StoryTitle, Content, PrivacyType_PrivacyTypeId, Active)
VALUES ("9", "Multiculturalism, Can it Work", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ", "1", TRUE);
INSERT INTO Story (User_UserId, StoryTitle, Content, PrivacyType_PrivacyTypeId, Active)
VALUES ("10", "Talk To Me Later", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ", "1", TRUE);
INSERT INTO Story (User_UserId, StoryTitle, Content, PrivacyType_PrivacyTypeId, Active)
VALUES ("10", "Stephen Harper The One Man Band", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ", "1", TRUE);
INSERT INTO Story (User_UserId, StoryTitle, Content, PrivacyType_PrivacyTypeId, Active)
VALUES ("1", "Why My Family Lives Here", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ", "1", TRUE);

INSERT INTO Story (User_UserId, StoryTitle, Content, PrivacyType_PrivacyTypeId, Active)
VALUES ("3", "Financial Issues", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ", "1", TRUE);
INSERT INTO Story (User_UserId, StoryTitle, Content, PrivacyType_PrivacyTypeId, Active)
VALUES ("2", "There Is No Solution", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ", "1", TRUE);
INSERT INTO Story (User_UserId, StoryTitle, Content, PrivacyType_PrivacyTypeId, Active)
VALUES ("2", "I Love My Country", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ", "3", TRUE);
INSERT INTO Story (User_UserId, StoryTitle, Content, PrivacyType_PrivacyTypeId, Active)
VALUES ("1", "Where Are The Workers", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. .", "3", TRUE);

INSERT INTO Story (User_UserId, StoryTitle, Content, PrivacyType_PrivacyTypeId, Active)
VALUES ("8", "Farmers On The Rise", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ", "2", FALSE);
INSERT INTO Story (User_UserId, StoryTitle, Content, PrivacyType_PrivacyTypeId, Active)
VALUES ("9", "Hockey Baby!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ", "2", TRUE);
INSERT INTO Story (User_UserId, StoryTitle, Content, PrivacyType_PrivacyTypeId, Active)
VALUES ("4", "Politics 101", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ", "2", FALSE);
INSERT INTO Story (User_UserId, StoryTitle, Content, PrivacyType_PrivacyTypeId, Active)
VALUES ("1", "This Is My Opinion", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ", "2", TRUE);


--
-- Insert into story_tag table
--

INSERT INTO story_tag (Story_StoryId, Tag_TagId)
VALUES ("1", "1");
INSERT INTO story_tag (Story_StoryId, Tag_TagId)
VALUES ("1", "4");

INSERT INTO story_tag (Story_StoryId, Tag_TagId)
VALUES ("2", "1");
INSERT INTO story_tag (Story_StoryId, Tag_TagId)
VALUES ("2", "7");

INSERT INTO story_tag (Story_StoryId, Tag_TagId)
VALUES ("3", "1");

INSERT INTO story_tag (Story_StoryId, Tag_TagId)
VALUES ("4", "2");

INSERT INTO story_tag (Story_StoryId, Tag_TagId)
VALUES ("5", "2");

INSERT INTO story_tag (Story_StoryId, Tag_TagId)
VALUES ("6", "3");
INSERT INTO story_tag (Story_StoryId, Tag_TagId)
VALUES ("6", "8");
INSERT INTO story_tag (Story_StoryId, Tag_TagId)
VALUES ("6", "1");

INSERT INTO story_tag (Story_StoryId, Tag_TagId)
VALUES ("7", "4");

INSERT INTO story_tag (Story_StoryId, Tag_TagId)
VALUES ("8", "4");

INSERT INTO story_tag (Story_StoryId, Tag_TagId)
VALUES ("9", "5");

INSERT INTO story_tag (Story_StoryId, Tag_TagId)
VALUES ("10", "6");
INSERT INTO story_tag (Story_StoryId, Tag_TagId)
VALUES ("10", "8");
INSERT INTO story_tag (Story_StoryId, Tag_TagId)
VALUES ("10", "3");

INSERT INTO story_tag (Story_StoryId, Tag_TagId)
VALUES ("11", "6");

INSERT INTO story_tag (Story_StoryId, Tag_TagId)
VALUES ("12", "6");

INSERT INTO story_tag (Story_StoryId, Tag_TagId)
VALUES ("13", "7");
INSERT INTO story_tag (Story_StoryId, Tag_TagId)
VALUES ("13", "3");
INSERT INTO story_tag (Story_StoryId, Tag_TagId)
VALUES ("13", "5");

INSERT INTO story_tag (Story_StoryId, Tag_TagId)
VALUES ("14", "8");

INSERT INTO story_tag (Story_StoryId, Tag_TagId)
VALUES ("15", "8");

INSERT INTO story_tag (Story_StoryId, Tag_TagId)
VALUES ("16", "7");
INSERT INTO story_tag (Story_StoryId, Tag_TagId)
VALUES ("16", "2");

INSERT INTO story_tag (Story_StoryId, Tag_TagId)
VALUES ("17", "7");
INSERT INTO story_tag (Story_StoryId, Tag_TagId)
VALUES ("17", "1");

INSERT INTO story_tag (Story_StoryId, Tag_TagId)
VALUES ("18", "1");
INSERT INTO story_tag (Story_StoryId, Tag_TagId)
VALUES ("18", "3");

INSERT INTO story_tag (Story_StoryId, Tag_TagId)
VALUES ("19", "2");

INSERT INTO story_tag (Story_StoryId, Tag_TagId)
VALUES ("20", "6");

--
-- Insert into StoryLink table
--

INSERT INTO StoryLink (Story_ParentStoryId, Story_StoryId)
VALUES ("1", "2");
INSERT INTO StoryLink (Story_ParentStoryId, Story_StoryId)
VALUES ("1", "4");
INSERT INTO StoryLink (Story_ParentStoryId, Story_StoryId)
VALUES ("1", "5");
INSERT INTO StoryLink (Story_ParentStoryId, Story_StoryId)
VALUES ("1", "9");
INSERT INTO StoryLink (Story_ParentStoryId, Story_StoryId)
VALUES ("11", "12");
INSERT INTO StoryLink (Story_ParentStoryId, Story_StoryId)
VALUES ("2", "3");
INSERT INTO StoryLink (Story_ParentStoryId, Story_StoryId)
VALUES ("2", "9");
INSERT INTO StoryLink (Story_ParentStoryId, Story_StoryId)
VALUES ("20", "15");
INSERT INTO StoryLink (Story_ParentStoryId, Story_StoryId)
VALUES ("11", "14");
INSERT INTO StoryLink (Story_ParentStoryId, Story_StoryId)
VALUES ("2", "19");
INSERT INTO StoryLink (Story_ParentStoryId, Story_StoryId)
VALUES ("2", "20");
INSERT INTO StoryLink (Story_ParentStoryId, Story_StoryId)
VALUES ("20", "18");

--
-- Insert into Picture table for stories
--

--INSERT INTO StoryLink (Story_StoryId, Title, Description, FileName, Active, User_UserId, picturetype_PictureTypeId)
--VALUES ("1", "Some Title", "This is a description of an image", "banana", TRUE, "1", "3");




--
-- Insert into User_Recommend_Story table
--

INSERT INTO user_recommend_story (User_UserId, Story_StoryId, Opinion)
VALUES ("1", "11", TRUE);
INSERT INTO user_recommend_story (User_UserId, Story_StoryId, Opinion)
VALUES ("1", "2", TRUE);
INSERT INTO user_recommend_story (User_UserId, Story_StoryId, Opinion)
VALUES ("1", "4", TRUE);
INSERT INTO user_recommend_story (User_UserId, Story_StoryId, Opinion)
VALUES ("1", "10", TRUE);
INSERT INTO user_recommend_story (User_UserId, Story_StoryId, Opinion)
VALUES ("1", "18", TRUE);


INSERT INTO user_recommend_story (User_UserId, Story_StoryId, Opinion)
VALUES ("2", "1", TRUE);
INSERT INTO user_recommend_story (User_UserId, Story_StoryId, Opinion)
VALUES ("2", "3", TRUE);
INSERT INTO user_recommend_story (User_UserId, Story_StoryId, Opinion)
VALUES ("2", "4", FALSE);
INSERT INTO user_recommend_story (User_UserId, Story_StoryId, Opinion)
VALUES ("2", "5", TRUE);
INSERT INTO user_recommend_story (User_UserId, Story_StoryId, Opinion)
VALUES ("2", "6", TRUE);

INSERT INTO user_recommend_story (User_UserId, Story_StoryId, Opinion)
VALUES ("11", "11", FALSE);
INSERT INTO user_recommend_story (User_UserId, Story_StoryId, Opinion)
VALUES ("11", "4", TRUE);
INSERT INTO user_recommend_story (User_UserId, Story_StoryId, Opinion)
VALUES ("11", "1", TRUE);
INSERT INTO user_recommend_story (User_UserId, Story_StoryId, Opinion)
VALUES ("11", "10", TRUE);

INSERT INTO user_recommend_story (User_UserId, Story_StoryId, Opinion)
VALUES ("12", "11", FALSE);
INSERT INTO user_recommend_story (User_UserId, Story_StoryId, Opinion)
VALUES ("12", "5", TRUE);
INSERT INTO user_recommend_story (User_UserId, Story_StoryId, Opinion)
VALUES ("12", "6", TRUE);
INSERT INTO user_recommend_story (User_UserId, Story_StoryId, Opinion)
VALUES ("12", "1", TRUE);

INSERT INTO user_recommend_story (User_UserId, Story_StoryId, Opinion)
VALUES ("7", "11", FALSE);
INSERT INTO user_recommend_story (User_UserId, Story_StoryId, Opinion)
VALUES ("7", "15", FALSE);
INSERT INTO user_recommend_story (User_UserId, Story_StoryId, Opinion)
VALUES ("7", "16", TRUE);
INSERT INTO user_recommend_story (User_UserId, Story_StoryId, Opinion)
VALUES ("7", "17", TRUE);

>>>>>>> origin/master

