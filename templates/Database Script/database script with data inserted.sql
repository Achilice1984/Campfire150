-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 04, 2015 at 01:23 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `achievementleveltype`
--

INSERT INTO `achievementleveltype` (`LevelId`, `DescriptionE`, `DescriptionF`, `NameE`, `NameF`) VALUES
(1, 'Some Achievement Description', 'F-Some Achievement Description', 'Tier 1', 'F-Tier 1'),
(2, 'master', 'master in French', 'M', 'M');

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
  `Approved` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`User_UserId`,`Story_StoryId`),
  KEY `fk_User_has_Story_Story2_idx` (`Story_StoryId`),
  KEY `fk_User_has_Story_User2_idx` (`User_UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_approve_story`
--

INSERT INTO `admin_approve_story` (`User_UserId`, `Story_StoryId`, `ApprovalCommentE`, `ApprovalCommentF`, `ApprovedDate`, `Approved`) VALUES
(2, 8, 'sfas', 'as', '2015-02-04 00:52:01', 0),
(5, 6, 'good', NULL, '2015-02-04 00:52:01', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`AnswerId`, `AnswerE`, `AnswerF`) VALUES
(1, 'environment changes', 'modifications de l''environnement'),
(2, 'Elementary school education', 'L''enseignement primaire'),
(3, 'earthquake and warter pollution', 'la pollution de tremblement de terre et warter'),
(4, 'School safety and food quality', 'Sécurité à l''école et la qualité alimentaire'),
(5, 'things are going to change better', 'les choses vont changer meilleure'),
(6, 'things are going to change better', 'les choses vont changer meilleure');

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

--
-- Dumping data for table `answer_for_question`
--

INSERT INTO `answer_for_question` (`Answer_AnswerId`, `Question_QuestionId`) VALUES
(1, 1),
(2, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(1, 3),
(2, 3),
(5, 3),
(6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `CommentId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Story_StoryId` int(10) unsigned NOT NULL,
  `User_UserId` int(10) unsigned NOT NULL,
  `Content` mediumtext,
  `PublishFlag` tinyint(1) NOT NULL DEFAULT '0',
  `TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`CommentId`),
  UNIQUE KEY `CommentId_UNIQUE` (`CommentId`),
  KEY `fk_Comment_Story1_idx` (`Story_StoryId`),
  KEY `fk_Comment_User1_idx` (`User_UserId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`CommentId`, `Story_StoryId`, `User_UserId`, `Content`, `PublishFlag`, `TimeStamp`) VALUES
(1, 6, 4, 'WONDERFUL, GOOD .', 1, '2015-02-04 00:53:30'),
(2, 8, 12, 'PERFECT, i LIKE IT', 0, '2015-02-04 00:53:30');

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

--
-- Dumping data for table `following`
--

INSERT INTO `following` (`User_UserId`, `User_FollowerId`, `Active`, `TimeStamp`) VALUES
(1, 3, 1, '2015-02-04 00:26:04'),
(1, 6, 1, '2015-02-04 00:26:04'),
(6, 12, 1, '2015-02-04 00:26:04'),
(9, 10, 1, '2015-02-04 00:26:04'),
(13, 9, 1, '2015-02-04 00:26:04');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `languagetype`
--

INSERT INTO `languagetype` (`LanguageId`, `LanguageNameE`, `LanguageNameF`) VALUES
(1, 'English', 'Anglais'),
(2, 'French', 'Français');

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
  `picturetype_PictureTypeId` int(10) unsigned NOT NULL COMMENT 'Picture is used for beckground or profile or story',
  `PictureExtension` varchar(45) NOT NULL,
  PRIMARY KEY (`PictureId`),
  UNIQUE KEY `PictureId_UNIQUE` (`PictureId`),
  UNIQUE KEY `FileName_UNIQUE` (`FileName`),
  KEY `fk_Picture_User1_idx` (`User_UserId`),
  KEY `fk_picture_picturetype1_idx` (`picturetype_PictureTypeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `picture`
--

INSERT INTO `picture` (`PictureId`, `Title`, `Description`, `FileName`, `Active`, `InppropriateFlag`, `User_UserId`, `TimeStamp`, `picturetype_PictureTypeId`, `PictureExtension`) VALUES
(1, 'hello kitty', 'Story about manga', 'haha , kitty , how are u', 1, 0, 8, '2015-02-04 00:28:26', 1, 'jpg'),
(2, 'what'' uo', 'sdfgtfvc', 'hello world', 0, 3, 11, '2015-02-04 00:28:26', 2, 'png');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `picturetype`
--

INSERT INTO `picturetype` (`PictureTypeId`, `PictureTypeNameE`, `PictureTypeNameF`) VALUES
(1, 'Profile', 'Profil'),
(2, 'Background', 'Fond');

-- --------------------------------------------------------

--
-- Table structure for table `privacytype`
--

CREATE TABLE IF NOT EXISTS `privacytype` (
  `PrivacyTypeId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `DescriptionE` tinytext,
  `DescriptionF` tinytext,
  PRIMARY KEY (`PrivacyTypeId`),
  UNIQUE KEY `PrivacyTypeId_UNIQUE` (`PrivacyTypeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `privacytype`
--

INSERT INTO `privacytype` (`PrivacyTypeId`, `DescriptionE`, `DescriptionF`) VALUES
(1, 'Public', 'Public'),
(2, 'Private', 'Privé'),
(3, 'Friends', 'Amis');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`QuestionId`, `QuestionE`, `QuestionF`) VALUES
(1, 'What are the most important themes discussed in your story? ', 'Quels sont les thèmes les plus importants abordés dans votre histoire ?'),
(2, 'What are the challenges in your story?', 'Quels sont les défis dans votre histoire ?'),
(3, 'How does your story view Canada''s future?', 'Comment votre histoire voir l''avenir du Canada ?');

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
  `PrivacyType_PrivacyTypeId` int(10) unsigned NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1',
  `LatestChange` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`StoryId`),
  UNIQUE KEY `StoryId_UNIQUE` (`StoryId`),
  KEY `fk_Story_User1_idx` (`User_UserId`),
  KEY `fk_Story_PrivacyType1_idx` (`PrivacyType_PrivacyTypeId`),
  FULLTEXT KEY `search_index` (`Content`,`StoryTitle`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `story`
--

INSERT INTO `story` (`StoryId`, `DatePosted`, `User_UserId`, `StoryTitle`, `Content`, `PrivacyType_PrivacyTypeId`, `Active`, `LatestChange`) VALUES
(6, '2015-02-04 00:40:38', 3, 'dhfdg', 'vsjnhdtrewsdbdf', 1, 1, '2015-02-04 00:40:38'),
(7, '2015-02-04 00:40:38', 8, 'tyrfaw', 'hello chende', 1, 1, '2015-02-04 00:40:38'),
(8, '2015-02-04 00:41:29', 3, 'sdf', 'hahahhaha', 1, 1, '2015-02-04 00:41:29'),
(9, '2015-02-04 00:41:29', 13, 'kkskdjfoiw', 'hahah chende', 3, 1, '2015-02-04 00:41:29');

-- --------------------------------------------------------

--
-- Table structure for table `storylink`
--

CREATE TABLE IF NOT EXISTS `storylink` (
  `Story_ParentStoryId` int(10) unsigned NOT NULL,
  `Story_StoryId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`Story_ParentStoryId`,`Story_StoryId`),
  KEY `fk_StoryLink_Story1_idx` (`Story_ParentStoryId`),
  KEY `fk_StoryLink_Story2_idx` (`Story_StoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `storylink`
--

INSERT INTO `storylink` (`Story_ParentStoryId`, `Story_StoryId`) VALUES
(6, 7),
(6, 9),
(7, 8),
(8, 9),
(9, 6);

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

--
-- Dumping data for table `story_has_answer_for_question`
--

INSERT INTO `story_has_answer_for_question` (`Story_StoryId`, `Answer_for_Question_Answer_AnswerId`, `Answer_for_Question_Question_QuestionId`, `TimeStamp`) VALUES
(6, 1, 1, '2015-02-04 00:58:08'),
(6, 2, 1, '2015-02-04 00:58:08'),
(6, 3, 2, '2015-02-04 00:58:08'),
(7, 1, 1, '2015-02-04 00:58:08'),
(7, 3, 2, '2015-02-04 00:58:08');

-- --------------------------------------------------------

--
-- Table structure for table `story_has_picture`
--

CREATE TABLE IF NOT EXISTS `story_has_picture` (
  `story_StoryId` int(10) unsigned NOT NULL,
  `picture_PictureId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`story_StoryId`,`picture_PictureId`),
  KEY `fk_story_has_picture_picture1_idx` (`picture_PictureId`),
  KEY `fk_story_has_picture_story1_idx` (`story_StoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `story_has_picture`
--

INSERT INTO `story_has_picture` (`story_StoryId`, `picture_PictureId`) VALUES
(6, 1),
(6, 2),
(7, 2),
(8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `story_tag`
--

CREATE TABLE IF NOT EXISTS `story_tag` (
  `Story_StoryId` int(10) unsigned NOT NULL,
  `Tag_TagId` int(10) unsigned NOT NULL,
  `TimeStamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Story_StoryId`,`Tag_TagId`),
  KEY `fk_Story_Tag_Story1_idx` (`Story_StoryId`),
  KEY `fk_Story_Tag_Tag1_idx` (`Tag_TagId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `story_tag`
--

INSERT INTO `story_tag` (`Story_StoryId`, `Tag_TagId`, `TimeStamp`) VALUES
(6, 1, '2015-02-04 01:20:41'),
(6, 7, '2015-02-04 01:20:41'),
(7, 2, '2015-02-04 01:20:41'),
(8, 4, '2015-02-04 01:20:41'),
(9, 7, '2015-02-04 01:20:41');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`TagId`, `TagNameE`, `TagNameF`) VALUES
(1, 'Art', 'Art'),
(2, 'Challenges', 'Défis'),
(3, 'Climate/Weather', 'Climat/Temps'),
(4, 'Environment', 'Environnement'),
(5, 'Family', 'Famille'),
(6, 'Leadership', 'Leadership'),
(7, 'Technology', 'Technologie'),
(8, 'Uncategorized', 'Non classé');

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
  `LockoutTimes` int(11) DEFAULT NULL,
  PRIMARY KEY (`UserId`),
  UNIQUE KEY `userId_UNIQUE` (`UserId`),
  UNIQUE KEY `email_UNIQUE` (`Email`),
  KEY `fk_User_AchievementLevelType1_idx` (`AchievementLevelType_LevelId`),
  KEY `fk_User_LanguageType1_idx` (`LanguageType_LanguageId`),
  FULLTEXT KEY `search_index` (`Email`,`FirstName`,`LastName`,`MidName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserId`, `Email`, `Password`, `RegisterDate`, `AchievementLevelType_LevelId`, `Address`, `PostalCode`, `Notes`, `FirstName`, `MidName`, `LastName`, `LanguageType_LanguageId`, `Active`, `AdminFlag`, `VerifiedEmail`, `PhoneNumber`, `VerificationCode`, `FailedLoginAttempt`, `LockoutTimes`) VALUES
(1, 'josh@campfire.com', '$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2', '2015-02-04 00:26:03', 1, '123 Fake Street', 'K2J4B8', NULL, 'Josh', '', 'de Vries', 1, 1, 1, 1, '6132551111', NULL, NULL, NULL),
(2, 'chenda@campfire.com', '$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2', '2015-02-04 00:26:03', 1, '123 Fake Street', 'K2J4B8', NULL, 'Chenda', '', 'Houeng', 1, 1, 1, 1, '6132551111', NULL, NULL, NULL),
(3, 'yougen@campfire.com', '$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2', '2015-02-04 00:26:03', 1, '123 Fake Street', 'K2J4B8', NULL, 'Yougen', '', 'Xue', 1, 1, 1, 1, '6132551111', NULL, NULL, NULL),
(4, 'jacob@campfire.com', '$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2', '2015-02-04 00:26:03', 1, '123 Fake Street', 'K2J4B8', NULL, 'Jacob', '', 'Trembletski', 1, 1, 1, 1, '6132551111', NULL, NULL, NULL),
(5, 'brian@campfire.com', '$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2', '2015-02-04 00:26:03', 1, '123 Fake Street', 'K2J4B8', NULL, 'Brain', '', 'Meagher', 1, 1, 1, 1, '6132551111', NULL, NULL, NULL),
(6, 'darren@campfire.com', '$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2', '2015-02-04 00:26:03', 1, '123 Fake Street', 'K2J4B8', NULL, 'Darren', '', 'Caldwell', 1, 1, 1, 1, '6132551111', NULL, NULL, NULL),
(7, 'jeff@campfire.com', '$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2', '2015-02-04 00:26:03', 1, '123 Fake Street', 'K2J4B8', NULL, 'Jeff', '', 'Johnson', 1, 1, 0, 1, '6132551111', NULL, NULL, NULL),
(8, 'brad@campfire.com', '$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2', '2015-02-04 00:26:03', 1, '123 Fake Street', 'K2J4B8', NULL, 'Brad', '', 'Bradly', 1, 1, 0, 1, '6132551111', NULL, NULL, NULL),
(9, 'alana@campfire.com', '$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2', '2015-02-04 00:26:03', 1, '123 Fake Street', 'K2J4B8', NULL, 'Alana', '', 'Bauer', 1, 1, 0, 1, '6132551111', NULL, NULL, NULL),
(10, 'kelsey@campfire.com', '$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2', '2015-02-04 00:26:03', 1, '123 Fake Street', 'K2J4B8', NULL, 'Kelsey', '', 'Smith', 1, 1, 0, 1, '6132551111', NULL, NULL, NULL),
(11, 'blane@campfire.com', '$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2', '2015-02-04 00:26:03', 1, '123 Fake Street', 'K2J4B8', NULL, 'Blane', '', 'Black', 1, 0, 0, 1, '6132551111', NULL, NULL, NULL),
(12, 'barney@campfire.com', '$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2', '2015-02-04 00:26:03', 1, '123 Fake Street', 'K2J4B8', NULL, 'Barney', '', 'Smojic', 1, 0, 0, 1, '6132551111', NULL, NULL, NULL),
(13, 'jenkins@campfire.com', '$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2', '2015-02-04 00:26:03', 1, '123 Fake Street', 'K2J4B8', NULL, 'Jenkins', '', 'Tremblay', 1, 1, 0, 0, '6132551111', NULL, NULL, NULL),
(14, 'olga@campfire.com', '$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2', '2015-02-04 00:26:03', 1, '123 Fake Street', 'K2J4B8', NULL, 'Olga', '', 'Ralph', 1, 1, 0, 0, '6132551111', NULL, NULL, NULL);

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

--
-- Dumping data for table `user_inappropriateflag_comment`
--

INSERT INTO `user_inappropriateflag_comment` (`User_UserId`, `Comment_CommentId`, `TimeStamp`) VALUES
(2, 1, '2015-02-04 00:54:55'),
(4, 2, '2015-02-04 00:54:55'),
(5, 1, '2015-02-04 00:54:55'),
(8, 2, '2015-02-04 00:54:55'),
(9, 2, '2015-02-04 00:54:55'),
(10, 1, '2015-02-04 00:54:55'),
(10, 2, '2015-02-04 00:54:55'),
(11, 2, '2015-02-04 00:54:55'),
(14, 1, '2015-02-04 00:54:55'),
(14, 2, '2015-02-04 00:54:55');

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
-- Dumping data for table `user_recommend_story`
--

INSERT INTO `user_recommend_story` (`User_UserId`, `Story_StoryId`, `LatestChange`, `Opinion`) VALUES
(4, 6, '2015-02-04 02:50:12', 1),
(7, 9, '2015-02-04 02:50:12', 1),
(10, 8, '2015-02-04 02:50:12', 1),
(12, 7, '2015-02-04 02:50:12', 1),
(13, 6, '2015-02-04 02:50:12', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_approve_story`
--
ALTER TABLE `admin_approve_story`
  ADD CONSTRAINT `fk_User_Approve_Story_User2` FOREIGN KEY (`User_UserId`) REFERENCES `user` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_User_Approve_Story_Story2` FOREIGN KEY (`Story_StoryId`) REFERENCES `story` (`StoryId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Constraints for table `picture`
--
ALTER TABLE `picture`
  ADD CONSTRAINT `fk_Picture_User1` FOREIGN KEY (`User_UserId`) REFERENCES `user` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_picture_picturetype1` FOREIGN KEY (`picturetype_PictureTypeId`) REFERENCES `picturetype` (`PictureTypeId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `story`
--
ALTER TABLE `story`
  ADD CONSTRAINT `fk_Story_User1` FOREIGN KEY (`User_UserId`) REFERENCES `user` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Story_PrivacyType1` FOREIGN KEY (`PrivacyType_PrivacyTypeId`) REFERENCES `privacytype` (`PrivacyTypeId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_story_has_picture_picture1` FOREIGN KEY (`picture_PictureId`) REFERENCES `picture` (`PictureId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `story_tag`
--
ALTER TABLE `story_tag`
  ADD CONSTRAINT `fk_Story_Tag_Story1` FOREIGN KEY (`Story_StoryId`) REFERENCES `story` (`StoryId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Story_Tag_Tag1` FOREIGN KEY (`Tag_TagId`) REFERENCES `tag` (`TagId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_User_AchievementLevelType1` FOREIGN KEY (`AchievementLevelType_LevelId`) REFERENCES `achievementleveltype` (`LevelId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_User_LanguageType1` FOREIGN KEY (`LanguageType_LanguageId`) REFERENCES `languagetype` (`LanguageId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
