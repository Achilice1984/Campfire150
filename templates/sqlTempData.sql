
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

--
-- Insert into PictureType table
--

INSERT INTO PictureType (NameE, NameF)
VALUES ("Profile", "Profil");
INSERT INTO PictureType (NameE, NameF)
VALUES ("Background", "Fond");

--
-- Insert into User table
--
-- All passwords == 123456
--

INSERT INTO User (Email, Password, Address, PostalCode, PhoneNumber, FirstName, LastName, MidName, Active, AdminFlag, Verified)
VALUES ("josh@campfire.com", "$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2", "123 Fake Street", "K2J4B8", "6132551111", "Josh", "de Vries", "", TRUE, TRUE, TRUE);
INSERT INTO User (Email, Password, Address, PostalCode, PhoneNumber, FirstName, LastName, MidName, Active, AdminFlag, Verified)
VALUES ("chenda@campfire.com", "$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2", "123 Fake Street", "K2J4B8", "6132551111", "Chenda", "Houeng", "", TRUE, TRUE, TRUE);
INSERT INTO User (Email, Password, Address, PostalCode, PhoneNumber, FirstName, LastName, MidName, Active, AdminFlag, Verified)
VALUES ("yougen@campfire.com", "$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2", "123 Fake Street", "K2J4B8", "6132551111", "Yougen", "Xue", "", TRUE, TRUE, TRUE);
INSERT INTO User (Email, Password, Address, PostalCode, PhoneNumber, FirstName, LastName, MidName, Active, AdminFlag, Verified)
VALUES ("jacob@campfire.com", "$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2", "123 Fake Street", "K2J4B8", "6132551111", "Jacob", "Trembletski", "", TRUE, TRUE, TRUE);
INSERT INTO User (Email, Password, Address, PostalCode, PhoneNumber, FirstName, LastName, MidName, Active, AdminFlag, Verified)
VALUES ("brian@campfire.com", "$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2", "123 Fake Street", "K2J4B8", "6132551111", "Brain", "Meagher", "", TRUE, TRUE, TRUE);
INSERT INTO User (Email, Password, Address, PostalCode, PhoneNumber, FirstName, LastName, MidName, Active, AdminFlag, Verified)
VALUES ("darren@campfire.com", "$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2", "123 Fake Street", "K2J4B8", "6132551111", "Darren", "Caldwell", "", TRUE, TRUE, TRUE);

INSERT INTO User (Email, Password, Address, PostalCode, PhoneNumber, FirstName, LastName, MidName, Active, AdminFlag, Verified)
VALUES ("jeff@campfire.com", "$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2", "123 Fake Street", "K2J4B8", "6132551111", "Jeff", "Johnson", "", TRUE, FLASE, TRUE);
INSERT INTO User (Email, Password, Address, PostalCode, PhoneNumber, FirstName, LastName, MidName, Active, AdminFlag, Verified)
VALUES ("brad@campfire.com", "$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2", "123 Fake Street", "K2J4B8", "6132551111", "Brad", "Bradly", "", TRUE, FALSE, TRUE);
INSERT INTO User (Email, Password, Address, PostalCode, PhoneNumber, FirstName, LastName, MidName, Active, AdminFlag, Verified)
VALUES ("alana@campfire.com", "$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2", "123 Fake Street", "K2J4B8", "6132551111", "Alana", "Bauer", "", TRUE, FALSE, TRUE);
INSERT INTO User (Email, Password, Address, PostalCode, PhoneNumber, FirstName, LastName, MidName, Active, AdminFlag, Verified)
VALUES ("kelsey@campfire.com", "$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2", "123 Fake Street", "K2J4B8", "6132551111", "Kelsey", "Smith", "", TRUE, FALSE, TRUE);

INSERT INTO User (Email, Password, Address, PostalCode, PhoneNumber, FirstName, LastName, MidName, Active, AdminFlag, Verified)
VALUES ("blane@campfire.com", "$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2", "123 Fake Street", "K2J4B8", "6132551111", "Blane", "Black", "", FALSE, FLASE, TRUE);
INSERT INTO User (Email, Password, Address, PostalCode, PhoneNumber, FirstName, LastName, MidName, Active, AdminFlag, Verified)
VALUES ("barney@campfire.com", "$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2", "123 Fake Street", "K2J4B8", "6132551111", "Barney", "Smojic", "", FALSE, FALSE, TRUE);
INSERT INTO User (Email, Password, Address, PostalCode, PhoneNumber, FirstName, LastName, MidName, Active, AdminFlag, Verified)
VALUES ("jenkins@campfire.com", "$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2", "123 Fake Street", "K2J4B8", "6132551111", "Jenkins", "Tremblay", "", TRUE, FALSE, FALSE);
INSERT INTO User (Email, Password, Address, PostalCode, PhoneNumber, FirstName, LastName, MidName, Active, AdminFlag, Verified)
VALUES ("olga@campfire.com", "$2y$10$MBaV5Rm/j7ydZxOGXR5FFOcjFf.8oaYS2CTaBZawL2rHtZM/SyiK2", "123 Fake Street", "K2J4B8", "6132551111", "Olga", "Ralph", "", TRUE, FALSE, FALSE);
