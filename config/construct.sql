DROP SCHEMA IF EXISTS `database01`;
CREATE SCHEMA IF NOT EXISTS `database01` DEFAULT CHARACTER SET utf8;
USE `database01`;

CREATE TABLE `User` (
	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	username varchar(200) NOT NULL,
	email varchar(200) NOT NULL,
	passwd text NOT NULL);


/*CREATE TABLE `picture` (
  `image` LONGBLOB NOT NULL,
  `comment` TEXT NOT NULL,
  `like` TEXT NOT NULL,
  `email` TEXT NOT NULL,
  PRIMARY KEY (`email`(128)))
  ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Pictures';*/


