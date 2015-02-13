-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 12, 2015 at 05:47 PM
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
  `NameE` varchar(45) NOT NULL,
  `NameF` varchar(45) NOT NULL,
  PRIMARY KEY (`LevelId`),
  UNIQUE KEY `LevelId_UNIQUE` (`LevelId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `achievementleveltype`
--

INSERT INTO `achievementleveltype` (`LevelId`, `DescriptionE`, `DescriptionF`, `NameE`, `NameF`) VALUES
(1, 'Some Achievement Description', 'F-Some Achievement Description', 'Tier 1', 'F-Tier 1'),
(2, 'master', 'master in French', 'M', 'M'),
(3, 'Some Achievement Description', 'F-Some Achievement Description', 'Tier 1', 'F-Tier 1'),
(4, 'master', 'master in French', 'M', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `admin_actionon_user`
--

CREATE TABLE IF NOT EXISTS `admin_actionon_user` (
  `Admin_UserId` int(10) unsigned NOT NULL,
  `user_UserId` int(10) unsigned NOT NULL,
  `Action` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 means admin reject user,1 means admin approve user.',
  `Reason` tinytext,
  `TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Admin_UserId`,`user_UserId`),
  KEY `fk_user_has_user_user2_idx` (`user_UserId`),
  KEY `fk_user_has_user_user1_idx` (`Admin_UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_actionon_user`
--

INSERT INTO `admin_actionon_user` (`Admin_UserId`, `user_UserId`, `Action`, `Reason`, `TimeStamp`) VALUES
(1, 7, 1, 'Interesting Guy', '2015-02-12 16:57:51'),
(2, 13, 0, 'Not so interesting. Always dirty words.', '2015-02-12 16:57:51'),
(3, 9, 1, 'deleted the dirty pictures', '2015-02-12 17:05:26'),
(3, 10, 1, 'Became better', '2015-02-12 17:05:26'),
(3, 14, 0, 'terrorism words', '2015-02-12 17:05:26'),
(4, 12, 0, 'inapproprate upload', '2015-02-12 17:05:26'),
(4, 13, 1, 'Innocent one', '2015-02-12 17:05:26');

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

--
-- Dumping data for table `admin_approve_story`
--

INSERT INTO `admin_approve_story` (`User_UserId`, `Story_StoryId`, `ApprovalCommentE`, `ApprovalCommentF`, `ApprovedDate`, `Approved`) VALUES
(2, 8, 'sfas', 'as', '2015-02-12 16:35:03', 0),
(5, 6, 'good', NULL, '2015-02-12 16:35:03', 1);

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

--
-- Dumping data for table `admin_reject_comment`
--

INSERT INTO `admin_reject_comment` (`comment_CommentId`, `user_UserId`, `rejected`, `reason`, `TimeStamp`) VALUES
(1, 2, 1, 'inappropriate words', '2015-02-12 17:07:48'),
(2, 5, 0, 'the user has modified the comment', '2015-02-12 17:07:48');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=115 ;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`AnswerId`, `AnswerE`, `AnswerF`) VALUES
(1, 'Environment', 'environnement'),
(2, 'Families', 'familles'),
(3, 'Art', 'art'),
(4, 'Music', 'musique'),
(5, 'Technology', 'technologie'),
(6, 'Science', 'science'),
(7, 'Education', 'éducation'),
(8, 'Government', 'gouvernement'),
(9, 'Women', 'femmes'),
(10, 'Agriculture', 'agriculture'),
(11, 'Business', 'entreprise'),
(12, 'Economy', 'économie'),
(13, 'Nature', 'nature'),
(14, 'Children', 'enfants'),
(15, 'Immigration', 'immigration'),
(16, 'Innovation', 'innovation'),
(17, 'Leadership', 'leadership'),
(18, 'Urban ', 'urbain'),
(19, 'Sports', 'sportif'),
(20, 'Travel ', 'Voyage'),
(21, 'Tradition', 'tradition'),
(22, 'Change', 'changement'),
(23, 'Natural resources', 'Les ressources naturelles'),
(24, 'Culture', 'culture'),
(25, 'Diversity', 'diversité'),
(26, 'Animals/wildlife', 'Animaux / vie sauvage'),
(27, 'Water', 'eau'),
(28, 'Faith', 'foi'),
(29, 'Climate/weather', 'Climat / météo'),
(30, 'Food', 'nourriture'),
(31, 'included', 'inclus'),
(32, 'alienated ', 'aliéné'),
(33, 'neutral in your story', 'neutre dans votre histoire'),
(34, 'Not confident', 'pas confiant'),
(35, 'neutral', 'neutre'),
(36, 'Very confident', 'très confiant'),
(37, 'Individuals', 'personnes'),
(38, 'Communities', 'communautés'),
(39, 'governments', 'gouvernements'),
(40, 'Comedy', 'comédie'),
(41, 'Fantasy', 'fantaisie'),
(42, 'Fairy tale', 'conte de fées'),
(43, 'Drama', 'drame'),
(44, 'Ghost/horror story', 'Ghost / histoire d''horreur'),
(45, 'Satire', 'satire'),
(46, 'Adventure', 'aventure'),
(47, 'Romance', 'romance'),
(48, 'Mystery', 'mystère'),
(49, 'Poetry', 'poésie'),
(50, 'Song', 'chanson'),
(51, 'Never', 'jamais'),
(52, '1-2 times a year', '1-2 fois par année'),
(53, '1-2 times a month', '1-2 fois par mois'),
(54, '1-2 times a week', '1-2 fois par semaine'),
(55, 'Never', 'jamais'),
(56, 'Usually', 'habituellement'),
(57, 'Always', 'toujours'),
(58, 'Environment', 'environnement'),
(59, 'Families', 'familles'),
(60, 'Art', 'art'),
(61, 'Music', 'musique'),
(62, 'Technology', 'technologie'),
(63, 'Science', 'science'),
(64, 'Education', 'éducation'),
(65, 'Government', 'gouvernement'),
(66, 'Women', 'femmes'),
(67, 'Agriculture', 'agriculture'),
(68, 'Business', 'entreprise'),
(69, 'Economy', 'économie'),
(70, 'Nature', 'nature'),
(71, 'Children', 'enfants'),
(72, 'Immigration', 'immigration'),
(73, 'Innovation', 'innovation'),
(74, 'Leadership', 'leadership'),
(75, 'Urban ', 'urbain'),
(76, 'Sports', 'sportif'),
(77, 'Travel ', 'Voyage'),
(78, 'Tradition', 'tradition'),
(79, 'Change', 'changement'),
(80, 'Natural resources', 'Les ressources naturelles'),
(81, 'Culture', 'culture'),
(82, 'Diversity', 'diversité'),
(83, 'Animals/wildlife', 'Animaux / vie sauvage'),
(84, 'Water', 'eau'),
(85, 'Faith', 'foi'),
(86, 'Climate/weather', 'Climat / météo'),
(87, 'Food', 'nourriture'),
(88, 'included', 'inclus'),
(89, 'alienated ', 'aliéné'),
(90, 'neutral in your story', 'neutre dans votre histoire'),
(91, 'Not confident', 'pas confiant'),
(92, 'neutral', 'neutre'),
(93, 'Very confident', 'très confiant'),
(94, 'Individuals', 'personnes'),
(95, 'Communities', 'communautés'),
(96, 'governments', 'gouvernements'),
(97, 'Comedy', 'comédie'),
(98, 'Fantasy', 'fantaisie'),
(99, 'Fairy tale', 'conte de fées'),
(100, 'Drama', 'drame'),
(101, 'Ghost/horror story', 'Ghost / histoire d''horreur'),
(102, 'Satire', 'satire'),
(103, 'Adventure', 'aventure'),
(104, 'Romance', 'romance'),
(105, 'Mystery', 'mystère'),
(106, 'Poetry', 'poésie'),
(107, 'Song', 'chanson'),
(108, 'Never', 'jamais'),
(109, '1-2 times a year', '1-2 fois par année'),
(110, '1-2 times a month', '1-2 fois par mois'),
(111, '1-2 times a week', '1-2 fois par semaine'),
(112, 'Never', 'jamais'),
(113, 'Usually', 'habituellement'),
(114, 'Always', 'toujours');

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
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`CommentId`, `Story_StoryId`, `User_UserId`, `Content`, `PublishFlag`, `TimeStamp`) VALUES
(1, 6, 4, 'WONDERFUL, GOOD .', 1, '2015-02-12 16:35:56'),
(2, 8, 12, 'PERFECT, i LIKE IT', 0, '2015-02-12 16:35:56');

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
(1, 3, 1, '2015-02-12 16:29:09'),
(1, 6, 1, '2015-02-12 16:29:09'),
(6, 12, 1, '2015-02-12 16:29:09'),
(9, 10, 1, '2015-02-12 16:29:09'),
(13, 9, 1, '2015-02-12 16:29:09');

-- --------------------------------------------------------

--
-- Table structure for table `languagetype`
--

CREATE TABLE IF NOT EXISTS `languagetype` (
  `LanguageId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `NameE` varchar(45) NOT NULL,
  `NameF` varchar(45) NOT NULL,
  PRIMARY KEY (`LanguageId`),
  UNIQUE KEY `LanguageId_UNIQUE` (`LanguageId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `languagetype`
--

INSERT INTO `languagetype` (`LanguageId`, `NameE`, `NameF`) VALUES
(1, 'English', 'Anglais'),
(2, 'French', 'Français'),
(3, 'English', 'Anglais'),
(4, 'French', 'Français');

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
  `picturetype_PictureTypeId` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'Picture is used for beckground or profile or story;\ndefault 1 means that it has not been assigned for any purpose yet.',
  `PictureExtension` varchar(45) NOT NULL,
  PRIMARY KEY (`PictureId`),
  UNIQUE KEY `PictureId_UNIQUE` (`PictureId`),
  UNIQUE KEY `FileName_UNIQUE` (`FileName`),
  KEY `fk_Picture_User1_idx` (`User_UserId`),
  KEY `fk_picture_picturetype1_idx` (`picturetype_PictureTypeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `picture`
--

INSERT INTO `picture` (`PictureId`, `Title`, `Description`, `FileName`, `Active`, `InppropriateFlag`, `User_UserId`, `TimeStamp`, `picturetype_PictureTypeId`, `PictureExtension`) VALUES
(1, 'hello kitty', 'Story about manga', 'haha , kitty , how are u', 1, 0, 8, '2015-02-12 16:29:09', 1, ''),
(2, 'what'' uo', 'sdfgtfvc', 'hello world', 0, 3, 11, '2015-02-12 16:29:09', 2, ''),
(3, 'Camp fire', 'A small facebook', 'campfire', 1, 0, 10, '2015-02-12 16:29:10', 2, ''),
(4, 'happy today', 'happy ever day', 'some stupid', 1, 0, 6, '2015-02-12 16:29:10', 1, 'jpg');

-- --------------------------------------------------------

--
-- Table structure for table `picturetype`
--

CREATE TABLE IF NOT EXISTS `picturetype` (
  `PictureTypeId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `NameE` varchar(45) NOT NULL,
  `NameF` varchar(45) NOT NULL,
  PRIMARY KEY (`PictureTypeId`),
  UNIQUE KEY `PictureTypeId_UNIQUE` (`PictureTypeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `picturetype`
--

INSERT INTO `picturetype` (`PictureTypeId`, `NameE`, `NameF`) VALUES
(1, 'Profile', 'Profil'),
(2, 'Background', 'Fond'),
(3, 'Story', 'histoire'),
(4, 'Profile', 'Profil'),
(5, 'Background', 'Fond'),
(6, 'Story', 'histoire');

-- --------------------------------------------------------

--
-- Table structure for table `profileprivacytype`
--

CREATE TABLE IF NOT EXISTS `profileprivacytype` (
  `PrivacyTypeId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `NameE` tinytext NOT NULL,
  `NameF` tinytext NOT NULL,
  PRIMARY KEY (`PrivacyTypeId`),
  UNIQUE KEY `PrivacyTypeId_UNIQUE` (`PrivacyTypeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `profileprivacytype`
--

INSERT INTO `profileprivacytype` (`PrivacyTypeId`, `NameE`, `NameF`) VALUES
(1, 'Public', 'Public'),
(2, 'Private', 'Privé'),
(3, 'Friends', 'Amis'),
(4, 'Public', 'Public'),
(5, 'Private', 'Privé'),
(6, 'Friends', 'Amis');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `QuestionId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `QuestionE` tinytext NOT NULL,
  `QuestionF` tinytext NOT NULL,
  PRIMARY KEY (`QuestionId`),
  UNIQUE KEY `QuestionnaireId_UNIQUE` (`QuestionId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`QuestionId`, `QuestionE`, `QuestionF`) VALUES
(1, 'What are the most important themes discussed in your story?', 'Quels sont les thèmes les plus importants abordés dans votre histoire ?'),
(2, 'What are the challenges in your story?', 'Quels sont les défis dans votre histoire?'),
(3, 'Do you feel: included, alienated, or neutral in your story?', 'Vous sentez-vous : inclus , aliéné , ou neutre dans votre histoire ?'),
(4, 'How confident is your story about Canada''s future?', 'Comment est votre histoire confiants quant à l''avenir du Canada ?'),
(5, 'Who are the most important characters in making your vision a reality?', 'Qui sont les personnages les plus importants dans la prise de votre vision une réalité ?'),
(6, 'What genre of story is this? ', 'Quel genre d'' histoire que ce est?'),
(7, 'How often do you volunteer in your community?', 'Combien de fois avez-vous bénévole dans votre collectivité ?'),
(8, 'How often do you vote?', 'Combien de fois avez-vous voter ?'),
(9, 'What are the most important themes discussed in your story?', 'Quels sont les thèmes les plus importants abordés dans votre histoire ?'),
(10, 'What are the challenges in your story?', 'Quels sont les défis dans votre histoire?'),
(11, 'Do you feel: included, alienated, or neutral in your story?', 'Vous sentez-vous : inclus , aliéné , ou neutre dans votre histoire ?'),
(12, 'How confident is your story about Canada''s future?', 'Comment est votre histoire confiants quant à l''avenir du Canada ?'),
(13, 'Who are the most important characters in making your vision a reality?', 'Qui sont les personnages les plus importants dans la prise de votre vision une réalité ?'),
(14, 'What genre of story is this? ', 'Quel genre d'' histoire que ce est?'),
(15, 'How often do you volunteer in your community?', 'Combien de fois avez-vous bénévole dans votre collectivité ?'),
(16, 'How often do you vote?', 'Combien de fois avez-vous voter ?');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `story`
--

INSERT INTO `story` (`StoryId`, `DatePosted`, `User_UserId`, `StoryTitle`, `Content`, `Active`, `LatestChange`, `Published`, `StoryPrivacyType_StoryPrivacyTypeId`) VALUES
(6, '2015-02-04 05:40:38', 3, 'dhfdg', 'vsjnhdtrewsdbdf', 1, '2015-02-04 05:40:38', 0, 1),
(7, '2015-02-04 05:40:38', 8, 'tyrfaw', 'hello chende', 1, '2015-02-04 05:40:38', 0, 1),
(8, '2015-02-04 05:41:29', 3, 'sdf', 'hahahhaha', 1, '2015-02-04 05:41:29', 0, 1),
(9, '2015-02-04 05:41:29', 13, 'kkskdjfoiw', 'hahah chende', 1, '2015-02-04 05:41:29', 0, 3),
(10, '2015-02-12 16:37:30', 1, 'The Old Dude', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ', 1, '2015-02-12 16:37:30', 0, 1),
(11, '2015-02-12 16:37:30', 2, 'The Big Bannana', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ', 1, '2015-02-12 16:37:30', 0, 1),
(12, '2015-02-12 16:37:30', 3, 'Why Am I Here?', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ', 1, '2015-02-12 16:37:30', 0, 1),
(13, '2015-02-12 16:37:30', 4, 'Is There Really a Point', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ', 1, '2015-02-12 16:37:30', 0, 1),
(14, '2015-02-12 16:37:30', 5, 'No Reason To Stay Home', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. .', 1, '2015-02-12 16:37:30', 0, 1),
(15, '2015-02-12 16:37:30', 6, 'Falling Through The Cracks', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ', 1, '2015-02-12 16:37:30', 0, 1),
(16, '2015-02-12 16:37:30', 7, 'Is There Anyone Out There', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ', 1, '2015-02-12 16:37:30', 0, 1),
(17, '2015-02-12 16:37:30', 8, 'Canada Is My Home', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ', 1, '2015-02-12 16:37:30', 0, 1),
(18, '2015-02-12 16:37:30', 9, 'Multiculturalism, Can it Work', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ', 1, '2015-02-12 16:37:30', 0, 1),
(19, '2015-02-12 16:37:30', 10, 'Talk To Me Later', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ', 1, '2015-02-12 16:37:30', 0, 1),
(20, '2015-02-12 16:37:30', 10, 'Stephen Harper The One Man Band', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ', 1, '2015-02-12 16:37:30', 0, 1),
(21, '2015-02-12 16:37:30', 1, 'Why My Family Lives Here', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ', 1, '2015-02-12 16:37:30', 0, 1),
(22, '2015-02-12 16:37:30', 3, 'Financial Issues', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ', 1, '2015-02-12 16:37:30', 0, 1),
(23, '2015-02-12 16:37:30', 2, 'There Is No Solution', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ', 1, '2015-02-12 16:37:30', 0, 1),
(24, '2015-02-12 16:37:31', 2, 'I Love My Country', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ', 1, '2015-02-12 16:37:31', 0, 3),
(25, '2015-02-12 16:37:31', 1, 'Where Are The Workers', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. .', 1, '2015-02-12 16:37:31', 0, 3),
(26, '2015-02-12 16:37:31', 8, 'Farmers On The Rise', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ', 0, '2015-02-12 16:37:31', 0, 2),
(27, '2015-02-12 16:37:31', 9, 'Hockey Baby!', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ', 1, '2015-02-12 16:37:31', 0, 2),
(28, '2015-02-12 16:37:31', 4, 'Politics 101', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ', 0, '2015-02-12 16:37:31', 0, 2),
(29, '2015-02-12 16:37:31', 1, 'This Is My Opinion', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu tortor nunc. Curabitur elit massa, dignissim dapibus diam quis, pulvinar facilisis quam. Quisque at tellus rhoncus, aliquam enim at, finibus augue. Duis ultricies fringilla leo, a finibus enim bibendum ut. Vestibulum sagittis felis ipsum, ut consequat sapien ultricies quis. Integer vel ligula in velit lacinia posuere. Etiam vestibulum efficitur rhoncus. Nulla laoreet lectus in facilisis malesuada. Phasellus ut imperdiet orci. In hac habitasse platea dictumst. Praesent eu tellus a ante pellentesque euismod a id risus. Nam malesuada diam ac congue consequat. Pellentesque sit amet laoreet magna. Fusce pellentesque congue mi, at tristique lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut vel turpis in enim iaculis commodo. ', 1, '2015-02-12 16:37:31', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `storylink`
--

CREATE TABLE IF NOT EXISTS `storylink` (
  `Story_ParentStoryId` int(10) unsigned NOT NULL,
  `Story_StoryId` int(10) unsigned NOT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Story_ParentStoryId`,`Story_StoryId`),
  KEY `fk_StoryLink_Story1_idx` (`Story_ParentStoryId`),
  KEY `fk_StoryLink_Story2_idx` (`Story_StoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `storylink`
--

INSERT INTO `storylink` (`Story_ParentStoryId`, `Story_StoryId`, `TimeStamp`) VALUES
(6, 7, '2015-02-12 16:30:06'),
(6, 8, '2015-02-12 16:43:51'),
(6, 9, '2015-02-12 16:30:06'),
(6, 11, '2015-02-12 16:43:51'),
(7, 8, '2015-02-12 16:30:06'),
(7, 18, '2015-02-12 16:44:15'),
(8, 9, '2015-02-12 16:30:06'),
(8, 17, '2015-02-12 16:44:30'),
(8, 19, '2015-02-12 16:44:30'),
(8, 20, '2015-02-12 16:44:30'),
(9, 6, '2015-02-12 16:30:06'),
(11, 9, '2015-02-12 16:44:15'),
(11, 12, '2015-02-12 16:44:16'),
(11, 14, '2015-02-12 16:44:30'),
(20, 15, '2015-02-12 16:44:30'),
(20, 18, '2015-02-12 16:44:30');

-- --------------------------------------------------------

--
-- Table structure for table `storyprivacytype`
--

CREATE TABLE IF NOT EXISTS `storyprivacytype` (
  `StoryPrivacyTypeId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `NameE` tinytext NOT NULL,
  `NameF` tinytext NOT NULL,
  PRIMARY KEY (`StoryPrivacyTypeId`),
  UNIQUE KEY `StoryPrivacyTypeId_UNIQUE` (`StoryPrivacyTypeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `storyprivacytype`
--

INSERT INTO `storyprivacytype` (`StoryPrivacyTypeId`, `NameE`, `NameF`) VALUES
(1, 'Public', 'Public'),
(2, 'Private', 'Privé'),
(3, 'Friends', 'Amis'),
(4, 'Public', 'Public'),
(5, 'Private', 'Privé'),
(6, 'Friends', 'Amis');

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
(6, 1, 1, '2015-02-12 17:20:39'),
(7, 5, 1, '2015-02-12 17:34:58'),
(8, 9, 1, '2015-02-12 17:34:58'),
(9, 11, 1, '2015-02-12 17:34:58'),
(10, 10, 1, '2015-02-12 17:34:58'),
(11, 1, 1, '2015-02-12 17:34:58'),
(12, 1, 1, '2015-02-12 17:34:58'),
(13, 1, 1, '2015-02-12 17:34:58'),
(14, 1, 1, '2015-02-12 17:34:58'),
(15, 1, 1, '2015-02-12 17:34:58'),
(16, 1, 1, '2015-02-12 17:34:58');

-- --------------------------------------------------------

--
-- Table structure for table `story_has_picture`
--

CREATE TABLE IF NOT EXISTS `story_has_picture` (
  `story_StoryId` int(10) unsigned NOT NULL,
  `PictureId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`story_StoryId`,`PictureId`),
  KEY `fk_story_has_picture_story1_idx` (`story_StoryId`),
  KEY `fk_story_has_picture_picture_idx` (`PictureId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `story_has_picture`
--

INSERT INTO `story_has_picture` (`story_StoryId`, `PictureId`) VALUES
(6, 1),
(7, 1),
(7, 2),
(8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `story_has_tag`
--

CREATE TABLE IF NOT EXISTS `story_has_tag` (
  `Story_StoryId` int(10) unsigned NOT NULL,
  `Tag_TagId` int(10) unsigned NOT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Story_StoryId`,`Tag_TagId`),
  KEY `fk_Story_Tag_Story1_idx` (`Story_StoryId`),
  KEY `fk_Story_Tag_Tag1_idx` (`Tag_TagId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `story_has_tag`
--

INSERT INTO `story_has_tag` (`Story_StoryId`, `Tag_TagId`, `TimeStamp`) VALUES
(6, 1, '2015-02-12 16:35:57'),
(6, 7, '2015-02-12 16:35:57'),
(7, 2, '2015-02-12 16:35:57'),
(8, 4, '2015-02-12 16:35:57'),
(9, 7, '2015-02-12 16:35:57');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `TagId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `NameE` varchar(45) NOT NULL,
  `NameF` varchar(45) NOT NULL,
  PRIMARY KEY (`TagId`),
  UNIQUE KEY `TagId_UNIQUE` (`TagId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`TagId`, `NameE`, `NameF`) VALUES
(1, 'Art', 'Art'),
(2, 'Challenges', 'Défis'),
(3, 'Climate/Weather', 'Climat/Temps'),
(4, 'Environment', 'Environnement'),
(5, 'Family', 'Famille'),
(6, 'Leadership', 'Leadership'),
(7, 'Technology', 'Technologie'),
(8, 'Uncategorized', 'Non classé'),
(9, 'Art', 'Art'),
(10, 'Challenges', 'Défis'),
(11, 'Climate/Weather', 'Climat/Temps'),
(12, 'Environment', 'Environnement'),
(13, 'Family', 'Famille'),
(14, 'Leadership', 'Leadership'),
(15, 'Technology', 'Technologie'),
(16, 'Uncategorized', 'Non classé');

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
  `Birthday` date DEFAULT NULL,
  `Gender` varchar(45) DEFAULT NULL,
  `Ethnicity` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`UserId`),
  UNIQUE KEY `userId_UNIQUE` (`UserId`),
  UNIQUE KEY `email_UNIQUE` (`Email`),
  KEY `fk_User_AchievementLevelType1_idx` (`AchievementLevelType_LevelId`),
  KEY `fk_User_LanguageType1_idx` (`LanguageType_LanguageId`),
  KEY `fk_user_ProfilePrivacyType1_idx` (`ProfilePrivacyType_PrivacyTypeId`),
  FULLTEXT KEY `search_index` (`Email`,`FirstName`,`LastName`,`MidName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserId`, `Email`, `Password`, `RegisterDate`, `AchievementLevelType_LevelId`, `Address`, `PostalCode`, `Notes`, `FirstName`, `MidName`, `LastName`, `LanguageType_LanguageId`, `Active`, `AdminFlag`, `VerifiedEmail`, `PhoneNumber`, `VerificationCode`, `FailedLoginAttempt`, `LockoutTimes`, `ProfilePrivacyType_PrivacyTypeId`, `Rejected`, `Birthday`, `Gender`, `Ethnicity`) VALUES
(1, 'josh@campfire.com', '$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2', '2015-02-12 16:27:32', 1, '123 Fake Street', 'K2J4B8', NULL, 'Josh', '', 'de Vries', 1, 1, 1, 1, '6132551111', NULL, NULL, NULL, 1, 0, NULL, NULL, NULL),
(2, 'chenda@campfire.com', '$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2', '2015-02-12 16:27:32', 1, '123 Fake Street', 'K2J4B8', NULL, 'Chenda', '', 'Houeng', 1, 1, 1, 1, '6132551111', NULL, NULL, NULL, 2, 0, NULL, NULL, NULL),
(3, 'yougen@campfire.com', '$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2', '2015-02-12 16:27:32', 1, '123 Fake Street', 'K2J4B8', NULL, 'Yougen', '', 'Xue', 1, 1, 1, 1, '6132551111', NULL, NULL, NULL, 1, 0, NULL, NULL, NULL),
(4, 'jacob@campfire.com', '$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2', '2015-02-12 16:27:32', 1, '123 Fake Street', 'K2J4B8', NULL, 'Jacob', '', 'Trembletski', 1, 1, 1, 1, '6132551111', NULL, NULL, NULL, 3, 0, NULL, NULL, NULL),
(5, 'brian@campfire.com', '$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2', '2015-02-12 16:27:32', 1, '123 Fake Street', 'K2J4B8', NULL, 'Brain', '', 'Meagher', 1, 1, 1, 1, '6132551111', NULL, NULL, NULL, 1, 0, NULL, NULL, NULL),
(6, 'darren@campfire.com', '$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2', '2015-02-12 16:27:32', 1, '123 Fake Street', 'K2J4B8', NULL, 'Darren', '', 'Caldwell', 1, 1, 1, 1, '6132551111', NULL, NULL, NULL, 2, 0, NULL, NULL, NULL),
(7, 'jeff@campfire.com', '$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2', '2015-02-12 16:27:32', 1, '123 Fake Street', 'K2J4B8', NULL, 'Jeff', '', 'Johnson', 1, 1, 0, 1, '6132551111', NULL, NULL, NULL, 1, 0, NULL, NULL, NULL),
(8, 'brad@campfire.com', '$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2', '2015-02-12 16:27:32', 1, '123 Fake Street', 'K2J4B8', NULL, 'Brad', '', 'Bradly', 1, 1, 0, 1, '6132551111', NULL, NULL, NULL, 1, 0, NULL, NULL, NULL),
(9, 'alana@campfire.com', '$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2', '2015-02-12 16:27:32', 1, '123 Fake Street', 'K2J4B8', NULL, 'Alana', '', 'Bauer', 1, 1, 0, 1, '6132551111', NULL, NULL, NULL, 1, 0, NULL, NULL, NULL),
(10, 'kelsey@campfire.com', '$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2', '2015-02-12 16:27:33', 1, '123 Fake Street', 'K2J4B8', NULL, 'Kelsey', '', 'Smith', 1, 1, 0, 1, '6132551111', NULL, NULL, NULL, 1, 0, NULL, NULL, NULL),
(11, 'blane@campfire.com', '$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2', '2015-02-12 16:27:33', 1, '123 Fake Street', 'K2J4B8', NULL, 'Blane', '', 'Black', 1, 0, 0, 1, '6132551111', NULL, NULL, NULL, 1, 0, NULL, NULL, NULL),
(12, 'barney@campfire.com', '$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2', '2015-02-12 16:27:33', 1, '123 Fake Street', 'K2J4B8', NULL, 'Barney', '', 'Smojic', 1, 0, 0, 1, '6132551111', NULL, NULL, NULL, 1, 0, NULL, NULL, NULL),
(13, 'jenkins@campfire.com', '$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2', '2015-02-12 16:27:33', 1, '123 Fake Street', 'K2J4B8', NULL, 'Jenkins', '', 'Tremblay', 1, 1, 0, 0, '6132551111', NULL, NULL, NULL, 1, 0, NULL, NULL, NULL),
(14, 'olga@campfire.com', '$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2', '2015-02-12 16:27:33', 1, '123 Fake Street', 'K2J4B8', NULL, 'Olga', '', 'Ralph', 1, 1, 0, 0, '6132551111', NULL, NULL, NULL, 1, 0, NULL, NULL, NULL);

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
  `ActionStatement` tinytext NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Id_UNIQUE` (`Id`),
  KEY `fk_ActionStatement_user1_idx` (`user_UserId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `useractionstatement`
--

INSERT INTO `useractionstatement` (`Id`, `user_UserId`, `Active`, `DateCreated`, `DateDeactived`, `ActionStatement`) VALUES
(1, 7, 1, '2015-02-12 17:31:21', NULL, 'Old brother want to change this world.'),
(2, 8, 1, '2015-02-12 17:31:21', NULL, 'Not a problem. Let''s go and see.'),
(3, 9, 1, '2015-02-12 17:44:01', NULL, 'Faster is not equal better.'),
(4, 12, 1, '2015-02-12 17:46:09', NULL, 'Hope and wait.'),
(5, 8, 0, '2015-02-12 17:46:09', NULL, 'Laugh out loudly will change you life.');

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
(2, 1, '2015-02-12 16:35:56'),
(4, 2, '2015-02-12 16:35:56'),
(5, 1, '2015-02-12 16:35:56'),
(8, 2, '2015-02-12 16:35:56'),
(9, 2, '2015-02-12 16:35:56'),
(10, 1, '2015-02-12 16:35:56'),
(10, 2, '2015-02-12 16:35:56'),
(11, 2, '2015-02-12 16:35:56'),
(14, 1, '2015-02-12 16:35:56'),
(14, 2, '2015-02-12 16:35:56');

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
(1, 8, '2015-02-12 16:49:59', 1),
(1, 10, '2015-02-12 16:50:00', 1),
(1, 11, '2015-02-12 16:46:28', 1),
(1, 12, '2015-02-12 16:49:59', 1),
(1, 18, '2015-02-12 16:50:00', 1),
(2, 6, '2015-02-12 16:50:00', 1),
(2, 8, '2015-02-12 16:50:00', 1),
(2, 10, '2015-02-12 16:50:00', 0),
(2, 11, '2015-02-12 16:50:00', 1),
(2, 26, '2015-02-12 16:50:00', 1),
(4, 6, '2015-02-04 02:50:12', 1),
(7, 9, '2015-02-04 02:50:12', 1),
(7, 11, '2015-02-12 16:52:01', 0),
(7, 15, '2015-02-12 16:52:02', 0),
(7, 16, '2015-02-12 16:52:02', 1),
(7, 17, '2015-02-12 16:52:02', 1),
(10, 8, '2015-02-04 02:50:12', 1),
(11, 10, '2015-02-12 16:51:36', 1),
(11, 11, '2015-02-12 16:50:00', 0),
(11, 21, '2015-02-12 16:51:36', 1),
(11, 24, '2015-02-12 16:51:36', 1),
(12, 7, '2015-02-04 02:50:12', 1),
(12, 11, '2015-02-12 16:51:36', 0),
(12, 15, '2015-02-12 16:51:36', 1),
(12, 16, '2015-02-12 16:51:36', 1),
(12, 21, '2015-02-12 16:52:01', 1),
(13, 6, '2015-02-04 02:50:12', 0);

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
