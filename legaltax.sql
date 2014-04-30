-- phpMyAdmin SQL Dump
-- version 3.3.2deb1ubuntu1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 30, 2014 at 08:30 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `reg_nr`, `adress`, `phone`, `email`, `person`) VALUES
(2, 'Web Skola', '165646513546', 'Kr.Barona iela 32-8, Riga, LV-1011', '27770074', 'info@webskola.lv', 'Nikita Seleckis'),
(3, 'SIA JADA', 'LV40103423293', 'Kr.Barona iela 32-8, Riga, LV-1011', '+37127770074', '', 'Janis Dabins'),
(5, 'SIA AXIOMA', 'LV40103423293', 'Kr.Barona iela 32-8, Riga, LV-1011', '27770074', 'info@estrista.com', 'Nikita Seleckis'),
(6, 'fwfwefw', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `clients_dump`
--

CREATE TABLE IF NOT EXISTS `clients_dump` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reg_nr` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `person` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `clients_dump`
--

INSERT INTO `clients_dump` (`id`, `name`, `reg_nr`, `adress`, `phone`, `email`, `person`) VALUES
(2, 'Web Skola', '165646513546', 'Kr.Barona iela 32-8, Riga, LV-1011', '27770074', 'info@webskola.lv', 'Nikita Seleckis'),
(3, 'SIA JADA', 'LV40103423293', 'Kr.Barona iela 32-8, Riga, LV-1011', '+37127770074', '', 'Janis Dabins'),
(4, 'SIA testaklients', '24543543543', '', '', '', ''),
(5, 'SIA AXIOMA', 'LV40103423293', 'Kr.Barona iela 32-8, Riga, LV-1011', '27770074', 'info@estrista.com', 'Nikita Seleckis'),
(6, 'fwfwefw', '', '', '', '', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `rek_nr`, `rek_datums`, `piegadatajs`, `klients`, `kopa`, `pvn`, `sum_kopa`, `no`, `lidz`, `pamats`, `apmaksas_type`, `apmaksas_termins`, `valde`, `tips`, `status`) VALUES
(2, '5653653515544', '2014-04-28', 0, 2, '0.00', '0.00', '0.00', '2014-04-29', '2014-04-30', '', '', '', 'E.Krauklis', 1, 1),
(3, '56', '2014-04-28', 0, 3, '0.00', '0.00', '0.00', '2014-04-10', '2014-04-18', '', '', '', 'E.Krauklis', 2, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `invoice_data`
--

INSERT INTO `invoice_data` (`id`, `id_invoice`, `nr`, `lieta`, `datums`, `datums_lidz`, `apraksts`, `type`, `time`, `cena`, `sum`, `date`) VALUES
(2, 0, 1, 'Documentations sagatavošana', '2014-04-28', '0000-00-00', 'aaa', 'stunda', 2, '7.00', '14.00', '2014-04-28'),
(3, 0, 2, 'Documentations sagatavošana', '2014-04-28', '0000-00-00', 'bbbb', 'stunda', 4, '7.00', '24.50', '2014-04-28'),
(4, 0, 1, 'Documentations sagatavošana', '2014-04-28', '0000-00-00', 'aaa', 'stunda', 2, '0.00', '0.00', '2014-04-28'),
(5, 0, 2, 'Documentations sagatavošana', '2014-04-28', '0000-00-00', 'bbbb', 'stunda', 4, '0.00', '0.00', '2014-04-28'),
(6, 0, 1, 'Documentations sagatavošana', '2014-04-28', '0000-00-00', 'aaa', 'stunda', 2, '0.00', '0.00', '2014-04-28'),
(7, 0, 2, 'Documentations sagatavošana', '2014-04-28', '0000-00-00', 'bbbb', 'stunda', 4, '0.00', '0.00', '2014-04-28'),
(8, 0, 1, 'Juridiskie pakalpojumi', '0000-00-00', '0000-00-00', '', 'stunda', 6, '7.00', '38.50', '2014-04-28'),
(9, 0, 1, 'Juridiskie pakalpojumi', '0000-00-00', '0000-00-00', '', 'stunda', 6, '23.00', '126.50', '2014-04-28'),
(10, 0, 1, 'Documentations sagatavošana', '2014-04-28', '0000-00-00', 'Izdarīju to un to', 'stunda', 4, '0.00', '0.00', '2014-04-29');

-- --------------------------------------------------------

--
-- Table structure for table `lieta`
--

CREATE TABLE IF NOT EXISTS `lieta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `info` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `lieta`
--

INSERT INTO `lieta` (`id`, `name`, `info`) VALUES
(2, 'testa lieta', '<p>aaa</p>\n');

-- --------------------------------------------------------

--
-- Table structure for table `lieta_dump`
--

CREATE TABLE IF NOT EXISTS `lieta_dump` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `info` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `lieta_dump`
--

INSERT INTO `lieta_dump` (`id`, `name`, `info`) VALUES
(1, 'Documentations sagatavošana', '<p>Blalalalala</p>\n'),
(2, 'testa lieta', '<p>aaa</p>\n');

-- --------------------------------------------------------

--
-- Table structure for table `prioritate`
--

CREATE TABLE IF NOT EXISTS `prioritate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `prioritate`
--

INSERT INTO `prioritate` (`id`, `name`) VALUES
(3, 'Augsta'),
(4, 'Normāla');

-- --------------------------------------------------------

--
-- Table structure for table `prioritate_dump`
--

CREATE TABLE IF NOT EXISTS `prioritate_dump` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `prioritate_dump`
--

INSERT INTO `prioritate_dump` (`id`, `name`) VALUES
(1, 'Normala'),
(2, 'feefef'),
(3, 'Augsta'),
(4, 'Normāla');

-- --------------------------------------------------------

--
-- Table structure for table `sadala`
--

CREATE TABLE IF NOT EXISTS `sadala` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sadala`
--

INSERT INTO `sadala` (`id`, `name`) VALUES
(3, 'Klienti');

-- --------------------------------------------------------

--
-- Table structure for table `sadala_dump`
--

CREATE TABLE IF NOT EXISTS `sadala_dump` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sadala_dump`
--

INSERT INTO `sadala_dump` (`id`, `name`) VALUES
(1, 'Clienti'),
(2, 'ggr'),
(3, 'Klienti');

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
(2, 'Pabeigts'),
(5, 'Aktīvs');

-- --------------------------------------------------------

--
-- Table structure for table `status_dump`
--

CREATE TABLE IF NOT EXISTS `status_dump` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `status_dump`
--

INSERT INTO `status_dump` (`id`, `name`) VALUES
(1, 'Aktivs'),
(2, 'Pabeigts'),
(3, 'Test'),
(4, 'www'),
(5, 'Aktīvs');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `sadala`, `klients`, `lieta`, `uzdevums`, `izpildes_gaita`, `status`, `prioritate`, `privats`, `termins`, `add_date`) VALUES
(1, 'Tsest ', 1, 3, 1, '<p>Blalalalalla</p>\n', '<p>sdggdg</p>\n <table border="1" cellpadding="1" cellspacing="1" >\n <tbody>\n  <tr>\n   <td>wewe</td>\n   <td>erwt</td>\n  </tr>\n  <tr>\n   <td>&nbsp;</td>\n   <td>&nbsp;</td>\n  </tr>\n  <tr>\n   <td>&nbsp;</td>\n   <td>&nbsp;</td>\n  </tr>\n </tbody>\n</table>\n\n<p>&nbsp;</p>\n', 1, 1, 'Yes', '2014-04-23', '2014-04-27'),
(2, 'Uzdevuma nosaukums', 0, 3, 0, '<p>&Scaron;is ir uzdevums!</p>\n\n<table border="1" cellpadding="1" cellspacing="1">\n <tbody>\n  <tr>\n   <td>&nbsp;</td>\n   <td>&nbsp;</td>\n  </tr>\n  <tr>\n   <td>&nbsp;</td>\n   <td>&nbsp;</td>\n  </tr>\n  <tr>\n   <td>&nbsp;</td>\n   <td>&nbsp;</td>\n  </tr>\n </tbody>\n</table>\n\n<p>&nbsp;</p>\n', '', 0, 0, 'Yes', '2014-04-30', '2014-04-28'),
(3, 'uzdevums3', 0, 2, 0, '<p>sis ir uzdevuma teksts</p>\n', '<p>hohohhohoh</p>\n', 2, 0, 'Yes', '2014-04-29', '2014-04-28'),
(4, 'Brauciens ar velosipadi', 3, 5, 2, '<p>Hohohoho</p>\n', '', 5, 3, 'Yes', '2014-04-29', '2014-04-29'),
(5, 'Brauciens ar velosipadi', 3, 6, 2, '<p>hooooo</p>\n', '', 5, 4, 'Yes', '2014-04-29', '2014-04-29');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=45 ;

--
-- Dumping data for table `task_users`
--

INSERT INTO `task_users` (`id`, `task_id`, `user_id`, `type`) VALUES
(33, 3, 1, 2),
(34, 2, 10, 2),
(35, 2, 3, 1),
(36, 2, 1, 1),
(41, 4, 10, 2),
(42, 4, 3, 1),
(43, 5, 10, 2),
(44, 5, 3, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '\0\0', 'administrator', '06470a0fe8139b6ee44c4cc12af6fc03444c0f7e', '9462e8eee0', 'admin@admin.com', '', NULL, NULL, '9d029802e28cd9c768e8e62277c0df49ec65c48c', 1268889823, 1398832971, 1, 'Admin', 'Adminovich1', 'ADMIN', '27770074'),
(3, '\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0', 'kirgudu123', '70177d2aae502613d98a2256ffd9d69b1809bf6c', NULL, 'kirgudu12@gmail.com', NULL, NULL, NULL, NULL, 1395402561, 1398252058, 1, 'Andrejs', 'Ovcinnikovs', NULL, '27770074'),
(10, 'W�K', 'test', 'ab88a83726565688a23448be29c79017ad140da4', NULL, 'test@test.lv', NULL, NULL, NULL, NULL, 1398619349, 1398771249, 1, 'test', 'Test', NULL, '25648564');

-- --------------------------------------------------------

--
-- Table structure for table `users_dump`
--

CREATE TABLE IF NOT EXISTS `users_dump` (
  `id` int(11) unsigned NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_dump`
--

INSERT INTO `users_dump` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '\0\0', 'administrator', '06470a0fe8139b6ee44c4cc12af6fc03444c0f7e', '9462e8eee0', 'admin@admin.com', '', NULL, NULL, '9d029802e28cd9c768e8e62277c0df49ec65c48c', 1268889823, 1398602195, 1, 'Admin', 'Adminovich1', 'ADMIN', '27770074'),
(3, '\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0', 'kirgudu123', '70177d2aae502613d98a2256ffd9d69b1809bf6c', NULL, 'kirgudu12@gmail.com', NULL, NULL, NULL, NULL, 1395402561, 1398252058, 1, 'Andrejs', 'Ovcinnikovs', NULL, '27770074'),
(9, 'W�K', 'administrator1', 'b53d2ca1b4e9fdcdf70e2c5f1dd3ea568f2b27e2', NULL, 'info@estrista.com', NULL, NULL, NULL, NULL, 1398619014, 1398619014, 1, 'Admin', 'Adminovich1', NULL, '25648564'),
(10, 'W�K', 'test', 'ab88a83726565688a23448be29c79017ad140da4', NULL, 'test@test.lv', NULL, NULL, NULL, NULL, 1398619349, 1398619349, 1, 'test', 'Test', NULL, '25648564'),
(11, 'Qƍ�', 'dasafff', '6fc7bf044c450e1354552ed498052bbd01543baf', NULL, 'ddas@sddsd.er', NULL, NULL, NULL, NULL, 1398698639, 1398698639, 1, 'fsfdsf', 'sdfdsfsd', NULL, '24234');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(8, 3, 2),
(15, 10, 2);

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
(2, '2014-04-28', '0000-00-00', 10, 1, 3, 1, 'Izdarīju to un to', '4.00', 'šīs ir piezīmes', '230.00'),
(3, '2014-04-28', '0000-00-00', 10, 1, 2, 1, 'aaa', '2.00', '', '0.00'),
(4, '2014-04-28', '0000-00-00', 10, 1, 2, 1, 'bbbb', '3.50', '', '0.00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
