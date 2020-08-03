USE spacemy;

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `blog_comments`;
CREATE TABLE `blog_comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `blog` int NOT NULL,
  `author` int NOT NULL,
  `text` text NOT NULL,
  `date` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `blogs`;
CREATE TABLE `blogs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `author` int NOT NULL,
  `title` text NOT NULL,
  `date` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `friends`;
CREATE TABLE `friends` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sender` int NOT NULL,
  `recipient` int NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `group_comments`;
CREATE TABLE `group_comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `group` int NOT NULL,
  `author` int NOT NULL,
  `date` int NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `owner` int NOT NULL,
  `date` int NOT NULL,
  `shout` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `invite_keys`;
CREATE TABLE `invite_keys` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uses` int NOT NULL,
  `max_uses` int NOT NULL,
  `creator` int NOT NULL,
  `key` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `user_comments`;
CREATE TABLE `user_comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user` int NOT NULL,
  `author` int NOT NULL,
  `text` text NOT NULL,
  `date` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `created` int NOT NULL,
  `last_active` int NOT NULL,
  `nickname` text NOT NULL,
  `stylesheet` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `current_group` int NOT NULL DEFAULT '-1',
  `pronouns` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'xe/xim',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;