-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `jumbotron` text COLLATE utf8_czech_ci NOT NULL,
  `content` longtext COLLATE utf8_czech_ci NOT NULL,
  `updatedAt` datetime NOT NULL,
  `createdAt` datetime NOT NULL,
  `lang` enum('en','cz') COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `page` (`id`, `page_name`, `title`, `jumbotron`, `content`, `updatedAt`, `createdAt`, `lang`) VALUES
(5,	'o-nas',	'O nás 1',	'<p>Popis</p>',	'<p>Kontent</p>',	'2016-12-05 09:06:29',	'2016-12-05 08:26:26',	'cz'),
(6,	'kontakt',	'Kontakt',	'<p>Kontakt</p>',	'<p>Kontakt</p>',	'2016-12-05 09:11:38',	'2016-12-05 09:11:38',	'cz');

-- 2016-12-05 08:13:58