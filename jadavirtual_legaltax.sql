-- phpMyAdmin SQL Dump
-- version 3.3.2deb1ubuntu1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 26, 2014 at 12:49 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.2-1ubuntu4.20

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jadavirtual_legaltax`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reg_nr` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `person` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `reg_nr`, `adress`, `phone`, `email`, `person`) VALUES
(2, 'Web Skola', '165646513546', 'Kr.Barona iela 32-8, Riga, LV-1011', '27770074', 'info@webskola.lv', 'Nikita Seleckis'),
(3, 'SIA JADA', 'LV40103423293', 'Kr.Barona iela 32-8, Riga, LV-1011', '+37127770074', '', 'Janis Dabins'),
(4, 'SIA testaklients', '24543543543', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rek_nr` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rek_datums` date NOT NULL,
  `piegadatajs` int(11) NOT NULL,
  `klients` int(11) NOT NULL,
  `kopa` decimal(10,2) NOT NULL,
  `pvn` decimal(10,2) NOT NULL,
  `sum_kopa` decimal(10,2) NOT NULL,
  `no` date NOT NULL,
  `lidz` date NOT NULL,
  `pamats` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apmaksas_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apmaksas_termins` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valde` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tips` int(2) NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `rek_nr`, `rek_datums`, `piegadatajs`, `klients`, `kopa`, `pvn`, `sum_kopa`, `no`, `lidz`, `pamats`, `apmaksas_type`, `apmaksas_termins`, `valde`, `tips`, `status`) VALUES
(15, '565365351', '2014-04-15', 0, 3, '182.00', '38.22', '220.22', '2014-04-16', '2014-04-18', 'yjygjyjygj', 'ar  parskaite', '10 diena laika', 'E.Krauklis', 1, 1),
(20, 'test', '2014-04-15', 0, 2, '210.00', '44.10', '254.10', '2014-04-07', '2014-04-08', '', '', '', 'E.Krauklis', 2, 1),
(21, 'test1', '2014-04-15', 0, 2, '180.00', '37.80', '217.80', '2014-04-16', '2014-04-18', 'yjygjyjygj', 'ar  parskaite', '10 diena laika', 'E.Krauklis', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_data`
--

CREATE TABLE IF NOT EXISTS `invoice_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_invoice` int(11) NOT NULL,
  `nr` int(11) NOT NULL,
  `lieta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datums` date NOT NULL,
  `datums_lidz` date NOT NULL,
  `apraksts` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time` int(11) NOT NULL,
  `cena` decimal(10,2) NOT NULL,
  `sum` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=61 ;

--
-- Dumping data for table `invoice_data`
--

INSERT INTO `invoice_data` (`id`, `id_invoice`, `nr`, `lieta`, `datums`, `datums_lidz`, `apraksts`, `type`, `time`, `cena`, `sum`, `date`) VALUES
(55, 15, 1, 'VID Aizstaviba', '2014-04-07', '0000-00-00', 'dfgdfgdf', 'stunda', 2, '15.00', '30.00', '2014-04-17'),
(56, 15, 2, 'VID Aizstaviba', '2014-04-08', '0000-00-00', 'gfdghjdfkgfdgdf', 'stunda', 5, '22.00', '110.00', '2014-04-17'),
(57, 15, 3, 'Gramatvediba', '2014-04-07', '0000-00-00', '', 'stunda', 2, '21.00', '42.00', '2014-04-17'),
(59, 20, 1, 'Juridiskie pakalpojumi', '2014-04-07', '2014-04-08', '', 'stunda', 7, '30.00', '210.00', '2014-04-17'),
(60, 21, 1, 'Juridiskie pakalpojumi', '2014-04-16', '2014-04-17', '', 'stunda', 9, '20.00', '180.00', '2014-04-17');

-- --------------------------------------------------------

--
-- Table structure for table `lieta`
--

CREATE TABLE IF NOT EXISTS `lieta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `info` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `lieta`
--

INSERT INTO `lieta` (`id`, `name`, `info`) VALUES
(1, 'VID Aizstaviba', 'Bllalalalalalal'),
(2, 'Gramatvediba', '<p>Yep some intro text about gramatvedibas.</p>\r\n'),
(3, 'Testalieta', '<p>&Scaron;is ir testa lietas teksts</p>\n');

-- --------------------------------------------------------

--
-- Table structure for table `prioritate`
--

CREATE TABLE IF NOT EXISTS `prioritate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `prioritate`
--

INSERT INTO `prioritate` (`id`, `name`) VALUES
(4, 'Steidzama'),
(5, 'Normāla');

-- --------------------------------------------------------

--
-- Table structure for table `sadala`
--

CREATE TABLE IF NOT EXISTS `sadala` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sadala`
--

INSERT INTO `sadala` (`id`, `name`) VALUES
(1, 'Klienti'),
(2, 'Darbinieki'),
(4, 'Parastie Uzdevumi');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(3, 'Pabeigts'),
(4, 'Aktivs'),
(5, 'Procesā');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sadala` int(11) NOT NULL,
  `klients` int(11) NOT NULL,
  `lieta` int(11) NOT NULL,
  `uzdevums` text COLLATE utf8_unicode_ci NOT NULL,
  `izpildes_gaita` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `prioritate` int(11) NOT NULL,
  `privats` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL,
  `termins` date NOT NULL,
  `add_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `sadala`, `klients`, `lieta`, `uzdevums`, `izpildes_gaita`, `status`, `prioritate`, `privats`, `termins`, `add_date`) VALUES
(1, 'First uzdevums', 4, 3, 2, '<p>HHHaaahahah nbsp;<img alt="sad" src="http://localhost/assets/jadmin/js/ckeditor/plugins/smiley/images/sad_smile.png" title="" /><img alt="laugh" src="http://localhost/assets/jadmin/js/ckeditor/plugins/smiley/images/teeth_smile.png" title="laugh" /></p>\n', '<p>Saku taisit so uzdevumu!</p>\r\n', 0, 0, 'Yes', '2014-04-21', '0000-00-00'),
(2, 'Kaut kads uzdevums', 4, 3, 1, '<p>Nuia vajag sataisit sito un sito</p>\n\n<p>Nuia vajag sataisit sito un sito</p>\n\n<p>Nuia vajag sataisit sito un sito</p>\n\n<p>Nuia vajag sataisit sito un sito</p>\n\n<p>Nuia vajag sataisit sito un sito</p>\n\n<p>Nuia vajag sataisit sito un sito</p>\n\n<p>Nuia vajag sataisit sito un sito</p>\n', '', 3, 0, 'No', '2014-04-16', '0000-00-00'),
(3, 'Brauciens ar velosipadi', 4, 0, 1, '<p>Braucam ar riteni =)</p>\n', '', 4, 0, 'Yes', '2014-04-30', '2014-04-04'),
(4, 'testauzdevumsadminam', 1, 3, 2, '<p>&Scaron;is ir uzdevuma teksts</p>\n', '', 0, 0, 'No', '2014-04-18', '2014-04-17'),
(5, 'testa uzdevums', 1, 2, 1, '<p>&Scaron;is ir uzdevuma teksts</p>\n', '', 0, 0, 'No', '2014-04-18', '2014-04-17'),
(7, 'testa uzdevums', 4, 3, 2, '<p>&Scaron;is ir uzdevuma teksts</p>\n', '<p>&Scaron;ī ir izpildes gaita</p>\n', 3, 0, 'Yes', '2014-04-30', '2014-04-17'),
(8, 'testa uzdevums2', 4, 3, 3, '<p>hgfhgfhgf</p>\n', '', 5, 5, 'No', '0000-00-00', '2014-04-17'),
(9, '123', 4, 4, 3, '<p>Hello <strong><span >THIS!</span></strong></p>\n', '', 4, 5, 'Yes', '2014-04-22', '2014-04-22'),
(10, 'Jauns uzdevums', 4, 3, 3, '<p>test</p>\n', '', 3, 4, 'Yes', '2014-04-24', '2014-04-23');

-- --------------------------------------------------------

--
-- Table structure for table `task_users`
--

CREATE TABLE IF NOT EXISTS `task_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=75 ;

--
-- Dumping data for table `task_users`
--

INSERT INTO `task_users` (`id`, `task_id`, `user_id`, `type`) VALUES
(43, 9, 3, 2),
(44, 9, 3, 1),
(45, 9, 1, 1),
(46, 8, 3, 2),
(47, 8, 4, 1),
(48, 1, 1, 2),
(49, 1, 3, 1),
(50, 2, 1, 2),
(51, 2, 4, 1),
(52, 2, 3, 1),
(53, 2, 1, 1),
(54, 3, 3, 2),
(55, 3, 4, 1),
(56, 3, 3, 1),
(57, 3, 1, 1),
(58, 4, 3, 2),
(59, 4, 4, 1),
(60, 4, 3, 1),
(61, 4, 1, 1),
(62, 5, 4, 2),
(63, 5, 1, 1),
(64, 7, 3, 2),
(65, 7, 1, 1),
(72, 10, 1, 2),
(73, 10, 4, 1),
(74, 10, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '\0\0', 'administrator', '06470a0fe8139b6ee44c4cc12af6fc03444c0f7e', '9462e8eee0', 'admin@admin.com', '', NULL, NULL, '9d029802e28cd9c768e8e62277c0df49ec65c48c', 1268889823, 1398440792, 1, 'Admin', 'Adminovich1', 'ADMIN', '27770074'),
(3, '\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0', 'kirgudu123', '70177d2aae502613d98a2256ffd9d69b1809bf6c', NULL, 'kirgudu12@gmail.com', NULL, NULL, NULL, NULL, 1395402561, 1398252058, 1, 'Andrejs', 'Ovcinnikovs', NULL, '27770074'),
(4, 'P虔', 'testuser', 'eeb4c2de36fa7a22fc959850f25fb6679c2de698', NULL, 'testuser@test.lv', NULL, NULL, NULL, NULL, 1397719438, 1397719449, 1, 'Uservārds', 'Useruzvārds', NULL, '21487941723');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(8, 3, 2),
(9, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `uzskaite`
--

CREATE TABLE IF NOT EXISTS `uzskaite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datums` date NOT NULL,
  `datums_lidz` date NOT NULL,
  `darbinieks` int(11) NOT NULL,
  `sadala` int(11) NOT NULL,
  `klients` int(11) NOT NULL,
  `lieta` int(11) NOT NULL,
  `apraksts` text COLLATE utf8_unicode_ci NOT NULL,
  `time` decimal(10,2) NOT NULL DEFAULT '0.00',
  `piezimes` text COLLATE utf8_unicode_ci NOT NULL,
  `papildus_izmaksas` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `uzskaite`
--

INSERT INTO `uzskaite` (`id`, `datums`, `datums_lidz`, `darbinieks`, `sadala`, `klients`, `lieta`, `apraksts`, `time`, `piezimes`, `papildus_izmaksas`) VALUES
(1, '2014-04-07', '0000-00-00', 3, 4, 3, 2, '', '2.00', '', '7.00'),
(2, '2014-04-07', '0000-00-00', 3, 1, 2, 1, 'dfgdfgdf\r\n', '2.00', 'dfgdfgdfgd\r\n', '7.00'),
(4, '2014-04-08', '0000-00-00', 1, 2, 2, 1, 'gfdghjdfkgfdgdf\r\n', '5.00', 'Some text\r\n', '15.00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
