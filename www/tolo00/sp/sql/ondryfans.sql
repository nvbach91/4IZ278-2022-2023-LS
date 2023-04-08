-- Adminer 4.8.1 MySQL 5.7.32-log dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_account_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `parent_comment_id` int(11) DEFAULT NULL,
  `text` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526C4B89032C` (`post_id`),
  KEY `IDX_9474526CBF2AF943` (`parent_comment_id`),
  KEY `IDX_9474526C3C0C9956` (`user_account_id`),
  CONSTRAINT `FK_9474526C3C0C9956` FOREIGN KEY (`user_account_id`) REFERENCES `user_account` (`id`),
  CONSTRAINT `FK_9474526C4B89032C` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  CONSTRAINT `FK_9474526CBF2AF943` FOREIGN KEY (`parent_comment_id`) REFERENCES `comment` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `comment` (`id`, `user_account_id`, `post_id`, `parent_comment_id`, `text`, `date_created`) VALUES
(54,	2,	9,	NULL,	'Ale i tak je to super, nemůžu si pomoct! ',	'2023-04-08 13:43:27'),
(55,	1,	9,	54,	'Děkuji sám sobě z admin účtu za krásný komentář.',	'2023-04-08 13:44:22'),
(62,	3,	9,	54,	'Perfektnííííí',	'2023-04-08 14:58:50'),
(63,	4,	10,	NULL,	'Topová fotka!',	'2023-04-08 15:12:56'),
(64,	4,	9,	54,	'Ondro, jestli někdo umí programovat appky, tak to není chuck norris, ale outý - Ondra Tölg! Moje škola se prostě pozná!',	'2023-04-08 15:14:14');

DROP TABLE IF EXISTS `comment_like`;
CREATE TABLE `comment_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) DEFAULT NULL,
  `user_account_id` int(11) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8A55E25FF8697D13` (`comment_id`),
  KEY `IDX_8A55E25F3C0C9956` (`user_account_id`),
  CONSTRAINT `FK_8A55E25F3C0C9956` FOREIGN KEY (`user_account_id`) REFERENCES `user_account` (`id`),
  CONSTRAINT `FK_8A55E25FF8697D13` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `comment_like` (`id`, `comment_id`, `user_account_id`, `date_created`) VALUES
(31,	54,	2,	'2023-04-08 13:43:37'),
(32,	54,	1,	'2023-04-08 13:44:24'),
(33,	55,	4,	'2023-04-08 15:13:16'),
(35,	62,	4,	'2023-04-08 15:13:18'),
(36,	64,	4,	'2023-04-08 15:14:20'),
(37,	64,	1,	'2023-04-08 15:19:36');

DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_account_id` int(11) DEFAULT NULL,
  `post_photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5A8A6C8D3C0C9956` (`user_account_id`),
  CONSTRAINT `FK_5A8A6C8D3C0C9956` FOREIGN KEY (`user_account_id`) REFERENCES `user_account` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `post` (`id`, `user_account_id`, `post_photo`, `text`, `date_created`) VALUES
(6,	NULL,	'cfyaxffe8fgyua6cj3ji.jpg',	'AI \"MidJourney\" mi vygenerovala tenhle krásný obrázek na základě fotky, kterou jsem jí poskytl. Docela cool, ne?',	'2023-04-08 13:19:31'),
(7,	NULL,	'yli35b5noetooxr7h32k.jpg',	'Snímek z nahrávání coveru na song z mého oblíbeného filmu \"Whiplash\". S výsledkem jsem nadmíru spokojen!',	'2023-04-08 13:24:56'),
(8,	NULL,	's3h8y31qb4l6km2q26jm.jpg',	'Výsledek přegenerování 2d loga pomocí AI budoucí herní společnosti. Neskutečné co to všechno dokáže.',	'2023-04-08 13:26:28'),
(9,	NULL,	'zsugw2ly6hhitxndnddf.jpg',	'Promo obrázek budoucího herního serveru \"Los Santos Zombie Apocalypse\". Neskutečně atmosférické! Avšak AI má docela problém s generováním rukou a objektů, které v nich člověk běží. Zatím nevím jak problém vyřešit.',	'2023-04-08 13:28:23'),
(10,	NULL,	'oywyx5imtw8iy87mknc3.jpg',	'Můj nejoblíbenější obrázek vygenerovaný AI. Mega dobrý.',	'2023-04-08 13:49:52');

DROP TABLE IF EXISTS `post_like`;
CREATE TABLE `post_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `user_account_id` int(11) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_653627B84B89032C` (`post_id`),
  KEY `IDX_653627B83C0C9956` (`user_account_id`),
  CONSTRAINT `FK_653627B83C0C9956` FOREIGN KEY (`user_account_id`) REFERENCES `user_account` (`id`),
  CONSTRAINT `FK_653627B84B89032C` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `post_like` (`id`, `post_id`, `user_account_id`, `date_created`) VALUES
(32,	9,	1,	'2023-04-08 15:19:40');

DROP TABLE IF EXISTS `post_topic`;
CREATE TABLE `post_topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `post_topic` (`id`, `title`, `color`) VALUES
(1,	'#gaming',	'#00f028'),
(3,	'#art',	'#fe1650'),
(4,	'#lifestyle',	'#00afdb'),
(5,	'#ai',	'#c20000'),
(6,	'#music',	'#c200db');

DROP TABLE IF EXISTS `post_to_topic`;
CREATE TABLE `post_to_topic` (
  `post_id` int(11) NOT NULL,
  `post_topic_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`,`post_topic_id`),
  KEY `IDX_2991668A4B89032C` (`post_id`),
  KEY `IDX_2991668AA0B8A99C` (`post_topic_id`),
  CONSTRAINT `FK_2991668A4B89032C` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_2991668AA0B8A99C` FOREIGN KEY (`post_topic_id`) REFERENCES `post_topic` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `post_to_topic` (`post_id`, `post_topic_id`) VALUES
(6,	3),
(6,	5),
(7,	3),
(7,	4),
(7,	6),
(8,	1),
(8,	3),
(9,	1),
(9,	3),
(9,	5),
(10,	1),
(10,	3),
(10,	5);

DROP TABLE IF EXISTS `user_account`;
CREATE TABLE `user_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profile_photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `user_account` (`id`, `role`, `username`, `profile_photo`, `email`, `password`) VALUES
(1,	'admin',	'Ondřej Tölg',	'admin.png',	'tolgicraft@gmail.com',	'$2y$10$09fOG0WPZMaElo7reF6/Becrvu5u8kWXKp3nIbo4fI1MESlDR7bjK'),
(2,	'user',	'Ondra Tölg',	'bsgqkqlna5h6jhekua55.jpg',	'ondratolg@seznam.cz',	'6071515736220159'),
(3,	'user',	'Dagmar Tölgová',	'ccgr80ddcfupj1du54h4.jpg',	'merlotka13@seznam.cz',	'947835749587465'),
(4,	'user',	'Honza Tölg',	'2kpbn6r5vep33nhsrlhb.jpg',	'creasser@gmail.com',	'10230539807225841');

-- 2023-04-08 13:22:23
