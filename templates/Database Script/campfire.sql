-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 11, 2015 at 07:52 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `campfire`
--
CREATE DATABASE IF NOT EXISTS `campfire` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `campfire`;

-- --------------------------------------------------------

--
-- Table structure for table `achievementleveltype`
--

CREATE TABLE IF NOT EXISTS `achievementleveltype` (
  `LevelId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `DescriptionE` varchar(512) DEFAULT NULL,
  `DescriptionF` varchar(512) DEFAULT NULL,
  `NameE` varchar(45) DEFAULT NULL,
  `NameF` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`LevelId`),
  UNIQUE KEY `LevelId_UNIQUE` (`LevelId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `admin_actionon_user`
--

CREATE TABLE IF NOT EXISTS `admin_actionon_user` (
  `Admin_UserId` int(10) unsigned NOT NULL,
  `user_UserId` int(10) unsigned NOT NULL,
  `Action` tinyint(1) NOT NULL COMMENT '0 means admin reject user;\n1 means admin approve user.',
  `Reason` tinytext,
  `TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Admin_UserId`,`user_UserId`),
  KEY `fk_user_has_user_user2_idx` (`user_UserId`),
  KEY `fk_user_has_user_user1_idx` (`Admin_UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin_approve_story`
--

CREATE TABLE IF NOT EXISTS `admin_approve_story` (
  `User_UserId` int(10) unsigned NOT NULL COMMENT 'This UserId should belong to an admin type user\n',
  `Story_StoryId` int(10) unsigned NOT NULL,
  `ApprovalCommentE` varchar(255) DEFAULT NULL,
  `ApprovalCommentF` varchar(255) DEFAULT NULL,
  `ApprovedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Approved` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 means admin rejected story;\n1 means admin approved story.',
  PRIMARY KEY (`User_UserId`,`Story_StoryId`),
  KEY `fk_User_has_Story_Story2_idx` (`Story_StoryId`),
  KEY `fk_User_has_Story_User2_idx` (`User_UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin_reject_comment`
--

CREATE TABLE IF NOT EXISTS `admin_reject_comment` (
  `comment_CommentId` int(10) unsigned NOT NULL,
  `user_UserId` int(10) unsigned NOT NULL,
  `rejected` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Default 1 means admin rejected comment;\n0 means admin approved comment.',
  `reason` tinytext,
  `TimeStamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_CommentId`,`user_UserId`),
  KEY `fk_comment_has_user_user1_idx` (`user_UserId`),
  KEY `fk_comment_has_user_comment1_idx` (`comment_CommentId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
  `AnswerId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `AnswerE` tinytext NOT NULL,
  `AnswerF` tinytext NOT NULL,
  PRIMARY KEY (`AnswerId`),
  UNIQUE KEY `AnswerId_UNIQUE` (`AnswerId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `answer_for_question`
--

CREATE TABLE IF NOT EXISTS `answer_for_question` (
  `Answer_AnswerId` int(10) unsigned NOT NULL,
  `Question_QuestionId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`Answer_AnswerId`,`Question_QuestionId`),
  KEY `fk_Answer_has_Question_Question1_idx` (`Question_QuestionId`),
  KEY `fk_Answer_has_Question_Answer1_idx` (`Answer_AnswerId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `CommentId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Story_StoryId` int(10) unsigned NOT NULL,
  `User_UserId` int(10) unsigned NOT NULL,
  `Content` mediumtext,
  `PublishFlag` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 means unpublished.',
  `TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`CommentId`),
  UNIQUE KEY `CommentId_UNIQUE` (`CommentId`),
  KEY `fk_Comment_Story1_idx` (`Story_StoryId`),
  KEY `fk_Comment_User1_idx` (`User_UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `following`
--

CREATE TABLE IF NOT EXISTS `following` (
  `User_UserId` int(10) unsigned NOT NULL,
  `User_FollowerId` int(10) unsigned NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1',
  `TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`User_UserId`,`User_FollowerId`),
  KEY `fk_User_has_User_User2_idx` (`User_FollowerId`),
  KEY `fk_User_has_User_User1_idx` (`User_UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `languagetype`
--

CREATE TABLE IF NOT EXISTS `languagetype` (
  `LanguageId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `LanguageNameE` varchar(45) DEFAULT NULL,
  `LanguageNameF` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`LanguageId`),
  UNIQUE KEY `LanguageId_UNIQUE` (`LanguageId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `picture`
--

CREATE TABLE IF NOT EXISTS `picture` (
  `PictureId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `FileName` varchar(255) NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1',
  `InppropriateFlag` int(11) NOT NULL DEFAULT '0' COMMENT 'Flagged by Administrator\n',
  `User_UserId` int(10) unsigned NOT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `picturetype_PictureTypeId` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'Picture is used for beckground or profile or story;\ndefault 1 means that it hasn''t been assigned for any purpose yet.',
  `PictureExtension` varchar(45) NOT NULL,
  PRIMARY KEY (`PictureId`),
  UNIQUE KEY `PictureId_UNIQUE` (`PictureId`),
  UNIQUE KEY `FileName_UNIQUE` (`FileName`),
  KEY `fk_Picture_User1_idx` (`User_UserId`),
  KEY `fk_picture_picturetype1_idx` (`picturetype_PictureTypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `picturetype`
--

CREATE TABLE IF NOT EXISTS `picturetype` (
  `PictureTypeId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PictureTypeNameE` varchar(45) NOT NULL,
  `PictureTypeNameF` varchar(45) NOT NULL,
  PRIMARY KEY (`PictureTypeId`),
  UNIQUE KEY `PictureTypeId_UNIQUE` (`PictureTypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `profileprivacytype`
--

CREATE TABLE IF NOT EXISTS `profileprivacytype` (
  `PrivacyTypeId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `DescriptionE` tinytext,
  `DescriptionF` tinytext,
  PRIMARY KEY (`PrivacyTypeId`),
  UNIQUE KEY `PrivacyTypeId_UNIQUE` (`PrivacyTypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `QuestionId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `QuestionE` tinytext NOT NULL,
  `QuestionF` tinytext,
  PRIMARY KEY (`QuestionId`),
  UNIQUE KEY `QuestionnaireId_UNIQUE` (`QuestionId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `story`
--

CREATE TABLE IF NOT EXISTS `story` (
  `StoryId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `DatePosted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `User_UserId` int(10) unsigned NOT NULL,
  `StoryTitle` varchar(255) DEFAULT NULL,
  `Content` text,
  `Active` tinyint(1) NOT NULL DEFAULT '1',
  `LatestChange` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Published` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 means the story is unpublished;\n\n1 means the story is published',
  `StoryPrivacyType_StoryPrivacyTypeId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`StoryId`),
  UNIQUE KEY `StoryId_UNIQUE` (`StoryId`),
  KEY `fk_Story_User1_idx` (`User_UserId`),
  KEY `fk_story_StoryPrivacyType1_idx` (`StoryPrivacyType_StoryPrivacyTypeId`),
  FULLTEXT KEY `search_index` (`Content`,`StoryTitle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `storylink`
--

CREATE TABLE IF NOT EXISTS `storylink` (
  `Story_ParentStoryId` int(10) unsigned NOT NULL,
  `Story_StoryId` int(10) unsigned NOT NULL,
  `TimeStamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Story_ParentStoryId`,`Story_StoryId`),
  KEY `fk_StoryLink_Story1_idx` (`Story_ParentStoryId`),
  KEY `fk_StoryLink_Story2_idx` (`Story_StoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `storyprivacytype`
--

CREATE TABLE IF NOT EXISTS `storyprivacytype` (
  `StoryPrivacyTypeId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `DescriptionE` tinytext NOT NULL,
  `DescriptionF` tinytext NOT NULL,
  PRIMARY KEY (`StoryPrivacyTypeId`),
  UNIQUE KEY `StoryPrivacyTypeId_UNIQUE` (`StoryPrivacyTypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `story_has_answer_for_question`
--

CREATE TABLE IF NOT EXISTS `story_has_answer_for_question` (
  `Story_StoryId` int(11) unsigned NOT NULL,
  `Answer_for_Question_Answer_AnswerId` int(11) unsigned NOT NULL,
  `Answer_for_Question_Question_QuestionId` int(11) unsigned NOT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Story_StoryId`,`Answer_for_Question_Answer_AnswerId`,`Answer_for_Question_Question_QuestionId`),
  KEY `fk_Story_has_Answer_for_Question_Answer_for_Question1_idx` (`Answer_for_Question_Answer_AnswerId`,`Answer_for_Question_Question_QuestionId`),
  KEY `fk_Story_has_Answer_for_Question_Story1_idx` (`Story_StoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `story_has_picture`
--

CREATE TABLE IF NOT EXISTS `story_has_picture` (
  `story_StoryId` int(10) unsigned NOT NULL,
  `PictureId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`story_StoryId`),
  KEY `fk_story_has_picture_story1_idx` (`story_StoryId`),
  KEY `fk_story_has_picture_picture_idx` (`PictureId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `story_has_tag`
--

CREATE TABLE IF NOT EXISTS `story_has_tag` (
  `Story_StoryId` int(10) unsigned NOT NULL,
  `Tag_TagId` int(10) unsigned NOT NULL,
  `TimeStamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Story_StoryId`,`Tag_TagId`),
  KEY `fk_Story_Tag_Story1_idx` (`Story_StoryId`),
  KEY `fk_Story_Tag_Tag1_idx` (`Tag_TagId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `TagId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `TagNameE` varchar(45) DEFAULT NULL,
  `TagNameF` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`TagId`),
  UNIQUE KEY `TagId_UNIQUE` (`TagId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `UserId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `RegisterDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AchievementLevelType_LevelId` int(10) unsigned NOT NULL DEFAULT '1',
  `Address` varchar(255) DEFAULT NULL,
  `PostalCode` varchar(25) DEFAULT NULL,
  `Notes` varchar(255) DEFAULT NULL,
  `FirstName` varchar(45) NOT NULL,
  `MidName` varchar(45) DEFAULT NULL,
  `LastName` varchar(45) NOT NULL,
  `LanguageType_LanguageId` int(10) unsigned NOT NULL DEFAULT '1',
  `Active` tinyint(1) NOT NULL DEFAULT '1',
  `AdminFlag` tinyint(1) NOT NULL DEFAULT '0',
  `VerifiedEmail` tinyint(1) NOT NULL DEFAULT '0',
  `PhoneNumber` varchar(45) DEFAULT NULL,
  `VerificationCode` varchar(255) DEFAULT NULL COMMENT 'only for valify email',
  `FailedLoginAttempt` int(11) DEFAULT NULL,
  `LockoutTimes` time DEFAULT NULL,
  `ProfilePrivacyType_PrivacyTypeId` int(10) unsigned NOT NULL,
  `Rejected` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`UserId`),
  UNIQUE KEY `userId_UNIQUE` (`UserId`),
  UNIQUE KEY `email_UNIQUE` (`Email`),
  KEY `fk_User_AchievementLevelType1_idx` (`AchievementLevelType_LevelId`),
  KEY `fk_User_LanguageType1_idx` (`LanguageType_LanguageId`),
  KEY `fk_user_ProfilePrivacyType1_idx` (`ProfilePrivacyType_PrivacyTypeId`),
  FULLTEXT KEY `search_index` (`Email`,`FirstName`,`LastName`,`MidName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `useractionstatement`
--

CREATE TABLE IF NOT EXISTS `useractionstatement` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_UserId` int(10) unsigned NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1',
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateDeactived` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Id_UNIQUE` (`Id`),
  KEY `fk_ActionStatement_user1_idx` (`user_UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_inappropriateflag_comment`
--

CREATE TABLE IF NOT EXISTS `user_inappropriateflag_comment` (
  `User_UserId` int(10) unsigned NOT NULL,
  `Comment_CommentId` int(10) unsigned NOT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`User_UserId`,`Comment_CommentId`),
  KEY `fk_User_has_Comment_Comment1_idx` (`Comment_CommentId`),
  KEY `fk_User_has_Comment_User1_idx` (`User_UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_recommend_story`
--

CREATE TABLE IF NOT EXISTS `user_recommend_story` (
  `User_UserId` int(11) unsigned NOT NULL,
  `Story_StoryId` int(11) unsigned NOT NULL,
  `LatestChange` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Opinion` tinyint(1) DEFAULT NULL COMMENT 'Opinion==''true'' means User recommend this story;\nOpinionl=''false'' means User Inappropriate the story;\nIf Opinion == NULL means User has no Opinion for this story.',
  PRIMARY KEY (`User_UserId`,`Story_StoryId`),
  KEY `fk_User_has_Story_Story1_idx` (`Story_StoryId`),
  KEY `fk_User_has_Story_User1_idx` (`User_UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_actionon_user`
--
ALTER TABLE `admin_actionon_user`
  ADD CONSTRAINT `fk_user_actionon_user_user1` FOREIGN KEY (`Admin_UserId`) REFERENCES `user` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_actionon_user_user2` FOREIGN KEY (`user_UserId`) REFERENCES `user` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `admin_approve_story`
--
ALTER TABLE `admin_approve_story`
  ADD CONSTRAINT `fk_User_Approve_Story_User2` FOREIGN KEY (`User_UserId`) REFERENCES `user` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_User_Approve_Story_Story2` FOREIGN KEY (`Story_StoryId`) REFERENCES `story` (`StoryId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `admin_reject_comment`
--
ALTER TABLE `admin_reject_comment`
  ADD CONSTRAINT `fk_comment_has_user_comment1` FOREIGN KEY (`comment_CommentId`) REFERENCES `comment` (`CommentId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comment_has_user_user1` FOREIGN KEY (`user_UserId`) REFERENCES `user` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `answer_for_question`
--
ALTER TABLE `answer_for_question`
  ADD CONSTRAINT `fk_Answer_has_Question_Answer1` FOREIGN KEY (`Answer_AnswerId`) REFERENCES `answer` (`AnswerId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Answer_has_Question_Question1` FOREIGN KEY (`Question_QuestionId`) REFERENCES `question` (`QuestionId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_Comment_Story1` FOREIGN KEY (`Story_StoryId`) REFERENCES `story` (`StoryId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Comment_User1` FOREIGN KEY (`User_UserId`) REFERENCES `user` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `following`
--
ALTER TABLE `following`
  ADD CONSTRAINT `fk_User_has_User_User1` FOREIGN KEY (`User_UserId`) REFERENCES `user` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_User_has_User_User2` FOREIGN KEY (`User_FollowerId`) REFERENCES `user` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `story`
--
ALTER TABLE `story`
  ADD CONSTRAINT `fk_Story_User1` FOREIGN KEY (`User_UserId`) REFERENCES `user` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_story_StoryPrivacyType1` FOREIGN KEY (`StoryPrivacyType_StoryPrivacyTypeId`) REFERENCES `storyprivacytype` (`StoryPrivacyTypeId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `storylink`
--
ALTER TABLE `storylink`
  ADD CONSTRAINT `fk_StoryLink_Story1` FOREIGN KEY (`Story_ParentStoryId`) REFERENCES `story` (`StoryId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_StoryLink_Story2` FOREIGN KEY (`Story_StoryId`) REFERENCES `story` (`StoryId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `story_has_answer_for_question`
--
ALTER TABLE `story_has_answer_for_question`
  ADD CONSTRAINT `fk_Story_has_Answer_for_Question_Story1` FOREIGN KEY (`Story_StoryId`) REFERENCES `story` (`StoryId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Story_has_Answer_for_Question_Answer_for_Question1` FOREIGN KEY (`Answer_for_Question_Answer_AnswerId`, `Answer_for_Question_Question_QuestionId`) REFERENCES `answer_for_question` (`Answer_AnswerId`, `Question_QuestionId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `story_has_picture`
--
ALTER TABLE `story_has_picture`
  ADD CONSTRAINT `fk_story_has_picture_story1` FOREIGN KEY (`story_StoryId`) REFERENCES `story` (`StoryId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_story_has_picture_picture` FOREIGN KEY (`PictureId`) REFERENCES `picture` (`PictureId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `story_has_tag`
--
ALTER TABLE `story_has_tag`
  ADD CONSTRAINT `fk_Story_Tag_Story1` FOREIGN KEY (`Story_StoryId`) REFERENCES `story` (`StoryId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Story_Tag_Tag1` FOREIGN KEY (`Tag_TagId`) REFERENCES `tag` (`TagId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_User_AchievementLevelType1` FOREIGN KEY (`AchievementLevelType_LevelId`) REFERENCES `achievementleveltype` (`LevelId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_User_LanguageType1` FOREIGN KEY (`LanguageType_LanguageId`) REFERENCES `languagetype` (`LanguageId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_ProfilePrivacyType1` FOREIGN KEY (`ProfilePrivacyType_PrivacyTypeId`) REFERENCES `profileprivacytype` (`PrivacyTypeId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `useractionstatement`
--
ALTER TABLE `useractionstatement`
  ADD CONSTRAINT `fk_ActionStatement_user1` FOREIGN KEY (`user_UserId`) REFERENCES `user` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_inappropriateflag_comment`
--
ALTER TABLE `user_inappropriateflag_comment`
  ADD CONSTRAINT `fk_User_has_Comment_User1` FOREIGN KEY (`User_UserId`) REFERENCES `user` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_User_has_Comment_Comment1` FOREIGN KEY (`Comment_CommentId`) REFERENCES `comment` (`CommentId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_recommend_story`
--
ALTER TABLE `user_recommend_story`
  ADD CONSTRAINT `fk_User_has_Story_User1` FOREIGN KEY (`User_UserId`) REFERENCES `user` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_User_has_Story_Story1` FOREIGN KEY (`Story_StoryId`) REFERENCES `story` (`StoryId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
